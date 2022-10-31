<?php
include './.core/index.php';
unset($_SESSION['group_id']);
$groups = GroupLessonsTable::get_all_groups();
$lessons = GroupLessonsAction::getGroupInfo();
$allStudents = StudentsActions::get_students_by_group();
$infoStudents = GroupLessonsAction::getInfoStudents();



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
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <div class="wrapper bg-secondary">
        <?php require_once("./partials/header.php") ?>
        <div class="container h-100 d-flex flex-column justify-content-center">
            <form action="./rate.php" class="form d-flex align-items-center mb-5" method="GET">
                <select name="group_id" id="" class="form-select w-25">
                    <option value="">Группа</option>
                    <?php foreach ($groups as $row) : ?>
                    <?php if ($_SESSION['group_id'] == $row['id']) : ?>
                    <option selected value="<?= $row['id']; ?>">
                        <?= $row['name']; ?></option>
                    <?php else : ?>
                    <option value="<?= $row['id']; ?>">
                        <?= $row['name']; ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary">Показать рейтинг</button>
            </form>
            <div class="crud-btn d-flex">
                <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#addStudent">
                    Добавить студента
                </button>
            </div>
            <table class="table">
                <thead>
                    <th scope="col">ФИО</th>
                    <?php if ($lessons != null) : ?>
                    <?php foreach ($lessons as $item) : ?>
                    <th id="lesson_<?= $item[1]['id'] ?>" scrope='col'><?= $item[0]['name']; ?></th>
                    <?php endforeach; ?>
                    <th scrope='col'></th>
                    <th scrope='col'></th>
                    <?php endif; ?>
                </thead>
                <tbody>

                    <?php if ($allStudents != null) : ?>
                    <?php foreach ($allStudents as $student) : ?>
                    <tr>
                        <th scope="row" class="student_name"><?= $student[0]['name'] ?></th>
                        <td class=" d-none student_id"><?= $student[1]['id'] ?></td>
                        <?php foreach ($lessons as $lesson) : ?>
                        <td class="lesson-score" data-lesson='<?= $lesson[1]['id'] ?>' ?>
                            <?php
                                        foreach ($infoStudents as $item) {
                                            $student_flag = $student[1]['id'] == $item[1]['student_id'] ? true : false;
                                            $lesson_flag = $lesson[1]['id'] == $item[2]['lesson_id'] ? true : false;
                                            if ($student_flag && $lesson_flag) {
                                                $td = $item[3]['score'];
                                                echo $td;
                                            }
                                        }
                                        ?>
                        </td>
                        <?php endforeach; ?>
                        <td>
                            <button data-id="<?= $student[1]['id'] ?>" type="button" data-bs-toggle="modal"
                                data-bs-target="#updateStudent" class="btn btn-success m-1">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </td>
                        <td>
                            <button data-id="<?= $student[1]['id'] ?>" type="button" data-bs-toggle="modal"
                                data-bs-target="#deleteStudent" class="btn btn-danger m-1">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </td>
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
                    <form action="./logic//GroupRating.php" class="form" method="POST">
                        <div class="box-form d-flex flex-column align-items-center justify-content-between">
                            <h4 class="student_name_form"></h4>
                            <input type="number" class="d-none student_id_form" name="update_student_id">
                            <input type="text" class="d-none" value="update" name="cmd">
                            <?php foreach ($lessons as $lesson) : ?>
                            <div class="box-lesson d-flex align-items-center justify-content-between m-2 w-75">
                                <label for="" value="update_" class="label w-50"> <?= $lesson[0]['name'] ?> </label>
                                <input type="number" class="d-none" value="<?= $lesson[1]['id'] ?>"
                                    name="update_lesson_<?= $lesson[1]['id'] ?>">
                                <select data-lesson='<?= $lesson[1]['id'] ?>' class="w-50 form-select"
                                    name="update_score_<?= $lesson[1]['id'] ?>" id="">
                                    <option value="">Оценка</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <?php endforeach; ?>

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
                    <form action="./logic/GroupRating.php" class="form" method="POST">
                        <div class="box-form d-flex align-items-center justify-content-between">
                            <input name='student_name' type="text" placeholder="Спичкин Евгений Денисович"
                                class="form-control">
                            <input type="text" class="d-none" value="add" name="cmd">
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
    <div class="modal" id="deleteStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удалить студента</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form action="./logic/GroupRating.php" class="form" method="POST">
                        <h4>Вы уверены, что хотите удалить запись?</h4>
                        <input type="text" class="d-none" value="delete" name="cmd">
                        <input class="delete-id-input d-none" type="text" value="" name="id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Удалить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Пакет JavaScript с Popper -->



    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="./script/modalRate.js"></script>

</body>

</html>