<?php


namespace Xorinzor\Shoutzor\App\FormBuilder\Fields;

use Xorinzor\Shoutzor\App\FormBuilder\Fields\FormField;

/**
 * Select field for the form generator
 * meant for <select />
 */
class SelectField extends FormField {

    private $options;
    private $multiple;

    public function __construct($id, $name, $title, $type, $value = '', $options = array(), $multiple = false, $description = '', $classes = '', $attributes = '', $template = 'template.php')
    {
        $this->id = $id;
        $this->setName($name);
        $this->setTitle($title);
        $this->setValue($value);
        $this->setOptions($options);
        $this->setMultiple($multiple);
        $this->setDescription($description);
        $this->setClasses($classes);
        $this->setAttributes($attributes);
        $this->setTemplate($template);
    }

    public function getOptions() {
        return $this->options;
    }

    public function getMultiple() {
        return $this->multiple;
    }

    public function setOptions($options) {
        $this->options = $options;
    }

    public function setMultiple($multiple) {
        $this->multiple = $multiple;
    }

    public function render() {
        $multiple = ($this->getMultiple() === true) ? 'multiple' : '';
        $content = '<select class="'. $this->getClasses() .'" name="'. $this->getName() .'" id="'. $this->getId() .'" '. $multiple .' '. $this->getAttributes() .' />';

        foreach($this->getOptions() as $option) {
            $selected = ($this->getValue() == $option['value']) ? 'selected' : '';
            $content .= '<option value="'. $option['value'] .'" ' . $selected . '>' . $option['title'] . '</option>';
        }

        $content .= '</select>';

        if(!empty($this->getDescription())) {
            $content .= ' <p class="uk-form-help-block">'. $this->getDescription() .'</p>';
        }

        if(!empty($this->getValidationError())) {
            $content .= ' <p class="uk-text-danger">'. $this->getValidationError() .'</p>';
        }

        if(!empty($this->getValidationSuccess())) {
            $content .= ' <p class="uk-text-success">'. $this->getValidationSuccess() .'</p>';
        }

        $data = array(
            "%id%" => $this->getId(),
            "%title%" => $this->getTitle(),
            "%content%" => $content
        );

        return $this->parseTemplate($data);
    }

}
