<?php 

	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use app\index\model\Handle;
	use think\Db;

	/**
	* 考生答案类
	*/
	class Examineeanswer extends Controller
	{
		
		public function _initialize(){
			if(session("jqmsuser") == NULL){
				$this->redirect(url("index"));
			}
		}

		public function saveAnswer(){
			$request = Request::instance();
			$handle = new Handle();
			$single = $request->post("single");
			$completion = $request->post("completion");
			$essay = $request->post("essay");
			$id = $handle->base64_decode($request->post("exam"));


			//实例化答案类
			$answer = model("Examineeanswer");

			//学生id
			$sid = $handle->base64_decode(session("jqmsuser")["id"]);

			$status = $answer::get([
					"student_id" => $sid,
					"examination_id" => $id,
				]);
			if(!(!$status)){
				return $handle->response(400,"已考过不要重复答题");
			}


			$sanswer = explode(",",$single);
			$pascal = model("Pascal");

			$scoreid = [];
			$score = [];
			foreach ($sanswer as $key => $value) {
				$d = explode("-",$value);
				$scoreid[$key] = $handle->base64_decode($d[0]);
				$score[$key] = isset($d[1])?$d[1]== "1"?"A":$d[1]== "2"?"B":$d[1]== "3"?"C":$d[1]== "4"?"D":"":"";
			}

			$pdata = $pascal::all($scoreid);
			$pdata = $handle->toArray($pdata);
			
			$sum = 0;

			foreach ($pdata as $key => $value) {
				
				if($value["single_answer"] == $score[$key]){
					$sum += $value["score"];
				}
			}

			$data = [
				"student_id" => $sid,
				"examination_id" => $id,
				"pattern_one" => $single,
				"pattern_two" => $completion,
				"pattern_three" => $essay,
				"performance" => $sum,
				"examineeanswer_date" => time()
			];
		

			$status = $answer->save($data);
			if($status == 1){
				return $handle->response(200,"提交成功");
			}else{
				return $handle->response(400,"提交失败");
			}
		}


		public function _empty(){
			$this->redirect(url("index"));
		}
	}

 ?>