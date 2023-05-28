          <section class="content-header">
            <b>
              Расписание
            </b>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
              <li class="active">Расписание</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th style = "width:40%">Логин</th>
                          <th style = "width:40%">E-mail</th>
                          <th style = "width:10%">Роль</th>
                          <th style = "width:10%">Редактировать</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        
                          foreach($users as $user){
                        
                        ?>
    
                          <tr>
                            <td><?php echo $user['login']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['role_name']; ?></td>
                            <td align = "center"><a href = "editschedule?id=<?php echo $user['id']; ?>" class='btn btn-block btn-success btn-xs' style = 'width:100px;' >Расписание</button></a>
                          </tr>                      
                        
                        <?php
                            
                          }
                        
                        ?>

                      </tbody>
                    </table>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </section><!-- /.content -->

        <script type="text/javascript">

        </script>
        
     