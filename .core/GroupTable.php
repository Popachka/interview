<?php
class GroupTable
{

    public static function update($new_name, $id)
    {
        $mysqli = Database::GetConnection();
        $sql = "UPDATE `groups` SET `name` = ? WHERE `id` = '$id'";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $new_name);
        $stmt->execute();
    }
    public static function add($name)
    {
        $mysqli = Database::GetConnection();
        $sql = "INSERT INTO  `groups` (name) VALUES (?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $name);
        $stmt->execute();
    }
    public static function delete($id)
    {
        $mysqli = Database::GetConnection();
        $mysqli->query("DELETE FROM `students` WHERE `group_id` = '$id'");
        $mysqli->query("DELETE FROM `groups_lessons` WHERE `group_id` = '$id'");
        $mysqli->query("DELETE FROM `groups` WHERE `id` = '$id'");
    }
}