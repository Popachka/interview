<?php

class StudentsActions
{

    public static function create_student()
    {

        if ('POST' != $_SERVER['REQUEST_METHOD']) {
            return [];
        }
        if ($_POST['cmd'] != 'add') {
            return [];
        }
        $errors = [];

        // Валидация StudentsLogic
        $name = StudentsLogic::validate_name($_POST['student_name']);
        //...

        StudentsTable::create($_POST['student_group'], $name);
    }
    public static function get_students_by_group()
    {
        if (isset($_GET['group_id']) && !empty($_GET['group_id'])) {

            if (!($_GET['group_id'] = intval($_GET['group_id'])) && !($_GET['group_id'] > 0)) {
                return '';
            }
            $_SESSION['group'] = $_GET['group_id'];
            $items = GroupLessonsTable::get_student_by_group($_GET['group_id']);
            $students = [];
            $i = 0;
            foreach ($items as $item) {
                array_push($students, [
                    ['name' => $item['name']],
                    ['id' => $item['id']]
                ]);
            }

            return $students;
        } else {
            return null;
        }
    }
    public static function DelObj()
    {
        if ('POST' != $_SERVER['REQUEST_METHOD']) {
            return [];
        }
        if ($_POST['cmd'] != 'delete') {
            return [];
        }
        StudentsTable::del_student_by_id($_POST['id']);
    }
    public static function update_scores()
    {
        if ('POST' != $_SERVER['REQUEST_METHOD']) {
            return [];
        }
        if ($_POST['cmd'] != 'update') {
            return [];
        }
        //Валидация $_POST['']
        //...
        $list = [];

        foreach ($_POST as $key => $value) {
            if (preg_match("/update_lesson/", $key)) {
                // $key = 'update_lessons-13';
                $lesson_id = str_replace('update_lesson_', "", $key); // = 13 должно быть, а сейчас = 3. Надо чтобы он обрезал тут update_lesson- и оставил только 13
                foreach ($_POST as $j_key => $j_value) {
                    if (preg_match("/update_score/", $j_key)) {
                        $score_id = str_replace('update_score_', "", $j_key);
                        if ($lesson_id == $score_id) {
                            array_push(
                                $list,
                                [$lesson_id => $j_value],
                            );
                        }
                    }
                }
            }
            var_dump($list);
            // echo "<p>" . $key .  "=>" . $value . "</p>";
        }
        print_r($list);
        foreach ($list as $arr) {
            foreach ($arr as $key => $value) {
                if ($value == "") {
                    continue;
                }
                // echo "<p>" . $key .  "=>" . $value . "</p>";
                StudentsTable::update($_POST['update_student_id'], $value, $key);
            }
        }
    }
}