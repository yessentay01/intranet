    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo base_url(); ?>"><b>BITLAB.KZ</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
              <?php
                if(isset($_GET['error'])){
              ?>
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <b> Неверный логин или пароль </b>                          
                </div>                          
              <?php
                }
              ?>
              <form action="<?php echo base_url('auth'); ?>" method="post">
                <div class="form-group has-feedback">
                  <input type="email" class="form-control" placeholder="Email" name = "email">
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <input type="password" class="form-control" placeholder="Password" name = "password">
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                  <div class="col-xs-8">
      			  <div>
                <label>
                  <input type="checkbox" name = "remember"> Запомнить меня 
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Войти</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->