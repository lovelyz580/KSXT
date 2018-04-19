<?php 
	//声明命名空间
	namespace app\index\validate;

	//导入系统验证类
	use think\Validate;


	/**
	 * 题库类
	 */
	class Question extends Validate{

		//验证规则
		protected $rule = [

			"id" => "require",
			"name" => "require|max:30|special:[^~!@#$%^&*><?]",
			"brief" => "max:255|special:[^~!@#$%^&*<>]",

		];

		//提示信息
		protected $message = [

			"id.require" => "id不能为空",
			"name.require" => "名称不能为空",
			"name.max" => "长度1-30位",
			"name.special" => "不能包含特殊字符",
			"brief.max" => "简介长度为1-255位",
			"brief.special" => "简介不能包含特殊字符",
			
		];

		// 自定义验证规则
		// 正则表达式验证
   		protected function special($value,$rule,$data){
   			$pattern = "/".$rule."/";
       		if(preg_match($pattern,$value)){
       			return true;
       		}else{
       			return false;
       		}
	   	}
	}

 ?>