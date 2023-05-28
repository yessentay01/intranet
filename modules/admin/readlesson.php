<?php if($lesson != null): ?>
<div class="header">

    <div class="title">
        <p>
            Урок
            <a href="<?php echo base_url('addlesson?chid='.$chapter['id']); ?>"><i class="add-icon" data-feather="plus-circle"></i></a>
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <a href="<?php echo base_url("courses"); ?>">Курсы</a>
            <span>•</span>
            <a href="<?php echo base_url("editcourse?cid=".$lesson['course_id']); ?>"><?php echo $lesson['course_name']; ?></a>
            <span>•</span>
            <a href="<?php echo base_url("editchapter?chid=".$lesson['chapter_id']); ?>"><?php echo $lesson['course_name']; ?></a>
            <span>•</span>
            <span><?php echo $lesson['name']; ?></span>
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
    <script src="../../dist/js/dropzone.js"></script>
    <link rel="stylesheet" href="../../dist/css/dropzone.css">

    <h2><?php echo $lesson['name']; ?></h2>
    <p><i>Тип Урока: <?php echo $lesson['lesson_type_name']; ?></i></p>
    <br />
    <div class="inner-content">
        <?php  echo $lesson['content']; ?>
    </div>
</div>


<?php endif; ?>