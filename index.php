<?php
include './.core/index.php';
$groups = GroupLessonsTable::get_all_groups();
$groupInfo = GroupLessonsAction::getGroupInfo();

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
</body>

</html>