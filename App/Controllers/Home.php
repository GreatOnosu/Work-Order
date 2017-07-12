<?php
namespace App\Controllers;
use \Core\View;
/************************************************************************/
use \App\Models\User;
/************************************************************************/	
class Home extends \Core\Controller{
/************************************************************************/	
	protected function before(){

	}
/************************************************************************/	
	public function indexAction(){
		$result = User::isLogin();
		View::render('Home/index.php', [
			'stat'	=>	$result
			]);
	}
	public function signupAction(){
		$result = User::createAccount();
		View::render('Home/signup.php', [
			'stat'	=>	$result
			]);
	}
	public function successAction(){
		if(isset($_GET['acct'])){
			$msg = $_GET['acct'];
		}
		View::render('Home/success.php', [
			'msg'	=>	$msg
			]);
	}
	public function logoutAction(){
		View::render('Home/logout.php');
	}
/************************************************************************/	
	protected function after(){

	}
}