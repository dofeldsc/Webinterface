<?php

class Input {
    public static function get($item) {
        if (isset($_POST[$item])) {
            return $_POST[$item];
        } else if (isset($_GET[$item])) {
            return $_GET[$item];
        } else if (isset($_FILES[$item])) {
            if(!empty($_FILES[$item]['name'])) {
                return $_FILES[$item];
            }
        }
        return '';
    }
    
    public static function has($type = 'post') {
        switch ($type) {
            case 'post':
                return (!empty($_POST)) ? true : false;
                break;
            case 'get':
                return (!empty($_GET)) ? true : false;
                break;
            default:
                return false;
                break;
        }
    }

    public static function exists($item) {
        if (isset($_POST[$item])) {
            return true;
        } else if (isset($_GET[$item])) {
            return true;
        } else if (isset($_FILES[$item])) {
            if(!empty($_FILES[$item]['name'])) {
                return true;
            }
        }
        return false;
    }
}