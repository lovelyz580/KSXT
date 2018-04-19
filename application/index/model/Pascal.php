<?php 

	//声明命名空间
	namespace app\index\model;

	//导入系统模型类
	use think\Model;

	/**
	* 试题类
	*/

	class Pascal extends Model{
		/**
		 * id字段加密
		 * @param  int $value 数据库数据
		 * @return String        加密后数据
		 */
		public function getIdAttr($value){
			//加密
			$md = base64_encode($value);
			//截取前2个字符
			$first = substr($md,0,2);
			//截取后两个字符
			$last = substr($md,-2);
			//替换和前两个一样的字符
			$md = substr_replace($md, $last, 0,2);
			//替换和后两个一样的字符
			$md = substr_replace($md, $first, -2,2);
			//二次加密
			$md = base64_encode($md);
			$md = substr_replace($md, "", -2,2);
			return $md;
		}

		

		//名称数组化
		public function getNameAttr($value){
			return str_replace("|_|", "___", $value);
		}


		//单选选项
		public function getOptionsAttr($value){
			return explode("|_|",$value);
		}

		//难度格式化
		public function getDifficultyAttr($value){
			switch($value){
				case "1":
					return "非常简单";
				break;
				case "2":
					return "简单";
				break;
				case "3":
					return "一般";
				break;
				case "4":
					return "困难";
				break;
			}
		}

		//单选答案
		public function getSingleAnswerAttr($value){
			switch($value){
				case "1":
					return "A";
				break;
				case "2":
					return "B";
				break;
				case "3":
					return "C";
				break;
				case "4":
					return "D";
				break;
			}
		}

		//填空题答案
		public function getCompletionAnswerAttr($value){
			return explode("|_|",$value);
		}

		//时间格式化
		public function getDateAttr($value){
			return date("Y-m-d H:i:s",$value);
		}
	}

 ?>