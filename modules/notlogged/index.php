<div class="login">
    <div class="login-logo">
        <a href="<?php echo base_url(); ?>">GRADE<span>•</span>IT</a>
    </div>

    <?php  if(isset($_GET['error'])): ?>
        <p>Неверный логин или пароль</p>
    <?php endif; ?>

    <form action="<?php echo base_url('auth'); ?>" method="POST">
        <input type="email" name="email" placeholder="Email" />
        <input type="password" name="password" placeholder="Пароль" />
        <div class="remember">
            <input type="checkbox" name="remember" id="remember" class="checbox">
            <label for="remember">Запомнить меня</label>
        </div>
        <button type="submit">Войти</button>
    </form>
</div>