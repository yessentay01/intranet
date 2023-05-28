        <div class="container">
          <section class="content-header">
            <b>
              <?php echo $chapter['name']; ?>
            </b>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
              <li><a href="<?php echo base_url('courses'); ?>"><i class="fa fa-dashboard"></i> Мои курсы</a></li>
              <li><a href="<?php echo base_url('readcourse?cid='.$chapter['course_id']); ?>"><i class="fa fa-dashboard"></i> <?php echo $chapter['course_name'];?></a></li>
              <li class="active"><?php echo $chapter['name']; ?></li>
            </ol>
          </section>
          <!-- Main content -->
          <section class="content">           
	          <div class="row">
	            <div class="col-xs-12">
	              <div class="box">
	                <div class="box-body">
		              <div class="box box-widget widget-user-2">		                
		                <div class="widget-user-header bg-yellow">
		                  <h3 class="widget-user-username"><?php echo $chapter['name']; ?></h3>
		                  <h5 class="widget-user-desc"><?php echo $chapter['description']; ?></h5>
		                </div>
		                <div class="box-body">

		                  	<?php

		                  		$last_lesson_type_id = 0;
		                  		$lesson_number_value = 0;

		                  		foreach($lessons as $lesson){

		                  			if($last_lesson_type_id!=$lesson['lesson_type_id']){
		                  				$lesson_number_value = 0;
		                  				$last_lesson_type_id = $lesson['lesson_type_id'];
		                  			}

		                  			$lesson_number_value++;

		                  	?>
				                <div class="widget-user-header bg-gray">
				                  <h3 class="widget-user-username"><?php echo $lesson['lesson_type_name']; ?> <?php echo $lesson_number_value; ?></h3>
				                  <h5 class="widget-user-desc"><?php echo $lesson['name']; ?></h5>
				                </div>
								<p>
									<?php
										echo $lesson['content'];
									?>
								</p>
				                      <?php

				                      	$attachments = get_attachments_by_lesson_id($lesson['id']);

				                      	if($attachments!=null){

				                      	?>
										<div class="widget-user-header bg-blue">
										<h5>Вложения</h5>

					                    <table class="table">
					                      <tr>
					                        <th>Наименование</th>
					                        <th>Дата добавления</th>
					                        <th>Скачать</th>				                        				                        
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
				                            <a class = "btn btn-default btn-xs" href = "<?php echo $attachment['attachment']; ?>">
				                              Скачать
				                            </a>
				                          </td>
				                        </tr>
				                    	<?php
				                    			
				                    		}

				                    	?>
				                    </table>
								</div>
								<br>

		                    <?php
		                    		}
		                    	}
		                    ?>

		                </div>
		              </div>
	                </div><!-- /.box-body -->
	              </div><!-- /.box -->
	            </div><!-- /.col -->
	          </div><!-- /.row -->          	
          </section><!-- /.content -->
        </div><!-- /.container -->