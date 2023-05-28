        <div class="container">
          <section class="content-header">
            <b>
              <?php echo $course['name']; ?>
            </b>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
              <li><a href="<?php echo base_url('courses'); ?>"><i class="fa fa-dashboard"></i> Мои курсы</a></li>
              <li class="active"><?php echo $course['name']; ?></li>
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
		                  <h3 class="widget-user-username"><?php echo $course['name']; ?></h3>
		                  <h5 class="widget-user-desc"><?php echo $course['description']; ?></h5>
		                </div>
		                <div class="box-footer no-padding">
		                  <ul class="nav nav-stacked">
		                  	<?php
		                  		foreach($chapters as $chapter){
		                  	?>
		                    	<li><a href="<?php echo base_url('readchapter?chid='.$chapter['id']); ?>"><?php echo $chapter['name']; ?></a></li>
		                    <?php
		                    	}
		                    ?>
		                  </ul>
		                </div>
		              </div>
	                </div><!-- /.box-body -->
	              </div><!-- /.box -->
	            </div><!-- /.col -->
	          </div><!-- /.row -->          	
          </section><!-- /.content -->
        </div><!-- /.container -->