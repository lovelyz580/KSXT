<?php
	//声明命名空间
	namespace app\index\validate;

	//导入系统验证类
	use think\Validate;

	/**
	* 单选题
	*/
	class Single extends Validate{
		
		// //验证规则
		protected $rule = [

			"id" => "require",
			"name" => "require|length:1,255|special:[^~!@#$%^&*<>]",
			"option1" => "require|length:1,50|special:[^~!@#$%^&*><]",
			"option2" => "require|length:1,50|special:[^~!@#$%^&*><]",
			"option3" => "require|length:1,50|special:[^~!@#$%^&*><]",
			"option4" => "require|length:1,50|special:[^~!@#$%^&*><]",
			"answer" => "require|between:1,4",
			"socre" => "require|number|between:1,100|special:[^~!@#$%^&*><]",
			"problems" => "max:255|special:[^~!@#$%^&*><]",

		];

		// //错误提示信息
		protected $message = [

			"id.require" => "id不能为空",
			"name.require" => "题干不能为空",
			"name.length" => "题干为1-255位",
			"name.special" => "题干不能包含特殊字符",
			"option1.require" => "选项不能为空",
			"option1.length" => "选项为1-50位",
			"option1.special" => "选项不能包含特殊字符",
			"option2.require" => "选项不能为空",
			"option2.length" => "选项为1-50位",
			"option2.special" => "选项不能包含特殊字符",
			"option3.require" => "选项不能为空",
			"option3.length" => "选项为1-50位",
			"option3.special" => "选项不能包含特殊字符",
			"option4.require" => "选项不能为空",
			"option4.length" => "选项为1-50位",
			"option4.special" => "选项不能包含特殊字符",
			"answer.require" => "答案不能为空",
			"answer.between" => "答案无效",
			"problems.max" => "解析为1-255位",
			"problems.special" => "解析不能包含特殊字符",

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