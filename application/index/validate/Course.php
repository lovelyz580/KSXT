<?php 
	//声明命名空间
	namespace app\index\validate;

	//导入系统验证类
	use think\Validate;

	/**
	* 单选题
	*/
	class Course extends Validate{
		
		// //验证规则
		protected $rule = [

			"name" => "require|length:1,90|special:[~!@#$%^&*<>]",

		];

		// //错误提示信息
		protected $message = [

			"name.require" => "名称不能为空",
			"name.length" => "名称长度为1-30位",
			"name.special" => "名称不能包含特殊字符",

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