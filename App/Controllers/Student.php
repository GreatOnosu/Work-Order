<?php
namespace App\Controllers;
use \Core\View;
/************************************************************************/
use \App\Models\User;
/************************************************************************/	
class Student extends \Core\Controller{
/************************************************************************/	
	protected function before(){

	}
/************************************************************************/	
	public function indexAction(){
		User::isLoginCheck();
		$info = User::recentStudentStatus();
		View::render('Student/index.php',[
			'maintain' => $info
			]);
	}
	public function resultAction(){
		$info = User::getResult();
		View::render('Student/result.php', [
			'students'	=>	$info
			]);
	}
	public function maintenanceAction(){
		User::isLoginCheck();
		$info = User::submitRequest();
		View::render('Student/maintenance.php',[
			'stat'	=>	$info
			]);
	}
	public function statusAction(){
		User::isLoginCheck();
		$info = User::getStaffStatus();
		View::render('Student/status.php',[
			'maintain' => $info{'maintain'}
			]);
	}
/************************************************************************/	
	protected function after(){

	}
}