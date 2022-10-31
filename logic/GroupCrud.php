<?php
include '../.core/index.php';

GroupActions::updateGroup();
GroupActions::addGroup();
GroupActions::delGroup();
header("Location: /groups.php");