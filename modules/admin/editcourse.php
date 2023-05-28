<?php if($course != null): ?>

<div class="header">

    <div class="title">
        <p>
            Курс
            <a href="#add"><i class="add-icon" data-feather="plus-circle"></i></a>
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <a href="<?php echo base_url("courses"); ?>">Курсы</a>
            <span>•</span>
            <span><?php echo $course['name']; ?></span>
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
            <th>Порядок</th>
            <th>Подробнее</th>
            <th>Редактировать</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($chapters as $chapter): ?>
            <tr>
                <td width="40%"><b><?php echo $chapter['name']; ?></b></td>
                <td width="40%"><b><?php echo $chapter['order_value']; ?></b></td>
                <td><a href = "<?php echo base_url('editchapter?chid='.$chapter['id']); ?>">Подробнее</a></td>
                <td><button type="button" onclick="editChapter(<?php echo $chapter['id']; ?>)">Редактировать</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="add" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Добавить Главу</h3>
                <a href="#close" title="Close" class="close">×</a>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url("processrequest"); ?>" method="POST">
                    <input type="hidden" name="request_action" value="add_chapter">
                    <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">

                    <input type="text" placeholder="Наименование" name="name">


                    <label>Порядок</label>
                    <select name="order">
                        <?php for ($i=1; $i<50; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                        <?php endfor; ?>
                    </select>


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
                <h3 class="modal-title">Редактировать Главу</h3>
                <a href="#close" title="Close" class="close">×</a>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url("processrequest"); ?>" method="POST" id="edit_chapter_modal">

                    <input id="request_action_id" type="hidden" name="request_action" value="save_chapter">
                    <input id="chapter_id" type="hidden" name="chapter_id" >
                    <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">

                    <input id="chapter_name" type="text" placeholder="Наименование" name="name">


                    <label>Порядок</label>
                    <select name="order" id="chapter_order">
                        <?php for ($i=1; $i<50; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                        <?php endfor; ?>
                    </select>


                    <textarea id="chapter_description" name="description" rows="3" placeholder="Описание ..."></textarea>
                    <button type="submit" >Сохранить</button>
                    <button onclick="deleteChapter()" type="button" class="delete">Удалить</button>

                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function editChapter(id) {

        $("#chapter_id").val("");
        $("#chapter_name").val("");
        $("#chapter_order").val("");
        $("#chapter_description").val("");

        $.get("<?php echo base_url(); ?>ajaxrequest?request_method=get_chapter_by_id", { "chapter_id":id }, function(response){
            const data = $.parseJSON(response);
            $("#chapter_id").val(data.id);
            $("#chapter_name").val(data.name);
            $("#chapter_order").val(data.order_value);
            $("#chapter_description").val(data.description);
        })

        document.location.replace("#edit");
    }

    function deleteChapter(){
        if(confirm("Вы уверены?")) {
            $("#request_action_id").val("delete_chapter");
            $("#edit_chapter_modal").submit();
        }
    }
</script>

<?php endif; ?>
