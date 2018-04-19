<?php 

	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use app\index\model\Handle;

	/**
	* 学生考试类
	*/
	class Showpascal extends Controller
	{
		//初始化 控制器
		public function _initialize(){
			if(session('jqmsuser') == NULL){
				$this->redirect(url("index"));
			}


		}


		//判断是否是答题时间
		public function ifExamTime(){

			$handle = new Handle();
			$request = Request::instance();

			$id = $handle->base64_decode($request->post("id"));
			

			//判断是否是考试时间
			$time = time();
			$pascal = model("Published");

			$data = $pascal::get($id);

			$data = $data->toArray();

			$date = strtotime($data["strat"])+$data["size"];

			if($time > $data || $time < strtotime($data["strat"])){
				return $handle->response(400,"未到考试时间");
			}else{
				return $handle->response(200,"开始考试");
			}
		}


		//学生答题页面
		public function datiPage($id){
			$handle = new Handle();
			$id = $handle->base64_decode($id);

			//判断是否是考试时间
			$time = time();
			$pascal = model("Published");

			$data = $pascal::get($id);

			$data = $data->toArray();

			$date = strtotime($data["strat"])+$data["size"];
			if($date < $time){
				$this->redirect("index/Studentper/ksxt");
			}
			

			$exam = model("Pascal");
			// 单选题
			$data = $exam->table(["pascal","examinationtext","published"])
				->where("pascal.id=examinationtext.pascal_id")
				->where("published.id",$id)
				->where("examinationtext.examination_id=published.exam_id")
				->where("pascal.pattern_id","1")
				->field([
					"pascal.id" => "id",
					"pascal.name" => "name",
					"pascal.options" => "options",
				])
				->select();
			$this->assign("single",$data);
			// 填空题
			$data = $exam->table(["pascal","examinationtext","published"])
				->where("pascal.id=examinationtext.pascal_id")
				->where("published.id",$id)
				->where("examinationtext.examination_id=published.exam_id")
				->where("pascal.pattern_id","2")
				->field([
					"pascal.id" => "id",
					"pascal.name" => "name",
				])
				->select();
			$data = $handle->toArray($data);
			foreach ($data as $key => $value) {
				$str = $value["name"];
				
					$str=preg_replace("/___/","<input type='text' placeholder='填写答案'/>", $str);
				
				$data[$key]["name"] = $str;
			}
			$this->assign("completion",$data);
			// 问答题
			$data = $exam->table(["pascal","examinationtext","published"])
				->where("pascal.id=examinationtext.pascal_id")
				->where("published.id",$id)
				->where("examinationtext.examination_id=published.exam_id")
				->where("pascal.pattern_id","3")
				->field([
					"pascal.id" => "id",
					"pascal.name" => "name",
				])
				->select();

			$this->assign("essay",$data);
			// 试卷名
			$exam = model("Published");

			$data = $exam->table(["published","examination"])
				->where('published.exam_id=examination.id')
				->where('published.id',$id)
				->field([
					"published.id" => "id",
					"published.strat" => "strat",
					"published.length" => "length",
					"published.size" => "size",
					"examination.examination_name" => 'name',
				])
				->select();

			$data = $handle->toArray($data);

			$this->assign("exam",$data[0]);

			return view();
		}

		//空操作
		public function _empty(){
			$this->redirect(url("index"));
		}
	}
 ?>