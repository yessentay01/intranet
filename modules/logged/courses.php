
<div class="header">

    <div class="title">
        <p>
            Курсы
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <span>Курсы</span>
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
            <th>Наименование</th>
            <th>Описание</th>
            <th>Подробнее</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($courses as $course): ?>
            <tr>
                <td width="40%"><b><?php echo $course['name']; ?></b></td>
                <td width="40%"><b><?php echo $course['description']; ?></b></td>
                <td><a href = "<?php echo base_url()."readcourse?cid=".$course['id']; ?>">Подробнее</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
