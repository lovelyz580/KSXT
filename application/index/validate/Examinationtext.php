<?php 
	//声明命名空间
	namespace app\index\validate;

	//导入系统验证类
	use think\Validate;


	/**
	 * 填空题类
	 */
	class Examinationtext extends Validate{

		//验证规则
		protected $rule = [

			//试卷名称
			"name" => "require|max:15|special:[^~!@#$%^&*<>]",
			//考试时间
			"strat" => "require|date|dateFormat:Y-m-d H:i:s",
			//考试时长
			"length" => "require|number|between:1,2000",
			//拖堂时长
			"delay" => "request|number|between:0,30",

		];

		//提示信息
		protected $message = [

			"name.require" => "试卷名称不能为空",
			"name.max" => "长度1-30位",
			"name.special" => "名称不能包含特殊字符",
			"strat.require" => "考试时间不能为空",
			"strat.date" => "考试时间无效",
			"strat.dateFormat" => "考试时间格式错误",
			"length.require" => "考试时长不能为空",
			"length.number" => "考试时长为数值",
			"length.dateFormat" => "考试时长无效",
			"delay.request" => "拖堂时长不能为空",
			"delay.number" => "拖堂时长为数值",
			"delay.between" => "拖堂时长不能大于30分钟",
			
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