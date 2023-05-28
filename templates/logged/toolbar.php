<div class="toolbar-inner">
    <div class="toolbar-logo">
        <a href="<?php echo base_url(); ?>">GRADE<span>•</span>IT</a>
    </div>
    <div class="menu">

        <span>Информация</span>

        <a href="<?php echo base_url('schedule');?>" class="menu-item <?php if ($page == 'schedule'): ?> active <?php endif; ?>">
            <div class="corner"></div>
            <i class="menu-icon" data-feather="calendar"></i>
            <b> Расписание</b>
        </a>

        <a href="<?php echo base_url('courses');?>" class="menu-item <?php if ($page=='courses' || $page=='readcourse' || $page=='readchapter'): ?> active <?php endif; ?>">
            <div class="corner"></div>
            <i class="menu-icon" data-feather="book"></i>
            <b> Курсы</b>
        </a>

        <span>Общие</span>

        <a href="<?php echo base_url('profile');?>" class="menu-item <?php if ($page == 'profile'): ?> active <?php endif; ?>">
            <div class="corner"></div>
            <i class="menu-icon" data-feather="user"></i>
            <b> Профиль</b>
        </a>

        <form action="<?php echo base_url('logout'); ?>" method="POST">
            <button type="submit" class="menu-item">
                <i class="menu-icon" data-feather="log-out"></i>
                <b> Выход</b>
            </button>
        </form>

    </div>
</div>