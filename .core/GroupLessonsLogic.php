<?php

class GroupLessonsLogic
{

    public static function list_of_scores_by_student($student_id)
    {

        $scores = GroupLessonsTable::get_scores_by_student($student_id);
    }
}