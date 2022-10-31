<?php
class GroupActions
{
    public static function updateGroup()
    {
        if (isset($_POST['update-group_name']) && !empty($_POST['update-group_name'])) {

            $name = GroupLogic::validate_name($_POST['update-group_name']);

            GroupTable::update($name, $_POST['group_id']);
        } else {
            return null;
        }
    }
    public static function addGroup()
    {
        if (isset($_POST['add-group_name']) && !empty($_POST['add-group_name'])) {

            $name = GroupLogic::validate_name($_POST['add-group_name']);

            GroupTable::add($name);
        } else {
            return null;
        }
    }
    public static function delGroup()
    {
        if (isset($_POST['del-id']) && !empty($_POST['del-id'])) {
            GroupTable::delete($_POST['del-id']);
        } else {
            return null;
        }
    }
}