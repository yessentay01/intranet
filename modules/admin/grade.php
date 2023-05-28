<div class="header">

    <div class="title">
        <p>
            <?php echo $course["name"]; ?>
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <a href="<?php echo base_url('grades'); ?>">Мои курсы</a>
            <span>•</span>
            <a href="<?php echo base_url("gradegroup?tid=$team_id&cid=$course_id"); ?>"><?php echo $team["name"]; ?></a>
            <span>•</span>
            <span><?php echo $course["name"]; ?></span>
        </div>
    </div>

    <div class="user">
        <a href="<?php echo base_url('profile'); ?>" >
            <i class="user-icon" data-feather="user"></i>
            <?php echo $USER_DATA['login']; ?>
        </a>
    </div>

</div>

<div class="box">
    <table>
        <thead>
        <tr>
            <th>Группа</th>
            <th>Курс</th>
            <th>Оценка</th>
            <th>домашнее задание</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($members as $member): ?>
            <tr>
                <td width="25%"><b><?php echo $member['login']; ?></b></td>
                <td width="35%"><b><?php echo $member['email']; ?></b></td>
                <td width="15%"><button type="button" onclick="loadGrade(<?php echo intval($member['id']); ?>)">Ставить оценку</button></td>
                <td width="25%"><button type="button" onclick="loadHomework(<?php echo intval($member['id']); ?>)">Посмотреть домашнее задание</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="grade" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Ставить оценку</h3>
                <a href="#close" title="Close" class="close">×</a>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url("processrequest"); ?>" method="POST">
                    <input type="hidden" name="request_action" value="make_grade">

                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $course_id; ?>">
                    <input type="hidden" name="team_id" id="team_id" value="<?php echo $team_id; ?>">
                    <input type="hidden" name="teacher_id" id="teacher_id" value="<?php echo $teacher_id; ?>">
                    <input type="hidden" name="user_id" id="user_id">

                    <input type="number" id="grade_val" placeholder="Оценка" name="grade">
                    <button type="submit" class="button" >Ставить</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="homework" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Домашнее задание</h3>
                <a href="#close" title="Close" class="close">×</a>
            </div>
            <div class="modal-body">
                <div id="file"></div>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    function loadGrade(id) {

        const course_id = $("#course_id").val();
        const team_id = $("#team_id").val();
        const teacher_id = $("#teacher_id").val();
        $("#user_id").val(id);

        $.get(
            "<?php echo base_url(); ?>ajaxrequest?request_method=get_grade",
            {
                "course_id": course_id,
                "team_id": team_id,
                "teacher_id": teacher_id,
                "user_id": id
            },
            function (response) {
                $("#grade_val").val(parseInt(response));
                document.location.replace("#grade");
            }
        )
    }

    function loadHomework(id) {

        const course_id = '<?php  echo $course_id; ?>';
        const team_id = '<?php  echo $team_id; ?>';
        const teacher_id = '<?php  echo $teacher_id; ?>';

        $.get(
            "<?php echo base_url(); ?>ajaxrequest?request_method=get_homework",
            {
                "course_id": course_id,
                "team_id": team_id,
                "teacher_id": teacher_id,
                "user_id": id
            },
            function (response) {
                if(response === "0"){
                    $("#file").html("<p style='text-align: center;padding: 10px'>Файл не выбран</p>");
                }
                else {
                    $("#file").html("<p style='text-align: center;padding: 10px'>Файл: <br /><a style='color: #8bc34a;font-weight: bold' href='#close'>" + response + "</a></p>");
                }
                document.location.replace("#homework");
            }
        )
    }
</script>