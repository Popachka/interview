<?php
include '../.core/index.php';
LessonsActions::updateLesson();
LessonsActions::addLesson();
LessonsActions::delLesson();
LessonsActions::link();
LessonsActions::unlink();
header("Location: /lessons.php");