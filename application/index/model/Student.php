<?php 

	//声明命名空间
	namespace app\index\model;

	//导入系统模型类
	use think\Model;

	class Student extends Model{
		
		//设置主键
		protected $pk = "id";

		//设置修改器
		
		/**
		 * 设置密码
		 * @param String $value 客户端数据
		 */
		public function setPasswordAttr($value){
			return md5(md5($value));
		}


		//设置获取器
		public function getSexAttr($value){
			return $value=="1" ? "男" : "女";
		}

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
	}

 ?>