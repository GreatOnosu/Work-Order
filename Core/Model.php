<?php
namespace Core;
use PDO;
use App\Config;
abstract class model{
	protected static function getDB(){
		static $conn = null;
		if($conn === null){
			try{
				$dsn = 'mysql:host='. Config::DB_HOST .';dbname='. Config::DB_NAME .';charset=utf8';
				$conn = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
				return $conn;
			} catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}
/************************************************************************************************************/
	public static function validateData($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
/************************************************************************************************************/
	public static function getMatno($data){
		if($data == 'Computer Science'){
			$res = "BIU/CSC/16".rand(1000,9999);
		}elseif ($data == 'Mass Communication') {
			$res = "BIU/MAC/16".rand(1000,9999);
		}elseif ($data == 'Law') {
			$res = "BIU/LAW/16".rand(1000,9999);
		}elseif ($data == 'International Studies and Diplomacy') {
			$res = "BIU/ISD/16".rand(1000,9999);
		}elseif($data == 'Mechanical Engineering'){
			$res = "BIU/MEC/16".rand(1000,9999);
		}
		return $res;
	}
/************************************************************************************************************/
	public static function getData($conn, $table, $id, $value){
		try {
			$result = $conn->prepare("SELECT * FROM $table WHERE $id = '$value' ORDER BY id DESC");
			$result->execute();
			return $result->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			return false;
		}
	}
}