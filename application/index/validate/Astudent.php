<?php
	//声明命名空间
	namespace app\index\validate;

	//导入系统验证类
	use think\Validate;

	/**
	* 教师修改验证类
	*/
	class Astudent extends Validate{
		
		// //验证规则
		protected $rule = [

			"name" => "require|length:1,15|special:[~!@#$%^&*<>]",
			"email" => "require|email",
			"sign" => "require|length:1,30|special:[~!@#$%^&*<>]",
			"class" => "require|max:30|special:[~!@#$%^&*<>]",

		];

		// //错误提示信息
		protected $message = [

			"name.require" => "姓名不能为空",
			"name.length" => "姓名长度为1-15位",
			"name.special" => "姓名不能包含特殊字符",
			"email.require" => "电子邮件不能为空",
			"email.email" => "电子邮件格式错误",
			"sign.require" => "个签不能为空",
			"sign.length" => "个签长度为1-30位",
			"sign.special" => "个签不能包含特殊字符",
			"class.require" => "班级不能为空",
			"class.max" => "班级长度1-30位",
			"class.special" => "班级不能包含特殊字符"

		];

		// 自定义验证规则
		// 正则表达式验证
   		protected function special($value,$rule,$data){
   			$pattern = "/".$rule."/";
       		if(preg_match($pattern,$value)){
       			return false;
       		}else{
       			return true;
       		}
	   	}

	}

 ?>