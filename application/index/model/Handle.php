<?php 

	namespace app\index\model;

	/**
	*	数组操作处理类
	*/
	class Handle{
		
		/**
		 * 对象数组转成数组
		 * @param  array 	$arr 	转换的对象
		 * @return array 	转换后的数组
		 */
		public function toArray($arr){

			//转换后存储数组
			$res = [];

			//遍历转换数组对象元素
			foreach ($arr as $key => $value) {
				$res[$key] = $value -> toArray();
			}

			//返回转化后数据
			return $res;
		}


		/**
		 * base64解密
		 * @param  String $value 解密数据
		 * @return String        解密后数据
		 */
		public function base64_decode($value){
			$value = $value."==";

			//第一次解密
			$st = base64_decode($value);

			//截取前2个字符
			$first = substr($st,0,2);
			//截取后两个字符
			$last = substr($st,-2);
			//替换和前两个一样的字符
			$st = substr_replace($st, $last, 0,2);
			//替换和后两个一样的字符
			$st = substr_replace($st, $first, -2,2);
			//第二次解密
			$st = base64_decode($st);
			return $st;
		}

		/**
		 *	返回客户端数据格式化方法
		 * @param  int   	$code 		状态码
		 * @param  String 	$message 	状态码信息
		 * @param  Array 	$value 		返回数据
		 * @return String        		转换后的字符串
		 */
		public function response($code,$message,$value=[]){

			//整个返回数据
			$res = [

				"code" => $code,
				"message" => $message,
				"data" => $value
			];

			//转成json字符串返回
			return json_encode($res,JSON_UNESCAPED_UNICODE);
		}

		//图片类型效验
		public function imageType($file){
			$name = $file["name"];
			$size = $file["size"];
			$name = substr($name,-3);
			$arr = ["jpg","jpeg","png","bmp"];
			if($size > 1024*1024*1024*5){
				// 头像不能大于5M
				return "文件不能大于5M";
			}
			foreach ($arr as $key => $value) {
				if($value == $name){
					return true;
				}
			}
			return "请上传jpg/png/bmp图片";
		}
	}

 ?>