<div class="modal" id="updateStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить студента</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form action="./index.php" class="form" method="POST">
                    <div class="box-form d-flex align-items-center justify-content-between">
                        <label for="">Выбрать студента</label>
                        <select name="update_group" class="form-select" id="">
                            <?php foreach ($allStudents as $row) : ?>
                            <option value="<?= $row['id']; ?>"><?= $row['full_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="addStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить студента</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form action="./index.php" class="form" method="POST">
                    <div class="box-form d-flex align-items-center justify-content-between">
                        <input name='student_name' type="text" placeholder="Спичкин Евгений Денисович"
                            class="form-control">
                    </div>
                    <div class="box-form d-flex align-items-center justify-content-between mt-5">
                        <select name="student_group" id="student_group" class="form-select">
                            <option value="">Группа</option>
                            <?php foreach ($groups as $row) : ?>
                            <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php if ($groupInfo != null) : ?>
<?php foreach ($groupInfo['students'] as $student) : ?>
<tr>
    <th scrope='row'><?= $student['name']; ?></th>
    <?php $listScores = GroupLessonsTable::get_scores_by_student($student['id']); ?>
    <?php
            foreach ($groupInfo['lessons'] as $lesson) {
                $td = "<td></td>";
                foreach ($listScores as $listScore) {
                    if ($listScore['lesson_id'] == $lesson['id']) {
                        $td = "<td>" . $listScore['score'] . "</td>";
                        break;
                    } else {
                        $td = "<td></td>";
                        continue;
                    }
                }
                echo $td;
            }
            ?>
</tr>
<?php endforeach; ?>
<?php endif; ?>