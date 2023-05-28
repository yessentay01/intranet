<div class="header">

    <div class="title">
        <p>
            Написать контест
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <span>Написать контест</span>
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
            <th style = "width:50%">Наименование</th>
            <th style = "width:20%">Время контеста</th>
            <th style = "width:20%">Вопросы</th>
            <th style = "width:10%">Начать</th>
        </tr>
        </thead>
        <tbody>
        <?php if(isset($tests)): foreach($tests as $test): ?>
                <tr>
                    <td><?php echo $test['name']; ?></td>
                    <td><?php echo $test['testing_min']; ?> мин</td>
                    <td><?php echo $test['question_amount']; ?></td>
                    <td>
                        <button type="button" onclick="toGenerateTest(<?php echo $test['id']; ?>)">Начать</button>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
