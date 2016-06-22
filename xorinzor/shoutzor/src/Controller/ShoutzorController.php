<?php

namespace Xorinzor\Shoutzor\Controller;

use Pagekit\Application as App;

/**
 * @Access(admin=true)
 */
class ShoutzorController
{
    public function indexAction()
    {
        return [
            '$view' => [
                'title' => __('Shoutzor Settings'),
                'name'  => 'shoutzor:views/admin/shoutzor.php'
            ],
            '$data' => [
                'config' => App::module('shoutzor')->config()
            ]
        ];
    }
}
