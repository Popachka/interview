<?php

class GroupLessonsAction
{
    public static function getGroupInfo()
    {
        if (isset($_GET['group_id']) && !empty($_GET['group_id'])) {

            if (!($_GET['group_id'] = intval($_GET['group_id'])) && !($_GET['group_id'] > 0)) {
                return '';
            }
            $_SESSION['group_id'] = $_GET['group_id'];
            $lessons = GroupLessonsTable::get_all_lessons_by_group($_GET['group_id']);
            // $students = GroupLessonsTable::get_student_by_group($_GET['group_id']);

            $listLessons = [];
            foreach ($lessons as $item) {
                array_push($listLessons, [
                    ['name' => $item['lesson']],
                    ['id' => $item['id']]
                ]);
            }

            return $listLessons;
        } else {
            return null;
        }
    }
    public static function getInfoGroup()
    {
        if (isset($_GET['group_id']) && !empty($_GET['group_id'])) {

            if (!($_GET['group_id'] = intval($_GET['group_id'])) && !($_GET['group_id'] > 0)) {
                return '';
            }
            $result = GroupLessonsTable::get_info_by_group($_GET['group_id']);
            return $result;
        } else {
            return null;
        }
    }
    public static function getInfoStudents()
    {
        if (isset($_GET['group_id']) && !empty($_GET['group_id'])) {

            if (!($_GET['group_id'] = intval($_GET['group_id'])) && !($_GET['group_id'] > 0)) {
                return '';
            }


            $result = GroupLessonsTable::get_info_by_group($_GET['group_id']);
            $info = [];
            foreach ($result as $item) {
                array_push($info, [
                    ['student_name' => $item['student_name']],
                    ['student_id' => $item['student_id']],
                    ['lesson_id' => $item['lesson_id']],
                    ['score' => $item['score_value']]
                ]);
            }


            return $info;
        } else {
            return null;
        }
    }
}