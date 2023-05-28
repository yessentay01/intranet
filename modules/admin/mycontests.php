<div class="header">

    <div class="title">
        <p>
            Мои контесты
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <span>Мои контесты</span>
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
            <th style="width:30%">Предмет</th>
            <th style="width:20%">Время</th>
            <th style="width:20%">Вопросы</th>
            <th style="width:20%">Статус</th>
            <th style="width:10%">Операции</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($contests)): foreach ($contests as $contest): ?>

            <tr>
                <td><?php echo $contest['test_name']; ?></td>
                <td><?php echo $contest['start_time']; ?></td>
                <td><?php echo $contest['question_amount']; ?> </td>
                <?php if ($contest['is_finished'] == 0): ?>
                    <td style="color:red;">Не завершен</td>
                    <td><a href='<?php echo base_url('readcontest?contest_id=' . $contest['id']); ?>'>Продолжить</a>
                    </td>
                <?php else : ?>
                    <td style="color:green;">Завершен</td>
                    <td><a href='<?php echo base_url('readcontest?contest_id=' . $contest['id']); ?>'>Результаты</a>
                    </td>
                <?php endif; ?>
            </tr>

        <?php endforeach; endif; ?>

        </tbody>
    </table>
</div>
