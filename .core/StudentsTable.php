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
    public static function get_students()
    {
        $mysqli = Database::GetConnection();
        $result = $mysqli->query("SELECT id,full_name FROM students");
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}