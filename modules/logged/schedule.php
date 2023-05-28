<div class="header">

    <div class="title">
        <p>
            Мое расписание
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <span>Мое расписание</span>
        </div>
    </div>

    <div class="user">
        <a href="<?php echo base_url('profile'); ?>" >
            <i class="user-icon" data-feather="user"></i>
            <?php echo $USER_DATA['login']; ?>
        </a>
    </div>

</div>




          <!-- Main content -->
          <section class="content">
            <div class="row">
              <div class="col-xs-12">

                <?php

                  if(isset($generated_schedule_list)&&sizeof($generated_schedule_list)>0){
                    for($i=0;$i<sizeof($generated_schedule_list);$i++){
                ?>
                <div class="box">
                  <div class="box-header">
                    <b>
                      Расписание команды : <?php echo $generated_schedule_list[$i]['team']['name'];?>
                    </b>
                  </div>
                  <div class="box-body">
                    <table class="table table-striped">
                      <tr>
                        <th>Время</th>
                        <th style = "width:15%">Понедельник</th>
                        <th style = "width:15%">Вторник</th>
                        <th style = "width:15%">Среда</th>
                        <th style = "width:15%">Четверг</th>
                        <th style = "width:15%">Пятница</th>
                        <th style = "width:15%">Суббота</th>
                      </tr>
                      <?php

                        if(isset($generated_schedule_list[$i]['schedule'])){

                          foreach($generated_schedule_list[$i]['schedule'] as $schedule){

                      ?>
                        <tr>
                          <td>
                            <?php echo $schedule['lesson_hour']; ?>
                          </td>
                          <td style = "font-size:11px;">
                            <?php echo $schedule['monday']; ?>
                          </td>                          
                          <td style = "font-size:11px;">
                            <?php echo $schedule['tuesday']; ?>
                          </td>
                          <td style = "font-size:11px;">
                            <?php echo $schedule['wednesday']; ?>
                          </td>
                          <td style = "font-size:11px;">
                            <?php echo $schedule['thursday']; ?>
                          </td>
                          <td style = "font-size:11px;">
                            <?php echo $schedule['friday']; ?>
                          </td>
                          <td style = "font-size:11px;">
                            <?php echo $schedule['saturday']; ?>
                          </td>                                                   
                        </tr>
                      <?php
                          }

                        }

                      ?>                           
                    </table>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->

                <?php
                    }

                  }

                ?>

              </div><!-- /.col -->
            </div><!-- /.row -->
          </section><!-- /.content -->
          <script type="text/javascript">
            


          </script>
        
     