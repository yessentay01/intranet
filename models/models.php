<?php

    function get_user_by_id_password($id, $password){
        
        global $connection;
        $userData = null;

		try{

			$query = $connection->prepare(" SELECT u.id, u.login, u.email, u.role_id, r.role role_name FROM users u LEFT OUTER JOIN roles r ON r.id = u.role_id WHERE u.id =:id AND u.password =:password AND u.active = 1 LIMIT 1");
			
			$query->execute(array('id' => $id, 'password' => $password ));

			foreach ($query as $row){
				
				$userData = $row;

			}

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}        
        
        return $userData;
        
    }
    
    function get_user_by_email_password($email, $password){
        
        global $connection;
        $userData = null;

		try{

			$query = $connection->prepare(" SELECT u.id, u.password FROM users u WHERE u.email =:email AND u.password =:password AND u.active = 1 LIMIT 1 ");
			
			$query->execute(array('email' => $email, 'password' => sha1($password) ));

			foreach ($query as $row){
				
				$userData = $row;

			}

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
		return $userData;
        
    }

    function get_user_by_cookie_value($cookie_value, $salt){
        
        global $connection;
        $userData = null;

		try{

			$query = $connection->prepare("
				 SELECT u.id, u.password FROM users u  
				 WHERE SHA1(CONCAT(u.email,u.password,:salt))=:cookie_value AND u.active = 1 LIMIT 1 ");
			
			$query->execute(array('salt' => $salt, 'cookie_value' => $cookie_value));

			foreach ($query as $row){
				
				$userData = $row;

			}

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
		return $userData;
        
    }
    
    function add_new_user($login, $email, $password, $role_id, $phone, $status){
        
        global $connection;
        $userData = null;
        $exists = false;
        $success = false;

		try{

			$query = $connection->prepare(" SELECT COUNT(u.id) amount FROM users u WHERE u.email = :email AND u.active = 1 ");
			
			$query->execute(array('email' => $email));

			$result = $query->fetch();

			$exists = $result['amount']>0;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
		if(!$exists){
	
			try{
	
				$query = $connection->prepare(" INSERT INTO users (id, login, email, password, role_id, active) VALUES (NULL,:login,:email,:password,:role_id,1)");
				
				$result = $query->execute(array('login' => $login, 'email' => $email , 'password' => sha1($password) , 'role_id' => $role_id));
				
				$success = $result>0;

				if($success){
					$last_id = $connection->lastInsertId();
					
					$query = $connection->prepare("
						INSERT INTO user_data (id, user_id, phone, registration_date, user_status) 
						VALUES (NULL, :user_id, :phone, NOW(), :user_status)
					");

					$query->execute(array("user_id"=>$last_id, "phone"=>$phone, "user_status"=>$status));

				}
	
			}catch(PDOException $e){
	
				echo "Error: ".$e;
			
			}

		}
		
      	return !$exists&&$success;
        
    }

	function get_all_users(){
        
        global $connection;
        $query = null;


		try{

			$query = $connection->prepare("
				SELECT u.id, u.login, u.email, r.role role_name, ud.phone, CASE WHEN ud.user_status = 1 THEN 'Активен' WHEN ud.user_status = 2 THEN 'Приостановлен' WHEN ud.user_status = 0 THEN 'Завершен' END user_status, DATE_FORMAT( ud.registration_date, '%M %d, %Y') registration_date  
				FROM users u 
				LEFT OUTER JOIN roles r ON r.id = u.role_id 
				LEFT OUTER JOIN user_data ud ON ud.user_id = u.id 
				WHERE u.active = 1 ");
			
			$query->execute();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }

	function get_all_users_by_roles($role_id){
        
        global $connection;
        $query = null;


		try{

			$query = $connection->prepare(" SELECT u.id, u.login, u.email, r.role role_name FROM users u LEFT OUTER JOIN roles r ON r.id = u.role_id WHERE u.active = 1 AND u.role_id = :role_id");
			
			$query->execute(array("role_id"=>$role_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }

    function get_user_by_id($user_id){
        
        global $connection;
        $user = null;
                      
		try{

			$query = $connection->prepare(" 
				SELECT u.id, u.login, u.email, u.role_id, r.role role_name, ud.user_status, ud.phone 
				FROM users u 
				LEFT OUTER JOIN roles r ON r.id = u.role_id 
				LEFT OUTER JOIN user_data ud ON ud.user_id = u.id 
				WHERE u.active = 1 AND u.id = ".$user_id." LIMIT 1 ");
			
			$query->execute();

			foreach ($query as $row) {
			
				$user = $row;
			
			}

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $user;
        
    }

    function save_user($user_id, $login, $email, $role_id, $phone, $status){
        
        global $connection;
        $userData = null;
        $success = false;
	
		try{

			$query = $connection->prepare(" UPDATE users SET login =:login, email =:email, role_id =:role_id WHERE id =:user_id");
			$row = $query->execute(array('login' => $login, 'email' => $email , 'role_id' => $role_id, 'user_id' => $user_id));
			$success = $row>0;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}

		try{

			$query = $connection->prepare(" SELECT COUNT(*) amount FROM user_data WHERE user_id = :user_id ");
			$query->execute(array('user_id' => $user_id));
			$result = $query->fetch();
			$count = $result['amount'];

			if($count>0){
			
				$query = $connection->prepare(" UPDATE user_data SET phone =:phone, user_status =:user_status WHERE user_id =:user_id");
				$row = $query->execute(array('phone' => $phone, 'user_status' => $status, 'user_id' => $user_id));				
			
			}else{
				$query = $connection->prepare("
					INSERT INTO user_data (id, user_id, phone, registration_date, user_status) 
					VALUES (NULL, :user_id, :phone, NOW(), :user_status)
				");
				$query->execute(array("user_id"=>$user_id, "phone"=>$phone, "user_status"=>$status));
			}

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }    

    function delete_user($user_id){
        
        global $connection;
        $userData = null;
        $success = false;
	
		try{

			$query = $connection->prepare(" UPDATE users SET active = 0 WHERE id =:user_id");
			$rows = $query->execute(array('user_id' => $user_id));
			$success = $rows>0;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }    

    function change_user_password($user_id, $old_password, $new_password){
        
        global $connection;
        $userData = null;
        $success = false;
        $correct_password = false;
		
		try{

			$query = $connection->prepare(" SELECT * FROM users WHERE id =:user_id AND password =:password AND ACTIVE = 1 LIMIT 1 ");
			
			$query->execute(array('user_id' => $user_id, 'password' => sha1($old_password)));
			
			foreach ($query as $row) {
			
				$correct_password = true;
			
			}			

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}	

		if($correct_password){

			try{

				$query = $connection->prepare(" UPDATE users SET password =:new_password WHERE id =:user_id AND active = 1 ");
				
				$query->execute(array('new_password' => sha1($new_password), 'user_id' => $user_id));
				
				$success = true;

			}catch(PDOException $e){

				echo "Error: ".$e;
			
			}

		}
		
      	return $success;
        
    }

	function rewrite_user_password($user_id, $new_password){
        
        global $connection;
        $success = false;
    	
		try{

			$query = $connection->prepare(" UPDATE users SET password =:new_password WHERE id =:user_id AND active = 1 ");
			
			$query->execute(array('new_password' => sha1($new_password), 'user_id' => $user_id));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
	
      	return $success;		

    }

    function add_new_course($name, $description){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" INSERT INTO courses (id, name, description, created_date, active) VALUES (NULL,:name,:description,NULL,1)");
			
			$query->execute(array('name' => $name, 'description' => $description));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}

		
      	return $success;
        
    } 

    function get_all_courses(){
        
        global $connection;
        $query = null;       

		try{

			$query = $connection->prepare(" SELECT c.id, c.name, c.created_date FROM courses c WHERE c.active = 1 ORDER BY c.created_date DESC ");
			
			$query->execute();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }

    function get_course_by_id($course_id){
        
        global $connection;
        $course = null;
                      
		try{

			$query = $connection->prepare(" SELECT c.id, c.name, c.description FROM courses c WHERE c.active = 1 AND c.id =:course_id LIMIT 1 ");
			
			$query->execute(array("course_id"=>$course_id));

			foreach ($query as $row) {
			
				$course = $row;
			
			}

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $course;
        
    }
    
    function save_course($course_id, $name, $description){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" UPDATE courses SET name =:name, description =:description WHERE id =:course_id");
			
			$query->execute(array('course_id' => $course_id, 'name' => $name, 'description' => $description));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }

    function delete_course($course_id){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" UPDATE courses SET active = 0 WHERE id =:course_id");
			
			$query->execute(array('course_id' => $course_id));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }    

    function get_all_chapters_by_course_id($cid){
        
        global $connection;
        $query = null;
        
		try{

			$query = $connection->prepare(" SELECT c.id, c.name, c.order_value FROM chapters c LEFT OUTER JOIN courses co ON co.id = c.course_id WHERE c.course_id = ".$cid." AND c.active = 1 AND co.active = 1 ORDER BY c.order_value ASC ");
			
			$query->execute();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }    

    function add_new_chapter($course_id, $name, $description, $order){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" INSERT INTO chapters (id, course_id , name, description, order_value, active) VALUES (NULL,:course_id,:name,:description,:order_value, 1 ) ");
			
			$query->execute(array('course_id'=>$course_id, 'name'=>$name, 'description'=>$description, 'order_value'=>$order));
			
			$success = true;			

		}catch(PDOException $e){

			echo "Error: ".$e;			
		
		}
		
      	return $success;
        
    } 

    function get_chapter_by_id($chapter_id){
        
        global $connection;
        $chapter = null;
                      
		try{

			$query = $connection->prepare(" SELECT c.id, c.name, c.description, c.order_value, c.course_id, co.name course_name FROM chapters c LEFT OUTER JOIN courses co ON c.course_id = co.id WHERE c.active = 1 AND co.active = 1 AND c.id =:chapter_id LIMIT 1 ");
			
			$query->execute(array("chapter_id"=>$chapter_id));

			$chapter = $query->fetch();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $chapter;
        
    }

    function save_chapter($chapter_id, $name, $description, $order){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" UPDATE chapters SET name =:name, description =:description, order_value=:order_value WHERE id =:chapter_id");
			
			$query->execute(array('chapter_id' => $chapter_id, 'name' => $name, 'description' => $description, 'order_value' => $order));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }    

    function delete_chapter($chapter_id){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" UPDATE chapters SET active = 0 WHERE id =:chapter_id");
			
			$query->execute(array('chapter_id' => $chapter_id));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }

   	function get_all_lesson_types(){
        
        global $connection;
        $query = null;
                      
		try{

			$query = $connection->prepare(" SELECT * FROM lesson_types WHERE active = 1 ORDER BY id ");
			
			$query->execute();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }    

    function add_new_lesson($chapter_id, $name, $content, $order, $lesson_type_id){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" INSERT INTO lessons (id, chapter_id , name, content, lesson_type_id, order_value, added_date, active) VALUES (NULL, :chapter_id, :name, :content, :lesson_type_id, :order_value, NULL, 1 ) ");
			
			$query->execute(array('chapter_id'=>$chapter_id, 'name'=>$name, 'content'=>$content, 'order_value'=>$order, 'lesson_type_id'=>$lesson_type_id));
			
			$success = true;			

		}catch(PDOException $e){

			echo "Error: ".$e;			
		
		}
		
      	return $success;
        
    }

    function get_lessons_by_chapter_id($chapter_id){
        
        global $connection;
        $query = null;
        
		try{

			$sql_query = " 			

				SELECT l.id, l.name, l.order_value, l.lesson_type_id, lt.name lesson_type_name 
				FROM lessons l 
				LEFT OUTER JOIN lesson_types lt ON lt.id = l.lesson_type_id 
				LEFT OUTER JOIN chapters ch ON l.chapter_id = ch.id 
				LEFT OUTER JOIN courses c ON c.id = ch.course_id 
				WHERE l.chapter_id =:chapter_id AND l.active = 1 AND c.active = 1 AND ch.active = 1 
				ORDER BY l.order_value ASC 

			";

			$query = $connection->prepare($sql_query);
			
			$query->execute(array("chapter_id"=>$chapter_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }

	function get_lesson_by_id($lesson_id){
        
        global $connection;
        $lesson = null;
                      
		try{

			$sql_query = " 			

				SELECT l.id, l.name, l.order_value, l.lesson_type_id, l.content, lt.name lesson_type_name, c.name course_name, ch.name chapter_name, c.id course_id, ch.id chapter_id 
				FROM lessons l 				
				LEFT OUTER JOIN chapters ch ON l.chapter_id = ch.id 
				LEFT OUTER JOIN courses c ON c.id = ch.course_id 
				LEFT OUTER JOIN lesson_types lt ON lt.id = l.lesson_type_id 
				WHERE l.id =:lesson_id AND l.active = 1 AND c.active = 1 AND ch.active = 1 LIMIT 1 ";

			$query = $connection->prepare($sql_query);
			
			$query->execute(array("lesson_id"=>$lesson_id));

			$lesson = $query->fetch();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $lesson;
        
    }

    function save_lesson($lesson_id, $name, $content, $order, $lesson_type_id){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" UPDATE lessons SET name =:name, content =:content, order_value=:order_value, lesson_type_id =:lesson_type_id WHERE id =:lesson_id ");
			
			$query->execute(array('lesson_id'=>$lesson_id, 'name'=>$name, 'content'=>$content, 'order_value'=>$order, 'lesson_type_id'=>$lesson_type_id));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }

    function delete_lesson($lesson_id){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" UPDATE lessons SET active = 0 WHERE id =:lesson_id");
			
			$query->execute(array('lesson_id' => $lesson_id));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }

	function get_all_groups(){
        
        global $connection;
        $query = null;


		try{

			$query = $connection->prepare(" SELECT g.* FROM groups g WHERE g.active = 1 ");
			
			$query->execute();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }
    
    function add_new_group($name){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" INSERT INTO groups (id, name, created_date, active) VALUES (NULL, :name, NULL, 1 ) ");
			
			$query->execute(array('name'=>$name));
			
			$success = true;			

		}catch(PDOException $e){

			echo "Error: ".$e;			
		
		}
		
      	return $success;
        
    }
    
	function get_group_by_id($group_id){
        
        global $connection;
        $group = null;
                      
		try{

			$sql_query = " SELECT g.* FROM groups g WHERE g.active = 1 AND g.id =:group_id ";

			$query = $connection->prepare($sql_query);
			
			$query->execute(array('group_id'=>$group_id));

			$group = $query->fetch();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $group;
        
    }

    function save_group($group_id, $name){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" UPDATE groups SET name =:name WHERE id =:group_id AND active = 1 ");
			
			$query->execute(array('group_id'=>$group_id,'name'=>$name));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }  
    
    function delete_group($group_id){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" UPDATE groups SET active = 0 WHERE id =:group_id AND active = 1 ");
			
			$query->execute(array('group_id'=>$group_id));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }     
    
	function get_all_available_group_users($group_id){
        
        global $connection;
        $query = null;

		try{

			$query = $connection->prepare("

				SELECT u.id, u.login, r.role, u.email 
				FROM users u 
				LEFT OUTER JOIN roles r ON u.role_id = r.id 
				WHERE u.id NOT IN (SELECT gu.user_id FROM group_users gu WHERE gu.group_id =:group_id) AND u.active = 1 
			
			");
			
			$query->execute(array('group_id'=>$group_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }

	function is_group_users_exist($group_id, $user_id){
        
        global $connection;
        $query = null;
        $result = false;

		try{

			$query = $connection->prepare("

				SELECT gu.id 
				FROM group_users gu 
				WHERE gu.group_id =:group_id AND gu.user_id =:user_id 
			
			");
			
			$query->execute(array('group_id'=>$group_id, 'user_id'=>$user_id));

			foreach ($query as $row) {

				$result = true;
			
			}

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $result;
        
    }    

    function add_user_to_group($group_id,$user_id){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" INSERT INTO group_users (id, group_id, user_id) VALUES (NULL, :group_id, :user_id) ");
			
			$query->execute(array('user_id'=>$user_id, 'group_id'=>$group_id));
			
			$success = true;			

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }

    function remove_user_from_group($group_id,$user_id){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" DELETE FROM group_users WHERE group_id = :group_id AND user_id = :user_id ");

			$query->execute(array('user_id'=>$user_id, 'group_id'=>$group_id));
			
			$success = true;			

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }

	function get_all_group_users_by_group_id($group_id){

        global $connection;
        $query = null;

		try{

			$query = $connection->prepare("

				SELECT gu.id, gu.user_id, u.login, r.role, u.email 
				FROM group_users gu
				LEFT OUTER JOIN users u ON u.id = gu.user_id 
				LEFT OUTER JOIN roles r ON r.id = u.role_id
				WHERE gu.group_id = :group_id 
				ORDER BY u.login ASC 

			");
			
			$query->execute(array('group_id'=>$group_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }

	function get_all_available_group_courses($group_id){
        
        global $connection;
        $query = null;   

		try{

			$query = $connection->prepare("

				SELECT c.id, c.name
				FROM courses c 
				WHERE c.id NOT IN (SELECT gc.course_id FROM group_courses gc WHERE gc.group_id =:group_id) AND c.active = 1 
				ORDER BY c.name ASC
			
			");
			
			$query->execute(array('group_id'=>$group_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }

    function add_course_to_group($group_id,$course_id){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" INSERT INTO group_courses (id, group_id, course_id) VALUES (NULL, :group_id, :course_id) ");
			
			$query->execute(array('course_id'=>$course_id, 'group_id'=>$group_id));
			
			$success = true;			

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }    

	function is_group_courses_exist($group_id, $course_id){
        
        global $connection;
        $query = null;
        $result = false;

		try{

			$query = $connection->prepare("

				SELECT gc.id 
				FROM group_courses gc 
				WHERE gc.group_id =:group_id AND gc.course_id =:course_id 
			
			");
			
			$query->execute(array('group_id'=>$group_id, 'course_id'=>$course_id));

			foreach ($query as $row) {

				$result = true;
			
			}

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $result;
        
    }    

	function get_all_group_courses_by_group_id($group_id){

        global $connection;
        $query = null;

		try{

			$query = $connection->prepare("
				SELECT gc.id, gc.course_id, c.name, c.description 
				FROM group_courses gc 
				LEFT OUTER JOIN courses c ON c.id = gc.course_id 		
				WHERE gc.group_id = :group_id 
				ORDER BY c.name ASC
			");
			
			$query->execute(array('group_id'=>$group_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }

    function remove_course_from_group($group_id,$course_id){
        
        global $connection;
        $success = false;

      	try{

			$query = $connection->prepare(" DELETE FROM group_courses WHERE group_id = :group_id AND course_id = :course_id ");

			$query->execute(array('course_id'=>$course_id, 'group_id'=>$group_id));
			
			$success = true;			

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }

    function get_access_courses_by_user_id($user_id){

        global $connection;
        $query = null;

		try{

			$query = $connection->prepare("

				SELECT DISTINCT(c.id) id, c.name, c.description 
				FROM group_courses gc
				LEFT OUTER JOIN group_users gu ON gu.group_id = gc.group_id
				LEFT OUTER JOIN courses c ON c.id = gc.course_id 
				WHERE gu.user_id =:user_id 
			
			");
			
			$query->execute(array('user_id'=>$user_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();    	 

    }

    function get_access_course_by_user_id_and_course_id($user_id, $course_id){
  
        global $connection;
        $course = null;
                      
		try{

			$query = $connection->prepare("

				SELECT DISTINCT(c.id) id, c.name, c.description 
				FROM group_courses gc 
				LEFT OUTER JOIN group_users gu ON gu.group_id = gc.group_id
				LEFT OUTER JOIN courses c ON c.id = gc.course_id 
				WHERE gu.user_id =:user_id AND gc.course_id =:course_id AND c.active = 1 
				LIMIT 1 
			
			");
			
			$query->execute(array('user_id'=>$user_id, 'course_id'=>$course_id));

			foreach ($query as $row) {
			
				$course = $row;
			
			}

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $course;

    }

    function get_access_chapters_by_user_id_and_course_id($user_id, $course_id){

        global $connection;
        $query = null;

		try{

			$query = $connection->prepare("

				SELECT DISTINCT(ch.id) id, ch.name, c.description 
				FROM group_courses gc 
				LEFT OUTER JOIN group_users gu ON gu.group_id = gc.group_id 
				LEFT OUTER JOIN courses c ON c.id = gc.course_id 
				LEFT OUTER JOIN chapters ch ON ch.course_id = gc.course_id 
				WHERE gu.user_id =:user_id AND gc.course_id =:course_id AND c.active = 1 AND ch.active = 1 
				ORDER BY ch.order_value ASC 
			
			");
			
			$query->execute(array('user_id'=>$user_id, 'course_id'=>$course_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();    	 

    }

    function get_access_chapter_by_user_id_and_chapter_id($user_id, $chapter_id){

        global $connection;
        $chapter = null;
                      
		try{

			$query = $connection->prepare("

				SELECT DISTINCT(ch.id) id, ch.name, ch.description, c.name course_name, c.id course_id 
				FROM group_courses gc 
				LEFT OUTER JOIN group_users gu ON gu.group_id = gc.group_id
				LEFT OUTER JOIN courses c ON c.id = gc.course_id 
				LEFT OUTER JOIN chapters ch ON ch.course_id = gc.course_id 
				WHERE gu.user_id =:user_id AND ch.id =:chapter_id AND c.active = 1 AND ch.active = 1 
				LIMIT 1 
			
			");
			
			$query->execute(array('user_id'=>$user_id, 'chapter_id'=>$chapter_id));

			foreach ($query as $row) {
			
				$chapter = $row;
			
			}

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $chapter;  	 

    }

    function get_access_lessons_by_user_id_and_chapter_id($user_id, $chapter_id){

        global $connection;
        $query = null;

		try{

			$query = $connection->prepare("

				SELECT DISTINCT(l.id) id, l.name, l.content, l.order_value, l.lesson_type_id, lt.name lesson_type_name 
				FROM group_courses gc 
				LEFT OUTER JOIN group_users gu ON gu.group_id = gc.group_id 
				LEFT OUTER JOIN courses c ON c.id = gc.course_id 
				LEFT OUTER JOIN chapters ch ON ch.course_id = gc.course_id 
				LEFT OUTER JOIN lessons l ON l.chapter_id = ch.id 
				LEFT OUTER JOIN lesson_types lt ON lt.id = l.lesson_type_id 
				WHERE gu.user_id =:user_id AND ch.id =:chapter_id AND c.active = 1 AND ch.active = 1 AND l.active = 1 
				ORDER BY l.lesson_type_id ASC, l.order_value ASC 
			
			");
			
			$query->execute(array('user_id'=>$user_id, 'chapter_id'=>$chapter_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();    	 

    }

    function get_access_groups_by_user_id($user_id){

        global $connection;
        $query = null;

		try{

			$query = $connection->prepare("

				SELECT g.id, g.name 
				FROM group_users gu 
				LEFT OUTER JOIN groups g ON g.id = gu.group_id 
				WHERE gu.user_id =:user_id AND g.active = 1 
			
			");
			
			$query->execute(array('user_id'=>$user_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();    	 

    }

////////////#########################################################################################////////////
////////////#########################################################################################////////////
////////////#########################################################################################////////////
////////////#########################################################################################////////////
////////////#########################################################################################////////////

    function add_new_team($name){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" INSERT INTO teams (id, name, created_date, active) VALUES (NULL, :name, NULL, 1 ) ");
			
			$rows = $query->execute(array('name'=>$name));
			
			$success = $rows>0;

		}catch(PDOException $e){

			echo "Error: ".$e;			
		
		}
		
      	return $success;
        
    }

    function get_all_teams(){
        
        global $connection;
        $query = null;


		try{

			$query = $connection->prepare(" SELECT t.* FROM teams t WHERE t.active = 1 ");
			
			$query->execute();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }

    function get_team_by_id($team_id){
        
        global $connection;
        $team = null;
                      
		try{

			$sql_query = " SELECT t.* FROM teams t WHERE t.active = 1 AND t.id =:team_id ";

			$query = $connection->prepare($sql_query);
			
			$query->execute(array('team_id'=>$team_id));

			$team = $query->fetch();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $team;
        
    }

    function delete_team($team_id){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" UPDATE teams SET active = 0 WHERE id =:team_id AND active = 1 ");
			$rows = $query->execute(array('team_id'=>$team_id));
			$success = $rows>0;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }

    function save_team($team_id, $name){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" UPDATE teams SET name =:name WHERE id =:team_id AND active = 1 ");
			$query->execute(array('team_id'=>$team_id,'name'=>$name));			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }

	function get_all_available_team_users($team_id){
        
        global $connection;
        $query = null;

		try{

			$query = $connection->prepare("

				SELECT u.id, u.login, r.role, u.email 
				FROM users u 
				LEFT OUTER JOIN roles r ON u.role_id = r.id 
				WHERE u.id NOT IN (SELECT tu.user_id FROM team_users tu WHERE tu.team_id =:team_id) AND u.active = 1 
			
			");
			
			$query->execute(array('team_id'=>$team_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }

    function add_user_to_team($team_id,$user_id){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" INSERT INTO team_users (id, team_id, user_id) VALUES (NULL, :team_id, :user_id) ");
			
			$row = $query->execute(array('user_id'=>$user_id, 'team_id'=>$team_id));
			
			$success = $row>0;			

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }

	function get_all_team_users_by_team_id($team_id){

        global $connection;
        $query = null;

		try{

			$query = $connection->prepare("

				SELECT tu.id, tu.user_id, u.login, r.role, u.email 
				FROM team_users tu
				LEFT OUTER JOIN users u ON u.id = tu.user_id 
				LEFT OUTER JOIN roles r ON r.id = u.role_id
				WHERE tu.team_id = :team_id 
				ORDER BY u.login ASC 

			");
			
			$query->execute(array('team_id'=>$team_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }

    function remove_user_from_team($team_id,$user_id){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" DELETE FROM team_users WHERE team_id = :team_id AND user_id = :user_id ");

			$row = $query->execute(array('user_id'=>$user_id, 'team_id'=>$team_id));
			
			$success = $row>0;			

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }

    function get_all_teams_by_user_id($user_id){
        
        global $connection;
        $query = null;

		try{

			$query = $connection->prepare("
				SELECT t.* 
				FROM teams t
				LEFT OUTER JOIN team_users tu ON tu.team_id = t.id 
				WHERE tu.user_id = :user_id AND t.active = 1 ");
			
			$query->execute(array("user_id"=>$user_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }


////////////#########################################################################################////////////
////////////#########################################################################################////////////
////////////#########################################################################################////////////
////////////#########################################################################################////////////
////////////#########################################################################################////////////

    function get_attachments_by_lesson_id($lesson_id){

        global $connection;
        $query = null;        

		try{

			$query = $connection->prepare("
					SELECT * 
					FROM lesson_attachments 
					WHERE lesson_id =:lesson_id
					ORDER BY added_date DESC 
				");
			
			$query->execute(array("lesson_id"=>$lesson_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();

    }

	function attach_file($user_id, $lesson_id, $name, $link){

        global $connection;
        $success = false;

		try{

			$query = $connection->prepare("

				INSERT INTO lesson_attachments (id, lesson_id, user_id, name, attachment, added_date)
				VALUES (NULL, :lesson_id, :user_id, :name, :attachment, NOW())

			");
			
			$query->execute(array(

				'lesson_id' => $lesson_id,
				'user_id' => $user_id, 
				'name' =>$name, 
				'attachment' => $link

			));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;		

	}

	function get_attachment_by_id($attachment_id){

    	global $connection;
        $attach = null;

		try{

			$query = $connection->prepare("
				SELECT * FROM lesson_attachments WHERE id =:id
			");
			
			$query->execute(array('id' => $attachment_id));

			foreach ($query as $row){
				
				$attach = $row;

			}

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}        
        
        return $attach;

	}

    function delete_attachement($id){

    	global $connection;
        $success = false;

		try{

			$query = $connection->prepare("
				
				DELETE FROM lesson_attachments WHERE id = :id

			");
			
			$query->execute(array('id' =>$id)

			);
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;

    }

	function search($user_id, $key){
  
        global $connection;
                      
		try{

			$query = $connection->prepare("

				SELECT DISTINCT(l.id) id, l.name, SUBSTRING(l.content,1,10000) lesson_content, c.name lesson_name, ch.name chapter_name 
				FROM lessons l 
				LEFT OUTER JOIN chapters ch ON ch.id = l.chapter_id 
				LEFT OUTER JOIN courses c ON c.id = ch.course_id 
				WHERE l.content LIKE CONCAT('%',CONCAT(:search_key,'%')) AND l.active = 1 
				ORDER BY l.added_date ASC  

			");
			
			$query->execute(array('search_key'=>$key));


		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();

    }

    function add_new_schedule($team_id, $course_id, $day_id, $hour_id, $teacher_id){
        
        global $connection;
        $userData = null;
        $exists = false;
        $success = false;

		try{

			$query = $connection->prepare(" 
				INSERT INTO schedules (id, team_id, course_id, teacher_id, day_id, hour_id) 
				VALUES (NULL,:team_id, :course_id, :teacher_id, :day_id, :hour_id) 
			");
			
			$row = $query->execute(array('team_id'=>$team_id, 'course_id'=>$course_id, 'teacher_id'=>$teacher_id, 'day_id'=>$day_id, 'hour_id' =>$hour_id));
			
			$success = $row>0;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}

      	return $success;
        
    }

    function generate_schedule_by_team_id($id){

    	global $connection;
                      
		try{

			$query = $connection->prepare("
				
				SELECT 
				schedule.lesson_hour, GROUP_CONCAT(schedule.monday SEPARATOR '') monday, GROUP_CONCAT(schedule.tuesday SEPARATOR '') tuesday, GROUP_CONCAT(schedule.wednesday SEPARATOR '') wednesday, GROUP_CONCAT(schedule.thursday SEPARATOR '') thursday, GROUP_CONCAT(schedule.friday SEPARATOR '') friday, GROUP_CONCAT(schedule.saturday SEPARATOR '') saturday
				FROM 
				(
					SELECT 
					CASE WHEN sc.hour_id = 1 THEN '09:00-10:00' WHEN sc.hour_id = 2 THEN '10:00-11:00' WHEN sc.hour_id = 3 THEN '11:00-12:00' WHEN sc.hour_id = 4 THEN '12:00-13:00' WHEN sc.hour_id = 5 THEN '13:00-14:00' WHEN sc.hour_id = 6 THEN '14:00-15:00' WHEN sc.hour_id = 7 THEN '15:00-16:00' WHEN sc.hour_id = 8 THEN '16:00-17:00' WHEN sc.hour_id = 9 THEN '17:00-18:00' WHEN sc.hour_id = 10 THEN '18:00-19:00' WHEN sc.hour_id = 11 THEN '19:00-20:00' WHEN sc.hour_id = 12 THEN '20:00-21:00' ELSE 'No Lesson' END as 'lesson_hour',
					CASE WHEN sc.day_id = 1 THEN c.name ELSE '' END as 'monday', 
					CASE WHEN sc.day_id = 2 THEN c.name ELSE '' END as 'tuesday', 
					CASE WHEN sc.day_id = 3 THEN c.name ELSE '' END as 'wednesday',
					CASE WHEN sc.day_id = 4 THEN c.name ELSE '' END as 'thursday',
					CASE WHEN sc.day_id = 5 THEN c.name ELSE '' END as 'friday',
					CASE WHEN sc.day_id = 6 THEN c.name ELSE '' END as 'saturday', 
					sc.hour_id as 'hour_id' 
					FROM schedules sc
					LEFT OUTER JOIN courses c ON c.id = sc.course_id
					WHERE sc.team_id = :team_id	AND c.active = 1 
					
					UNION
					SELECT '09:00-10:00' as 'lesson_hour', '' as 'monday','' as 'tuesday','' as 'wednesday','' as 'thursday','' as 'friday','' as saturday, 1 as 'hour_id'
					UNION
					SELECT '10:00-11:00' as 'lesson_hour', '' as 'monday','' as 'tuesday','' as 'wednesday','' as 'thursday','' as 'friday','' as saturday, 2 as 'hour_id'
					UNION
					SELECT '11:00-12:00' as 'lesson_hour', '' as 'monday','' as 'tuesday','' as 'wednesday','' as 'thursday','' as 'friday','' as saturday, 3 as 'hour_id'
					UNION
					SELECT '12:00-13:00' as 'lesson_hour', '' as 'monday','' as 'tuesday','' as 'wednesday','' as 'thursday','' as 'friday','' as saturday, 4 as 'hour_id'
					UNION
					SELECT '13:00-14:00' as 'lesson_hour', '' as 'monday','' as 'tuesday','' as 'wednesday','' as 'thursday','' as 'friday','' as saturday, 5 as 'hour_id'
					UNION
					SELECT '14:00-15:00' as 'lesson_hour', '' as 'monday','' as 'tuesday','' as 'wednesday','' as 'thursday','' as 'friday','' as saturday, 6 as 'hour_id'
					UNION
					SELECT '15:00-16:00' as 'lesson_hour', '' as 'monday','' as 'tuesday','' as 'wednesday','' as 'thursday','' as 'friday','' as saturday, 7 as 'hour_id'
					UNION
					SELECT '16:00-17:00' as 'lesson_hour', '' as 'monday','' as 'tuesday','' as 'wednesday','' as 'thursday','' as 'friday','' as saturday, 8 as 'hour_id'
					UNION
					SELECT '17:00-18:00' as 'lesson_hour', '' as 'monday','' as 'tuesday','' as 'wednesday','' as 'thursday','' as 'friday','' as saturday, 9 as 'hour_id'
					UNION
					SELECT '18:00-19:00' as 'lesson_hour', '' as 'monday','' as 'tuesday','' as 'wednesday','' as 'thursday','' as 'friday','' as saturday, 10 as 'hour_id'
					UNION
					SELECT '19:00-20:00' as 'lesson_hour', '' as 'monday','' as 'tuesday','' as 'wednesday','' as 'thursday','' as 'friday','' as saturday, 11 as 'hour_id'
					UNION
					SELECT '20:00-21:00' as 'lesson_hour', '' as 'monday','' as 'tuesday','' as 'wednesday','' as 'thursday','' as 'friday','' as saturday, 12 as 'hour_id'

				) schedule 
				GROUP BY schedule.hour_id

			");
			
			$query->execute(array('team_id'=>$id));


		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();

    }

    function get_schedule_list_by_team_id($id){

    	global $connection;
                      
		try{

			$query = $connection->prepare("

				SELECT sc.id, sc.team_id, sc.course_id, sc.teacher_id, sc.day_id, t.login teacher_name, c.name course_name, 

				CASE WHEN sc.hour_id = 1 THEN '09:00-10:00' WHEN sc.hour_id = 2 THEN '10:00-11:00' WHEN sc.hour_id = 3 THEN '11:00-12:00' WHEN sc.hour_id = 4 THEN '12:00-13:00' WHEN sc.hour_id = 5 THEN '13:00-14:00' WHEN sc.hour_id = 6 THEN '14:00-15:00' WHEN sc.hour_id = 7 THEN '15:00-16:00' WHEN sc.hour_id = 8 THEN '16:00-17:00' WHEN sc.hour_id = 9 THEN '17:00-18:00' WHEN sc.hour_id = 10 THEN '18:00-19:00' WHEN sc.hour_id = 11 THEN '19:00-20:00' WHEN sc.hour_id = 12 THEN '20:00-21:00' END as 'lesson_hour', 

				CASE WHEN sc.day_id = 1 THEN 'Понедельник' WHEN sc.day_id = 2 THEN 'Вторник' WHEN sc.day_id = 3 THEN 'Среда' WHEN sc.day_id = 4 THEN 'Четверг' WHEN sc.day_id = 5 THEN 'Пятница' WHEN sc.day_id = 6 THEN 'Суббота' END as 'lesson_day'

				FROM schedules sc 
				LEFT OUTER JOIN users t ON t.id = sc.teacher_id 
				LEFT OUTER JOIN courses c ON c.id = sc.course_id
				WHERE sc.team_id = :team_id AND c.active = 1 

			");
			
			$query->execute(array('team_id'=>$id));


		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();

    }



    /* NEW QUERIES */
    function get_schedule_by_teacher_id($id){
        global $connection;


        $query =  $connection->prepare("
            SELECT t.id as team_id, c.id as course_id, t.name team_name, c.name course_name
            FROM schedules sc 
            INNER JOIN teams t ON t.id = sc.team_id 
            INNER JOIN courses c ON c.id = sc.course_id
            WHERE sc.teacher_id = :id AND c.active = 1
            GROUP BY t.id, c.id, team_name, course_name
        ");


        $query->execute(array('id'=> $id));
        $query->setFetchMode(PDO::FETCH_ASSOC);


        return $query->fetchAll();
    }


    function get_chapters_by_course_id($id) {
        global $connection;

        $query =  $connection->prepare("
            SELECT
                ch.*
            FROM courses c
            INNER JOIN chapters ch ON ch.course_id = c.id
            WHERE c.id = :id AND c.active = 1
        ");

        $query->execute(array('id'=> $id));
        $query->setFetchMode(PDO::FETCH_ASSOC);

        return $query->fetchAll();
    }


    function get_dates_from_schedulte($user_id, $team_id, $course_id) {

        global $connection;

        $query =  $connection->prepare("
            SELECT sc.id as schedule_id, sc.day_id, sc.hour_id, sc.team_id, t.name,

				CASE WHEN sc.hour_id = 1 THEN '09:00-10:00' WHEN sc.hour_id = 2 THEN '10:00-11:00' WHEN sc.hour_id = 3 THEN '11:00-12:00' WHEN sc.hour_id = 4 THEN '12:00-13:00' WHEN sc.hour_id = 5 THEN '13:00-14:00' WHEN sc.hour_id = 6 THEN '14:00-15:00' WHEN sc.hour_id = 7 THEN '15:00-16:00' WHEN sc.hour_id = 8 THEN '16:00-17:00' WHEN sc.hour_id = 9 THEN '17:00-18:00' WHEN sc.hour_id = 10 THEN '18:00-19:00' WHEN sc.hour_id = 11 THEN '19:00-20:00' WHEN sc.hour_id = 12 THEN '20:00-21:00' END as 'lesson_hour', 

				CASE WHEN sc.day_id = 1 THEN 'Понедельник' WHEN sc.day_id = 2 THEN 'Вторник' WHEN sc.day_id = 3 THEN 'Среда' WHEN sc.day_id = 4 THEN 'Четверг' WHEN sc.day_id = 5 THEN 'Пятница' WHEN sc.day_id = 6 THEN 'Суббота' END as 'lesson_day'

				FROM schedules sc 
				LEFT OUTER JOIN teams t ON t.id = sc.team_id 
				WHERE sc.team_id = :team_id AND sc.teacher_id = :user_id AND sc.course_id = :course_id
        ");

        $query->execute(array('user_id' => $user_id, 'team_id' => $team_id, 'course_id' => $course_id));

        $query->setFetchMode(PDO::FETCH_ASSOC);

        return $query->fetchAll();
    }


    function get_user_grade($user_id, $teacher_id, $team_id, $course_id) {
        global $connection;

        $query =  $connection->prepare("
                SELECT
                    grade
                FROM grades 
                WHERE 
                    team_id=:team_id AND 
                    course_id=:course_id AND 
                    teacher_id=:teacher_id AND
                    user_id=:user_id
                ORDER BY id DESC
                LIMIT 1
            ");

        $query->execute(array(
            'team_id'=> $team_id,
            'course_id'=> $course_id,
            'teacher_id'=> $teacher_id,
            'user_id'=> $user_id
        ));
        $query->setFetchMode(PDO::FETCH_ASSOC);

        return $query->fetch();
    }

    function get_user_homework($user_id, $teacher_id, $team_id, $course_id) {
        global $connection;

        $query =  $connection->prepare("
                    SELECT
                        file
                    FROM homeworks 
                    WHERE 
                        team_id=:team_id AND 
                        course_id=:course_id AND 
                        teacher_id=:teacher_id AND
                        user_id=:user_id
                    ORDER BY id DESC
                    LIMIT 1
                ");

        $query->execute(array(
            'team_id'=> $team_id,
            'course_id'=> $course_id,
            'teacher_id'=> $teacher_id,
            'user_id'=> $user_id
        ));
        $query->setFetchMode(PDO::FETCH_ASSOC);

        return $query->fetch();
    }

    function add_user_grade($user_id, $teacher_id, $team_id, $course_id, $grade) {
        global $connection;

        $success = false;

        try{

            $query =  $connection->prepare("
                    INSERT INTO grades ( team_id, course_id, user_id, teacher_id, grade, created_at)
                    VALUES (:team_id,:course_id,:user_id,:teacher_id,:grade, NOW())
                ");

            $query->execute(array(
                'team_id'=> $team_id,
                'course_id'=> $course_id,
                'teacher_id'=> $teacher_id,
                'user_id'=> $user_id,
                'grade'=> $grade,
            ));

            $success = true;


        }catch(PDOException $e){

            echo "Error: ".$e;

        }

        return $success;

    }

    function update_user_grade($user_id, $teacher_id, $team_id, $course_id, $grade) {
        global $connection;

        $success = false;

        try{

            $query =  $connection->prepare("
                        UPDATE grades 
                        SET grade=:grade
                        WHERE 
                            team_id=:team_id AND 
                            course_id=:course_id AND 
                            teacher_id=:teacher_id AND
                            user_id=:user_id
                    ");

            $query->execute(array(
                'team_id'=> $team_id,
                'course_id'=> $course_id,
                'teacher_id'=> $teacher_id,
                'user_id'=> $user_id,
                'grade'=> $grade,
            ));

            $success = true;


        }catch(PDOException $e){

            echo "Error: ".$e;

        }

        return $success;

    }

    /* End  */






    function get_schedule_by_id_and_team_id($schedule_id, $team_id){

    	global $connection;
    	$scheduleData = null;
                      
		try{

			$query = $connection->prepare("

				SELECT sc.id, sc.team_id, sc.course_id, sc.teacher_id, sc.day_id, sc.hour_id
				FROM schedules sc  
				LEFT OUTER JOIN courses c ON c.id = sc.course_id
				WHERE sc.team_id = :team_id AND sc.id = :schedule_id AND c.active = 1 LIMIT 1

			");
			
			$query->execute(array('schedule_id'=>$schedule_id, 'team_id'=>$team_id));

			foreach ($query as $row){
				
				$scheduleData = $row;

			}


		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $scheduleData;

    }

    function save_new_schedule($schedule_id, $team_id, $course_id, $day_id, $hour_id, $teacher_id){
        
        global $connection;
        $userData = null;
        $success = false;

		try{

			$query = $connection->prepare(" 
				UPDATE schedules SET hour_id = :hour_id, day_id = :day_id, teacher_id = :teacher_id, course_id = :course_id 
				WHERE id = :schedule_id AND team_id = :team_id 
			");
			
			$query->execute(array('schedule_id'=>$schedule_id, 'team_id'=>$team_id, 'course_id'=>$course_id, 'teacher_id'=>$teacher_id, 'day_id'=>$day_id, 'hour_id' =>$hour_id));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}

		
      	return $exists&&$success;
        
    }

    function delete_schedule($schedule_id, $team_id){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare(" 
				DELETE FROM schedules WHERE id = :schedule_id AND team_id = :team_id 
			");
			
			$row = $query->execute(array('schedule_id'=>$schedule_id, 'team_id'=>$team_id));

			$success = $row>0;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
		
      	return $success;
        
    }

    function add_new_test($name, $description, $testing_time, $question_amount){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare("
			 	INSERT INTO tests (id, name, testing_time, question_amount, description, created_date, active) 
			 	VALUES (NULL,:name, :testing_time, :question_amount, :description,NULL,1)
			 ");
			
			$query->execute(array('name' => $name, 'description' => $description, 'testing_time' => $testing_time, 'question_amount' => $question_amount));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}

		
      	return $success;
        
    }

    function save_test($id, $name, $description, $testing_time, $question_amount){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare("
				UPDATE tests SET name = :name, description = :description, testing_time = :testing_time, question_amount = :question_amount
				WHERE id = :id 
			");
			
			$query->execute(array('name' => $name, 'description' => $description, 'id' => $id, 'testing_time' => $testing_time, 'question_amount' => $question_amount));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}

		
      	return $success;
        
    }

    function delete_test($id){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare("
				UPDATE tests SET active = 0 
				WHERE id = :id 
			");
			
			$query->execute(array('id' => $id));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}

		
      	return $success;
        
    }

    function get_all_tests(){
        
        global $connection;
        $query = null;       

		try{

			$query = $connection->prepare(" 
				SELECT t.id, t.name, t.testing_time, t.description, t.question_amount, round((t.testing_time)/60) as testing_min, t.created_date 
				FROM tests t 
				WHERE t.active = 1 
				ORDER BY t.created_date DESC 
			");
			
			$query->execute();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }

    function get_test_by_id($test_id){
        
        global $connection;
        $test = null;
                      
		try{

			$query = $connection->prepare("
				SELECT t.id, t.name, t.testing_time, t.question_amount, t.description 
				FROM tests t WHERE t.active = 1 AND t.id =:test_id LIMIT 1 
			");
			
			$query->execute(array("test_id"=>$test_id));

			$test = $query->fetch();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $test;
        
    }

    function add_new_question($test_id, $name, $level, $question, $variant_1=null, $variant_2=null, $variant_3=null, $variant_4=null, $answer){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare("
					INSERT INTO test_questions (id, test_id, level_id, question, name, variant_1, variant_2, variant_3, variant_4, answer, added_date, active) 
					VALUES (NULL, :test_id, :level_id, :question, :name, :variant_1, :variant_2, :variant_3, :variant_4, :answer, NOW(), 1)
				");
			
			$query->execute(array(
				'test_id' => $test_id,
				'level_id' => $level,
				'question' => $question,
				'name' => $name, 
				'variant_1' => $variant_1,
				'variant_2' => $variant_2,
				'variant_3' => $variant_3,
				'variant_4' => $variant_4,
				'answer' => $answer
			));
			
			$success = true;

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}

		
      	return $success;
        
    }

    function get_all_question_names_by_test_id($test_id){
        
        global $connection;
        $query = null;       

		try{

			$query = $connection->prepare(" 
					SELECT q.id, q.level_id, q.name, q.added_date 
					FROM test_questions q 
					WHERE q.active = 1 AND q.test_id = :test_id 
					ORDER BY q.added_date DESC ");
			
			$query->execute(array("test_id"=>$test_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
        
    }   
    
    function get_question_by_id($question_id){
        
        global $connection;
        $query = null;       

		try{

			$query = $connection->prepare(" 
					SELECT q.id, q.test_id, t.name test_name, q.level_id, q.name, q.added_date, q.question, q.variant_1, q.variant_2, q.variant_3, q.variant_4, q.answer 
					FROM test_questions q 
					LEFT OUTER JOIN tests t ON t.id = q.test_id 
					WHERE q.active = 1 AND q.id = :question_id LIMIT 1");
			
			$query->execute(array("question_id"=>$question_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetch();
        
    }

    function save_question($id, $name, $level, $question, $variant_1=null, $variant_2=null, $variant_3=null, $variant_4=null, $answer){
        
        global $connection;
        $success = false;
	
		try{

			$query = $connection->prepare("

					UPDATE test_questions SET
						name = :name,
						level_id = :level_id,
						question = :question,
						variant_1 = :variant_1,
						variant_2 = :variant_2,
						variant_3 = :variant_3,
						variant_4 = :variant_4,
						answer = :answer
					WHERE id = :id AND active = 1

			");
			
			$success = $query->execute(array(
				'id' => $id,
				'level_id' => $level,
				'question' => $question,
				'name' => $name, 
				'variant_1' => $variant_1,
				'variant_2' => $variant_2,
				'variant_3' => $variant_3,
				'variant_4' => $variant_4, 
				'answer' => $answer
			));
			
		}catch(PDOException $e){

			$success = false;
			echo "Error: ".$e;
		
		}

		
      	return $success;
        
    } 

    function delete_question($id){
        
        global $connection;
	
		try{

			$query = $connection->prepare("SELECT test_id FROM test_questions WHERE id = :id LIMIT 1");
			$query->execute(array("id"=>$id));
			$result = $query->fetch();
			$test_id = $result['test_id'];

			$query = $connection->prepare("

					UPDATE test_questions SET
						active = 0 
					WHERE id = :id AND active = 1

			");
			
			$query->execute(array(
				'id' => $id
			));
			
		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}

		
      	return $test_id;
        
    } 

    function generate_contest($test_id, $user_id, $testing_time, $question_amount){

    	global $connection;
    	$id = null;

    	$unfinished_contest = get_unfinished_contests_by_user_id($user_id);

    	if($unfinished_contest['unfinished_contests_amount']==0){
			
	    	try{

	    		$query = $connection->prepare("
	    			INSERT INTO test_contests (id, test_id, user_id, start_time, end_time, is_finished, correct_answers) 
	    			VALUES (NULL, :test_id, :user_id, NOW(), DATE_ADD(NOW(), INTERVAL :testing_time SECOND), 0, 0)
	    		");

	    		$query->execute(
	    			array('test_id'=>$test_id, 'user_id'=>$user_id, 'testing_time'=> $testing_time)
	    		);

	    		$id = $connection->lastInsertId();
				
				if($id!=null&&$id!=0){

		    		$query = $connection->prepare("
		    			INSERT INTO contest_questions (contest_id, question_id, answered_value)
						(SELECT :contest_id, id, 0 FROM test_questions WHERE test_id = :test_id AND active = 1 ORDER BY RAND() LIMIT $question_amount)
		    		");

		    		$query->execute(array("contest_id"=>$id, "test_id"=>$test_id));
					
				}

	    	}catch(PDOException $e){

	    		echo "Error: ".$e;
	    	
	    	}

	    }

    	return $id;

    }

    function get_contests_by_user_id($user_id){
        
        global $connection;
        $query = null;       

		try{

			$query = $connection->prepare(" 
				SELECT ct.id, ct.test_id, t.name test_name, t.question_amount, ct.start_time, ct.end_time, ct.is_finished 
				FROM test_contests ct 
				LEFT OUTER JOIN tests t ON ct.test_id = t.id 
				WHERE t.active = 1 AND ct.user_id = :user_id
				ORDER BY t.name DESC 
			");
			
			$query->execute(array('user_id'=>$user_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetchAll();
    }

    function get_contest_by_contest_id_and_user_id($contest_id, $user_id){
        
        global $connection;
        $query = null;       

		try{

			$query = $connection->prepare(" 
				SELECT ct.id, ct.test_id, t.name test_name, t.description, t.question_amount, t.testing_time, round((t.testing_time)/60) as testing_min, ct.start_time, ct.end_time, ct.is_finished, ct.correct_answers 
				 
				FROM test_contests ct 
				LEFT OUTER JOIN tests t ON ct.test_id = t.id 
				WHERE t.active = 1 AND ct.user_id = :user_id AND ct.id = :contest_id 
				LIMIT 1 
			");
			
			$query->execute(array('user_id'=>$user_id, 'contest_id'=>$contest_id));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $query->fetch();
    }    

    function finish_contest_by_contest_id_and_user_id($contest_id, $user_id){
        
        global $connection;
        $query = null; 
        $result = false;      

		try{

			$query = $connection->prepare("
				SELECT count(cq.id) correct_answers 
				FROM contest_questions cq 
				LEFT OUTER JOIN test_questions tq ON tq.id = cq.question_id  
				LEFT OUTER JOIN test_contests tc ON tc.id = cq.contest_id
				WHERE cq.contest_id = :contest_id AND tq.answer = cq.answered_value AND tc.user_id = :user_id AND tq.active = 1 
			");

			$query->execute(array("contest_id" => $contest_id, "user_id" => $user_id));

			$correct_answers = $query->fetch()['correct_answers'];

			$query = $connection->prepare(" 
				UPDATE test_contests SET is_finished = 1, correct_answers = :correct_answers WHERE user_id =:user_id AND id = :contest_id 
			");
			
			$result = $query->execute(array('user_id'=>$user_id, 'contest_id'=>$contest_id, 'correct_answers' => $correct_answers));

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}

		return $result;
        
    }  

    function get_unfinished_contests_by_user_id($user_id){
        
        global $connection;
        $query = null;       

        $result = 0;

		try{

			$query = $connection->prepare(" 
				SELECT COUNT(ct.id) unfinished_contests_amount
				FROM test_contests ct 
				WHERE ct.user_id = :user_id AND ct.is_finished = 0 
			");
			
			$query->execute(array('user_id'=>$user_id));

			$result = $query->fetch();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $result;
    }

    function get_contest_questions_by_user_id_and_contest_id($contest_id){

    	global $connection;
        $query = null;       

        $result = 0;

		try{

			$query = $connection->prepare(" 
				SELECT cq.id, q.name, q.answer, cq.answered_value 
				FROM contest_questions cq 
				LEFT OUTER JOIN test_questions q ON cq.question_id = q.id
				WHERE cq.contest_id = :contest_id AND q.active = 1 
				ORDER BY cq.id ASC 
			");
			
			$query->execute(array('contest_id'=>$contest_id));

			$result = $query->fetchAll();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $result;

    }

    function get_next_contest_question_by_user_id_and_contest_id($user_id, $contest_id, $question_id){

    	global $connection;
        $query = null;       

        $result = null;

		try{

			$query = $connection->prepare(" 

				SELECT cq.id 
				FROM contest_questions cq 
				LEFT OUTER JOIN test_contests tc ON tc.id = cq.contest_id 
				WHERE cq.contest_id = :contest_id AND tc.user_id = :user_id AND cq.id > :question_id
				ORDER BY cq.id ASC LIMIT 1 
			
			");
			
			$query->execute(array('contest_id'=>$contest_id, 'user_id'=>$user_id, 'question_id'=>$question_id));

			$result = $query->fetch();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $result['id'];

    }

    function get_previous_contest_question_by_user_id_and_contest_id($user_id, $contest_id, $question_id){

    	global $connection;
        $query = null;       

        $result = null;

		try{

			$query = $connection->prepare(" 
				
				SELECT cq.id 
				FROM contest_questions cq 
				LEFT OUTER JOIN test_contests tc ON tc.id = cq.contest_id 
				WHERE cq.contest_id = :contest_id AND tc.user_id = :user_id AND cq.id < :question_id
				ORDER BY cq.id DESC LIMIT 1 	

			");
			
			$query->execute(array('contest_id'=>$contest_id, 'user_id'=>$user_id, 'question_id'=>$question_id));

			$result = $query->fetch();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $result['id'];

    }    

    function get_contest_question_by_user_id_and_question_id($user_id, $contest_question_id){

    	global $connection;
        $query = null;       

        $result = null;

		try{

			$query = $connection->prepare(" 
				SELECT cq.id, cq.contest_id, q.name, q.answer, cq.answered_value, q.question, q.variant_1, q.variant_2, q.variant_3, q.variant_4, q.level_id, t.name test_name, tc.test_id, tc.is_finished, CASE WHEN cq.answered_value = q.answer THEN 1 ELSE 0 END is_correct 
				FROM contest_questions cq 
				LEFT OUTER JOIN test_questions q ON cq.question_id = q.id
				LEFT OUTER JOIN test_contests tc ON tc.id = cq.contest_id 
				LEFT OUTER JOIN tests t ON t.id = tc.test_id 
				WHERE cq.id = :contest_question_id AND tc.user_id = :user_id AND q.active = 1
				LIMIT 1
			");
			
			$query->execute(array('contest_question_id'=>$contest_question_id, 'user_id'=>$user_id));

			$result = $query->fetch();

		}catch(PDOException $e){

			echo "Error: ".$e;
		
		}
        
        return $result;

    } 

    function update_contest_question_by_user_id_and_question_id($user_id, $contest_question_id, $answered_value){

    	global $connection;
        $query = null;       

        $result = false;

        $question = get_contest_question_by_user_id_and_question_id($user_id, $contest_question_id);

        if($question!=null&&$question['is_finished']==0){

			try{

				$query = $connection->prepare(" 
					UPDATE contest_questions cq SET cq.answered_value = :answered_value WHERE cq.id = :contest_question_id
				");
				
				$result = $query->execute(array('answered_value'=>$answered_value , 'contest_question_id'=>$contest_question_id));

			}catch(PDOException $e){

				echo "Error: ".$e;
			
			}
        
        }

        return $result;

    }        

?>