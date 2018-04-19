<?php 
	//声明命名空间
	namespace app\index\model;

	//导入系统模型类
	use think\Model;
	//导入软删除模型
	use traits\model\SoftDelete;

	/**
	* 试卷模型
	*/
	class Examination extends Model{
		
		//设置软删除字段
		use SoftDelete;
		protected $deleteTime = "examination_delete_date";



		//设置获取器
		


		/**
		 * 格式化试卷创建时间
		 * @param  int $value    数据库数据
		 * @return String        年-月-日 小时:分钟:秒
		 */
		public function getExaminationDateAttr($value){
			return date("Y-m-d H:i:s");
		}

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