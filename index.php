<?php

include_once 'init/db.php';

if(CONNECTED):
    $page = "index";

    include_once 'models/functions.php';
    include_once 'models/models.php';

    include_once 'init/user.php';

    include_once 'controllers/controllers.php';
    include_once 'controllers/ajaxcontroller.php';

    if(
        !(isset($_GET['ajax']) && $_GET['ajax'] == 'ajaxrequest') &&
        !(isset($_GET['act']) && $_GET['act'] == 'processrequest')
    ):

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>GRADE•IT</title>

        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('dist/img/letter-g.png'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>design/css/app.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.css">
        <script src="https://unpkg.com/feather-icons"></script>

    </head>
    <body>

        <?php if($online): ?>
            <div class="container">
                <div class="toolbar">
                    <?php include_once "templates/".(IS_ADMIN?"admin":"logged")."/toolbar.php"; ?>
                </div>
                <div class="content">
                    <?php include_once "modules/".(IS_ADMIN?"admin":"logged")."/".$page.".php"; ?>
                </div>
            </div>
        <?php else: ?>
            <?php include_once "modules/notlogged/index.php"; ?>
        <?php endif; ?>


        <script src="<?php echo base_url(); ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="<?php echo base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script>

        <script>
            feather.replace()
        </script>

        <script>
            $(function () {
                $("#courses").DataTable({
                    "order": [[ 1, "asc" ]]
                });
                $("#grades").DataTable({
                    "order": [[ 0, "asc" ]]
                });
            })
        </script>


        <script type="text/javascript">
            $(function () {
                $('.inner-content img').each(function(){
                    $(this).attr('src', "<?php echo base_url(); ?>" + $(this).attr('src'));
                })
            });
        </script>

    </body>
</html>

<?php endif; endif; ?>
