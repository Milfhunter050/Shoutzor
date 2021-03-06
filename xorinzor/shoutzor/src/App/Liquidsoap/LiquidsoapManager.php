<?php

namespace Xorinzor\Shoutzor\App\Liquidsoap;

use Pagekit\Application as App;
use Exception;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class LiquidsoapManager {

    //The directory where our liquidsoap files and scripts are located
    private $liquidsoapDirectory;
    private $pidFileDirectory;
    private $socketPath;
    private $wrapperConnection;
    private $shoutzorConnection;
    private $validTypes = array('wrapper', 'shoutzor');

    public function __construct() {
        $config = App::module('shoutzor')->config();

        $this->socketPath = $config['liquidsoap']['socketPath'];

        $this->liquidsoapDirectory = realpath($config['root_path'] . '/../shoutzor-requirements/liquidsoap/') . '/';
        $this->pidFileDirectory = $config['liquidsoap']['pidFileDirectory'];

        //Default values
        $this->wrapperConnection = null;
        $this->shoutzorConnection = null;

        try {
            $this->wrapperConnection = new LiquidsoapCommunicator($this->socketPath . '/wrapper');
            $this->shoutzorConnection = new LiquidsoapCommunicator($this->socketPath . '/shoutzor');
        } catch(Exception $e) {
            //One of the connections is down
        }
    }

    public function __destruct() {
    }

    /**
     * Makes sure the requested connection is valid and connected
     * returns false if something is wrong
     */
    private function getConnection($type) {
        if($type == 'wrapper' && $this->wrapperConnection !== null)
        {
            return $this->wrapperConnection;
        }
        elseif($type == 'shoutzor' && $this->shoutzorConnection !== null)
        {
            return $this->shoutzorConnection;
        }
        else
        {
            return false;
        }
    }

    public function help($type) {
        if($conn = $this->getConnection($type)) {
            return $conn->command('help');
        } else {
            return false;
        }
    }

    public function setVolume($type, $volume) {
        if($conn = $this->getConnection($type)) {
            return $conn->command('sound.volume 0 '.$volume);
        } else {
            return false;
        }
    }

	public function nextTrack() {
        if($conn = $this->getConnection('shoutzor')) {
            return $conn->command('shoutzorqueue.skip');
        } else {
            return false;
        }
    }

    public function queueTrack($filename) {
        if($conn = $this->getConnection('shoutzor')) {
            return $conn->command('shoutzorqueue.push replay_gain:'.$filename);
        } else {
            return false;
        }
    }

    public function remaining() {
        if($conn = $this->getConnection('shoutzor')) {
            $res = $conn->command('shoutzor.remaining');
            if(is_array($res)) {
                return array_filter($res);
            }

            return $res;
        } else {
            return false;
        }
    }

    public function isUp($type) {
        if($conn = $this->getConnection($type)) {
            return $conn->command('uptime');
        } else {
            return false;
        }
    }

    public function command($type, $command) {
        if($conn = $this->getConnection($type)) {
            return $conn->command($command);
        } else {
            return false;
        }
    }

    public function startScript($type) {
        if(in_array($type, $this->validTypes) === false) {
            return false;
        }

        if($this->isUp($type) !== false) {
            return true;
        }

        if(file_exists($this->socketPath . '/' . $type)) {
            return true;
        }

        $process = new Process("cd $this->liquidsoapDirectory && HOME=". $this->socketPath ."/ liquidsoap -d $type.liq &");
        $process->run();

        //Sleep a few seconds to give the script time to boot up
        sleep(2);

        //Reinitialize our connection to the socket for the type of script
        try {
            $this->{$type . "Connection"} = new LiquidsoapCommunicator($this->socketPath . '/' . $type);

            if($type == 'shoutzor') {
                $this->command('shoutzor', 'sound.select 0 true');
            }
        } catch(Exception $e) {
            //The socket isn't up yet apparently
        }

        return true;
    }

    public function stopScript($type) {
        if(in_array($type, $this->validTypes) === false) {
            return false;
        }

        if($this->isUp($type) === false) {
            return true;
        }

        //Close the screen session
        $process = new Process("kill -TERM `cat " . $this->pidFileDirectory . $type . ".pid` &");
        $process->run();

        sleep(2);

        //Remove any potential remaining socket files
        if(file_exists($this->socketPath . '/shoutzor')) {
            unlink($this->socketPath . '/shoutzor');
        }

        return true;
    }

    public function getPidFileDirectory() {
        return $this->pidFileDirectory;
    }

    public function getLiquidsoapDirectory() {
        return $this->liquidsoapDirectory;
    }

    public function generateConfigFile($values) {
        //Add a header to the config file
        $new_config  = "#\n";
        $new_config .= "# DO NOT MANUALLY EDIT THIS FILE - THIS FILE IS AUTOMATICALLY GENERATED \n";
        $new_config .= "# GENERATED AT: ".date("d-m-Y H:i:s")." (UTC) \n";
        $new_config .= "#\n\n";

        //Replace the fields in the template with their respective values
        $new_config .= str_replace(
                            array_keys($values),
                            array_values($values),
                            file_get_contents($this->liquidsoapDirectory . 'config.template'));

        //Save the config data
        file_put_contents($this->liquidsoapDirectory . 'config.liq', $new_config);
    }
}
