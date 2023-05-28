<?php

    if($online){
    
        if(IS_ADMIN){
            
            if(isset($_GET['ajax'])){
            
                if($_GET['ajax']=='ajaxrequest'){
                
                    if(isset($_GET['request_method'])){                      

                        if($_GET['request_method']=='get_user_by_id'){

                            if(isset($_GET['user_id'])&&is_numeric($_GET['user_id'])){

                                $user = get_user_by_id($_GET['user_id']);                                

                                if(isset($user)){

                                    echo json_encode($user);

                                }

                            }                            

                        }
                        if($_GET['request_method']=='get_schedule_by_id_and_team_id'){

                            if(isset($_GET['team_id'])&&is_numeric($_GET['team_id'])&&isset($_GET['schedule_id'])&&is_numeric($_GET['schedule_id'])){

                                $schedule = get_schedule_by_id_and_team_id($_GET['schedule_id'],$_GET['team_id']);                                

                                if(isset($schedule)){

                                    echo json_encode($schedule);

                                }

                            }

                        }
                        
                        if($_GET['request_method']=='get_course_by_id'){

                            if(isset($_GET['course_id'])&&is_numeric($_GET['course_id'])){

                                $course = get_course_by_id($_GET['course_id']);

                                if(isset($course)){

                                    echo json_encode($course);

                                }

                            }                            

                        }

                        if($_GET['request_method']=='get_grade'){

                            if(
                                isset($_GET['course_id']) && is_numeric($_GET['course_id']) &&
                                isset($_GET['team_id']) && is_numeric($_GET['team_id']) &&
                                isset($_GET['user_id']) && is_numeric($_GET['user_id']) &&
                                isset($_GET['teacher_id']) && is_numeric($_GET['teacher_id'])
                            ){

                                $course_id = intval($_GET['course_id']);
                                $team_id = intval($_GET['team_id']);
                                $user_id = intval($_GET['user_id']);
                                $teacher_id = intval($_GET['teacher_id']);

                                $grade = get_user_grade($user_id, $teacher_id, $team_id, $course_id);

                                if ($grade) {
                                    echo $grade["grade"];
                                }
                                else {
                                    echo "0";
                                }

                            }

                        }

                        if($_GET['request_method']=='get_homework'){

                            if(
                                isset($_GET['course_id']) && is_numeric($_GET['course_id']) &&
                                isset($_GET['team_id']) && is_numeric($_GET['team_id']) &&
                                isset($_GET['user_id']) && is_numeric($_GET['user_id']) &&
                                isset($_GET['teacher_id']) && is_numeric($_GET['teacher_id'])
                            ){

                                $course_id = intval($_GET['course_id']);
                                $team_id = intval($_GET['team_id']);
                                $user_id = intval($_GET['user_id']);
                                $teacher_id = intval($_GET['teacher_id']);

                                $homework = get_user_homework($user_id, $teacher_id, $team_id, $course_id);

                                if ($homework) {
                                    echo $homework["file"];
                                }
                                else {
                                    echo "0";
                                }

                            }

                        }

                        if($_GET['request_method']=='get_chapter_by_id'){

                            if(isset($_GET['chapter_id'])&&is_numeric($_GET['chapter_id'])){

                                $chapter = get_chapter_by_id($_GET['chapter_id']);

                                if(isset($chapter)){

                                    echo json_encode($chapter);

                                }

                            }                            

                        }

                        if($_GET['request_method']=='get_lesson_by_id'){

                            if(isset($_GET['lesson_id'])&&is_numeric($_GET['lesson_id'])){

                                $lesson = get_lesson_by_id($_GET['lesson_id']);

                                if(isset($lesson)){

                                    echo json_encode($lesson);

                                }

                            }                            

                        }    
                        
                        if($_GET['request_method']=='get_group_by_id'){

                            if(isset($_GET['group_id'])&&is_numeric($_GET['group_id'])){

                                $group = get_group_by_id($_GET['group_id']);                                

                                if(isset($group)){

                                    echo json_encode($group);

                                }

                            }                            

                        }

                        if($_GET['request_method']=='get_team_by_id'){

                            if(isset($_GET['team_id'])&&is_numeric($_GET['team_id'])){

                                $team = get_team_by_id($_GET['team_id']);                                
                                
                                if(isset($team)){

                                    echo json_encode($team);

                                }

                            }                            

                        }

                        if($_GET['request_method']=='get_test_by_id'){

                            if(isset($_GET['test_id'])&&is_numeric($_GET['test_id'])){

                                $test = get_test_by_id($_GET['test_id']);

                                if(isset($test)){

                                    echo json_encode($test);

                                }

                            }                            

                        }

                        if($_GET['request_method']=='check_is_contest_unfinished'){

                            $unfinished = get_unfinished_contests_by_user_id($USER_DATA['id']);

                            if(isset($unfinished)){
                                
                                echo json_encode($unfinished);

                            }else{

                                echo "0";

                            }

                        }

                        if($_GET['request_method']=='mark_answer'){

                            echo $_POST['contest_question_id']." ".$_POST['answered_value'];

                            if(isset($_POST['contest_question_id'])&&is_numeric($_POST['contest_question_id'])&&isset($_POST['answered_value'])&&is_numeric($_POST['answered_value'])&&$_POST['answered_value']>0&&$_POST['answered_value']<5){

                                update_contest_question_by_user_id_and_question_id($USER_DATA['id'], $_POST['contest_question_id'], $_POST['answered_value']);

                            }

                        }
                        
                    }
                      
                }
        
            }
        
        }else{
            
            if(isset($_GET['ajax'])){
            
                if($_GET['ajax']=='ajaxrequest'){
                
                    if(isset($_GET['request_method'])){        

                        if($_GET['request_method']=='check_is_contest_unfinished'){

                            $unfinished = get_unfinished_contests_by_user_id($USER_DATA['id']);

                            if(isset($unfinished)){
                                
                                echo json_encode($unfinished);

                            }else{

                                echo "0";

                            }

                        }if($_GET['request_method']=='mark_answer'){

                            echo $_POST['contest_question_id']." ".$_POST['answered_value'];

                            if(isset($_POST['contest_question_id'])&&is_numeric($_POST['contest_question_id'])&&isset($_POST['answered_value'])&&is_numeric($_POST['answered_value'])&&$_POST['answered_value']>0&&$_POST['answered_value']<5){

                                update_contest_question_by_user_id_and_question_id($USER_DATA['id'], $_POST['contest_question_id'], $_POST['answered_value']);

                            }

                        }

                    }
                      
                }
        
            }
            
        }
    }

?>