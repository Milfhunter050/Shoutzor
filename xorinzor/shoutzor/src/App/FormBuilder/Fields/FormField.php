<?php

namespace Xorinzor\Shoutzor\App\FormBuilder\Fields;

abstract class FormField {

    protected $id;
    protected $name;
    protected $title;
    protected $value;
    protected $description;
    protected $classes;
    protected $attributes;
    protected $template;

    protected $validation_type = null;
    protected $validation_requirements = array();
    protected $validation_error = '';
    protected $validation_success = '';

    public function __construct($id, $name, $title, $value = '', $description = '', $classes = '', $attributes = '', $template = 'template.php')
    {
        $this->id = $id;
        $this->setName($name);
        $this->setTitle($title);
        $this->setValue($value);
        $this->setDescription($description);
        $this->setClasses($classes);
        $this->setAttributes($attributes);
        $this->setTemplate($template);
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getValue() {
        return $this->value;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getClasses() {
        return $this->classes;
    }

    public function getAttributes() {
        return $this->attributes;
    }

    public function getTemplate() {
        return $this->template;
    }

    public function getValidationType() {
        return $this->validation_type;
    }

    public function getValidationRequirements() {
        return $this->validation_requirements;
    }

    public function getValidationError() {
        return $this->validation_error;
    }

    public function getValidationSuccess() {
        return $this->validation_success;
    }

    /**
     * Sets the name of the currently selected field
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Sets the title of the currently selected field
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * Sets the value of the currently selected field
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    /**
     * Sets the description of the currently selected field
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Sets the classes of the currently selected field
     */
    public function setClasses($classes) {
        $this->classes = $classes;
        return $this;
    }

    /**
    * Sets extra attributes of the currently selected field
     */
    public function setAttributes($attributes) {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * Sets the template to use for rendering this field
     */
    public function setTemplate($template) {
        $this->template = $template;
        return $this;
    }

    public function setValidationType($type) {
        $this->validation_type = $type;
        return $this;
    }

    public function setValidationRequirements($requirements) {
        if(!is_array($requirements)) {
            $requirements = array($requirements);
        }

        $this->validation_requirements = $requirements;
        return $this;
    }

    public function setValidationError($error) {
        $this->validation_error = $error;
        return $this;
    }

    public function setValidationSuccess($success) {
        $this->validation_success = $success;
        return $this;
    }

    /**
     * Parses the template with the provided data
     * Returns the output html
     */
    protected function parseTemplate($data) {
        return str_replace(array_keys($data), array_values($data), file_get_contents(__DIR__ . '/' . $this->template));
    }

    /**
     * The render method has to be implemented by the extending classes
     */
    abstract public function render();
}
