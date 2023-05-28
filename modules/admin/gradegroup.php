
<div class="header">

    <div class="title">
        <p>
            <?php echo $team["name"]; ?>
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <a href="<?php echo base_url('grades'); ?>">Мои курсы</a>
            <span>•</span>
            <span><?php echo $team["name"]; ?></span>
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

    <table id="grades">
        <thead>
            <tr>
                <th>#</th>
                <th>Наименование</th>
                <th>День</th>
                <th>Время</th>
                <th>Подробнее</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; foreach($chapters as $key => $chapter): if($i == count($dates)): $i = 0; endif;  ?>
                <tr>
                    <td><b><?php echo $key + 1; ?></b></td>
                    <td><b><?php echo $chapter["name"]; ?></b></td>
                    <td><b><?php echo $dates[$i]["lesson_day"]; ?></b></td>
                    <td><b><?php echo $dates[$i]["lesson_hour"]; ?></b></td>
                    <td><a href = "<?php echo base_url()."grade?tid=".$team_id."&cid=".$course_id; ?>">Подробнее</a></td>
                </tr>
            <?php $i++; endforeach; ?>
        </tbody>
    </table>

</div>