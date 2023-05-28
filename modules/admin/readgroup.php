          <section class="content-header">
            <?php
              if(isset($group)){
            ?>
            <b>
              Доступ: <?php echo $group['name'];?>
            </b>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
              <li><a href="<?php echo base_url('groups'); ?>"><i class="fa fa-dashboard"></i> Доступы</a></li>
              <li class="active"><?php echo $group['name']; ?></li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">

          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <a href="#foo" style = "width:200px;" data-toggle="modal" class="btn btn-block btn-default btn-xs" data-target="#add_user_modal" data-whatever="@getbootstrap">Добавить Пользователя</a>
                  <div class="box-tools">
                  </div>                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="users_table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="width: 35%">Логин</th>
                        <th style="width: 30%">Email</th>
                        <th style="width: 25%">Роль</th>
                        <th style="width: 10%"><center>Операции</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if(isset($group_users)){
                          foreach($group_users as $group_user){
                      ?>
                      <tr>
                        <td>
                          <?php
                            echo $group_user['login'];
                          ?>
                        </td>
                        <td>
                          <?php
                            echo $group_user['email'];
                          ?>
                        </td>
                        <td>
                          <?php
                            echo $group_user['role'];
                          ?>
                        </td>
                        <td>
                          <button class = "btn btn-block btn-danger btn-xs" onclick = "removeUser(<?php echo $group_user['user_id']; ?>)">Убрать</button>
                        </td>
                      </tr>
                      <?php
                          }
                        }
                      ?>                      
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <form action = "<?php echo base_url("processrequest"); ?>" method = "post" id = "remove_user_form_id">
            <input type = "hidden" name = "request_action" value = "remove_user_from_group">
            <input type = "hidden" id = "remove_user_id" name = "remove_user_id">
            <input type = "hidden" name = "group_id" value = "<?php echo $group['id']; ?>">
          </form>

          <form action = "<?php echo base_url("processrequest"); ?>" method = "post" id = "add_user_to_group_form_id">
            <input type = "hidden" name = "request_action" value = "add_user_to_group">
            <input type = "hidden" id = "add_user_id" name = "add_user_id">
            <input type = "hidden" name = "group_id" value = "<?php echo $group['id']; ?>">
          </form>

          <form action = "<?php echo base_url("processrequest"); ?>" method = "post" id = "remove_course_form_id">
            <input type = "hidden" name = "request_action" value = "remove_course_from_group">
            <input type = "hidden" id = "remove_course_id" name = "remove_course_id">
            <input type = "hidden" name = "group_id" value = "<?php echo $group['id']; ?>">
          </form>         

          <form action = "<?php echo base_url("processrequest"); ?>" method = "post" id = "add_course_to_group_form_id">
            <input type = "hidden" name = "request_action" value = "add_course_to_group">
            <input type = "hidden" id = "add_course_id" name = "add_course_id">
            <input type = "hidden" name = "group_id" value = "<?php echo $group['id']; ?>">
          </form>

          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <a href="#foo" style = "width:200px;" data-toggle="modal" class="btn btn-block btn-default btn-xs" data-target="#add_course_modal" data-whatever="@getbootstrap">Добавить Курс</a>
                  <div class="box-tools">
                  </div>                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="courses_table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="width: 30%">Имя</th>
                        <th style="width: 60%">Краткое описание</th>
                        <th style="width: 10%"><center>Операции</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if(isset($group_courses)){
                          foreach($group_courses as $group_course){
                      ?>
                      <tr>
                        <td>
                          <?php
                            echo $group_course['name'];
                          ?>
                        </td>
                        <td>
                          <?php
                            echo $group_course['description'];
                          ?>
                        </td>
                        <td>
                          <button class = "btn btn-block btn-danger btn-xs" onclick = "removeCourse(<?php echo $group_course['course_id']; ?>)">Убрать</button>
                        </td>
                      </tr>
                      <?php
                          }
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
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Добавить Пользователя</h4>
                    </div>
                    <div class="modal-body">
  	                  <div class="box-tools">		                	  
                        <table id="availavle_users_table" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th style="width: 40%">Логин</th>
                              <th style="width: 50%">Email</th>
                              <th style="width: 10%"><center>Операции</center></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              if(isset($available_user_list)){
                                foreach($available_user_list as $available_user){
                            ?>
                            <tr>
                              <td style="width: 40%;">
                                <?php
                                  echo $available_user['login'];
                                ?>
                              </td>
                              <td style="width: 50%;">
                                <?php
                                  echo $available_user['email'];
                                ?>
                              </td>
                              <td style="width: 10%;">
                                <button class = "btn btn-block btn-success btn-xs" onclick = "addUser(<?php echo $available_user['id']; ?>)">Добавить</button>
                              </td>
                            </tr>
                            <?php
                                }
                              }
                            ?>                      
                          </tbody>
                        </table>  	                    
  	                  </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Закрыть</button>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
            </div><!-- /.example-modal -->

          <div class="example-modal">
            <div class="modal" id = "add_course_modal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Добавить Курс</h4>
                  </div>
                  <div class="modal-body">
	                  <table id="availavle_courses_table" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th style="width: 90%;">Имя</th>
                          <th style="width: 10%;">Операции</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          if(isset($available_course_list)){
                            foreach($available_course_list as $available_course){
                        ?>
                        <tr>
                          <td style="width: 90%;">
                            <?php
                              echo $available_course['name'];
                            ?>
                          </td>
                          <td style="width: 10%;">
                            <button class = "btn btn-block btn-success btn-xs" onclick = "addCourse(<?php echo $available_course['id']; ?>)">Добавить</button>
                          </td>
                        </tr>
                        <?php
                            }
                          }
                        ?>                      
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Закрыть</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal --> 

          <?php
            
            }
          
          ?>
          </section><!-- /.content -->

          <script type="text/javascript">

              function removeUser(user_id){

                var removeUser = confirm("Вы уверены?");

                if(removeUser){

                  document.getElementById("remove_user_id").value = user_id;
                  document.getElementById("remove_user_form_id").submit();

                }
                
              }       

              function addUser(user_id){            
                  
                  document.getElementById("add_user_id").value = user_id;
                  document.getElementById("add_user_to_group_form_id").submit();
              
              }

              function removeCourse(course_id){

                var removeUser = confirm("Вы уверены?");

                if(removeUser){

                  document.getElementById("remove_course_id").value = course_id;
                  document.getElementById("remove_course_form_id").submit();

                }
                
              }

              function addCourse(course_id){  
                  
                  document.getElementById("add_course_id").value = course_id;
                  document.getElementById("add_course_to_group_form_id").submit();
              
              }


          </script>