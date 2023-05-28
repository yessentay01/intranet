          <?php

            if($lesson!=null){

          ?>
          <section class="content-header">
            <b>
              Урок
            </b>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>"> Главная</a></li>
              <li><a href="<?php echo base_url("courses"); ?>"></i> Курсы</a></li>
              <li><a href="<?php echo base_url("editcourse?cid=".$lesson['course_id']); ?>"></i> <?php echo $lesson['course_name']; ?></a></li>
              <li><a href="<?php echo base_url("editchapter?chid=".$lesson['chapter_id']); ?>"></i> <?php echo $lesson['chapter_name']; ?></a></li>
              <li class="active"><?php echo $lesson['name']; ?></li>
            </ol>
          </section>
          <!-- Main content -->

          <script src="dist/js/dropzone.js"></script>
          <link rel="stylesheet" href="dist/css/dropzone.css">     

          <section class="content">
            
            <div class="col-md-14">
              <div class="box">
                <div class="box-header">
                  <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin pull-right" id = "pagination_tab">
                    </ul>
                  </div>                    
                </div>
                <div class="box-body col-md-offset-1">
                  <form class="form-horizontal" action = "<?php echo base_url("processrequest"); ?>" method = "post" id = "edit_lesson_modal_id">
                    <input type="hidden" name="request_action" value="save_lesson" id = "request_action_id">
                    <input type="hidden" name="lesson_id" value = "<?php echo $lesson['id']; ?>">
                    <input type="hidden" name="chapter_id" value = "<?php echo $lesson['chapter_id']; ?>">
                    <div class="form-group">
                      <label class="col-md-4 control-label">Наименование</label>
                      <div class="col-md-7">
                        <input type="text" class="form-control" placeholder="Наименование" name = "name" value="<?php echo $lesson['name']; ?>">
                      </div>
                    </div>  
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Порядок</label>
                      <div class="col-sm-7">
                        <select class="form-control select2" style="width: 100%;" name = "order">
                          <?php
                            for($i=1;$i<50;$i++){
                          ?>
                            <option value = "<?php echo $i; ?>" <?php if($lesson['order_value'] == $i ){ echo "selected=\"selected\"";} ?>><?php echo $i;?></option>
                          <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Тип урока</label>
                      <div class="col-sm-7">                              
                        <select class="form-control select2" name = "lesson_type_id">
                          <?php
                            foreach($view_data['lesson_types'] as $lesson_type){
                          ?>
                            <option value = "<?php echo $lesson_type['id']; ?>" <?php if($lesson_type['id']==$lesson['lesson_type_id']){ echo "selected=\"selected\""; } ?> ><?php echo $lesson_type['name'];?></option>
                          <?php
                            }
                          ?>
                        </select> 
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-11">
                        <textarea class="form-control" name = "content" rows="3" style = "min-height:500px;"><?php echo htmlspecialchars($lesson['content']); ?></textarea>
                      </div>                      
                    </div>
                    <div class="form-group">
                      <div class="col-sm-2">
                        <button type="submit" class="btn btn-block btn-primary"> Сохранить урок </button>
                      </div>
                      <div class="col-sm-2">
                        <button class="btn btn-block btn-danger" onclick="deleteLesson()"> Удалить урок </button>
                      </div>
                      <div class="col-sm-2">
                        <a href="#foo" data-toggle="modal" class="btn btn-block btn-default" data-target="#attachmentsModal" data-whatever="@getbootstrap">Вложения</a>
                      </div>
                    </div>
                  </form>                  
                </div>              
              </div><!-- /.box -->              
            </div>                       

            <!-- Modal -->
            <div class="modal fade" id="attachmentsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Вложения</h4>
                  </div>
                  <div class="modal-body">
                    <table class="table">
                      <tr>
                        <th>Наименование</th>
                        <th>Файл</th>
                        <th>Дата вложения</th>
                        <th>Удалить</th>
                      </tr>
                      <?php

                        foreach($attachments as $attachment){

                      ?>
                        <tr>
                          <td>
                            <?php echo $attachment['name'];?>
                          </td>
                          <td>
                            <?php echo $attachment['added_date'];?>
                          </td>
                          <td>
                            <a class = "btn btn-default" href = "<?php echo base_url('get_attached_file?attachment_id='.$attachment['id']);?>">
                              Скачать
                            </a>
                          </td>                             
                          <td>
                            <form action="<?php echo base_url('processrequest');?>" method="post">
                              <input type="hidden" value="delete_attachement" name="request_action">
                              <input type="hidden" value="<?php echo $attachment['id']; ?>" name = "attachment_id">
                              <input type="hidden" value="<?php echo $lesson['id']; ?>" name = "lesson_id">
                              <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                          </td>               
                        </tr>
                      <?php

                        }

                      ?>
                      <form action="<?php echo base_url('processrequest');?>" enctype="multipart/form-data" method="post">
                        <tr>
                          <td colspan="3">
                        <input type="hidden" name = "request_action" value="attach_file">
                        <input type="hidden" value="<?php echo $lesson['id']; ?>" name = "lesson_id">
                        <input class="form-control" type="file" name = "uploaded_file">               
                          </td>
                          <td>
                            <button type="submit" class="btn btn-success">Вложить</button>
                          </td>
                        </tr>
                      </form>
                    </table>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                  </div>
                </div>
              </div>
            </div>  

        <script src = "<?php echo base_url("dist/js/tinymce/tinymce.min.js"); ?>"></script>
        <script>
          tinymce.init({ 
            selector:"textarea",
            toolbar: 'fontsizeselect',
            fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
            plugins: [
              "advlist autolink lists link image charmap print preview anchor",
              "searchreplace visualblocks code fullscreen",
              "insertdatetime media table contextmenu jbimages"
            ],
            
            // ===========================================
            // PUT PLUGIN'S BUTTON on the toolbar
            // ===========================================
            
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
            
            // ===========================================
            // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
            // ===========================================
            
            relative_urls: false, 
            file_browser_callback_types: 'file image media',
            image_advtab: true,
            image_caption: true
          });
        </script>

        <script type="text/javascript">

            function deleteLesson(){

              var conf = confirm("Вы уверены?");

              if(conf){
  
                $("#request_action_id").val("delete_lesson");
                $("#edit_lesson_modal_id").submit();

              }

            }

        </script>

          <?php

            }

          ?>
