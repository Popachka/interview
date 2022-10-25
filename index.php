<?php
include './.core/index.php';
$groups = GroupLessonsTable::get_all_groups();
$groupInfo = GroupLessonsAction::getGroupInfo();
$allStudents = StudentsTable::get_students();
StudentsActions::create_student();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interveiw task</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
    <div class="wrapper bg-secondary">
        <div class="container pt-5 h-100 d-flex flex-column justify-content-center">
            <form action="./index.php" class="form d-flex align-items-center mb-5" method="GET">
                <select name="group_id" id="" class="form-select w-25">
                    <option value="">Группа</option>
                    <?php foreach ($groups as $row) : ?>
                    <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary">Показать рейтинг</button>
            </form>
            <div class="crud-btn d-flex">
                <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#addStudent">
                    Добавить студента
                </button>
                <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal"
                    data-bs-target="#updateStudent">
                    Изменить данные студента
                </button>
            </div>
            <table class="table">
                <thead>
                    <th scope="col">ФИО</th>
                    <?php if ($groupInfo != null) : ?>
                    <?php foreach ($groupInfo['lessons'] as $row) : ?>
                    <th scrope='col' value="<?= $row['lesson']; ?>"><?= $row['lesson']; ?></th>
                    <?php endforeach; ?>
                    <?php endif; ?>


                </thead>
                <tbody>
                    <?php if ($groupInfo != null) : ?>
                    <?php foreach ($groupInfo['students'] as $row) : ?>
                    <tr>
                        <th scrope='row'><?= $row['name']; ?></th>
                        <?php foreach ($groupInfo['lessons'] as $lesson) : ?>
                        <?php $scores = GroupLessonsTable::get_score_by_student_and_by_lesson($row['id'], $lesson['id']); ?>
                        <td><?= isset($scores['score']) ? $scores['score'] : '' ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
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
    <!-- Пакет JavaScript с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    %!(EXTRA template.HTMLAttr=sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p)
</body>

</html>