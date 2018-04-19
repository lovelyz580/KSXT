<?php
	//声明命名空间
	namespace app\index\validate;

	//导入系统验证类
	use think\Validate;

	/**
	* 教师注册信息验证类
	*/
	class Teacher extends Validate{
		
		// //验证规则
		protected $rule = [

			"user" => "require|number|length:5,15",
			"password" => "require|alphaDash|length:5,15",
			"name" => "require|length:1,15|special:[^~!@#$%^&*<>]",
			"email" => "require|email",
		];

		// //错误提示信息
		protected $message = [

			"user.require" => "用户名不能为空",
			"user.length" => "长度为5-15位",
			"user.number" => "必须为数字型",
			"password.require" => "密码不能为空",
			"password.alphaDash" => "格式为字母数字下划线",
			"password.length" => "长度为5-15位",
			"name.require" => "姓名不能为空",
			"name.length" => "长度为1-15位",
			"name.special" => "不能包含特殊字符",
			"email.require" => "邮箱不能为空",
			"email.email" => "邮箱格式错误",

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