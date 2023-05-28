<div class="header">

    <div class="title">
        <p>
            Профиль
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <span>Профиль</span>
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
    <form action="<?php echo base_url('processrequest'); ?>" method="POST" class="form">
        <input type="hidden" name="request_action" value="change_password">

        <h1><?php echo $USER_DATA['login']; ?></h1>
        <p style="font-size: 14px; color: #999"><?php echo $USER_DATA['email']; ?> <b style="color: #8bc34a"><?php echo $USER_DATA['role_name']; ?></b></p>

        <h3 style="margin-top: 30px; margin-bottom: 15px;">Изменить пароль</h3>

        <?php if(isset($_GET['error'])): ?><p style="margin-bottom: 15px;font-size: 14px;color: red">Ошибка операции!</p><?php endif; ?>
        <?php if(isset($_GET['success'])): ?><p style="margin-bottom: 15px;font-size: 14px;color: #8bc34a">Профиль изменен успешно</p><?php endif; ?>

        <input type="password" placeholder="Пароль" name="old_password" />
        <input type="password" placeholder="Новый пароль" name="new_password" />
        <input type="password" placeholder="Подтвердите новый пароль" name="confirm_new_password" />
        <button type="submit">Сохранить</button>

    </form>
</div>