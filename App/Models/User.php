<?php
namespace App\Models;
use PDO;
use App\Config;
class User extends \Core\Model{
/************************************************************************/
	public static function isLogin(){
		$conn = static::getDB();
		if(isset($_POST['btn_login'])){
			$get_username = static::validateData($_POST['username']);
			$get_pin = static::validateData($_POST['pin']);
			try {
				$result = $conn->prepare("SELECT * FROM user_tb WHERE username = '$get_username' AND password = '$get_pin'");
				$result->execute();
				$log_in = $result->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				return false;
			}
			if(!empty($log_in)){
				$_SESSION['session_access'] = $log_in{0}->level;
				$_SESSION['session_username'] = $log_in{0}->username;
				$_SESSION['session_pin'] = $log_in{0}->password;
				if($_SESSION['session_access'] == 'Admin'){
					header("Location:../Admin/index");
				}elseif($_SESSION['session_access'] == 'Staff'){
					$check_duplicate = static::getData($conn, 'staff_tb', 'username', $_SESSION['session_username']);
					$_SESSION['session_dept'] = $check_duplicate{0}->department;
					$_SESSION['session_pix'] = $check_duplicate{0}->picture;
					$_SESSION['session_lastname'] = $check_duplicate{0}->last_name;
					$_SESSION['session_fullname'] = $check_duplicate{0}->first_name .' '. $check_duplicate{0}->last_name;
					if($_SESSION['session_dept'] == 'Exams and Records'){
						header("Location:../Staff/indexexam");
					}elseif($_SESSION['session_dept'] == 'Maintenance'){
						header("Location:../Staff/indexexam");
					}else{
						header("Location:../Staff/index");
					}					
				}else{
					$check_duplicate = static::getData($conn, 'student_tb', 'username', $_SESSION['session_username']);
					$_SESSION['session_dept'] = $check_duplicate{0}->department;
					$_SESSION['session_pix'] = $check_duplicate{0}->picture;
					$_SESSION['session_lastname'] = $check_duplicate{0}->last_name;
					$_SESSION['session_fullname'] = $check_duplicate{0}->first_name .' '. $check_duplicate{0}->last_name;
					header("Location:../Student/index");
				}
			}else{
				$stat = '<h3 class="error">Wrong username or pin</h3>';
				return $stat;
			}
		}
	}
/************************************************************************/
	public static function isLoginCheck(){
		if(isset($_SESSION['session_username'])){
			
		}else{
			header("Location:../Home/index");
		}
	}
/*********************************************************************************/
public static function createAccount(){
		$conn = static::getDB();
		$stat = '';
		if(isset($_POST['btn_signup'])){
			if(isset($_FILES['image'])){
				$image_name = $_FILES['image']['name'];
				$image_temp = $_FILES['image']['tmp_name'];
				$image_size = $_FILES['image']['size'];
				$image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
				$image_path = 'images/'.$image_name;
				if($image_size < 2000000){
					if($image_ext == 'jpg' || $image_ext = 'png' || $image_ext = 'gif'){
						if(move_uploaded_file($image_temp,$image_path)){
							$image_file = $image_path;
						}else{
							$stat = '<h3 class="error">Image upload not successful</h3>';
						}
					}else{
						$stat = '<h3 class="error">Wrong image format</h3>';
					}
				}else{
					$stat = '<h3 class="error">Image size is too big</h3>';
				}
			}
			$get_fname = static::validateData($_POST['fname']);
			$get_lname = static::validateData($_POST['lname']);
			$get_gender = $_POST['gender'];
			$get_cat = static::validateData($_POST['category']);
			$get_dept = static::validateData($_POST['department']);
			$get_pin = static::validateData($_POST['pin']);
			if($get_cat == 'Staff'){
				$get_username  = "BIU16".rand(10000,99999);
			}else{
				$get_username = static::getMatno($get_dept);
			}
			$check_dup = static::getData($conn, 'user_tb', 'username', $get_username);
			while (!empty($check_dup)) {
				if($get_cat == 'Staff'){
					$get_username  = "BIU16".rand(10000,99999);
				}else{
					$get_username = static::getMatno($get_dept);
				}
				$check_dup = static::getData($conn, 'user_tb', 'username', $get_username);
			}
			$bindings = array(
				'fname' 		=>	$get_fname,
				'lname'			=>	$get_lname,
				'gender'		=>	$get_gender,
				'dept'			=>	$get_dept,
				'pin'			=>	$get_pin,
				'username'		=>	$get_username,
				'picture'		=>	$image_file,
			);
			$bindings1 = array(
				'username'	=> $get_username,
				'pin'		=> $get_pin,
				'level'		=> $get_cat,
				'full_name' =>	$get_fname.''.$get_lname,
				'dept'		=>	$get_dept,
			);
			if($get_cat == 'Staff'){
				try {
					$result = $conn->prepare("INSERT INTO staff_tb (username, password, first_name, last_name, gender, picture, department) VALUES (:username, :pin, :fname, :lname, :gender, :picture, :dept)");
					$create_account = $result->execute($bindings);
				} catch (Exception $e) {
					return false;
				}
			}else{
				try {
					$result = $conn->prepare("INSERT INTO student_tb (username, password, first_name, last_name, gender, picture, department) VALUES (:username, :pin, :fname, :lname, :gender, :picture, :dept)");
					$create_account = $result->execute($bindings);
				} catch (Exception $e) {
					return false;
				}
			}
			try {
				$result = $conn->prepare("INSERT INTO user_tb (username, password, level, full_name, department) VALUES (:username, :pin, :level, :full_name, :dept)");
				$create_user = $result->execute($bindings1);
			} catch (Exception $e) {
				return false;
			}
			if(!empty($create_user) && !empty($create_account)){
				header("Location:success?acct=$get_username");
			}else{
				return $stat;
			}
		}
	}
/*********************************************************************************/
	public static function getStudent(){
		$conn = static::getDB();
		$get_dept = $_SESSION['session_dept'];
		$students = static::getData($conn, 'student_tb', 'department', $get_dept);
		$stat = '';	
		$rec = rand(100000,999999);
		$date = date("Y-m-d h:i:s");
		if(isset($_POST['staff_submit'])){
			$bindings = array(
				'dept' 		=>	$_SESSION['session_dept'],
				'staff'		=>	$_SESSION['session_fullname'],
				'rec'		=>	$rec,
				'status'	=>	'Assigned',
				'ptime'		=>	$date,
				);	
			try {
				$result = $conn->prepare("INSERT INTO records_tb (department, poster, records_id, status, post_time) VALUES (:dept, :staff, :rec, :status, :ptime)");
				$records = $result->execute($bindings);
			} catch (Exception $e) {
				return false;
			}
			$string = $conn->prepare("UPDATE student_tb SET status = 'Assigned', staff = concat(staff,'|$_SESSION[session_fullname]'), records_id = concat(records_id,'|$rec'), post_time = '$date' WHERE department = '$get_dept'");
			$output = $string->execute();
			if(!empty($records)){
				$stat = 'Submission Successfully';
			}else{
				$stat = 'Submission Unsuccessful';
			}
		}
		$info = array('students' => $students, 'stat' => $stat);
		return $info;
	}
/*********************************************************************************/
	public static function getResult(){
		$conn = static::getDB();
		$get_username = $_SESSION['session_username'];
		try {
			$result = $conn->prepare("SELECT * FROM student_tb WHERE username = '$get_username' AND status = 'Closed'");
			$result->execute();
			$students = $result->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			return false;
		}
		if(empty($students)){
			header("Location:index?msg=no");
		}
		return $students;
	}
/*********************************************************************************/
	public static function getUsers(){
		$conn = static::getDB();
		try {
			$result = $conn->prepare("SELECT * FROM user_tb");
			$result->execute();
			$users = $result->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			return false;
		}
		return $users;
	}
/*********************************************************************************/
	public static function acceptWork(){
		$conn = static::getDB();
		if($_SESSION['session_dept'] == 'Maintenance'){
			try {
				$result = $conn->prepare("SELECT * FROM maintenance_tb WHERE status = 'In queue' AND staff_allocated = '$_SESSION[session_fullname]'");
				$result->execute();
				$records = $result->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				return false;
			}
		}elseif($_SESSION['session_dept'] == 'Exams and Records'){
			try {
				$result = $conn->prepare("SELECT * FROM records_tb WHERE status = 'In queue'");
				$result->execute();
				$records = $result->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				return false;
			}
		}
		if(isset($_POST['accept_main'])){
			$id = $_POST['accept_id'];
			$string = $conn->prepare("UPDATE maintenance_tb SET status = 'Work In Progress' WHERE id = $id");
			$output = $string->execute();
			if(!empty($output)){
				header("Location:acceptmain?msg=ok");
			}
		}
		if(isset($_POST['accept_exam'])){
			$id = $_POST['accept_id'];
			$string = $conn->prepare("UPDATE records_tb SET status = 'Work In Progress' WHERE id = $id");
			$output = $string->execute();
			$string1 = $conn->prepare("UPDATE student_tb SET status = 'Work In Progress' WHERE id = $id");
			$output1 = $string1->execute();
			if(!empty($output) && !empty($output1)){
				header("Location:acceptexam?msg=ok");
			}
		}
		return $records;
	}
/*********************************************************************************/
	public static function completeWork(){
		$conn = static::getDB();
		if($_SESSION['session_dept'] == 'Maintenance'){
			try {
				$result = $conn->prepare("SELECT * FROM maintenance_tb WHERE status = 'Work In Progress' AND staff_allocated = '$_SESSION[session_fullname]'");
				$result->execute();
				$records = $result->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				return false;
			}
		}elseif($_SESSION['session_dept'] == 'Exams and Records'){
			try {
				$result = $conn->prepare("SELECT * FROM records_tb WHERE status = 'Work In Progress'");
				$result->execute();
				$records = $result->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				return false;
			}
		}
		if(isset($_POST['complete_main'])){
			$id = $_POST['complete_id'];		
			$date = date("Y-m-d h:i:s");	
			$string = $conn->prepare("UPDATE maintenance_tb SET status = 'Fulfilled', complete_time = '$date' WHERE id = $id");
			$output = $string->execute();
			$string1 = $conn->prepare("UPDATE student_tb SET status = 'Fulfilled', complete_time = '$date' WHERE id = $id");
			$output1 = $string1->execute();
			if(!empty($output) && !empty($output1)){
				header("Location:completemain?msg=ok");
			}
		}
		if(isset($_POST['complete_exam'])){
			$id = $_POST['complete_id'];		
			$date = date("Y-m-d h:i:s");	
			$string = $conn->prepare("UPDATE records_tb SET status = 'Fulfilled', complete_time = '$date' WHERE id = $id");
			$output = $string->execute();
			$string1 = $conn->prepare("UPDATE student_tb SET status = 'Fulfilled', complete_time = '$date' WHERE id = $id");
			$output1 = $string1->execute();
			if(!empty($output) && !empty($output1)){
				header("Location:completeexam?msg=ok");
			}
		}
		return $records;
	}
/*********************************************************************************/
	public static function getStaffStatus(){
		$conn = static::getDB();
		$get_username = $_SESSION['session_fullname'];
		$get_dept = $_SESSION['session_dept'];
		try {
			$result = $conn->prepare("SELECT * FROM student_tb WHERE staff LIKE '%$get_username%' AND department = '$get_dept'");
			$result->execute();
			$exams  =  $result->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			return false;
		}
		try {
			$result = $conn->prepare("SELECT * FROM maintenance_tb WHERE poster = '$_SESSION[session_username]'");
			$result->execute();
			$maintain  =  $result->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			return false;
		}
		return $info = array('exams' => $exams, 'maintain' => $maintain);
	}
/*********************************************************************************/
	public static function recentStudentStatus(){
		$conn = static::getDB();
		try {
			$result = $conn->prepare("SELECT * FROM maintenance_tb WHERE poster = '$_SESSION[session_username]' LIMIT 5");
			$result->execute();
			$exams  =  $result->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			return false;
		}
		return $exams;
	}
/*********************************************************************************/
	public static function recentStaffStatus(){
		$conn = static::getDB();
		try {
			$result = $conn->prepare("SELECT * FROM maintenance_tb WHERE poster = '$_SESSION[session_username]' LIMIT 5");
			$result->execute();
			$exams  =  $result->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			return false;
		}
		return $exams;
	}
/*********************************************************************************/
	public static function submitRequest(){
		$conn = static::getDB();
		if(isset($_POST['btn_request'])){
			$get_dept = $_SESSION['session_dept'];
			$get_username = $_SESSION['session_username'];
			$get_title = static::validateData($_POST['mtitle']);
			$get_desc = static::validateData($_POST['description']);
			$date = date("Y-m-d h:i:s");
			$bindings = array(
				'title' 		=>	$get_title,
				'description'	=>	$get_desc,
				'status'		=>	'Assigned',
				'department'	=>	$get_dept,
				'poster'		=>	$get_username,
				'post_time'		=>	$date,
			);
			try {
				$result = $conn->prepare("INSERT INTO maintenance_tb (title, description, status, department, poster, post_time) VALUES (:title, :description, :status, :department, :poster, :post_time)");
				$create_account = $result->execute($bindings);
				$stat = 'Request Submitted';
			} catch (Exception $e) {
				return false;
				$stat = 'Error Submitting Request';
			}
			return $stat;
		}
	}
}