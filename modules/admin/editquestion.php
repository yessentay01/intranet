          <?php

            if($question!=null){

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
              Глава : <?php echo $question['test_name']; ?>
            </b>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>"> Главная</a></li>
              <li><a href="<?php echo base_url("tests"); ?>"></i> Тесты</a></li>
              <li><a href="<?php echo base_url("edittest?id=".$question['test_id']); ?>"> <?php echo $question['test_name']; ?></a></li>
              <li class="active"><?php echo $question['name']; ?></li>
            </ol>
          </section>
          <!-- Main content -->
          <script src="dist/js/dropzone.js"></script>
          <link rel="stylesheet" href="dist/css/dropzone.css">
          <section class="content">
            <div class="col-md-14">
              <div class="box">
                <div class="box-body col-md-offset-1">
                  <form class="form-horizontal" action = "<?php echo base_url("processrequest"); ?>" method = "post" id = "edit_modal_id">
                    <input type="hidden" name="request_action" value="save_question" id = "request_action_id">
                    <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                    <div class="form-group">
                      <label class="col-md-2 control-label">Наименование</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Наименование" name = "name" value="<?php echo $question['name']; ?>">
                      </div>
                    </div>  
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Уровень</label>
                      <div class="col-sm-9">
                        <select class="form-control select2" style="width: 100%;" name = "level">
                          <?php
                            for($i=1;$i<=5;$i++){
                          ?>
                            <option value = "<?php echo $i; ?>" <?php if($i==$question['level_id']){ echo "selected"; } ?> ><?php echo $i;?></option>
                          <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Вопрос</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" name = "question" rows="3"><?php echo $question['question']; ?></textarea>
                      </div>                      
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Вариант 1</label>
                      <div class="col-md-9">
                        <textarea class="form-control" name = "variant_1"><?php echo $question['variant_1']; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Вариант 2</label>
                      <div class="col-md-9">
                        <textarea class="form-control" name = "variant_2"><?php echo $question['variant_2']; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Вариант 3</label>
                      <div class="col-md-9">
                        <textarea class="form-control" name = "variant_3"><?php echo $question['variant_3']; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Вариант 4</label>
                      <div class="col-md-9">
                        <textarea class="form-control" name = "variant_4"><?php echo $question['variant_4']; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Правильный вариант</label>
                      <div class="col-sm-9">
                        <select class="form-control select2" style="width: 100%;" name = "answer">
                            <option value = "1" <?php if($question['answer']==1){ echo "selected"; } ?> >Вариант 1</option>
                            <option value = "2" <?php if($question['answer']==2){ echo "selected"; } ?> >Вариант 2</option>
                            <option value = "3" <?php if($question['answer']==3){ echo "selected"; } ?> >Вариант 3</option>
                            <option value = "4" <?php if($question['answer']==4){ echo "selected"; } ?> >Вариант 4</option>
                        </select>
                      </div>
                    </div> 
                    <br>
                    <div class="form-group">
                      <div class="col-sm-2">
                        <button type="submit" class="btn btn-block btn-primary"> Сохранить вопрос </button>
                      </div>
                      <div class="col-sm-2">
                        <button type="button" class="btn btn-block btn-danger" onclick="deleteQuestion(<?php echo $question['id']; ?>)"> Удалить вопрос </button>
                      </div>
                    </div>                                     
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->              
            </div>

          </section><!-- /.content -->

        <script type="text/javascript">
                    
            function deleteQuestion(){

              var conf = confirm("Вы уверены?");

              if(conf){
  
                $("#request_action_id").val("delete_question");
                $("#edit_modal_id").submit();

              }

            }

        </script>

          <?php

            }

          ?>
