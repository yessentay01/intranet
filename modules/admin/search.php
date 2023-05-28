<div class="container">
	<br><br>
	<!-- Main content -->
	<section class="content">
		<div class="row">
		  	<div class="col-md-18">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3>Результаты поиска: <?php if(isset($_GET['key'])){ echo $_GET['key']; } ?></h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						<?php

							if(isset($search_results)){

								foreach ($search_results as $result) {
							
						?>

							<h1></h1>

							<div class="timeline-item">
				                <h3 class="timeline-header">
				                	<a href="<?php echo base_url('readlesson?lid='.$result['id']); ?>" style = "color:black;">
				                		<?php echo "Урок : ".$result['lesson_name'].", глава: ".$result['chapter_name'].", урок: ".$result['name'];?>
				                	</a>
				                </h3>
				                <div class="timeline-body">
				                	<div>
				                		<div>
						                	<?php
						                		echo strip_tags($result['lesson_content'],'<h1><h2><h3><h4><h5><p><a><div><img><strong><span><pre>');
						                		//echo "<p>".strip_tags($result['lesson_content'])."</p>";
						                	?>
					                	</div>
					                </div>
				                </div>
				                <div class="timeline-footer">
				                  <a class="btn btn-primary btn-xs" href = "<?php echo base_url('readlesson?lid='.$result['id']); ?>">Подробнее</a>
				                </div>
				            </div>
						<?php

								}

							}

						?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div><!-- /.container -->