<div class="header">

    <div class="title">
        <p>
            Команды
            <a href="#add"><i class="add-icon" data-feather="plus-circle"></i></a>
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <span>Команды</span>
        </div>
    </div>

    <div class="user">
        <a href="<?php echo base_url('profile'); ?>">
            <i class="user-icon" data-feather="user"></i>
            <?php echo $USER_DATA['login']; ?>
        </a>
    </div>

</div>


<div class="box">
    <table id="courses">
        <thead>
        <tr>
            <th>Наименование команды</th>
            <th>Дата создания</th>
            <th>Подробнее</th>
            <th>Редактировать</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($teams as $team): ?>
            <tr>
                <td width="40%"><b><?php echo $team['name']; ?></b></td>
                <td width="40%"><b><?php echo $team['created_date']; ?></b></td>
                <td><a href="<?php echo base_url() . "readteam?id=" . $team['id']; ?>">Подробнее</a></td>
                <td>
                    <button type="button" onclick="editTeam(<?php echo $team['id']; ?>)">Редактировать</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>


<div id="add" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Добавить команду</h3>
                <a href="#close" title="Close" class="close">×</a>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url("processrequest"); ?>" method="POST">
                    <input type="hidden" name="request_action" value="add_team">
                    <input type="text" placeholder="Наименование команды" name="name">
                    <button type="submit" class="button">Добавить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="edit" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Редактировать команду</h3>
                <a href="#close" title="Close" class="close">×</a>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url("processrequest"); ?>" method="POST" id="edit_team_form_id">
                    <input type="hidden" name="request_action" value="save_team" id="request_action_id">
                    <input type="hidden" name="team_id" id="save_team_id">
                    <input type="text" placeholder="Наименование команды" name="name" id="edit_team_name">
                    <button type="submit" class="button">Сохранить</button>
                    <button type="button" class="delete" onclick="deleteTeam()">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function editTeam(id) {

        $("#edit_team_name").val("");

        $.ajax({

            url: "<?php echo base_url(); ?>ajaxrequest?request_method=get_team_by_id",
            type: "get",
            data: {"team_id": id},

            success: function (response) {

                var data = $.parseJSON(response);

                $("#edit_team_name").val(data.name);
                $("#save_team_id").val(data.id);


            },
            error: function (xhr) {

            }
        });

        document.location.replace("#edit");

    }

    function deleteTeam() {

        if (confirm("Вы уверены?")) {

            $("#request_action_id").val("delete_team");
            $("#edit_team_form_id").submit();

        }

    }


</script>