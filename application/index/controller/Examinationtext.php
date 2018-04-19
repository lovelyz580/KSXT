<?php 
	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use think\Db;
	use app\index\model\Handle;
	/**
	* 试卷试题类
	*/
	class Examinationtext extends Controller{
		
		//初始化控制器
		public function _initialize(){
			if(session("jqmtuser") == NULL){
				$this->redirect(url("index"));
			}
		}

		//试卷查看
		public function see($id){

			$handle = new Handle();
			$data = session("jqmtuser");

			$this->assign("data",$data);

			$pascal = model("Pascal");
			//试卷id
			$id = $handle->base64_decode($id);
			$data = $pascal->table(["pascal","examination","examinationtext"])
				->where("pascal.id=examinationtext.pascal_id")
				->where("examinationtext.examination_id",$id)
				->where("examination.id",$id)
				->where("pascal.pattern_id","1")
				->field([
					"pascal.name" => "name",
					"pascal.options" => "options",
					"pascal.single_answer" => "answer",
					"pascal.completion_answer" => "completion_answer",
					"pascal.essayquestion_answer" => "essayquestion_answer",
					"pascal.pattern_id" => "patternId",
					"examination.examination_name" => "examName",
				])
				->order("pascal.pattern_id","asc")
				->select();
			$data = $handle->toArray($data);

			$this->assign("single",$data);

			$data = $pascal->table(["pascal","examination","examinationtext"])
				->where("pascal.id=examinationtext.pascal_id")
				->where("examinationtext.examination_id",$id)
				->where("examination.id",$id)
				->where("pascal.pattern_id","2")
				->field([
					"pascal.name" => "name",
					"pascal.options" => "options",
					"pascal.single_answer" => "answer",
					"pascal.completion_answer" => "completion_answer",
					"pascal.essayquestion_answer" => "essayquestion_answer",
					"pascal.pattern_id" => "patternId",
					"examination.examination_name" => "examName",
				])
				->order("pascal.pattern_id","asc")
				->select();
			$data = $handle->toArray($data);
			// return dump($data[0]["completion_answer"]);
			foreach ($data as $key => $value) {
				$str = $value["name"];
				foreach ( $value["completion_answer"] as $key2 => $value2) {
					$str=preg_replace("/___/","<span>".$value2."</span>", $str,1);
				}
				$data[$key]["name"] = $str;
			}
			
			$this->assign("completion",$data);

			$data = $pascal->table(["pascal","examination","examinationtext"])
				->where("pascal.id=examinationtext.pascal_id")
				->where("examinationtext.examination_id",$id)
				->where("examination.id",$id)
				->where("pascal.pattern_id","3")
				->field([
					"pascal.name" => "name",
					"pascal.options" => "options",
					"pascal.single_answer" => "answer",
					"pascal.completion_answer" => "completion_answer",
					"pascal.essayquestion_answer" => "essayquestion_answer",
					"pascal.pattern_id" => "patternId",
					"examination.examination_name" => "examName",
				])
				->order("pascal.pattern_id","asc")
				->select();
			$data = $handle->toArray($data);
			

			
			$this->assign("essay",$data);

			$exam = model("Examination");

			$data = $exam::get($id);

			$data = $data->toArray();

			$this->assign("name",$data);


			return view();
		}

		

		//删除
		public function delete(){
			//初始化
			$request = Request::instance();
			$handle = new Handle();

			//试卷id
			$id = $request->post("id");

			$id = explode(",",$id);
			$ids = [];
			foreach ($id as $key => $value) {
				# code...
				$ids[$key]=$value;
			}

			//实例化题库模型
			$examination = model("Examinationtext");

			if(sizeof($ids)==1){
				$id = $id[0];
			
				if($examination::destroy($id) == 1){
					return $handle->response(200,"删除成功");
				}else{
					return $handle->response(400,"删除失败");
				}
			}

			if($examination::destroy($ids)>= 1){
				return $handle->response(200,"删除成功");
			}else{
				return $handle->response(400,"删除失败");
			}
		}



		//空操作
		public function _empty(){
			$this->redirect(url("index"));
		}
	}

 ?>