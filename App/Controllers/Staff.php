<?php
namespace App\Controllers;
use \Core\View;
/************************************************************************/
use \App\Models\User;
/************************************************************************/	
class Staff extends \Core\Controller{
/************************************************************************/	
	protected function before(){

	}
/************************************************************************/	
	public function indexAction(){
		User::isLoginCheck();
		$info = User::recentStaffStatus();
		View::render('Staff/index.php',[
			'maintain' => $info
			]);
	}
	public function indexexamAction(){
		User::isLoginCheck();
		View::render('Staff/index2.php');
	}
	public function resultAction(){
		User::isLoginCheck();
		$info = User::getStudent();
		View::render('Staff/result.php', [
			'students'	=>	$info{'students'},
			'stat'		=>	$info{'stat'}
			]);
	}
	public function maintenanceAction(){
		User::isLoginCheck();
		$info = User::submitRequest();
		View::render('Staff/maintenance.php',[
			'stat'	=>	$info
			]);
	}
	public function statusAction(){
		User::isLoginCheck();
		$info = User::getStaffStatus();
		View::render('Staff/status.php',[
			'maintain' => $info{'maintain'}
			]);
	}
	public function courseAction(){
		User::isLoginCheck();
		User::addCourse();
		View::render('Staff/course.php');
	}
	public function acceptmainAction(){
		User::isLoginCheck();
		$info = User::acceptWork();
		if(isset($_GET['msg'])){
			$stat = 'Successful';
		}else{
			$stat = '';
		}
		View::render('Staff/accept_main.php',[
			'records'	=>	$info,
			'stat'		=>	$stat
			]);
	}
	public function completemainAction(){
		User::isLoginCheck();
		$info = User::completeWork();
		if(isset($_GET['msg'])){
			$stat = 'Successful';
		}else{
			$stat = '';
		}
		View::render('Staff/complete_main.php',[
			'records'	=>	$info,
			'stat'		=>	$stat
			]);
	}
	public function acceptexamAction(){
		User::isLoginCheck();
		$info = User::acceptWork();
		if(isset($_GET['msg'])){
			$stat = 'Successful';
		}else{
			$stat = '';
		}
		View::render('Staff/accept_exam.php',[
			'records'	=>	$info,
			'stat'		=>	$stat
			]);
	}
	public function completeexamAction(){
		User::isLoginCheck();
		$info = User::completeWork();
		if(isset($_GET['msg'])){
			$stat = 'Successful';
		}else{
			$stat = '';
		}
		View::render('Staff/complete_exam.php',[
			'records'	=>	$info,
			'stat'		=>	$stat
			]);
	}
	public function gradeAction(){
		User::isLoginCheck();
		$info = User::getStudent();
		View::render('Staff/grade.php', [
			'students'	=>	$info
			]);
	}
/************************************************************************/	
	protected function after(){

	}
}