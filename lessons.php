<?php
include './.core/index.php';
$lessons = LessonsTable::get_lessons();
$groups = GroupLessonsTable::get_all_groups();
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
        <?php require_once("./partials/header.php") ?>
        <div class="container">
            <button type="button" data-bs-toggle="modal" class="btn btn-primary" data-bs-target="#add"
                class="btn btn-success m-1">
                Добавить
            </button> <button type="button" data-bs-toggle="modal" data-bs-target="#link" class="btn btn-success m-1">
                Привязать к группе
            </button>
            </button> <button type="button" data-bs-toggle="modal" data-bs-target="#unlink" class="btn btn-success m-1">
                Отвязать от группы
            </button>
            <table class="table">
                <thead>
                    <th class="text-center" scope="col">Id</th>
                    <th class="text-center" scope="col" class="">Название предмета</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    <?php foreach ($lessons as $row) : ?>
                    <tr>
                        <th class="text-center lesson_id"><?= $row['id'] ?></th>
                        <td class="text-center lesson_name"><?= $row['name'] ?></td>
                        <td class="d-flex ">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#update"
                                class="btn btn-success m-1">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#delete"
                                class="btn btn-danger m-1">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </td>
                        <td class="">

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal" id="update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Изменить предмет</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form action="./logic/LessonsCrud.php" class="form" method="POST">
                        <div class="box-form d-flex flex-column align-items-center justify-content-between">
                            <input type="text" class="form-control lesson_name-input" name="update-lesson_name">
                            <input type="number" name="lesson_id" id="" class="d-none lesson_id-input">
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
    <div class="modal" id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить предмет</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form action="./logic/LessonsCrud.php" class="form" method="POST">
                        <div class="box-form d-flex flex-column align-items-center justify-content-between">
                            <input type="text" class="form-control group_name-input" name="add-lesson_name">
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
    <div class="modal" id="delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удалить предмет </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form action="./logic/LessonsCrud.php" class="form" method="POST">
                        <h4>Вы уверены, что хотите удалить запись?</h4>
                        <input class="delete-id-input d-none" type="text" value="" name="del-id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Удалить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="link" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Привязать предмет к группе</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form action="./logic/LessonsCrud.php" class="form d-flex" method="POST">
                        <select name="link-group_id" id="" class="form-select m-2">
                            <option value="">Группа</option>
                            <?php foreach ($groups as $item) : ?>
                            <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select name="link-lesson_id" id="" class="form-select m-2">
                            <option value="">Группа</option>
                            <?php foreach ($lessons as $item) : ?>
                            <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-primary m-2">Связать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="unlink" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Отвязать от группы</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form action="./logic/LessonsCrud.php" class="form d-flex" method="POST">
                        <select name="unlink-group_id" id="" class="form-select m-2">
                            <option value="">Группа</option>
                            <?php foreach ($groups as $item) : ?>
                            <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select name="unlink-lesson_id" id="" class="form-select m-2">
                            <option value="">Группа</option>
                            <?php foreach ($lessons as $item) : ?>
                            <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-primary m-2">Отвязать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="./script/modalLesson.js"></script>

</body>

</html>