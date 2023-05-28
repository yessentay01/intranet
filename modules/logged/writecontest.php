          <section class="content-header">
            <b>
              Написать контест
            </b>
            <ol class="breadcrumb">
              <li><a href="<?php echo base_url(); ?>"> Главная</a></li>
              <li class="active">Написать контест</li>
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
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style = "width:50%">Наименование</th>
                        <th style = "width:20%">Время контеста</th>
                        <th style = "width:20%">Вопросы</th>
                        <th style = "width:10%">Начать</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        
                        if(isset($tests)){
                        
                        foreach($tests as $test){
                      
                      ?>
                      <tr>
                        <td><?php echo $test['name']; ?></td>
                        <td><?php echo $test['testing_min']; ?> мин</td>
                        <td><?php echo $test['question_amount']; ?></td>
                        <td align = "center">
                          <input type="button" class='btn btn-block btn-success btn-xs' style = 'width:100%' value="Начать" onclick="toGenerateTest(<?php echo $test['id']; ?>)">
                        </td>
                      </tr>
                      <?php

                          }
                        }
                      
                      ?>
                    </tbody>
                  </table>
                  <form action="<?php echo base_url("processrequest"); ?>" method="post" id = "generate_contest_form_id">
                    <input type="hidden" name="request_action" value="generate_contest">
                    <input type="hidden" name="test_id" id = "test_id">
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </section><!-- /.content -->
        <script type="text/javascript">
                    
            function toGenerateTest(test_id){

              $.ajax({
                
                url: "<?php echo base_url(); ?>ajaxrequest?request_method=check_is_contest_unfinished",
                type: "get",
                data:{},

                success: function(response) {         

                    var data = $.parseJSON(response);

                    if(data.unfinished_contests_amount>0){
                      
                      alert("У вас есть не завершенный тест, завершите его!");

                    }else{
                      
                      $("#test_id").val(test_id);
                      $("#generate_contest_form_id").submit();

                    }
                  
                },
                error: function(xhr) {
                  
                }
              });

              $("#edit_test_modal").modal("show");
            }

        </script>