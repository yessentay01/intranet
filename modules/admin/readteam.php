<?php if (isset($team)): ?>

    <div class="header">

        <div class="title">
            <p>
                <?php echo $team['name']; ?>
                <a href="#add"><i class="add-icon" data-feather="plus-circle"></i></a>
            </p>

            <div class="breadcrumb">
                <a href="<?php echo base_url(); ?>">Главная</a>
                <span>•</span>
                <a href="<?php echo base_url('teams'); ?>">Команды</a>
                <span>•</span>
                <span><?php echo $team['name']; ?></span>
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
        <table>
            <thead>
            <tr>
                <th>Логин</th>
                <th>Email</th>
                <th>Роль</th>
                <th>Операции</th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($team_users)): foreach ($team_users as $team_user): ?>
                <tr>
                    <td width="30%"><b><?php echo $team_user['login']; ?></b></td>
                    <td width="30%"><b><?php echo $team_user['email']; ?></b></td>
                    <td width="30%"><b><?php echo $team_user['role']; ?></b></td>
                    <td width="10%">
                        <button type="button" onclick="editTeam(<?php echo $team['id']; ?>)">Убрать</button>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>

    <div class="header">
        <div class="title">
            <p>Расписание</p>
        </div>
    </div>


    <div class="box">
        <table>
            <thead>
                <tr>
                    <th style="width: 14.27%">Время</th>
                    <th style="width: 14.27%">Понедельник</th>
                    <th style="width: 14.27%">Вторник</th>
                    <th style="width: 14.27%">Среда</th>
                    <th style="width: 14.27%">Четверг</th>
                    <th style="width: 14.27%">Пятница</th>
                    <th style="width: 14.27%">Суббота</th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($generated_schedule)): foreach ($generated_schedule as $schedule): ?>
                <tr>
                    <td><?php echo $schedule['lesson_hour']; ?>
                    </td>
                    <td style="font-size:11px;">
                        <?php echo $schedule['monday']; ?>
                    </td>
                    <td style="font-size:11px;">
                        <?php echo $schedule['tuesday']; ?>
                    </td>
                    <td style="font-size:11px;">
                        <?php echo $schedule['wednesday']; ?>
                    </td>
                    <td style="font-size:11px;">
                        <?php echo $schedule['thursday']; ?>
                    </td>
                    <td style="font-size:11px;">
                        <?php echo $schedule['friday']; ?>
                    </td>
                    <td style="font-size:11px;">
                        <?php echo $schedule['saturday']; ?>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>



    <div class="header">
        <div class="title">
            <p>Распределение <a href="#create"><i class="add-icon" data-feather="plus-circle"></i></a></p>
        </div>
    </div>



    <div class="box">
        <table>
            <thead>
                <tr>
                    <th>Наименование курса</th>
                    <th>День в недели</th>
                    <th>Время</th>
                    <th>Преподаватель</th>
                    <th>Редактировать</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($schedule_list)): foreach ($schedule_list as $schedule): ?>
                    <tr>
                        <td style="width:35%">
                            <?php echo $schedule['course_name']; ?>
                        </td>
                        <td style="width:20%">
                            <?php echo $schedule['lesson_day']; ?>
                        </td>
                        <td style="width:20%">
                            <?php echo $schedule['lesson_hour']; ?>
                        </td>
                        <td style="width:20%">
                            <?php echo $schedule['teacher_name']; ?>
                        </td>
                        <td style="width:5%">
                            <button onclick="editSchedule(<?php echo $schedule['id']; ?>,<?php echo $team['id']; ?>)">
                                Редактировать
                            </button>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>



<?php endif; ?>
