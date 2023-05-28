<div class="header">

    <div class="title">
        <p>
            Пользователи
            <a href="#add"><i class="add-icon" data-feather="plus-circle"></i></a>
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <span>Пользователи</span>
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
    <table id="courses">
        <thead>
        <tr>
            <th>Логин</th>
            <th>E-mail</th>
            <th>Телефон</th>
            <th>Статус</th>
            <th>Регистрация</th>
            <th>Роль</th>
            <th>Редактировать</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($users as $user): ?>
            <tr>
                <td><?php echo $user['login']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['phone']; ?></td>
                <td><?php echo $user['user_status']; ?></td>
                <td><?php echo $user['registration_date']; ?></td>
                <td><?php echo $user['role_name']; ?></td>
                <td><button type="button" onclick="editUser(<?php echo $user['id']; ?>)">Редактировать</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="add" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Добавить пользователя</h3>
                <a href="#close" title="Close" class="close">×</a>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url("processrequest"); ?>" method="POST">
                    <input type="hidden" name="request_action" value="add_course">
                    <input type="text" placeholder="Наименование" name = "name">
                    <textarea name="description" rows="3" placeholder="Описание ..."></textarea>
                    <button type="submit" class="button" >Добавить</button>
                </form>
            </div>
        </div>
    </div>
</div>


<section class="content-header">
            <b>
              Пользователи
            </b>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
              <li class="active">Пользователи</li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <a href="#foo" style = "width:100px;" data-toggle="modal" class="btn btn-block btn-default btn-xs" data-target="#add_user_modal" data-whatever="@getbootstrap">Добавить</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style = "width:20%">Логин</th>
                        <th style = "width:20%">E-mail</th>
                        <th style = "width:5%">Телефон</th>
                        <th style = "width:5%">Статус</th>
                        <th style = "width:5%">Регистрация</th>
                        <th style = "width:5%">Роль</th>
                        <th style = "width:5%">Редактировать</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      
                        foreach($users as $user){
                      
                      ?>
                        <tr>
                          <td><?php echo $user['login']; ?></td>
                          <td><?php echo $user['email']; ?></td>
                          <td><?php echo $user['phone']; ?></td>
                          <td><?php echo $user['user_status']; ?></td>
                          <td><?php echo $user['registration_date']; ?></td>
                          <td><?php echo $user['role_name']; ?></td>
                          <td align = "center"><button class='btn btn-block btn-success btn-xs' onclick = 'editUser(<?php echo $user['id'];?>)'>Редактировать</button></td>
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

            <div class="example-modal">
              <div class="modal" id = "add_user_modal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form class="form-horizontal" action = "<?php echo base_url("processrequest"); ?>" method = "post">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Добавить пользователя</h4>
                      </div>
                      <div class="modal-body">                      
                        <ul class="nav nav-tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#main_data" aria-controls="main_data" role="tab" data-toggle="tab">Основные данные</a></li>
                          <li role="presentation"><a href="#extra_data" aria-controls="extra_data" role="tab" data-toggle="tab">Дополнительные данные</a></li>
                        </ul>
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane active" id="main_data">
                            <input type="hidden" name="request_action" value="add_user">
                            <div class="box box-info">
                              <div class="box-header with-border">
                                <h3 class="box-title"></h3>
                              </div><!-- /.box-header -->
                              <div class="box-body">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Email</label>
                                  <div class="col-sm-8">
                                    <input type="email" class="form-control" placeholder="Email" name = "email">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Логин</label>
                                  <div class="col-sm-8">
                                    <input type="login" class="form-control" placeholder="Логин" name = "login">
                                  </div>
                                </div>                            
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Пароль</label>
                                  <div class="col-sm-8">
                                    <input type="password" class="form-control" placeholder="Пароль" name = "password1">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Подтвердите пароль</label>
                                  <div class="col-sm-8">
                                    <input type="password" class="form-control" placeholder="Подтвердите пароль" name = "password2">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Роль</label>
                                  <div class="col-sm-8">
                                    <select class="form-control select2" style="width: 100%;" name = "role_id">
                                      <option value = "2" selected="selected">Пользователь</option>
                                      <option value = "1" >Админ</option>
                                    </select>                                
                                  </div>
                                </div>          
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
                          </div>
                          <div role="tabpanel" class="tab-pane" id="extra_data">
                            <div class="box box-info">
                              <div class="box-header with-border">
                                <h3 class="box-title"></h3>
                              </div><!-- /.box-header -->
                              <div class="box-body">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Номер телефона</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Номер телефона" name = "user_phone">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Статус</label>
                                  <div class="col-sm-8">
                                    <select class="form-control select2" style="width: 100%;" name = "user_status">
                                      <option value = "1" selected="selected">Активен</option>
                                      <option value = "2" >Приостановлен</option>
                                      <option value = "0" >Завершен</option>
                                    </select> 
                                  </div>
                                </div>
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
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
            </div><!-- /.example-modal --> 

            <div class="edit-modal">
              <div class="modal" id = "edit_user_modal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form class="form-horizontal" action = "<?php echo base_url("processrequest"); ?>" method = "post" id = "edit_user_form_id">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Редактировать пользователя</h4>
                      </div>
                      <div class="modal-body">
                        <ul class="nav nav-tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#edit_main_data" aria-controls="edit_main_data" role="tab" data-toggle="tab">Основные данные</a></li>
                          <li role="presentation"><a href="#edit_extra_data" aria-controls="edit_extra_data" role="tab" data-toggle="tab">Дополнительные данные</a></li>
                        </ul>
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane active" id="edit_main_data">
                            <input type="hidden" name="request_action" value="save_user" id = "request_action_id">
                            <input type="hidden" name="user_id" id = "save_user_id">
                            <div class="box box-info">
                              <div class="box-header with-border">
                                <h3 class="box-title"></h3>
                              </div><!-- /.box-header -->
                              <div class="box-body">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Email</label>
                                  <div class="col-sm-8">
                                    <input type="email" class="form-control" placeholder="Email" name = "email" id = "edit_user_email">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Логин</label>
                                  <div class="col-sm-8">
                                    <input type="login" class="form-control" placeholder="Логин" name = "login" id = "edit_user_login">
                                  </div>
                                </div>                            
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">Роль</label>
                                  <div class="col-sm-8">
                                    <select class="form-control select2" style="width: 100%;" name = "role_id" id = "edit_user_role">
                                      <option value = "2" >Пользователь</option>
                                      <option value = "1" >Админ</option>
                                    </select>                                
                                  </div>
                                </div>  
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
                          </div>
                          <div role="tabpanel" class="tab-pane" id="edit_extra_data">
                          <div class="box box-info">
                            <div class="box-header with-border">
                              <h3 class="box-title"></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                              <div class="form-group">
                                <label class="col-sm-4 control-label">Номер телефона</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" placeholder="Номер телефона" name = "user_phone" id = "edit_user_phone">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-4 control-label">Статус</label>
                                <div class="col-sm-8">
                                  <select class="form-control select2" style="width: 100%;" name = "user_status" id = "edit_user_status">
                                    <option value = "1" selected="selected">Активен</option>
                                    <option value = "2" >Приостановлен</option>
                                    <option value = "0" >Завершен</option>
                                  </select> 
                                </div>
                              </div>
                            </div><!-- /.box-body -->
                          </div><!-- /.box -->
                        </div>
                        </div>
                        
                        <div class="modal-footer">
                          <div class="form-group">
                            <label class="col-sm-4 control-label">Обновить пароль</label>
                            <div class="col-sm-8">
                              <div class="input-group">
                                <input type="password" class="form-control" name = "new_password" id = "new_password">
                                <div class="input-group-btn">
                                  <button type="button" class="btn btn-default" onclick="changePassword()">Обновить</button>
                                </div><!-- /btn-group -->                              
                              </div><!-- /input-group -->                          
                            </div>                          
                          </div>                        
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger pull-left" onclick="deleteUser()">Удалить</button>
                          <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                      </form>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
            </div><!-- /.edit-modal -->             

          </section><!-- /.content -->

        <script type="text/javascript">

            function editUser(id){

              $("#edit_user_email").val("");
              $("#edit_user_login").val("");
              $("#edit_user_role").val(1);

              $.ajax({
                
                url: "<?php echo base_url(); ?>ajaxrequest?request_method=get_user_by_id",
                type: "get",
                data:{"user_id":id},

                success: function(response) {
                  
                    var data = $.parseJSON(response);
                    
                    $("#edit_user_email").val(data.email);
                    $("#edit_user_login").val(data.login);
                    $("#edit_user_role").val(data.role_id);
                    $("#edit_user_phone").val(data.phone);
                    
                    if(data.user_status!=null){
                    
                      $("#edit_user_status").val(data.user_status);
                    
                    }else{

                      $("#edit_user_status").val(0);

                    }

                    $("#save_user_id").val(data.id);
                  
                },
                error: function(xhr) {
                  
                }
              });

              $("#edit_user_modal").modal("show");
            }

            function deleteUser(){

              if(confirm("Вы уверены?")){

                $("#request_action_id").val("delete_user");
                $("#edit_user_form_id").submit();

              }

            }

            function changePassword(){

              $("#request_action_id").val("rewrite_password");
              $("#edit_user_form_id").submit();

            }


        </script>
        
     