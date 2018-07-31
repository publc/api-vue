<?php

namespace App\Core;


class Validate
{

    protected $passed = false;

    protected $errors = array();

    public function check($source, $items = array())
    {
        $this->processItems($items);
        $source = (array) $source;

        foreach ($items as $item => $rules) {
            $value = $source[$item];
            $this->proccess($source, $item, $rules, $value);
        }

        if (empty($this->errors)) {
            $this->passed = true;
        }

        return $this;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function passed()
    {
        return $this->passed;
    }

    protected function processItems(&$items)
    {
        
        foreach ($items as $key => $item) {
            $items[$key] = explode('|', $item);

            $params = [];
            foreach ($items[$key] as $element) {
                $param = explode(':', $element);
                if (empty($param[1])) {
                    $params[$param[0]] = true;
                    continue;
                }
                $params[$param[0]] = $param[1];
                $items[$key] = $params;
            }
        }
    }

    protected function proccess($source, $item, $rules, $value)
    {
        foreach ($rules as $rule => $ruleValue) {
            switch ($rule) {
                case 'required':
                    $this->required($value, $item);
                    break;
                case 'min':
                    $this->min($value, $ruleValue, $item);
                    break;
                case 'max':
                    $this->max($value, $ruleValue, $item);
                    break;
                case 'matches':
                    $this->matches($value, $source, $ruleValue, $item);
                    break;
                case 'unique':
                    $this->unique($value, $ruleValue, $item);
                    break;
                case 'email':
                    $this->email($value, $item);
                    break;
            }
        }
    }

    protected function required($value, $item)
    {
        if (empty($value)) {
            $this->addError("{$item} is required");
            return;
        }
    }

    protected function min($value, $ruleValue, $item)
    {
        if (strlen($value) < $ruleValue) {
            $this->addError("{$item} must be a minimun of {$ruleValue} characters");
        }
    }

    protected function max($value, $ruleValue, $item)
    {
        if (strlen($value) > $ruleValue) {
            $this->addError("{$item} must be a maximum of {$ruleValue} characters");
        }
    }

    protected function matches($value, $source, $ruleValue, $item)
    {
        if ($value != $source[$ruleValue]) {
            $this->addError("{$item} must match {$ruleValue}");
        }
    }

    protected function unique($value, $ruleValue, $item)
    {

        $path = explode('->', $ruleValue);

        foreach ($path as &$param) {
            $param = ucwords($param);
        }

        $path = implode('\\', $path);

        $model = "\App\Http\Model\\" . $path;

        if (!class_exists($model)) {
            $this->addError("No model for this validation");
            return;
        }

        $model = new $model();
        
        $check = $model->find($item, $value);

        if (!is_null($check) || !empty($check)) {
            $this->addError("{$item} already exists");
        }
    }

    protected function email($value, $item)
    {
        $email = filter_var($value, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->addError("Invalid {$item}");
        }
    }

    protected function addError($error)
    {
        $this->errors[] = $error;
    }

    public function validateFile($params)
    {
        $files = $params->files;

        if (empty($files)) {
            return false;
        }

        $extentions = ['jpg', 'jpeg', 'png', 'svg'];

        foreach ($files as $file) {
            if ($file->error !== 0) {
                return false;
            }
            
            foreach ($extentions as $extention) {
                if (strpos($file->type, $extention)) {
                    return true;
                }
            }
        }
    }
}
