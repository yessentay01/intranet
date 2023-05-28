      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="<?php echo base_url(); ?>" class="navbar-brand">ПОРТАЛ <b>BITLAB</b></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li <?php if($page=='schedule'){ echo " class=\"active\""; } ?> ><a href="<?php echo base_url("schedule"); ?>">Расписание</a></li>
                <li <?php if($page=='courses'||$page=='readcourse'||$page=='readchapter'){ echo " class=\"active\""; } ?>><a href="<?php echo base_url('courses');?>">Мои курсы</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- User Account Menu -->
                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="hidden-xs">
                        <?php
                          echo $USER_DATA['login'];
                        ?>
                      </span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <p>
                          <?php
                            echo $USER_DATA['login'];
                          ?>
                          <small>
                          <?php
                            echo $USER_DATA['email'];
                          ?>                    
                          </small>
                        </p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="<?php echo base_url('profile'); ?>" class="btn btn-default btn-flat">Профиль</a>
                        </div>
                        <div class="pull-right">
                          <form action = "<?php echo base_url('logout'); ?>" method = "post">
                            <button type = "submit" class="btn btn-default btn-flat">Выход</button>
                          </form>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>