<?php foreach ($groupInfo['lessons'] as $lesson) : ?>
<?php $scores = GroupLessonsTable::get_score_by_student_and_by_lesson($row['id'], $lesson['id']); ?>
<td><?= isset($scores['score']) ? $scores['score'] : '' ?></td>
<?php endforeach; ?>