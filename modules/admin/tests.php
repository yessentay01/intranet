<div class="header">

    <div class="title">
        <p>
            Тесты
            <a href="#add"><i class="add-icon" data-feather="plus-circle"></i></a>
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <span>Тесты</span>
        </div>
    </div>

    <div class="user">
        <a href="<?php echo base_url('profile'); ?>">
            <i class="user-icon" data-feather="user"></i>
            <?php echo $USER_DATA['login']; ?>
        </a>
    </div>

</div>


<div class="box">
    <table id="courses">
        <thead>
        <tr>
            <th style="width:35%">Наименование</th>
            <th style="width:20%">Дата добавления</th>
            <th style="width:15%">Время теста</th>
            <th style="width:10%">Вопросы</th>
            <th style="width:10%">Подробнее</th>
            <th style="width:10%">Редактировать</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($tests)): foreach ($tests as $test): ?>

            <tr>
                <td><?php echo $test['name']; ?></td>
                <td><?php echo $test['created_date']; ?></td>
                <td><?php echo $test['testing_min']; ?> мин</td>
                <td><?php echo $test['question_amount']; ?></td>
                <td><a href="<?php echo base_url() . "edittest?id=" . $test['id']; ?>">Подробнее</a></td>
                <td>
                    <button onclick='editTest(<?php echo $test['id']; ?>)'>Редактировать</button>
                </td>
            </tr>

        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>