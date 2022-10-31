<?php
class LessonsActions
{
    public static function updateLesson()
    {
        if (isset($_POST['update-lesson_name']) && !empty($_POST['update-lesson_name'])) {

            $name = LessonsLogic::validate_name($_POST['update-lesson_name']);

            LessonsTable::update($name, $_POST['lesson_id']);
        } else {
            return null;
        }
    }
    public static function addLesson()
    {
        if (isset($_POST['add-lesson_name']) && !empty($_POST['add-lesson_name'])) {

            $name = LessonsLogic::validate_name($_POST['add-lesson_name']);

            LessonsTable::add($name);
        } else {
            return null;
        }
    }
    public static function delLesson()
    {
        if (isset($_POST['del-id']) && !empty($_POST['del-id'])) {
            LessonsTable::delete($_POST['del-id']);
        } else {
            return null;
        }
    }
    public static function link()
    {
        if (isset($_POST['link-group_id']) && !empty($_POST['link-group_id']) && isset($_POST['link-lesson_id']) && !empty($_POST['link-lesson_id'])) {

            $lesson_id = $_POST['link-lesson_id'];
            $group_id = $_POST['link-group_id'];

            LessonsTable::link_lesson_with_group($group_id, $lesson_id);
        } else {
            return null;
        }
    }
    public static function unlink()
    {
        if (!empty($_POST['unlink-group_id']) && !empty($_POST['unlink-lesson_id'])) {
            $lesson_id = $_POST['unlink-lesson_id'];
            $group_id = $_POST['unlink-group_id'];
            LessonsTable::unlink_lesson_with_group($group_id, $lesson_id);
        } else {
            return null;
        }
    }
}