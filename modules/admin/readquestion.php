          <?php

            if($question!=null){

          ?>      

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
                  <form class="form-horizontal">
                    <input type="hidden" name="request_action" value="save_question" id = "request_action_id">
                    <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                    <div class="form-group">
                      <label class="col-md-2 control-label">Наименование</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" readonly value="<?php echo $question['name']; ?>">
                      </div>
                    </div>  
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Уровень</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" readonly value="<?php echo $question['level_id']; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Вопрос</label>
                      <div class="col-sm-9">
                        <p>
                          <?php echo $question['question']; ?>
                        </p>
                      </div>                      
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Вариант 1</label>
                      <div class="col-md-9">
                        <p>
                          <?php echo $question['variant_1']; ?>
                        </p>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Вариант 2</label>
                      <div class="col-md-9">
                        <p>
                          <?php echo $question['variant_2']; ?>
                        </p>                    
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Вариант 3</label>
                      <div class="col-md-9">
                        <p>
                          <?php echo $question['variant_3']; ?>
                        </p>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label">Вариант 4</label>
                      <div class="col-md-9">
                        <p>
                          <?php echo $question['variant_4']; ?>
                        </p>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2">Правильный ответ: </label>
                      <label class="col-sm-9">Вариант <?php echo $question['answer']; ?></label>
                      
                    </div> 
                    <br>
                    <div class="form-group">
                      <div class="col-sm-2">
                        <a href = "<?php echo base_url("editquestion?id=").$question['id']; ?>" class="btn btn-block btn-primary"> Редактировать </a>
                      </div>
                    </div>                                     
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->              
            </div>

          </section><!-- /.content -->

          <?php

            }

          ?>
