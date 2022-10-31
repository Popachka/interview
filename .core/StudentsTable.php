<?php

class StudentsTable
{
    public static function create($group_id, $full_name)
    {
        $mysqli = Database::GetConnection();
        if ($q = $mysqli->prepare('INSERT INTO students (group_id,full_name) VALUES (?,?)')) {
            $q->bind_param("ss", $group_id, $full_name);
            $q->execute();
            $q->close();
        } else {
            $q->close();
        }
    }
    public static function update($student_id, $new_score, $lesson_id)
    {
        $mysqli = Database::GetConnection();
        $mysqli->query("DELETE FROM `scores` WHERE student_id = '$student_id' AND lesson_id = '$lesson_id' ");
        if ($q = $mysqli->prepare('INSERT INTO `scores` (student_id,lesson_id,score) VALUES (?,?,?)')) {
            $q->bind_param("sss", $student_id, $lesson_id, $new_score);
            $q->execute();
            $q->close();
        } else {
            $q->close();
        }
        // $mysqli->query("UPDATE `scores` SET score = '$new_score' WHERE student_id = '$student_id' AND lesson_id = '$lesson_id'");
    }
    public static function get_students()
    {
        $mysqli = Database::GetConnection();
        $result = $mysqli->query("SELECT id,full_name FROM students");
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public static function del_student_by_id($id)
    {
        $mysqli = Database::GetConnection();
        $mysqli->query("DELETE FROM `scores` WHERE `student_id` = '$id'");
        $mysqli->query("DELETE FROM `students` WHERE `id` = '$id'");
    }
}