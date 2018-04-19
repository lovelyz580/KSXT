<?php 

	namespace app\index\controller;

	use think\Controller;

	/**
	* 空控制器
	*/
	class Error extends Controller
	{
		
		public function _empty(){
			$this->redirect(url("index"));
		}
		
	}


 ?>