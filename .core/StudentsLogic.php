<?php

class StudentsLogic
{

    public static function validate_name($name)
    {
        $name = strip_tags($name);
        return $name;
    }
}