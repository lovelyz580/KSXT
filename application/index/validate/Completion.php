<?php 

	//声明命名空间
	namespace app\index\validate;

	//导入系统验证类
	use think\Validate;

	/**
	* 单选题
	*/
	class Completion extends Validate{
		
		// //验证规则
		protected $rule = [

			"id" => "require",
			"topic" => "require|length:1,255|special:[^~!@#$%^&*<>]",
			"answer" => "require|max:255|special:[^~!@#$%^&*<>]",
			"score" => "require|number|between:1,100",
			"analysis" => "max:255|special:[^~!@#$%^&*><]",

		];

		// //错误提示信息
		protected $message = [

			"id.require" => "id不能为空",
			"topic.require" => "题干不能为空",
			"topic.length" => "题干为1-255位",
			"topic.special" => "题干不能包含特殊字符",
			"answer.require" => "选项不能为空",
			"answer.max" => "选项长度为1-20位",
			"answer.special" => "选项不能包含特殊字符",
			"score.require" => "成绩不能为空",
			"score.number" => "成绩为数值",
			"score.between" => "成绩为1-100数字",
			"score.special" => "成绩不能为特殊字符",
			"analysis.max" => "解析为1-255位",
			"analysis.special" => "解析不能包含特殊字符",

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