<?php

class GroupLessonsAction
{
    public static function getGroupInfo()
    {
        if (isset($_GET['group_id']) && !empty($_GET['group_id'])) {

            if (!($_GET['group_id'] = intval($_GET['group_id'])) && !($_GET['group_id'] > 0)) {
                return '';
            }

            $lessons = GroupLessonsTable::get_all_lessons_by_group($_GET['group_id']);
            $students = GroupLessonsTable::get_student_by_group($_GET['group_id']);
            return ['lessons' => $lessons, 'students' => $students];
        } else {
            return null;
        }
    }
}