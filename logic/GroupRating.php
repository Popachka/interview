<?php
include '../.core/index.php';

StudentsActions::DelObj();
StudentsActions::create_student();
StudentsActions::update_scores();
header("Location: /rate.php?group_id=" . $_SESSION['group']);