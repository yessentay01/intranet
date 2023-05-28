          <section class="content-header">
            <b>
              Мои контесты
            </b>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>"> Главная </a></li>
              <li class="active">Мои контесты</li>
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
                  <table id="contests_table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style = "width:30%">Предмет</th>
                        <th style = "width:20%">Время</th>
                        <th style = "width:20%">Вопросы</th>
                        <th style = "width:20%">Статус</th>
                        <th style = "width:10%">Операции</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        
                        if(isset($contests)){
                        
                        foreach($contests as $contest){
                      
                      ?>
  
                        <tr>
                          <td><?php echo $contest['test_name']; ?></td>
                          <td><?php echo $contest['start_time']; ?></td>
                          <td><?php echo $contest['question_amount']; ?> </td>
                          <?php
                            if($contest['is_finished']==0){
                          ?>
                            <td style="color:red;">Не завершен</td>
                            <td align = "center">
                              <a href = '<?php echo base_url('readcontest?contest_id='.$contest['id']); ?>' class='btn btn-block btn-success btn-xs' style = 'width:100%'>Продолжить</a>
                            </td>
                          <?php
                            }else{
                          ?>
                            <td style="color:green;">Завершен</td>
                            <td align = "center">
                              <a href = '<?php echo base_url('readcontest?contest_id='.$contest['id']); ?>' class='btn btn-block btn-primary btn-xs' style = 'width:100%'>Результаты</a>
                            </td>                            
                          <?php
                            }
                          ?>
                        </tr>
                      
                      <?php

                          }
                        }
                      
                      ?>

                    </tbody>
                  </table>


                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>                   

          </section><!-- /.content -->
