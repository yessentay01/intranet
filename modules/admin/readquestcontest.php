          <?php

            if($question!=null){

          ?>      

          <section class="content-header">
            <b>
              <br>
            </b>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>"> Главная</a></li>
              <li><a href="<?php echo base_url("mycontests"); ?>"></i> Мои контесты</a></li>
              <li><a href="<?php echo base_url("readcontest?contest_id=".$question['contest_id']); ?>"> <?php echo $question['test_name']; ?></a></li>
              <li class="active"><?php echo $question['name']; ?></li>
            </ol>
          </section>
          <!-- Main content -->
          <script src="dist/js/dropzone.js"></script>
          <section class="content">
            <div class="col-md-14">
              <div class="col-md-14">
                <!-- Box Comment -->
                <div class="box box-widget">
                  <div class="box-header with-border">
                    <div class="user-block">
                      
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php

                         echo $question['question'];
                         $disabled = ($question['is_finished']==1?"disabled":"");

                    ?>
                  </div>
                  <!-- /.box-body -->
                  <?php

                    if($question['variant_1']!=null){

                  ?>
                  <div class="box-footer box-comments">
                    <div class="box-comment">
                      <input type = "radio" class="img-circle img-sm" name="answer_value" <?php if($question['answered_value']==1){ echo "checked"; } ?> <?php echo $disabled; ?> onclick = "markAnswer(1, <?php echo $question['id']; ?>)" >
                      <div class="comment-text">
                            <span class="username" <?php if($question['is_finished']==1&&$question['answer']==1){ if($question['is_correct']==1){ ?> style="color:green;" <?php } else { ?> style="color:red;" <?php } }?> >
                                Вариант 1
                            </span><!-- /.username -->
                            <?php echo $question['variant_1']; ?>
                      </div>
                    </div>
                  </div>
                  <?php

                    }

                    if($question['variant_2']!=null){

                  ?>
                  <div class="box-footer box-comments">
                    <div class="box-comment">
                      <input type = "radio" class="img-circle img-sm" name="answer_value" <?php if($question['answered_value']==2){ echo "checked"; } ?> <?php echo $disabled; ?> onclick = "markAnswer(2, <?php echo $question['id']; ?>)" >
                      <div class="comment-text">
                            <span class="username" <?php if($question['is_finished']==1&&$question['answer']==2){ if($question['is_correct']==1){ ?> style="color:green;" <?php } else { ?> style="color:red;" <?php } }?> >
                                Вариант 2
                            </span><!-- /.username -->
                            <?php echo $question['variant_2']; ?>
                      </div>
                    </div>
                  </div>
                  <?php

                    }

                    if($question['variant_3']!=null){

                  ?>                  
                  <div class="box-footer box-comments">
                    <div class="box-comment">
                      <input type = "radio" class="img-circle img-sm" name="answer_value" <?php if($question['answered_value']==3){ echo "checked"; } ?> <?php echo $disabled; ?> onclick = "markAnswer(3, <?php echo $question['id']; ?>)" >
                      <div class="comment-text">
                            <span class="username" <?php if($question['is_finished']==1&&$question['answer']==3){ if($question['is_correct']==1){ ?> style="color:green;" <?php } else { ?> style="color:red;" <?php } } ?> >
                                Вариант 3
                            </span><!-- /.username -->
                            <?php echo $question['variant_3']; ?>
                      </div>
                    </div>
                  </div>
                  <?php

                    }

                    if($question['variant_4']!=null){

                  ?>                  
                  <div class="box-footer box-comments">
                    <div class="box-comment">
                      <input type = "radio" class="img-circle img-sm" name="answer_value" <?php if($question['answered_value']==4){ echo "checked"; } ?> <?php echo $disabled; ?> onclick = "markAnswer(4, <?php echo $question['id']; ?>)" >
                      <div class="comment-text">
                            <span class="username" <?php if($question['is_finished']==1&&$question['answer']==4){ if($question['is_correct']==1){ ?> style="color:green;" <?php } else { ?> style="color:red;" <?php } }?> >
                                Вариант 4
                            </span><!-- /.username -->
                            <?php echo $question['variant_4']; ?>
                      </div>
                    </div>
                  </div>
                  <?php

                    }

                  ?>                                                      
                  <div class="box-footer">
                    <form action="#" method="post">
                      <div class="img-push">
                        <?php
                          if(isset($previous_question_id)){
                        ?>
                        <a href = "<?php echo base_url('readquestcontest?question_id='.$previous_question_id);?>" class="btn btn-primary">&#x21E6;</a>
                        <?php
                          }
                        ?>
                        <a href = "<?php echo base_url('readcontest?contest_id='.$question['contest_id']);?>" class="btn btn-primary">Назад</a>
                        <?php
                          if(isset($next_question_id)){
                        ?>
                        <a href = "<?php echo base_url('readquestcontest?question_id='.$next_question_id);?>" class="btn btn-primary">&#x21E8;</a>
                        <?php
                          }
                        ?>
                      </div>
                    </form>
                  </div>
                  <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>

          </section><!-- /.content -->

          <?php

            }

          ?>
          <script type="text/javascript">
            
            function markAnswer(answered_value, contest_question_id) {

              $.ajax({
                
                url: "<?php echo base_url(); ?>ajaxrequest?request_method=mark_answer",
                type: "post",
                data:{"answered_value":answered_value, "contest_question_id": contest_question_id},

                success: function(response) {

                },
                error: function(xhr) {
                  
                }
              });           

            }

          </script>