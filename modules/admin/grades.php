<div class="header">

    <div class="title">
        <p>
            Мои курсы
            <!--a href="#add"><i class="add-icon" data-feather="plus-circle"></i></a-->
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <span>Мои курсы</span>
        </div>
    </div>

    <div class="user">
        <a href="<?php echo base_url('profile'); ?>" >
            <i class="user-icon" data-feather="user"></i>
            <?php echo $USER_DATA['login']; ?>
        </a>
    </div>

</div>

<div class="box">
    <table id="courses">
        <thead>
        <tr>
            <th>Группа</th>
            <th>Курс</th>
            <th>Подробнее</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($schedule as $lesson): ?>
            <tr>
                <td><b><?php echo $lesson['team_name']; ?></b></td>
                <td><b><?php echo $lesson['course_name']; ?></b></td>
                <td><a href = "<?php echo base_url()."gradegroup?tid=".$lesson['team_id']."&cid=".$lesson["course_id"]; ?>">Подробнее</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
