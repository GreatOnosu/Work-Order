<?php
namespace App\Controllers;
use \Core\View;
/************************************************************************/
use \App\Models\User;
use \App\Models\Allocate;
/************************************************************************/	
class Admin extends \Core\Controller{
/************************************************************************/	
	protected function before(){

	}
/************************************************************************/	
	public function indexAction(){
		User::isLoginCheck();
		View::render('Admin/index.php');
	}
	public function assignAction(){
		User::isLoginCheck();
		$info = Allocate::getMaintenance();
		View::render('Admin/assign.php',[
			'records'	=>	$info{'records'},
			'staffs'	=>	$info{'staffs'},
			'stat'		=>	$info{'stat'}
			]);
	}
	public function usersAction(){
		User::isLoginCheck();
		$info = User::getUsers();
		View::render('Admin/users.php', [
			'users'	=>	$info
			]);
	}
	public function progressAction(){
		User::isLoginCheck();
		$info = Allocate::getMainProgress();
		View::render('Admin/progress.php',[
			'records'	=>	$info
			]);
	}
	public function fulfilledAction(){
		User::isLoginCheck();
		$info = Allocate::getMainFulfill();
		if(isset($_GET['msg'])){
			$stat = 'Successful';
		}else{
			$stat = '';
		}
		View::render('Admin/fulfilled.php',[
			'records'	=>	$info,
			'stat'		=>	$stat
			]);
	}
	public function closedAction(){
		User::isLoginCheck();
		$info = Allocate::getMainClosed();
		View::render('Admin/closed.php',[
			'records'	=>	$info
			]);
	}
	public function queueAction(){
		User::isLoginCheck();
		$info = Allocate::getMainQueue();
		View::render('Admin/queue.php',[
			'records'	=>	$info
			]);
	}
/************************************************************************/	
	protected function after(){

	}
}