<?php 
	//声明命名空间
	namespace app\index\model;

	//导入系统模型类
	use think\Model;

	/**
	* 发布试卷类
	*/
	class Published extends Model
	{
		
		//设置获取器
		
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

		//考试时间
		public function getStratAttr($value){
			return date("Y-m-d H:i:s",$value);
		}

		//发布时间
		public function getDateAttr($value){
			return date("Y-m-d H:i:s",$value);
		}
	}
 ?>