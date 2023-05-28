<div class="header">

    <div class="title">
        <p>
            Курсы
            <a href="#add"><i class="add-icon" data-feather="plus-circle"></i></a>
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <span>Курсы</span>
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
    <table id="courses">
        <thead>
            <tr>
                <th>Наименование</th>
                <th>Подробнее</th>
                <th>Редактировать</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($courses as $course): ?>
            <tr>
                <td width="80%"><b><?php echo $course['name']; ?></b></td>
                <td><a href = "<?php echo base_url()."editcourse?cid=".$course['id']; ?>">Подробнее</a></td>
                <td><button type="button" onclick="editCourse(<?php echo $course['id']; ?>)">Редактировать</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="add" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Добавить Курс</h3>
                <a href="#close" title="Close" class="close">×</a>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url("processrequest"); ?>" method="POST">
                    <input type="hidden" name="request_action" value="add_course">
                    <input type="text" placeholder="Наименование" name = "name">
                    <textarea name="description" rows="3" placeholder="Описание ..."></textarea>
                    <button type="submit" class="button" >Добавить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="add" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Добавить Курс</h3>
                <a href="#close" title="Close" class="close">×</a>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url("processrequest"); ?>" method="POST">
                    <input type="hidden" name="request_action" value="add_course">
                    <input type="text" placeholder="Наименование" name = "name">
                    <textarea name="description" rows="3" placeholder="Описание ..."></textarea>
                    <button type="submit" class="button" >Добавить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="edit" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Редактировать Курс</h3>
                <a href="#close" title="Close" class="close">×</a>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url("processrequest"); ?>" method="POST" id="save_course_form_id">

                    <input id="request_action_id" type="hidden" name="request_action" value="save_course">
                    <input id="course_id" type="hidden" name="course_id" >

                    <input id="course_name" type="text" placeholder="Наименование" name="name">
                    <textarea id="course_description" name="description" rows="3" placeholder="Описание ..."></textarea>
                    <button type="submit" >Сохранить</button>
                    <button onclick="deleteCourse()" type="button" class="delete">Удалить</button>

                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function editCourse(id) {

        $("#course_id").val("");
        $("#course_name").val("");
        $("#course_description").val("");

        $.get("<?php echo base_url(); ?>ajaxrequest?request_method=get_course_by_id", { "course_id":id }, function(response){
            const data = $.parseJSON(response);
            $("#course_id").val(data.id);
            $("#course_name").val(data.name);
            $("#course_description").val(data.description);
        })

        document.location.replace("#edit");
    }

    function deleteCourse(){
        if(confirm("Вы уверены?")) {
            $("#request_action_id").val("delete_course");
            $("#save_course_form_id").submit();
        }
    }
</script>