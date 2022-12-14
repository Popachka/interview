<?php

class GroupLessonsTable
{

    public static function create()
    {
    }

    public static function get_all_lessons_by_group($group_id)
    {
        $mysqli = Database::GetConnection();
        $result = $mysqli->query("SELECT lessons.name as lesson, lessons.id
                                FROM `groups_lessons`
                                inner join lessons on groups_lessons.lesson_id = lessons.id
                                WHERE `group_id` = '$group_id'");
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public static function get_all_groups()
    {
        $mysqli = Database::GetConnection();
        $result = $mysqli->query("SELECT `id`,`name` FROM `groups`");
        return $result;
    }
    public static function get_student_by_group($group_id)
    {
        $mysqli = Database::GetConnection();
        $result = $mysqli->query("SELECT full_name as name , id                              
                                FROM `students`
                                WHERE group_id = '$group_id' 
                                ");
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public static function get_score_by_student_and_by_lesson($student_id, $lesson_id)
    {
        $mysqli = Database::GetConnection();
        $result = $mysqli->query("SELECT `score`                             
                                FROM `scores`
                                inner join lessons on scores.lesson_id = lessons.id
                                WHERE student_id = '$student_id' AND lesson_id = '$lesson_id'
                                ");
        $result = $result->fetch_assoc();
        return $result;
    }
    public static function get_scores_by_student($student_id)
    {
        $mysqli = Database::GetConnection();
        $result = $mysqli->query("SELECT lesson_id, score FROM scores                
                                WHERE student_id = '$student_id'
        ");
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public static function get_info_by_group($group_id)
    {
        $mysqli = Database::GetConnection();
        $result = $mysqli->query("SELECT lessons.name as lesson_name,
                                         lessons.id as lesson_id,
                                         students.id as student_id,
                                         students.full_name as student_name,
                                         scores.score as score_value
                                         
                                FROM `groups_lessons`
                                inner join lessons on groups_lessons.lesson_id = lessons.id
                                inner join students on groups_lessons.group_id = students.group_id
                                RIGHT join scores on students.id = scores.student_id AND lessons.id = scores.lesson_id
                                WHERE groups_lessons.group_id = '$group_id'
        
        ");
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}