          <?php

            if($test!=null){

          ?>
          <section class="content-header">
			      <b>Редактировать тест</b>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>"> Главная</a></li>
              <li><a href="<?php echo base_url("tests"); ?>"> Тесты</a></li>
              <li class="active"><?php echo $test['name']; ?></li>
            </ol>
          </section> 

          <section class="content">
            
            <div class="col-md-14">
              <div class="box">
                <div class="box-header">
                  <div class="row">
                    <div class="col-xs-2">       
                      <a href="<?php echo base_url('addquestion?id='.$test['id']); ?>" style = "width:170px;" class="btn btn-block btn-default btn-xs" data-whatever="@getbootstrap">Добавить вопрос</a>
                    </div>
                  </div>
                  <div class="box-tools">
                  </div>                    
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="width: 45%">Наименование </th>
                        <th style="width: 10%">Уровень </th>
                        <th style="width: 20%">Дата добавления </th>
                        <th style="width: 10%">Просмотр </th>
                        <th style="width: 10%">Редактировать</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                        if(isset($questions)){
                        
                          foreach($questions as $question){
                      
                      ?>
  
                        <tr>
                          <td><?php echo $question['name']; ?></td>
                          <td><?php echo $question['level_id']; ?></td>
                          <td><?php echo $question['added_date']; ?></td>
                          <td align = "center"><a class='btn btn-block btn-default btn-xs' style = 'width:100px;' href = "<?php echo base_url("readquestion?id=").$question['id']; ?>" >Подробнее</a></td>
                          <td align = "center"><a href = "<?php echo base_url("editquestion?id=").$question['id']; ?>" class='btn btn-block btn-success btn-xs' style = 'width:100px;'>Редактировать</a></td>
                        </tr>                      
                      
                      <?php

                          }
                          
                        }
                      
                      ?>

                    </tbody>
                  </table>                  
                </div><!-- /.box-body -->                
              </div><!-- /.box -->              
            </div>            
            
            <div class="example-modal">
              <div class="modal" id = "add_lesson_modal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Добавить урок</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" action = "<?php echo base_url("processrequest"); ?>" method = "post">
                        <input type="hidden" name="request_action" value="add_lesson">
                        <input type="hidden" name="chapter_id" value="<?php echo $chapter['id']; ?>">
                        <div class="box box-info">
                          <div class="box-header with-border">
                            <h3 class="box-title"></h3>
                          </div><!-- /.box-header -->
                          <div class="box-body">
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Наименование</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Наименование" name = "name">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Порядок</label>
                              <div class="col-sm-2">
                                <select class="form-control select2" style="width: 100%;" name = "order">
                                  <?php
                                    for($i=1;$i<50;$i++){
                                  ?>
                                    <option value = "<?php echo $i; ?>"><?php echo $i;?></option>
                                  <?php
                                    }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Тип урока</label>
                              <div class="col-sm-2">                              
                                <select class="form-control select2" style="width:300px;" name = "lesson_type_id">
                                  <?php
                                    foreach($view_data['lesson_types'] as $lesson_type){
                                  ?>
                                    <option value = "<?php echo $lesson_type['id']; ?>"><?php echo $lesson_type['name'];?></option>
                                  <?php
                                    }
                                  ?>
                                </select>                               
                              </div>                              
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <textarea class="form-control" name = "content" rows="3"></textarea>
                              </div>
                            </div>                            
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->                        
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
              <div class="modal" id = "edit_lesson_modal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Редактировать Главу</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" action = "<?php echo base_url("processrequest"); ?>" method = "post" id = "edit_lesson_modal_id">
                        <input type="hidden" name="request_action" value="save_lesson" id = "request_action_id">
                        <input type="hidden" name="lesson_id" id = "save_lesson_id">
                        <input type="hidden" name="chapter_id" value = "<?php echo $chapter['id']; ?>">
                        <div class="box box-info">
                          <div class="box-header with-border">
                            <h3 class="box-title"></h3>
                          </div><!-- /.box-header -->
                          <div class="box-body">
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Наименование</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Наименование" name = "name" id = "save_lesson_name">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Порядок</label>
                              <div class="col-sm-2">
                                <select class="form-control select2" style="width: 100%;" name = "order" id = "save_lesson_order">
                                  <?php
                                    for($i=1;$i<50;$i++){
                                  ?>
                                    <option value = "<?php echo $i; ?>"><?php echo $i;?></option>
                                  <?php
                                    }
                                  ?>
                                </select>                                
                              </div>                              
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4 control-label">Тип урока</label>
                              <div class="col-sm-2">
                                <select class="form-control select2" style="width:300px;" name = "lesson_type_id" id = "save_lesson_type_id">
                                  <?php
                                    foreach($view_data['lesson_types'] as $lesson_type){
                                  ?>
                                    <option value = "<?php echo $lesson_type['id']; ?>"><?php echo $lesson_type['name'];?></option>
                                  <?php
                                    }
                                  ?>
                                </select>                               
                              </div>                              
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <textarea class="form-control" name = "content" rows="3" id = "save_lesson_content"></textarea>
                              </div>
                            </div>                            
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" onclick = "deleteLesson()">Удалить</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                      </div>
                    </form>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
            </div><!-- /.edit-modal -->  

            <div class="example-modal">
              <div class="modal" id = "add_pictures_modal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Добавить Изображения</h4>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo base_url('dropzone?cid='.$chapter['course_id']); ?>" class="dropzone">
                        <div class="fallback">
                          <input name="file" type="file" multiple />      
                        </div>
                      </form>                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Закрыть</button>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
            </div><!-- /.example-modal -->    

            <div class="example-modal">
              <div class="modal" id = "list_pictures_modal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Все Изображения</h4>
                    </div>
                    <div class="modal-body">

                      <div id = "course_images">
                      </div>                      
                     
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Закрыть</button>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
            </div><!-- /.example-modal -->                                 


          </section><!-- /.content -->
          
        <script type="text/javascript">
                    
            function editLesson(id){

              $("#save_lesson_name").val("");
              tinymce.get('save_lesson_content').setContent("");

              $.ajax({
                
                url: "<?php echo base_url(); ?>ajaxrequest?request_method=get_lesson_by_id",
                type: "get",
                data:{"lesson_id":id},

                success: function(response) {                

                    var data = $.parseJSON(response);                    
                    
                    $("#save_lesson_name").val(data.name);
                    $("#save_lesson_order").val(data.order_value);
                    $("#save_lesson_type_id").val(data.lesson_type_id);                    
                    $("#save_lesson_id").val(data.id);

                    tinymce.get('save_lesson_content').setContent(data.content);                  
                  
                },
                error: function(xhr) {
                  
                }
              });

              $("#edit_lesson_modal").modal("show");
            }

            function deleteLesson(){

              var conf = confirm("Вы уверены?");

              if(conf){
  
                $("#request_action_id").val("delete_lesson");
                $("#edit_lesson_modal_id").submit();

              }

            }

            function loadPictures(id) {

              $.ajax({
                
                url: "<?php echo base_url(); ?>ajaxrequest?request_method=get_pictures_by_course_id",
                type: "get",
                data:{"course_id": id},

                success: function(response) {

                  var courseImages = "";

                  var dataArray = $.parseJSON(response);
                  
                  for(var i=0;i<dataArray.length;i++){

                    courseImages+="<div class=\"row\">";
                    courseImages+="<div class=\"col-xs-6 col-md-3\">";                          
                    courseImages+="<p class=\"thumbnail\"><img src=\"coursedata/"+id+"/"+dataArray[i].name+"\"></p>";
                    courseImages+="</div>";
                    courseImages+="<div class=\"col-xs-6 col-md-9\">";                          
                    courseImages+="<input type=\"text\" class=\"form-control\" value = \"<?php echo base_url('coursedata'); ?>/"+id+"/"+dataArray[i].name+"\" onClick=\"this.setSelectionRange(0, this.value.length)\" readonly >";
                    courseImages+="</div>";
                    courseImages+="</div>";

                  
                  }

                  $("#course_images").html(courseImages);
                  
                },
                error: function(xhr) {
                  
                }
              });
              
              $("#list_pictures_modal").modal("show");

            }


        </script>

          <?php

            }

          ?>
