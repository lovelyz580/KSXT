<?php
	//声明命名空间
	namespace app\index\validate;

	//导入系统验证类
	use think\Validate;

	/**
	* 登录类
	*/
	class Login extends Validate{
		
		// //验证规则
		protected $rule = [

			"type" => "require",
			"user" => "require|number|length:5,15",
			"password" => "require|alphaDash|length:5,15",
			"captcha" => "require",
			
		];

		// //错误提示信息
		protected $message = [

			"type.require" => "id不能为空",
			"user.require" => "用户名不能为空",
			"user.number" => "用户名或密码错误",
			"user.length" => "用户名或密码错误",
			"password.require" => "密码不能为空",
			"password.alphaDash" => "用户名或密码错误",
			"password.length" => "用户名或密码错误",
			"captcha.require" => "验证码不能为空",
			
		];

		// 自定义验证规则
		// 正则表达式验证
   		protected function special($value,$rule,$data){
   			$pattern = "/^$rule$/";
       		if(preg_match($pattern,$value)){
       			return true;
       		}else{
       			return false;
       		}
	   	}

	}

 ?>