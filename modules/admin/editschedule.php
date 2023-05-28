          <section class="content-header">
            <b>
              Расписание: <?php echo $user['login']; ?>
            </b>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
              <li><a href="<?php echo base_url('schedule'); ?>"><i class="fa fa-dashboard"></i> Расписание</a></li>
              <li class="active"><?php echo $user['login']; ?></li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
            <div class="row">
              <div class="col-xs-12">
                <div class="box">
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

                        if(isset($generated_schedule)){

                          foreach($generated_schedule as $schedule){

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
                <div class="box">
                  <div class="box-header">
                    <a href="#foo" style = "width:100px;" data-toggle="modal" class="btn btn-block btn-default btn-xs" data-target="#add_schedule_modal" data-whatever="@getbootstrap">Добавить</a>
                  </div>
                  <div class="box-body">
                    <table class="table">
                      <tr>
                        <th>Наименование курса</th>
                        <th>День в недели</th>
                        <th>Время</th>
                        <th>Преподаватель</th>
                        <th>Редактировать</th>
                      </tr>
                      <?php

                         if(isset($schedule_list)){
                            foreach($schedule_list as $schedule){
                      ?>
                      <tr>
                        <td style = "width:35%">
                          <?php echo $schedule['course_name']; ?>
                        </td>
                        <td style = "width:20%">
                          <?php echo $schedule['lesson_day']; ?>
                        </td>
                        <td style = "width:20%">
                          <?php echo $schedule['lesson_hour']; ?>
                        </td>
                        <td style = "width:20%">
                          <?php echo $schedule['teacher_name']; ?>
                        </td>
                        <td style = "width:5%">
                          <button class="btn btn-block btn-success btn-xs" onclick = "editSchedule(<?php echo $schedule['id'];?>,<?php echo $user['id']; ?>)">Редактировать</button>
                        </td>
                      </tr>
                      <?php
                          }
                        }
                      ?>
                    </table>
                  </div>
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="add-modal">
              <div class="modal" id = "add_schedule_modal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Добавить расисание</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" action = "<?php echo base_url("processrequest"); ?>" method = "post">
                        <input type="hidden" name="request_action" value="add_schedule">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Наименование курса</label>
                          <div class="col-sm-8">
                            <select class="form-control" style="width: 100%;" name = "course_id">
                              <option value = "0" selected="selected">Выберите курс</option>
                              <?php
                                foreach($course_list as $course){
                              ?>
                                <option value = "<?php echo $course['id']; ?>"><?php echo $course['name']; ?></option>
                              <?php
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">День в недели</label>
                          <div class="col-sm-8">
                            <select class="form-control" style="width: 100%;" name = "day_id">
                              <option value = "0" selected="selected">Выберите день</option>
                              <option value = "1">Понедельник</option>
                              <option value = "2">Вторник</option>
                              <option value = "3">Среда</option>
                              <option value = "4">Четверг</option>
                              <option value = "5">Пятница</option>
                              <option value = "6">Суббота</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Время</label>
                          <div class="col-sm-8">
                            <select class="form-control" style="width: 100%;" name = "hour_id">
                              <option value = "0" selected="selected">Выберите время</option>
                              <option value = "1">9:00-10:00</option>
                              <option value = "2">10:00-11:00</option>
                              <option value = "3">11:00-12:00</option>
                              <option value = "4">12:00-13:00</option>
                              <option value = "5">13:00-14:00</option>
                              <option value = "6">14:00-15:00</option>
                              <option value = "7">15:00-16:00</option>
                              <option value = "8">16:00-17:00</option>
                              <option value = "9">17:00-18:00</option>
                              <option value = "10">18:00-19:00</option>
                              <option value = "11">19:00-20:00</option>
                              <option value = "12">20:00-21:00</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Преподаватель</label>
                          <div class="col-sm-8">
                            <select class="form-control" style="width: 100%;" name = "teacher_id">
                              <option value = "0" selected="selected">Выберите преподавателя</option>
                              <?php
                                if(isset($admins)){
                                  foreach ($admins as $admin) {
                              ?>
                                <option value = "<?php echo $admin['id']; ?>"><?php echo $admin['login']; ?></option>
                              <?php
                                  }
                                }
                              ?>
                            </select>
                          </div>
                        </div>                                                
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                      </div>
                    </form>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
            </div><!-- /.add-modal --> 

            <div class="edit-modal">
              <div class="modal" id = "edit_schedule_modal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Редактировать расписание</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" action = "<?php echo base_url("processrequest"); ?>" method = "post" id = "edit_schedule_modal_id">
                        <input type="hidden" name="request_action" value="save_schedule" id = "edit_schedule_request_action_id">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>" id = "user_id">
                        <input type="hidden" name="schedule_id" value="<?php echo $schedule['id']; ?>" id = "save_schedule_id">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Наименование курса</label>
                          <div class="col-sm-8">
                            <select class="form-control" style="width: 100%;" name = "course_id" id = "course_id">
                              <option value = "0" selected="selected">Выберите курс</option>
                              <?php
                                foreach($course_list as $course){
                              ?>
                                <option value = "<?php echo $course['id']; ?>"><?php echo $course['name']; ?></option>
                              <?php
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">День в недели</label>
                          <div class="col-sm-8">
                            <select class="form-control" style="width: 100%;" name = "day_id" id = "day_id">
                              <option value = "0" selected="selected">Выберите день</option>
                              <option value = "1">Понедельник</option>
                              <option value = "2">Вторник</option>
                              <option value = "3">Среда</option>
                              <option value = "4">Четверг</option>
                              <option value = "5">Пятница</option>
                              <option value = "6">Суббота</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Время</label>
                          <div class="col-sm-8">
                            <select class="form-control" style="width: 100%;" name = "hour_id" id = "hour_id">
                              <option value = "0" selected="selected">Выберите время</option>
                              <option value = "1">9:00-10:00</option>
                              <option value = "2">10:00-11:00</option>
                              <option value = "3">11:00-12:00</option>
                              <option value = "4">12:00-13:00</option>
                              <option value = "5">13:00-14:00</option>
                              <option value = "6">14:00-15:00</option>
                              <option value = "7">15:00-16:00</option>
                              <option value = "8">16:00-17:00</option>
                              <option value = "9">17:00-18:00</option>
                              <option value = "10">18:00-19:00</option>
                              <option value = "11">19:00-20:00</option>
                              <option value = "12">20:00-21:00</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Преподаватель</label>
                          <div class="col-sm-8">
                            <select class="form-control" style="width: 100%;" name = "teacher_id" id = "teacher_id">
                              <option value = "0" selected="selected">Выберите преподавателя</option>
                              <?php
                                if(isset($admins)){
                                  foreach ($admins as $admin) {
                              ?>
                                <option value = "<?php echo $admin['id']; ?>"><?php echo $admin['login']; ?></option>
                              <?php
                                  }
                                }
                              ?>
                            </select>
                          </div>
                        </div>                                                
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" onclick="deleteSchedule()">Удалить</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                      </div>
                    </form>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
            </div><!-- /.edit-modal -->             

          </section><!-- /.content -->

        <script type="text/javascript">
          
          function editSchedule(id, user_id){
          
              $("#course_id").val(0);
              $("#day_id").val(0);
              $("#hour_id").val(0);
              $("#teacher_id").val(0);              

              $.ajax({
                
                url: "<?php echo base_url(); ?>ajaxrequest?request_method=get_schedule_by_id_and_user_id",
                type: "get",
                data:{"schedule_id":id, "user_id":user_id},

                success: function(response) {
                  
                    var data = $.parseJSON(response);

                    $("#course_id").val(data.course_id);
                    $("#day_id").val(data.day_id);
                    $("#hour_id").val(data.hour_id);
                    $("#teacher_id").val(data.teacher_id);
                    $("#user_id").val(data.user_id);
                    $("#save_schedule_id").val(data.id);
                  
                },
                error: function(xhr) {
                  
                }
              });

              $("#edit_schedule_modal").modal("show");            
          
          }
    
          function deleteSchedule(){

            if(confirm("Вы уверены?")){

              $("#edit_schedule_request_action_id").val("delete_schedule");
              $("#edit_schedule_modal_id").submit();

            }

          }

        </script>
        
     