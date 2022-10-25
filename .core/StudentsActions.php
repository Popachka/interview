<?php

class StudentsActions
{

    public static function create_student()
    {

        if ('POST' != $_SERVER['REQUEST_METHOD']) {
            return [];
        }

        $errors = [];

        // Валидация StudentsLogic
        $name = StudentsLogic::validate_name($_POST['student_name']);
        //...

        StudentsTable::create($_POST['student_group'], $name);
    }
}