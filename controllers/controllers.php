<?php

    if($online){
    
        if(IS_ADMIN){
            
            if(isset($_GET['page'])){
            
                if($_GET['page']=='index'){
                	
					$courses = get_all_courses();

                    $page = 'courses';
                      
                }else if($_GET['page']=='courses'){
                
                    $page = 'courses';
                    $courses = get_all_courses();
                
                }else if($_GET['page']=='grades'){

                    $page = 'grades';
                    $id = intval($_SESSION["user"]["id"]);
                    $schedule = get_schedule_by_teacher_id($id);

                } else if($_GET['page']=='gradegroup'){

                    $page = 'gradegroup';

                    $user_id = intval($_SESSION["user"]["id"]);
                    $course_id = intval($_GET["cid"]);
                    $team_id = intval($_GET["tid"]);

                    $team = get_team_by_id($team_id);
                    $chapters = get_chapters_by_course_id($course_id);

                    $dates = get_dates_from_schedulte($user_id, $team_id, $course_id);

                }
                else if ($_GET['page']=='grade') {

                    $page = 'grade';

                    $teacher_id = intval($_SESSION["user"]["id"]);
                    $course_id = intval($_GET["cid"]);
                    $team_id = intval($_GET["tid"]);

                    $team = get_team_by_id($team_id);
                    $course = get_course_by_id($course_id);

                    $members = get_all_team_users_by_team_id($team_id);
                }
                else if($_GET['page']=='users'){
                
                    $page = 'users';
                    $users = get_all_users();
                
                }else if($_GET['page']=='tests'){

                    $tests = get_all_tests();
                    $page = 'tests';
                
                }else if($_GET['page']=='edittest'){

                    if(isset($_GET['id'])&&is_numeric($_GET['id'])){

                        $test = get_test_by_id($_GET['id']);
                        
                        if($test!=null){
                            $questions = get_all_question_names_by_test_id($_GET['id']);
                        }
                        
                        $page = 'edittest';
                    
                    }
                
                }else if($_GET['page']=='addquestion'){

                    if(isset($_GET['id'])&&is_numeric($_GET['id'])){

                        $test = get_test_by_id($_GET['id']);
                        $page = 'addquestion';
                    
                    }
                
                }else if($_GET['page']=='editquestion'){

                    if(isset($_GET['id'])&&is_numeric($_GET['id'])){

                        $question = get_question_by_id($_GET['id']);
                        $page = 'editquestion';
                    
                    }
                
                }else if($_GET['page']=='readquestion'){

                    if(isset($_GET['id'])&&is_numeric($_GET['id'])){

                        $question = get_question_by_id($_GET['id']);
                        $page = 'readquestion';
                    
                    }
                
                }else if($_GET['page']=='writecontest'){

                    $tests = get_all_tests();
                    $page = 'writecontest';                
                
                }else if($_GET['page']=='mycontests'){

                    $contests = get_contests_by_user_id($USER_DATA['id']);
                    $page = 'mycontests';                
                
                }else if($_GET['page']=='readcontest'){
                    
                    if(isset($_GET['contest_id'])&&is_numeric($_GET['contest_id'])){

                        $contest = get_contest_by_contest_id_and_user_id($_GET['contest_id'], $USER_DATA['id']);
                        
                        if($contest!=null){

                            $questions = get_contest_questions_by_user_id_and_contest_id($contest['id']);

                        }

                    }
                    $page = 'readcontest';                
                
                }else if($_GET['page']=='readquestcontest'){
                    
                    if(isset($_GET['question_id'])&&is_numeric($_GET['question_id'])){

                        $question = get_contest_question_by_user_id_and_question_id($USER_DATA['id'], $_GET['question_id']);
                        $next_question_id = get_next_contest_question_by_user_id_and_contest_id($USER_DATA['id'], $question['contest_id'], $question['id']);
                        $previous_question_id = get_previous_contest_question_by_user_id_and_contest_id($USER_DATA['id'], $question['contest_id'], $question['id']);

                    }

                    $page = 'readquestcontest';                
                
                }else if($_GET['page']=='search'){
                    
                    if(isset($_GET['key'])){

                        $search_results = search($USER_DATA['id'], $_GET['key']);
                    
                    }
                    $page = 'search';                    
                
                }else if($_GET['page']=='groups'){
                
                    $page = 'groups';
                    $groups = get_all_groups();
                
                }else if($_GET['page']=='teams'){
                
                    $page = 'teams';
                    $teams = get_all_teams();
                
                }else if($_GET['page']=='readgroup'){
                                    
                    if(isset($_GET['gid'])&&is_numeric($_GET['gid'])){

                        if(($group = get_group_by_id($_GET['gid']))!=null){                
                            
                            $page = 'readgroup';
                            $available_user_list = get_all_available_group_users($_GET['gid']);
                            $group_users = get_all_group_users_by_group_id($_GET['gid']);

                            $available_course_list = get_all_available_group_courses($_GET['gid']);
                            $group_courses = get_all_group_courses_by_group_id($_GET['gid']);
                        
                        }else{

                            $page = "access_error";

                        }
                    
                    }else{

                        $page = "404";

                    }
                    
                
                }else if($_GET['page']=='readteam'){
                                    
                    if(isset($_GET['id'])&&is_numeric($_GET['id'])){

                        if(($team = get_team_by_id($_GET['id']))!=null){
                            
                            $generated_schedule = generate_schedule_by_team_id($_GET['id']);
                            $course_list = get_all_courses();
                            $schedule_list = get_schedule_list_by_team_id($_GET['id']);
                            $admins = get_all_users_by_roles(1);

                            $page = 'readteam';
                            $available_user_list = get_all_available_team_users($_GET['id']);
                            $team_users = get_all_team_users_by_team_id($_GET['id']);
                        
                        }else{

                            $page = "access_error";

                        }
                    
                    }else{

                        $page = "404";

                    }
                    
                
                }else if($_GET['page']=='editcourse'){
                
                    if(isset($_GET['cid'])&&is_numeric($_GET['cid'])){

                        if(($course = get_course_by_id($_GET['cid']))!=null){                
                            
                            $page = 'editcourse';
                            $chapters = get_all_chapters_by_course_id($_GET['cid']);                            
                        
                        }else{

                            $page = "access_error";

                        }
                    
                    }else{

                        $page = "404";

                    }
                
                }else if($_GET['page']=='editchapter'){
                
                    if(isset($_GET['chid'])&&is_numeric($_GET['chid'])){

                        if(($chapter = get_chapter_by_id($_GET['chid']))!=null){ 
                            
                            $page = 'editchapter';
                            $view_data['lesson_types'] = get_all_lesson_types();
                            $lessons = get_lessons_by_chapter_id($_GET['chid']);
                        
                        }else{

                            $page = "access_error";

                        }
                    
                    }else{

                        $page = "404";

                    }
                
                }else if($_GET['page']=='editlesson'){
                
                    if(isset($_GET['lid'])&&is_numeric($_GET['lid'])){

                        if(($lesson = get_lesson_by_id($_GET['lid']))!=null){                
                            
                            $page = 'editlesson';
                            $view_data['lesson_types'] = get_all_lesson_types();

                            $attachments = get_attachments_by_lesson_id($_GET['lid']);
                        
                        }else{

                            $page = "access_error";

                        }
                    
                    }else{

                        $page = "404";

                    }
                
                }else if($_GET['page']=='readlesson'){
                
                    if(isset($_GET['lid'])&&is_numeric($_GET['lid'])){

                        if(($lesson = get_lesson_by_id($_GET['lid']))!=null){                
                            
                            $page = 'readlesson';
                            $view_data['lesson_types'] = get_all_lesson_types();

                            $attachments = get_attachments_by_lesson_id($_GET['lid']);
                        
                        }else{

                            $page = "access_error";

                        }
                    
                    }else{

                        $page = "404";

                    }
                
                }else if($_GET['page']=='addlesson'){

                    if(isset($_GET['chid'])&&is_numeric($_GET['chid'])){

                        if(($chapter = get_chapter_by_id($_GET['chid']))!=null){ 
                            
                            $page = 'addlesson';
                            $view_data['lesson_types'] = get_all_lesson_types();
                            $lessons = get_lessons_by_chapter_id($_GET['chid']);
                        
                        }else{

                            $page = "access_error";

                        }
                    
                    }else{

                        $page = "404";

                    }                    
                
                }else if($_GET['page']=='profile'){
                
                    $page = 'profile';
                
                }else if($_GET['page']=='get_attached_file'){

                    if(isset($_GET['attachment_id'])&&is_numeric($_GET['attachment_id'])){

                        $attach = get_attachment_by_id($_GET['attachment_id']);

                        header("Content-Type: ". $attach['mime']);
                        header("Content-Length: ". $attach['size']);
                        header("Content-Disposition: attachment; filename=".($attach['name'])."");

                        echo $attach['attachment'];

                    }

                }
        
            }
                    
        }else{
            
            if(isset($_GET['page'])){
            
                if($_GET['page']=='index'){
					
                    $teams = get_all_teams_by_user_id($USER_DATA['id']);
                    $generated_schedule_list = array();
                    $index = 0;

                    if($teams!=null){
                        foreach ($teams as $team) {
                            $generated_schedule_list[$index]['team'] = $team;
                            $generated_schedule_list[$index]['schedule'] = generate_schedule_by_team_id($team['id']);
                            $index++;
                        }
                    }
                	$page = 'schedule';
                      
                }else if($_GET['page']=='profile'){
                
                    $page = 'profile';
                
                }else if($_GET['page']=='courses'){
                    
                    $courses = get_access_courses_by_user_id($USER_DATA['id']);
                    $page = 'courses';
                
                }else if($_GET['page']=='readcourse'){
                    
                    if(isset($_GET['cid'])&&is_numeric($_GET['cid'])){
                        
                        $course = get_access_course_by_user_id_and_course_id($USER_DATA['id'], $_GET['cid']);

                        if(isset($course)){                     
                            
                            $chapters = get_access_chapters_by_user_id_and_course_id($USER_DATA['id'], $_GET['cid']);
                            $page = 'readcourse';

                        }else{

                            $page = "access_error";                            

                        }

                    }else{

                        $page = "access_error";

                    }                    
                    
                
                }else if($_GET['page']=='readchapter'){
                    
                    if(isset($_GET['chid'])&&is_numeric($_GET['chid'])){
                        
                        $chapter = get_access_chapter_by_user_id_and_chapter_id($USER_DATA['id'], $_GET['chid']);

                        if(isset($chapter)){
                            
                            $lesson_types = get_all_lesson_types();
                            $lessons = get_access_lessons_by_user_id_and_chapter_id($USER_DATA['id'], $_GET['chid']);                            

                            $page = 'readchapter';

                        }else{

                            $page = "access_error";                            

                        }

                    }else{

                        $page = "access_error";

                    }                    
                    
                
                }else if($_GET['page']=='get_attached_file'){

                    if(isset($_GET['attachment_id'])&&is_numeric($_GET['attachment_id'])){

                        $attach = get_attachment_by_id($_GET['attachment_id']);

                        header("Content-Type: ". $attach['mime']);
                        header("Content-Length: ". $attach['size']);
                        header("Content-Disposition: attachment; filename=".($attach['name'])."");

                        echo $attach['attachment'];

                    }

                }else if($_GET['page']=='schedule'){
                
                    $teams = get_all_teams_by_user_id($USER_DATA['id']);
                    $generated_schedule_list = array();
                    $index = 0;
                    
                    if($teams!=null){
                        foreach ($teams as $team) {
                            $generated_schedule_list[$index]['team'] = $team;
                            $generated_schedule_list[$index]['schedule'] = generate_schedule_by_team_id($team['id']);
                            $index++;
                        }
                    }
                    $page = 'schedule';
                
                }else if($_GET['page']=='writecontest'){

                    $tests = get_all_tests();
                    $page = 'writecontest';                
                
                }else if($_GET['page']=='mycontests'){

                    $contests = get_contests_by_user_id($USER_DATA['id']);
                    $page = 'mycontests';                
                
                }else if($_GET['page']=='readcontest'){
                    
                    if(isset($_GET['contest_id'])&&is_numeric($_GET['contest_id'])){

                        $contest = get_contest_by_contest_id_and_user_id($_GET['contest_id'], $USER_DATA['id']);
                        
                        if($contest!=null){

                            $questions = get_contest_questions_by_user_id_and_contest_id($contest['id']);

                        }

                    }
                    $page = 'readcontest';                
                
                }else if($_GET['page']=='readquestcontest'){
                    
                    if(isset($_GET['question_id'])&&is_numeric($_GET['question_id'])){

                        $question = get_contest_question_by_user_id_and_question_id($USER_DATA['id'], $_GET['question_id']);
                        $next_question_id = get_next_contest_question_by_user_id_and_contest_id($USER_DATA['id'], $question['contest_id'], $question['id']);
                        $previous_question_id = get_previous_contest_question_by_user_id_and_contest_id($USER_DATA['id'], $question['contest_id'], $question['id']);

                    }

                    $page = 'readquestcontest';                
                
                }                
        
            }
            
        }
    
    }else{
    
        if(isset($_GET['page'])){
        
            if($_GET['page']=='index'){
            
                $page = 'index';
                    
            }
            
        }
    
    }

    /////////#############################################################################################///////////    /////////#############################################################################################///////////
    /////////#############################################################################################///////////
    /////////#############################################################################################///////////
    /////////#################################### ACTION CONTROLLER ######################################///////////
    /////////#############################################################################################///////////
    /////////#############################################################################################///////////
    /////////#############################################################################################///////////
    /////////#############################################################################################///////////



    if($online){
      
        if(isset($_GET['act'])){
            
            if(IS_ADMIN){
    
                if($_GET['act']=='logout'){
                
                    session_destroy();
                    setcookie('auth_user_data', null, 0);
                    header("Location:".base_url());
                  
                }else if($_GET['act']=='processrequest'){

                    $uri = "";

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='add_user'){

                        $login = trim($_POST['login']);
                        $pass1 = trim($_POST['password1']);
                        $pass2 = trim($_POST['password2']);
                        $email = trim($_POST['email']);
                        $role = trim($_POST['role_id']);
                        $phone = trim($_POST['user_phone']);
                        $status = trim($_POST['user_status']);
                                                                    
                        if($login!=""&&$pass1!=""&&$pass2!=""&&$email!=""&&$role!=""){
                         
                            if($pass2==$pass2){
                                
                                if(add_new_user($login, $email, $pass1, $role, $phone, $status)){
                                    
                                    $uri = "users/?success=1";    
                                    
                                }else{
                                    
                                    $uri = "users/?error=1";
                                    
                                }
                                
                                
                            }else{
                                
                                $uri = "users/?error=2";
                                
                            }
                        
                        }else{
                            
                            $uri = "users/?error=3";
                            
                        }

                    }
                    
                    if(isset($_POST['request_action'])&&$_POST['request_action']=='save_user'){

                        $user_id = $_POST['user_id'];
                        $login = trim($_POST['login']);
                        $email = trim($_POST['email']);
                        $role  = trim($_POST['role_id']);
                        $phone = trim($_POST['user_phone']);
                        $status = trim($_POST['user_status']);
                                                                    
                        if($user_id!=null&&is_numeric($user_id)&&$login!=""&&$email!=""&&$role!=""){
                         
                            if(save_user($user_id, $login, $email, $role, $phone, $status)){
                                
                                $uri = "users/?success=1";    
                                
                            }else{
                                
                                $uri = "users/?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "users/?error=3";
                            
                        }                        

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='delete_user'){

                        $user_id = $_POST['user_id'];
                                                                    
                        if($user_id!=null&&is_numeric($user_id)){
                         
                            if(delete_user($user_id)){
                                
                                $uri = "users/?success=1";    
                                
                            }else{
                                
                                $uri = "users/?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "users/?error=3";
                            
                        }                        

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='make_grade') {

                        $team_id = intval($_POST["team_id"]);
                        $course_id = intval($_POST["course_id"]);
                        $teacher_id = intval($_SESSION["user"]["id"]);
                        $user_id = intval($_POST["user_id"]);
                        $grade = intval($_POST["grade"]);

                        $has = get_user_grade($user_id, $teacher_id, $team_id, $course_id);
                        var_dump($has);

                        if($has) {
                            if(update_user_grade($user_id, $teacher_id, $team_id, $course_id, $grade)) {
                                $uri = "grade?tid=$team_id&cid=$course_id&success=1";
                            }
                            else {
                                $uri = "grade?tid=$team_id&cid=$course_id&error=1";
                            }
                        }
                        else {
                            if(add_user_grade($user_id, $teacher_id, $team_id, $course_id, $grade)) {
                                $uri = "grade?tid=$team_id&cid=$course_id&success=1";
                            }
                            else {
                                $uri = "grade?tid=$team_id&cid=$course_id&error=1";
                            }
                        }


                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='add_course'){

                        $name = trim($_POST['name']);
                        $description  = trim($_POST['description']);
                                                                    
                        if($name!=""&&$description!=""){
                         
                            if(add_new_course($name, $description)){
                                
                                $uri = "courses/?success=1";    
                                
                            }else{
                                
                                $uri = "courses/?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "courses/?error=3";
                            
                        }                        

                    }                    

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='save_course'){

                        $course_id = $_POST['course_id'];
                        $name = trim($_POST['name']);
                        $description  = trim($_POST['description']);
                                                                    
                        if($course_id!=null&&$name!=""&&$description!=""&&is_numeric($course_id)){
                         
                            if(save_course($course_id, $name, $description)){
                                
                                $uri = "courses/?success=1";    
                                
                            }else{
                                
                                $uri = "courses/?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "courses/?error=3";
                            
                        }                        

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='delete_course'){

                        $course_id = $_POST['course_id'];
                                                                    
                        if($course_id!=null&&is_numeric($course_id)){
                         
                            if(delete_course($course_id)){
                                
                                $uri = "courses/?success=1";    
                                
                            }else{
                                
                                $uri = "courses/?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "courses/?error=3";
                            
                        }                        

                    }                    

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='add_chapter'){

                        $name = trim($_POST['name']);
                        $description  = trim($_POST['description']);
                        $order = $_POST['order'];
                        $course_id = $_POST['course_id'];                                                
                                                                    
                        if($name!=""&&$description!=""&&$order!=null&&is_numeric($order)&&$order>0&&$order<=50&&$course_id!=null&&is_numeric($course_id)){
                         
                            if(add_new_chapter($course_id, $name, $description, $order)){
                                
                                $uri = "editcourse?cid=".$course_id;
                                
                            }else{
                                
                                $uri = "editcourse?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "editcourse?error=3";
                            
                        }                        

                    }                    

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='save_chapter'){

                        $course_id = $_POST['course_id']; 
                        $chapter_id = $_POST['chapter_id'];
                        $name = trim($_POST['name']);
                        $description = trim($_POST['description']);
                        $order = $_POST['order'];
                                                                    
                        if($chapter_id!=null&&is_numeric($chapter_id)&&$name!=""&&$description!=""&&$order!=null&&is_numeric($order)&&$order>0&&$order<=50&&$course_id!=null&&is_numeric($course_id)){
                         
                            if(save_chapter($chapter_id, $name, $description, $order)){
                                
                                $uri = "editcourse/?cid=$course_id&&success=1";
                                
                            }else{
                                
                                $uri = "editcourse/?cid=$course_id&&error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "editcourse/?cid=$course_id&&error=3";
                            
                        }                        

                    }
                    

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='delete_chapter'){

                        $course_id = $_POST['course_id']; 
                        $chapter_id = $_POST['chapter_id'];
                                                                    
                        if($chapter_id!=null&&is_numeric($chapter_id)&&$course_id!=null&&is_numeric($course_id)){
                         
                            if(delete_chapter($chapter_id)){
                                
                                $uri = "editcourse/?cid=$course_id&&success=1";
                                
                            }else{
                                
                                $uri = "editcourse/?cid=$course_id&&error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "editcourse/?cid=$course_id&&error=3";
                            
                        }                        

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='add_lesson'){

                        $name = trim($_POST['name']);
                        $content  = trim($_POST['content']);
                        $order = $_POST['order'];
                        $chapter_id = $_POST['chapter_id'];
                        $lesson_type_id = $_POST['lesson_type_id'];
                                                                    
                        if($name!=""&&$content!=""&&$order!=null&&is_numeric($order)&&$order>0&&$order<=50&&$chapter_id!=null&&is_numeric($chapter_id)&&$lesson_type_id!=null&&is_numeric($lesson_type_id)){
                         
                            if(add_new_lesson($chapter_id, $name, $content, $order, $lesson_type_id)){
                                
                                $uri = "editchapter?chid=".$chapter_id;
                                
                            }else{
                                
                                $uri = "editchapter/?chid=$chapter_id&&error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "editchapter/?chid=$chapter_id&&error=3";
                            
                        }                        

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='save_lesson'){

                        $name = trim($_POST['name']);
                        $content  = trim($_POST['content']);
                        $order = $_POST['order'];
                        $chapter_id = $_POST['chapter_id'];
                        $lesson_type_id = $_POST['lesson_type_id'];
                        $lesson_id = $_POST['lesson_id'];        
                                                                    
                        if($name!=""&&$content!=""&&$order!=null&&is_numeric($order)&&$order>0&&$order<=50&&$chapter_id!=null&&is_numeric($chapter_id)&&$lesson_type_id!=null&&is_numeric($lesson_type_id)&&$lesson_id!=null&&is_numeric($lesson_id)){
                         
                            if(save_lesson($lesson_id, $name, $content, $order, $lesson_type_id)){
                                
                                $uri = "readlesson?lid=".$lesson_id;
                                
                            }else{
                                
                                $uri = "editchapter/?chid=$chapter_id&&error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "editchapter/?chid=$chapter_id&&error=3";
                            
                        }                      

                    }    

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='delete_lesson'){

                        $lesson_id = $_POST['lesson_id']; 
                        $chapter_id = $_POST['chapter_id'];
                                                                    
                        if($chapter_id!=null&&is_numeric($chapter_id)&&$lesson_id!=null&&is_numeric($lesson_id)){
                         
                            if(delete_lesson($lesson_id)){
                                
                                $uri = "editchapter/?chid=$chapter_id&&success=1";
                                
                            }else{
                                
                                $uri = "editchapter/?chid=$chapter_id&&error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "editchapter/?chid=$chapter_id&&error=3";
                            
                        }                        

                    }                    

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='add_test'){

                        $name = trim($_POST['name']);
                        $description = trim($_POST['description']);
                        $testing_time = $_POST['testing_time'];
                        $question_amount = $_POST['question_amount'];
                                                                    
                        if($name!=""&&$description!=""&&isset($testing_time)&&is_numeric($testing_time)&&$testing_time>0&&$testing_time<=1000000&&isset($question_amount)&&is_numeric($question_amount)&&$question_amount>0&&$question_amount<=100000){
                         
                            if(add_new_test($name, $description, $testing_time, $question_amount)){
                                
                                $uri = "tests/?success=1";    
                                
                            }else{
                                
                                $uri = "tests/?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "tests/?error=3";
                            
                        }                        

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='save_test'){

                        $id = $_POST['test_id'];
                        $name = trim($_POST['name']);
                        $description = trim($_POST['description']);
                        $testing_time = $_POST['testing_time'];
                        $question_amount = $_POST['question_amount'];

                        if(isset($id)&&is_numeric($id)&&$name!=""&&$description!=""&&isset($testing_time)&&is_numeric($testing_time)&&$testing_time>0&&$testing_time<=1000000&&isset($question_amount)&&is_numeric($question_amount)&&$question_amount>0&&$question_amount<=100000){
                         
                            if(save_test($id, $name, $description, $testing_time, $question_amount)){
                                
                                $uri = "tests/?success=1";
                                
                            }else{
                                
                                $uri = "tests/?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "tests/?error=3";
                            
                        }                        

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='delete_test'){

                        $id = $_POST['test_id'];

                        if(isset($id)&&is_numeric($id)){
                         
                            if(delete_test($id)){
                                
                                $uri = "tests/?success=1";
                                
                            }else{
                                
                                $uri = "tests/?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "tests/?error=3";
                            
                        }                        

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='add_question'){

                        $uri = "tests/?error=1";

                        $id = $_POST['test_id'];

                        if(isset($id)&&is_numeric($id)){

                            $uri = "addquestion/?id=$id&&error=1";
                         
                            $test = get_test_by_id($id);
                            
                            if($test!=null){

                                if(isset($_POST['name'])&&isset($_POST['question'])&&isset($_POST['level'])&&is_numeric($_POST['level'])&&$_POST['level']>0&&$_POST['level']<5&&isset($_POST['answer'])&&is_numeric($_POST['answer'])&&$_POST['answer']<=4&&$_POST['answer']>0){
                                    
                                    if(add_new_question($id, $_POST['name'], $_POST['level'], $_POST['question'], $_POST['variant_1'], $_POST['variant_2'], $_POST['variant_3'], $_POST['variant_4'], $_POST['answer'])){

                                        $uri = "edittest?id=$id&&success=1";

                                    }
                                
                                }

                            }

                        }

                    }

                   if(isset($_POST['request_action'])&&$_POST['request_action']=='save_question'){

                        $uri = "tests/?error=1";

                        $id = $_POST['question_id'];

                        if(isset($id)&&is_numeric($id)){

                            $uri = "readquestion/?id=$id&&error=1";

                            if(isset($_POST['name'])&&isset($_POST['question'])&&isset($_POST['level'])&&is_numeric($_POST['level'])&&$_POST['level']>0&&$_POST['level']<5&&isset($_POST['answer'])&&is_numeric($_POST['answer'])&&$_POST['answer']<=4&&$_POST['answer']>0){
                                
                                if(save_question($id, $_POST['name'], $_POST['level'], $_POST['question'], $_POST['variant_1'], $_POST['variant_2'], $_POST['variant_3'], $_POST['variant_4'], $_POST['answer'])){

                                    $uri = "readquestion?id=$id&&success=1";

                                }
                            
                            }

                        }

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='delete_question'){

                        $uri = "tests/?error=1";

                        $id = $_POST['question_id'];

                        if(isset($id)&&is_numeric($id)){

                            $test_id = delete_question($id);
                            if(isset($test_id)&&is_numeric($test_id)){
                                $uri = "edittest?id=$test_id"; 
                            }               

                        }

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='generate_contest'){

                        $uri = "tests/?error=1";

                        $test_id = $_POST['test_id'];

                        if(isset($test_id)&&is_numeric($test_id)){
                            
                            $test = get_test_by_id($test_id);
                            
                            if($test!=null){

                                $contest_id = generate_contest($test['id'], $USER_DATA['id'], $test['testing_time'], $test['question_amount']);
                                
                                if($contest_id!=null){

                                    $uri = "readcontest?contest_id=$contest_id";

                                }

                            }   

                        }

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='finish_contest'){

                        $uri = "mycontests";

                        $contest_id = $_POST['contest_id'];

                        if(isset($contest_id)&&is_numeric($contest_id)){
                            
                            if(finish_contest_by_contest_id_and_user_id($contest_id, $USER_DATA['id'])){
                                $uri = "readcontest?contest_id=".$contest_id;
                            }
                        }

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='attach_file'){
                                            
                        if(isset($_POST['lesson_id'])&&is_numeric($_POST['lesson_id'])){
                            
                            $lesson_id = $_POST['lesson_id'];
                            $uri = "readlesson?lid=".$lesson_id;

                            if(isset($_POST['link'])&&isset($_POST['name'])){

                                attach_file($USER_DATA['id'], $lesson_id, $_POST['name'], $_POST['link']);              

                            }                        


                        }else{                            

                            $uri = "courses";

                        }

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='delete_attachement'){

                        if(isset($_POST['lesson_id'])&&is_numeric($_POST['lesson_id'])){

                            $lesson_id = $_POST['lesson_id'];
                            $uri = "readlesson?lid=".$lesson_id;

                        }else{

                            $uri = "courses";                            

                        }
                    
                        if(isset($_POST['attachment_id'])&&is_numeric($_POST['attachment_id'])){

                            delete_attachement($_POST['attachment_id']);

                        }

                    }                    


                    if(isset($_POST['request_action'])&&$_POST['request_action']=='add_group'){

                        $name = trim($_POST['name']);
                                                                    
                        if($name!=""){
                         
                            if(add_new_group($name)){
                                
                                $uri = "groups";
                                
                            }else{
                                
                                $uri = "groups?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "groups?error=3";
                            
                        }                        

                    }  
                    
                    if(isset($_POST['request_action'])&&$_POST['request_action']=='save_group'){

                        $name = trim($_POST['name']);
                        $group_id = $_POST['group_id'];        
                                                                    
                        if($name!=""&&$group_id!=null&&is_numeric($group_id)){
                         
                            if(save_group($group_id, $name)){
                                
                                $uri = "groups";
                                
                            }else{
                                
                                $uri = "groups/?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "groups/?error=3";
                            
                        }                      

                    }
                    
                    if(isset($_POST['request_action'])&&$_POST['request_action']=='delete_group'){

                        $group_id = $_POST['group_id'];        
                                                                    
                        if($group_id!=null&&is_numeric($group_id)){
                         
                            if(delete_group($group_id)){
                                
                                $uri = "groups";
                                
                            }else{
                                
                                $uri = "groups/?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "groups/?error=3";
                            
                        }                      

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='remove_user_from_group'){

                        $group_id = $_POST['group_id'];
                        $remove_user_id = $_POST['remove_user_id'];
      
                        if($group_id!=null&&is_numeric($group_id)&&$remove_user_id!=null&&is_numeric($remove_user_id)){
                         
                            if(remove_user_from_group($group_id,$remove_user_id)){
                                
                                $uri = "readgroup/?gid=".$group_id."&success=1";
                                
                            }else{
                                
                                $uri = "readgroup/?gid=".$group_id."&error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "readgroup/?gid=".$group_id."&error=3";
                            
                        }                      

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='add_user_to_group'){

                        $group_id = $_POST['group_id'];
                        $add_user_id = $_POST['add_user_id'];
                                                                    
                        if($group_id!=null&&is_numeric($group_id)&&$add_user_id!=null&&is_numeric($add_user_id)){
                         
                            if(add_user_to_group($group_id,$add_user_id)){
                                
                                $uri = "readgroup/?gid=".$group_id."&success=1";
                                
                            }else{
                                
                                $uri = "readgroup/?gid=".$group_id."&error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "readgroup/?gid=".$group_id."&error=3";
                            
                        }                      

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='remove_course_from_group'){

                        $group_id = $_POST['group_id'];
                        $remove_course_id = $_POST['remove_course_id'];
      
                        if($group_id!=null&&is_numeric($group_id)&&$remove_course_id!=null&&is_numeric($remove_course_id)){
                         
                            if(remove_course_from_group($group_id,$remove_course_id)){
                                
                                $uri = "readgroup/?gid=".$group_id."&success=1";
                                
                            }else{
                                
                                $uri = "readgroup/?gid=".$group_id."&error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "readgroup/?gid=".$group_id."&error=3";
                            
                        }                      

                    } 

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='add_course_to_group'){

                        $group_id = $_POST['group_id'];
                        $add_course_id = $_POST['add_course_id'];
                                                                    
                        if($group_id!=null&&is_numeric($group_id)&&$add_course_id!=null&&is_numeric($add_course_id)){
                         
                            if(add_course_to_group($group_id,$add_course_id)){
                                
                                $uri = "readgroup/?gid=".$group_id."&success=1";
                                
                            }else{
                                
                                $uri = "readgroup/?gid=".$group_id."&error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "readgroup/?gid=".$group_id."&error=3";
                            
                        }                      

                    } 

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='add_team'){

                        $name = trim($_POST['name']);
                                                                    
                        if($name!=""){
                         
                            if(add_new_team($name)){
                                
                                $uri = "teams";
                                
                            }else{
                                
                                $uri = "teams?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "teams?error=3";
                            
                        }                        

                    }  

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='delete_team'){

                        $team_id = $_POST['team_id'];        
                                                                    
                        if($team_id!=null&&is_numeric($team_id)){
                         
                            if(delete_team($team_id)){
                                
                                $uri = "teams";
                                
                            }else{
                                
                                $uri = "teams/?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "teams/?error=3";
                            
                        }                      

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='save_team'){

                        $name = trim($_POST['name']);
                        $team_id = $_POST['team_id'];        
                                                                    
                        if($name!=""&&$team_id!=null&&is_numeric($team_id)){
                         
                            if(save_team($team_id, $name)){
                                
                                $uri = "teams";
                                
                            }else{
                                
                                $uri = "teams/?error=1";
                                
                            }

                        }else{
                            
                            $uri = "teams/?error=3";
                            
                        }                      
                    }                           

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='add_user_to_team'){

                        $team_id = $_POST['team_id'];
                        $add_user_id = $_POST['add_user_id'];
                                                                    
                        if($team_id!=null&&is_numeric($team_id)&&$add_user_id!=null&&is_numeric($add_user_id)){
                         
                            if(add_user_to_team($team_id,$add_user_id)){
                                
                                $uri = "readteam?id=".$team_id."&success=1";
                                
                            }else{
                                
                                $uri = "readteam?id=".$team_id."&error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "readteam?id=".$team_id."&error=3";
                            
                        }                      

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='remove_user_from_team'){

                        $team_id = $_POST['team_id'];
                        $remove_user_id = $_POST['remove_user_id'];
      
                        if($team_id!=null&&is_numeric($team_id)&&$remove_user_id!=null&&is_numeric($remove_user_id)){
                         
                            if(remove_user_from_team($team_id,$remove_user_id)){
                                
                                $uri = "readteam?id=".$team_id."&success=1";
                                
                            }else{
                                
                                $uri = "readteam?id=".$team_id."&error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "readteam?id=".$team_id."&error=3";
                            
                        }                      

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='add_schedule'){

                        $team_id = $_POST['team_id'];
                        $course_id = $_POST['course_id'];
                        $day_id = $_POST['day_id'];
                        $hour_id = $_POST['hour_id'];
                        $teacher_id = $_POST['teacher_id'];
                                                                    
                        if(isset($team_id)&&is_numeric($team_id)&&isset($course_id)&&is_numeric($course_id)&&isset($day_id)&&is_numeric($day_id)&&isset($hour_id)&&is_numeric($hour_id)&&isset($teacher_id)&&is_numeric($teacher_id)){
                                
                            if(add_new_schedule($team_id, $course_id, $day_id, $hour_id, $teacher_id)){
                                
                                $uri = "readteam?id=".$team_id."&success=1";    
                                
                            }else{
                                
                                $uri = "readteam?id=".$team_id."&error=1";
                                
                            }

                        }else{
                            
                            $uri = "readteam?id=".$team_id."&error=3";
                            
                        }

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='save_schedule'){

                        $schedule_id = $_POST['schedule_id'];
                        $team_id = $_POST['team_id'];
                        $course_id = $_POST['course_id'];
                        $day_id = $_POST['day_id'];
                        $hour_id = $_POST['hour_id'];
                        $teacher_id = $_POST['teacher_id'];
                                                                    
                        if(isset($schedule_id)&&is_numeric($schedule_id)&&isset($team_id)&&is_numeric($team_id)&&isset($course_id)&&is_numeric($course_id)&&isset($day_id)&&is_numeric($day_id)&&isset($hour_id)&&is_numeric($hour_id)&&isset($teacher_id)&&is_numeric($teacher_id)){
                                
                            if(save_new_schedule($schedule_id, $team_id, $course_id, $day_id, $hour_id, $teacher_id)){
                                
                                $uri = "readteam?id=".$team_id."&success=1";    
                                
                            }else{
                                
                                $uri = "readteam?id=".$team_id."&error=1";
                                
                            }

                        }else{
                            
                            $uri = "readteam?id=".$team_id."&error=3";
                            
                        }

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='delete_schedule'){

                        $schedule_id = $_POST['schedule_id'];
                        $team_id = $_POST['team_id'];
                                                                    
                        if(isset($schedule_id)&&is_numeric($schedule_id)&&isset($team_id)&&is_numeric($team_id)){
                                
                            if(delete_schedule($schedule_id, $team_id)){
                                
                                $uri = "readteam?id=".$team_id."&success=1";    
                                
                            }else{
                                
                                $uri = "readteam?id=".$team_id."&error=1";
                                
                            }

                        }else{
                            
                            $uri = "readteam?id=".$team_id."&error=3";
                            
                        }

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='change_password'){

                        $old_password = $_POST['old_password'];
                        $new_password = $_POST['new_password'];
                        $confirm_new_password = $_POST['confirm_new_password'];
                                                                    
                        if($old_password!=""&&$new_password!=""&&$confirm_new_password!=""&&$new_password==$confirm_new_password){
                         
                            if(change_user_password($USER_DATA['id'],$old_password, $new_password)){
                                
                                $uri = "profile/?success=1";

                                $_SESSION['user']['password'] = sha1($new_password);

                                
                            }else{
                                
                                $uri = "profile/?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "profile/?error=3";
                            
                        }                      

                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='rewrite_password'){

                        $new_password = $_POST['new_password'];
                        $user_id = $_POST['user_id'];                        
                                                                    
                        if($new_password!=""&&$user_id!=null&&is_numeric($user_id)){
                         
                            if(rewrite_user_password($user_id, $new_password)){
                                
                                $uri = "users/?success=1";                                

                                
                            }else{
                                
                                $uri = "users/?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "users/?error=3";
                            
                        }
                    }
                    
                    header("Location:".base_url().$uri);
                    
                }
                
                
            }else{
                
                if($_GET['act']=='logout'){
                
                    session_destroy();
                    setcookie('auth_user_data', null, 0);
                    header("Location:".base_url());
                  
                }else if($_GET['act']=='processrequest'){

                    $uri = "";

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='change_password'){

                        $old_password = $_POST['old_password'];
                        $new_password = $_POST['new_password'];
                        $confirm_new_password = $_POST['confirm_new_password'];
                                                                    
                        if($old_password!=""&&$new_password!=""&&$confirm_new_password!=""&&$new_password==$confirm_new_password){
                         
                            if(change_user_password($USER_DATA['id'],$old_password, $new_password)){
                                
                                $uri = "profile/?success=1";

                                $_SESSION['user']['password'] = sha1($new_password);

                                
                            }else{
                                
                                $uri = "profile/?error=1";
                                
                            }                            
                                                        
                        }else{
                            
                            $uri = "profile/?error=3";
                            
                        }
                    }

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='generate_contest'){

                        $uri = "tests/?error=1";

                        $test_id = $_POST['test_id'];

                        if(isset($test_id)&&is_numeric($test_id)){
                            
                            $test = get_test_by_id($test_id);
                            
                            if($test!=null){

                                $contest_id = generate_contest($test['id'], $USER_DATA['id'], $test['testing_time'], $test['question_amount']);
                                
                                if($contest_id!=null){

                                    $uri = "readcontest?contest_id=$contest_id";

                                }

                            }   

                        }

                    } 

                    if(isset($_POST['request_action'])&&$_POST['request_action']=='finish_contest'){

                        $uri = "mycontests";

                        $contest_id = $_POST['contest_id'];

                        if(isset($contest_id)&&is_numeric($contest_id)){
                            
                            if(finish_contest_by_contest_id_and_user_id($contest_id, $USER_DATA['id'])){
                                $uri = "readcontest?contest_id=".$contest_id;
                            }
                        }

                    }

                    header("Location:".base_url($uri));    

                }             

            }
        
        }
      
    }else{
      
        if(isset($_GET['act'])){
        
            if($_GET['act']=='auth'){
              
                $email = $_POST['email'];  
                
                $password = $_POST['password'];

                $remember = $_POST['remember'];
                
                $user = get_user_by_email_password($email, $password);
                
                $found = false;
                
                if($user!=null){
                    
                    $_SESSION['user'] = $user;
                    $found = true;
                    
                    if(isset($remember)){
                        setcookie('auth_user_data', sha1($email.sha1($password)."bitlab"), time() + 86400*30*12);
                    }
					header("Location:".base_url());
                          
                }
                
                header("Location:".base_url().(!$found?'?error=1':''));
              
            }
        
        }
      
    }

?>