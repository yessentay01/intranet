<div class="header">

    <div class="title">
        <p>
            Доступы
            <a href="#add"><i class="add-icon" data-feather="plus-circle"></i></a>
        </p>

        <div class="breadcrumb">
            <a href="<?php echo base_url(); ?>">Главная</a>
            <span>•</span>
            <span>Доступы</span>
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
                <th style="width:40%">Наименование доступа</th>
                <th style="width:20%">Дата создания</th>
                <th style="width:20%">Подробнее</th>
                <th style="width:10%">Редактировать</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groups as $group): ?>
                <tr>
                    <td><?php echo $group['name']; ?></td>
                    <td><?php echo $group['created_date']; ?></td>
                    <td><a href="<?php echo base_url('readgroup?gid='.$group['id']); ?>">Подробнее</a></td>
                    <td>
                        <button onclick='editGroup(<?php echo $group['id']; ?>)'>Редактировать</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
