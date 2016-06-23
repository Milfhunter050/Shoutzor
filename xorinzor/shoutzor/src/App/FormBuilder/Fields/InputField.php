<?php


namespace Xorinzor\Shoutzor\App\FormBuilder\Fields;

use Xorinzor\Shoutzor\App\FormBuilder\Fields\FormField;

/**
 * Input field for the form generator
 * meant for <input /> with type:
 * text, password, search, hidden, button, submit and reset
 */
class InputField extends FormField {

    private $type;

    public function __construct($id, $name, $title, $type, $value = '', $description = '', $classes = '', $template = 'template.php')
    {
        $this->id = $id;
        $this->setName($name);
        $this->setTitle($title);
        $this->setType($type);
        $this->setValue($value);
        $this->setDescription($description);
        $this->setClasses($classes);
        $this->setTemplate($template);
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function render() {

        $content = '<input class="'. $this->getClasses() .'" type="'. $this->getType() .'" value="'. $this->getValue() .'" name="'. $this->getName() .'" id="'. $this->getId() .'" />';

        if(!empty($this->getDescription())) {
            $content .= ' <p class="uk-form-help-block">'. $this->getDescription() .'</p>';
        }

        if(!empty($this->getValidationError())) {
            $content .= ' <p class="uk-text-danger">'. $this->getValidationError() .'</p>';
        }

        $data = array(
            "%id%" => $this->getId(),
            "%title%" => $this->getTitle(),
            "%content%" => $content
        );

        return $this->parseTemplate($data);
    }

}
