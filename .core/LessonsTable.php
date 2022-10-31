<?php

class LessonsTable
{
    public static function get_lessons()
    {
        $mysqli = Database::GetConnection();
        $result = $mysqli->query("SELECT `id`,`name` FROM `lessons`");
        $result = $result->fetch_all(MYSQLI_ASSOC);

        return $result;
    }

    public static function update($new_name, $id)
    {
        $mysqli = Database::GetConnection();
        $sql = "UPDATE `lessons` SET `name` = ? WHERE `id` = '$id'";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $new_name);
        $stmt->execute();
    }
    public static function add($name)
    {
        $mysqli = Database::GetConnection();
        $sql = "INSERT INTO  `lessons` (name) VALUES (?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $name);
        $stmt->execute();
    }
    public static function delete($id)
    {
        $mysqli = Database::GetConnection();
        $mysqli->query("DELETE FROM `groups_lessons` WHERE `lesson_id` = '$id'");
        $mysqli->query("DELETE FROM `lessons` WHERE `id` = '$id'");
    }
    public static function link_lesson_with_group($group_id, $lesson_id)
    {
        $mysqli = Database::GetConnection();
        $mysqli->query("DELETE FROM `groups_lessons` WHERE `group_id` = $group_id AND `lesson_id` = $lesson_id");
        $sql = "REPLACE INTO  `groups_lessons` (group_id,lesson_id) VALUES (?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ss', $group_id, $lesson_id);
        $stmt->execute();
    }
    public static function unlink_lesson_with_group($group_id, $lesson_id)
    {
        $mysqli = Database::GetConnection();
        $sql = "DELETE FROM `groups_lessons` WHERE `group_id` = '$group_id' AND `lesson_id` = '$lesson_id'";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
    }
}