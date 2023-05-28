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
                 <div class="row">
                    <div class="col-xs-2">       
                      <a href="<?php echo base_url('editlesson?lid='.$lesson['id']); ?>" data-toggle="modal" class="btn btn-block btn-default btn-xs" data-whatever="@getbootstrap">Редактировать</a>
                    </div>
                    <div class="col-xs-2">
                      <a href="#foo" data-toggle="modal" class="btn btn-block btn-default btn-xs" data-target="#attachmentsModal" data-whatever="@getbootstrap">Вложения</a>
                    </div>                                      
                  </div>                  
                  <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin pull-right" id = "pagination_tab">
                    </ul>
                  </div>                    
                </div>
                <div class="box-body">
                	<h3><?php echo $lesson['name']; ?></h3>
                	<h4>Тип Урока: <?php echo $lesson['lesson_type_name']; ?></h4>
                	<?php
                		echo $lesson['content'];
                	?>
                </div><!-- /.box-body -->                
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
                        <th>Дата вложения</th>
                        <th>Скачать</th>
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
                            <a class = "btn btn-default" href = "<?php echo $attachment['attachment'];?>">
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
                      <form action="<?php echo base_url('processrequest');?>" method="post">
                        <tr>
                          <td>
                            <input type="hidden" name = "request_action" value="attach_file">
                            <input type="hidden" value="<?php echo $lesson['id']; ?>" name = "lesson_id">
                            <input type="text" class="form-control" name = "name" placeholder="Наименование">
                          </td>
                          <td colspan="2">
                            <input type="text" class="form-control" name = "link" placeholder="Ссылка"></td>
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

          </section><!-- /.content -->

        <script type="text/javascript">
        </script>

          <?php

            }

          ?>
