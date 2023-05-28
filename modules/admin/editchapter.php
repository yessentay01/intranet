<?php if($chapter != null): ?>


<div class="header">

    <div class="title">
        <p>
            Уроки
            <a href="<?php echo base_url('addlesson?chid='.$chapter['id']); ?>"><i class="add-icon" data-feather="plus-circle"></i></a>
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <a href="<?php echo base_url("courses"); ?>">Курсы</a>
            <span>•</span>
            <a href="<?php echo base_url("editcourse?cid=".$chapter['course_id']); ?>"><?php echo $chapter['course_name']; ?></a>
            <span>•</span>
            <span><?php echo $chapter['name']; ?></span>
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
            <th>Порядок </th>
            <th>Тип урока </th>
            <th>Подробнее</th>
            <th>Редактировать</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($lessons as $lesson): ?>
            <tr>
                <td width="40%"><b><?php echo $lesson['name']; ?></b></td>
                <td width="40%"><b><?php echo $lesson['order_value']; ?></b></td>
                <td width="40%"><b><?php echo $lesson['lesson_type_name']; ?></b></td>
                <td><a href = "<?php echo base_url("readlesson?lid=").$lesson['id']; ?>">Подробнее</a></td>
                <td><a class="button" href = "<?php echo base_url("editlesson?lid=").$lesson['id']; ?>">Редактировать</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php endif; ?>