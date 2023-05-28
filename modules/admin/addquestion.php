          <?php

            if($test!=null){

          ?>

          <script src = "<?php echo base_url("dist/js/tinymce/tinymce.min.js"); ?>"></script>
          <script>
            tinymce.init({ 
              selector:"textarea",
              toolbar: 'fontsizeselect',
              fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
              plugins: [
                "autoresize image media advlist autolink lists link image charmap print preview anchor",
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

          <section class="content-header">
            <b>
              Глава : <?php echo $test['name']; ?>
            </b>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>"> Главная</a></li>
              <li><a href="<?php echo base_url("tests"); ?>"></i> Тесты</a></li>
              <li><a href="<?php echo base_url("edittest?id=".$test['id']); ?>"> <?php echo $test['name']; ?></a></li>
              <li class="active">Добавить вопрос</li>
            </ol>
          </section>
          <!-- Main content -->
          <script src="dist/js/dropzone.js"></script>
          <link rel="stylesheet" href="dist/css/dropzone.css">
          <section class="content">
            <div class="col-md-14">
              <div class="box">
                <div class="box-body col-md-offset-1">
                  <form class="form-horizontal" action = "<?php echo base_url("processrequest"); ?>" method = "post">
                    <input type="hidden" name="request_action" value="add_question">
                    <input type="hidden" name="test_id" value="<?php echo $test['id']; ?>">
                    <div class="form-group">
                      <label class="col-md-2 control-label">Наименование</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Наименование" name = "name">
                      </div>
                    </div>  
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Уровень</label>
                      <div class="col-sm-9">
                        <select class="form-control select2" style="width: 100%;" name = "level">
                          <?php
                            for($i=1;$i<=5;$i++){
                          ?>
                            <option value = "<?php echo $i; ?>"><?php echo $i;?></option>
                          <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Вопрос</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" name = "question" rows="3"></textarea>
                      </div>                      
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Вариант 1</label>
                      <div class="col-md-9">
                        <textarea class="form-control" name = "variant_1"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Вариант 2</label>
                      <div class="col-md-9">
                        <textarea class="form-control" name = "variant_2"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Вариант 3</label>
                      <div class="col-md-9">
                        <textarea class="form-control" name = "variant_3"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Вариант 4</label>
                      <div class="col-md-9">
                        <textarea class="form-control" name = "variant_4"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Правильный вариант</label>
                      <div class="col-sm-9">
                        <select class="form-control select2" style="width: 100%;" name = "answer">
                            <option value = "1">Вариант 1</option>
                            <option value = "2">Вариант 2</option>
                            <option value = "3">Вариант 3</option>
                            <option value = "4">Вариант 4</option>
                        </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <div class="col-sm-2">
                        <button type="submit" class="btn btn-block btn-primary"> Добавить вопрос </button>
                      </div>
                    </div>                                     
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->              
            </div>

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

        </script>

          <?php

            }

          ?>
