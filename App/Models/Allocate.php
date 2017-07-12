<?php
namespace App\Models;
use PDO;
use App\Config;
class Allocate extends \Core\Model{
/************************************************************************/
	public static function getExamRecords(){
		$conn = static::getDB();
		$records = static::getData($conn, 'records_tb', 'status', 'Assigned');
		return $records;

	}
/************************************************************************/
	public static function getExamQueue(){
		$conn = static::getDB();
		$records = static::getData($conn, 'records_tb', 'status', 'In Queue');
		return $records;

	}
/************************************************************************/
	public static function getMainQueue(){
		$conn = static::getDB();
		$records = static::getData($conn, 'maintenance_tb', 'status', 'In Queue');
		return $records;

	}
/************************************************************************/
	public static function getExamProgress(){
		$conn = static::getDB();
		$records = static::getData($conn, 'records_tb', 'status', 'Work In Progress');
		return $records;

	}
/************************************************************************/
	public static function getMainProgress(){
		$conn = static::getDB();
		$records = static::getData($conn, 'maintenance_tb', 'status', 'Work In Progress');
		return $records;

	}
/************************************************************************/
	public static function getMainFulfill(){
		$conn = static::getDB();
		$records = static::getData($conn, 'maintenance_tb', 'status', 'Fulfilled');
		if(isset($_POST['close_main'])){
			$id = $_POST['close_id'];	
			$string = $conn->prepare("UPDATE maintenance_tb SET status = 'Closed' WHERE id = $id");
			$output = $string->execute();
			if(!empty($output)){
				header("Location:fulfilled?msg=ok");
			}
		}
		return $records;
	}
/************************************************************************/
	public static function getMainClosed(){
		$conn = static::getDB();
		$records = static::getData($conn, 'maintenance_tb', 'status', 'Closed');
		return $records;

	}
/************************************************************************/
	public static function getMaintenance(){
		$conn = static::getDB();
		$records = static::getData($conn, 'maintenance_tb', 'status', 'Assigned');
		$staffs = static::getData($conn, 'staff_tb', 'department', 'Maintenance');
		$stat = '';
		if(isset($_POST['allo_main'])){
			$get_name = $_POST['it_allocate'];
			$id = $_POST['id'];
			$string = $conn->prepare("UPDATE maintenance_tb SET status = 'In Queue', staff_allocated = '$get_name' WHERE id = $id");
			$output = $string->execute();
			if(!empty($output)){
				$stat = "Succesful";
			}else{
				$stat = "Unsuccessful";
			}
		}
		return $info = array('records' => $records, 'staffs' => $staffs, 'stat' => $stat);

	}
/************************************************************************/
	public static function getStudentExam(){
		$conn = static::getDB();
		if(isset($_GET['post'])){
			$get_name = $_GET['post'];
			try {
				$result = $conn->prepare("SELECT * FROM student_tb WHERE records_id LIKE '%$get_name%'");
				$result->execute();
				$exams  =  $result->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				return false;
			}
			$staffs = static::getData($conn, 'staff_tb', 'department', 'Exams and Records');
			return $info = array('exams' => $exams, 'staffs' => $staffs);
		}
		if(isset($_POST['btn_allocate'])){
			$staff = $_POST['staff_allocate'];
			$id = $_POST['rec_id'];
			$string = $conn->prepare("UPDATE records_tb SET status = 'In Queue', staff_allocated = '$staff' WHERE records_id = $id");
			$output = $string->execute();
			$string1 = $conn->prepare("UPDATE student_tb SET status = 'In Queue', staff_allocated = '$staff' WHERE records_id LIKE '%$id%'");
			$output1 = $string1->execute();
			if(!empty($output) && !empty($output1)){
				header("Location:assignexams?msg=ok");
			}
		}
		if(isset($_POST['btn_decline'])){
			$staff = $_POST['staff_allocate'];
			$id = $_POST['rec_id'];
			$string = $conn->prepare("UPDATE records_tb SET status = 'Decline', staff_allocated = 'None' WHERE records_id = $id");
			$output = $string->execute();
			$string1 = $conn->prepare("UPDATE student_tb SET status = 'Decline', staff_allocated = 'None' WHERE records_id LIKE '%$id%'");
			$output1 = $string1->execute();
			if(!empty($output) && !empty($output1)){
				header("Location:assignexams?msg=ok");
			}
		}
	}
}