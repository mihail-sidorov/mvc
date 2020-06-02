<?php

namespace App;

class Validator

{

    public $errors;

    public function validate($rules, $params)

    {

        $this->errors = [];
        foreach ($rules as $name_field => $rule) {
            if (isset($params[$name_field])) {
                foreach (explode('|', $rule) as $name_rule) {
                    if ($name_rule === 'requare') {
                        if ($params[$name_field] === '') {
                            $this->errors[$name_field] = "Поле обязательно для заполнения";
                            break;
                        }
                    }

                    if ($name_rule === 'email') {
                        $rusChars = 'абвгдеёжзийклмнопрстуфхцчшщьыъэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯ';
                        if (!preg_match('/^(['.$rusChars.'a-zA-Z0-9_\.-])+@['.$rusChars.'a-zA-Z0-9-]+[\.]+(['.$rusChars.'a-zA-Z]{2,6}\.)?['.$rusChars.'a-z]{2,6}$/u', $params[$name_field])) {
                            $this->errors[$name_field] = "Поле не валидно";
                            break;
                        }
                    }
                }
            }
        }

        if (count($this->errors) > 0) {
            return false;
        }
        else {
            return true;
        }

    }

}