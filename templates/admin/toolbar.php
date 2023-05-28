<div class="toolbar-inner">
    <div class="toolbar-logo">
        <a href="<?php echo base_url(); ?>">GRADE<span>•</span>IT</a>
    </div>
    <div class="menu">

        <span>Информация</span>

        <a href="<?php echo base_url('courses');?>" class="menu-item <?php if ($page=='courses' || $page=='editcourse' || $page=='editchapter' || $page=='readlesson' || $page=='editlesson' || $page=='addlesson'): ?> active <?php endif; ?>">
            <div class="corner"></div>
            <i class="menu-icon" data-feather="book"></i>
            <b> Курсы</b>
        </a>

        <a href="<?php echo base_url('grades');?>" class="menu-item <?php if ($page=='grades' || $page=='gradegroup' || $page=='grade'): ?> active <?php endif; ?>">
            <div class="corner"></div>
            <i class="menu-icon" data-feather="star"></i>
            <b> Мои курсы</b>
        </a>

        <a href="<?php echo base_url('tests');?>" class="menu-item <?php if ($page=='tests' || $page=='edittest' || $page=='readquestion' || $page=='editquestion'): ?> active <?php endif; ?>">
            <div class="corner"></div>
            <i class="menu-icon" data-feather="check-square"></i>
            <b> База тестов</b>
        </a>

        <a href="<?php echo base_url('writecontest');?>" class="menu-item <?php if ($page=='writecontest'): ?> active <?php endif; ?>">
            <div class="corner"></div>
            <i class="menu-icon" data-feather="edit"></i>
            <b> Написать контест</b>
        </a>

        <a href="<?php echo base_url('mycontests');?>" class="menu-item <?php if ($page=='mycontests' || $page=='readcontest' || $page=='contestresults' || $page=='readquestcontest'): ?> active <?php endif; ?>">
            <div class="corner"></div>
            <i class="menu-icon" data-feather="file-text"></i>
            <b> Мои контесты</b>
        </a>

        <span>Пользователи и доступы</span>

        <a href="<?php echo base_url('users');?>" class="menu-item <?php if ($page=='users'): ?> active <?php endif; ?>">
            <div class="corner"></div>
            <i class="menu-icon" data-feather="users"></i>
            <b> Пользователи</b>
        </a>

        <a href="<?php echo base_url('groups');?>" class="menu-item <?php if ($page=='groups'||$page=='readgroup'): ?> active <?php endif; ?>">
            <div class="corner"></div>
            <i class="menu-icon" data-feather="key"></i>
            <b> Доступы</b>
        </a>

        <a href="<?php echo base_url('teams');?>" class="menu-item <?php if ($page=='teams'||$page=='readteam'): ?> active <?php endif; ?>">
            <div class="corner"></div>
            <i class="menu-icon" data-feather="user-check"></i>
            <b> Команды</b>
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