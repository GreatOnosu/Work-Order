<?php
if(isset($_POST['value_selected'])){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "workorder";
	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    }
	catch(PDOException $e)
	    {
	    echo "Connection failed: " . $e->getMessage();
	    }
	$value = $_POST['value_selected'];
	$id = $_POST['id_selected'];
	$name = $_POST['name_selected'];
  	try {
		$result = $conn->prepare("SELECT * FROM student_tb WHERE username = '$id'");
		$result->execute();
		$student  =  $result->fetchAll(PDO::FETCH_OBJ);
	} catch (Exception $e) {
		return false;
	}
	$res = explode("-", $name);
	$answer = str_replace("$name", "$res[0]-$value", $student{0}->courses);
	$result = $conn->prepare("UPDATE student_tb SET courses = '$answer' WHERE username = '$id'");
	$result = $result->execute();
}
?>