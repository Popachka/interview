<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/db.php');


require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/StudentsTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/StudentsLogic.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/StudentsActions.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/GroupLessonsTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/GroupLessonsLogic.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/GroupLessonsActions.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/GroupTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/GroupLogic.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/GroupActions.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/LessonsTable.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/LessonsLogic.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/LessonsActions.php');