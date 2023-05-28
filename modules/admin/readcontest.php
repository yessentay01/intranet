          <?php

            if(isset($contest)){

              $is_finished = $contest['is_finished']==1;

          ?>
          <section class="content-header">
            <b>
              <?php echo $contest['test_name']; ?>
            </b>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>"> Главная </a></li>
              <li><a href="<?php echo base_url('mycontests'); ?>"> Мои контесты </a></li>
              <li class="active"><?php echo $contest['test_name']; ?></li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">            
            <div class="col-md-14">
              <div class="box">
                <div class="box-header">
                  <div class="box-tools">
                  </div>
                </div>
                <div class="box-body">
                  <div class="box box-widget widget-user-2">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="widget-user-header bg-info">
                          <div class="row">
                            <div class="col-md-7">
                              <h3><?php echo $contest['test_name']; ?></h3>
                              <h5><?php echo $contest['description']; ?></h5>
                            </div>
                            <div class="col-md-3">
                              <h3></h3>
                              <h4>Количество вопросов : <?php echo $contest['question_amount']; ?></h4>
                              <h4>Старт : <?php echo $contest['start_time']; ?></h4>
                            </div>
                            <div class="col-md-2">
                              <?php
                                if(!$is_finished){
                              ?>
                              <h3></h3>
                              <center>
                                <button class="btn btn-success" onclick="toFinishContest()">
                                  Завершить
                                </button>
                              </center>
                            <?php
                              }else{
                            ?>
                              <h3></h3>
                              <h4><b><?php echo $contest['correct_answers']; ?></b> из <?php echo $contest['question_amount']; ?></h4>
                              <h4><?php echo round(100*$contest['correct_answers']/($contest['question_amount'])); ?> % </h4>
                            <?php  
                              }
                            ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 
                    <div class="box-footer no-padding">
                      <ul class="nav nav-stacked">
                        <?php
                          
                          if(isset($questions)){

                            $num = 1;
                            
                            foreach($questions as $question){

                              $style = ($question['answered_value']==0?"color:grey;":"color:darkblue;");
                              $correct = ($question['answered_value']==$question['answer']? "<span style = 'color:green;'>&#10004;</span>" : "<span style = 'color:red;'>&#10008;</span>");
                        ?>
                          <li>
                            <a href="<?php echo base_url('readquestcontest?question_id='.$question['id']); ?>">
                              <b style="<?php echo $style;?>">Вопрос <?php echo $num;?></b>  <?php echo ($is_finished?" - $correct":""); ?>
                            </a>
                          </li>
                        <?php

                              $num++;
                          
                            }

                          }

                        ?>
                      </ul>
                    </div>
                  </div>

                  <form action="<?php echo base_url('processrequest'); ?>" method = "post" id = "finish_contest_id">
                    <input type="hidden" name="request_action" value="finish_contest">
                    <input type="hidden" name="contest_id" value="<?php echo $contest['id']; ?>">
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </section><!-- /.content -->
          <?php

            }else{

          ?>



          <?php

            }

          ?>
        <script type="text/javascript">
                    
            function toFinishContest(){

              var conf = confirm("Вы уверены?");

              if(conf){

                $("#finish_contest_id").submit();

              }
              
            }

        </script>