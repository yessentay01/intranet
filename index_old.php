<?php

    include 'init/db.php';

    if(CONNECTED){

        $page = "index";

        include 'models/functions.php';
        include 'models/models.php';

        include 'init/user.php';

        include 'controllers/controllers.php';
        include 'controllers/ajaxcontroller.php';

        if(!(isset($_GET['ajax'])&&$_GET['ajax']=='ajaxrequest')&&!(isset($_GET['act'])&&$_GET['act']=='processrequest')){

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ПОРТАЛ BITLAB</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('dist/img/logo.png'); ?>" />
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


    <!--
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    -->
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/pace/pace.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-blue layout-top-nav">

    <?php

        if($online){

    ?>
    <div class="wrapper">
        <?php

          include "templates/".(IS_ADMIN?"admin":"logged")."/header_menu.php";

        ?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
          <div class="container">
            <?php

                include "modules/".(IS_ADMIN?"admin":"logged")."/".$page.".php";

            ?>
          </div>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="container">
          <div class="pull-right hidden-xs">
            Разработка команды <b>BITLAB Team</b>
          </div>
          <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://bitlab.kz">bitlab.kz</a>.</strong> Все права защищены.
        </div><!-- /.container -->
      </footer>
    </div><!-- ./wrapper -->
    <?php

        }else{

          include "modules/notlogged/index.php";

        }

    ?>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- PACE -->
    <script src="<?php echo base_url(); ?>plugins/pace/pace.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url(); ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>dist/js/demo.js"></script>

    <script type="text/javascript">
      // To make Pace works on Ajax calls
      $(document).load(function() { Pace.restart(); });

    </script>

    <script>
      $(function () {
        $("#example1").DataTable({
          <?php
            if($page=='editcourse'||$page=='editchapter'){
          ?>
            "order": [[ 1, "asc" ]]
          <?php
            }
          ?>
        });
      });

      <?php
        if($page=='readgroup'){
      ?>
        $(function () {
          $("#availavle_users_table").DataTable();
        });

        $(function () {
          $("#availavle_courses_table").DataTable();
        });

        $(function () {
          $("#users_table").DataTable();
        });

        $(function () {
          $("#courses_table").DataTable();
        });

      <?php
        }
        if($page=='readteam'){
      ?>
        $(function () {
          $("#availavle_users_table").DataTable();
        });

        $(function () {
          $("#users_table").DataTable();
        });

      <?php

        }
        if($page=='mycontests'){

      ?>
        $(function () {
          $("#contests_table").DataTable({
            "order": [[ 3, "desc" ], [ 1, "desc" ]]
          });
        });
      <?php
        }
        if($page=='teams'){
      ?>

        $(function () {
          $("#teams_table").DataTable({
            "order": [[ 1, "desc" ]]
          });
        });

      <?php
        }
      ?>
    </script>
  </body>
</html>
<?php

        }
    }

?>