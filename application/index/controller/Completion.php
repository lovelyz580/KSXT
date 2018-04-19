<?php 
	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use app\index\model\Handle;


	/**
	* 填空题管理类
	*/
	class Completion extends Controller{
		
		//控制器初始化
		public function _initialize(){
			if(session("jqmtuser") == NULL){
				$this->redirect(url("index"));
			}
		}

		
		//查询
		public function select(){
			$request = Request::instance();
			$handle = new Handle();
			//题库id
			$id = $handle->base64_decode($request->post("id"));
			//实例化填空题模型类
			$completion = model("Completion");
			if($id !=""){
				dump($handle->toArray($completion::all(["question_id"=>$id])));
				return;
			}

			//分数查询
			$search = $request->post("search");
			$score = $handle->toArray($completion::all(["completion_score"=>$search]));
			if(!$score){
				//题目查询
				//题库id
				$id = $handle->base64_decode($request->post("questionId"));
				dump($handle->toArray($completion->where(["completion_name"=>["like","%".$search."%"]])
					->where("question_id",$id)
					->select()));
			}else{
				dump($score);
			}
		}


		
		//添加
		public function add(){
			//初始化
			$request = Request::instance();
			$handle = new Handle();

			//提交数据验证
			$validate = validate("Completion");

			if(!$validate->check($request->post())){
				return $handle->response(400,$validate->getError());
			}

			$list = [
				//题库id
				"question_id" => $handle->base64_decode($request->post("id")),
				//题目
				"completion_name" => $request->post("topic"),
				//题解
				"completion_problems" => $request->post("problems"),
				//难度
				"completion_difficulty" => $request->post("difficulty"),
				//知识点
				"completion_knowledge" => $request->post("knowledge"),
				//答案
				"completion_answer" => $request->post("answer"),
				//分数
				"completion_score" => $request->post("score"),
			];
			
			//实例化填空题模型类
			$completion = model("Completion");
			//添加数据
			if($completion->save($list) == 1){
				return $handle->response(200,"添加成功");
			}else{
				return $handle->response(400,"添加失败");
			}

		}

		//修改
		public function alter(){
			//初始化
			$request = Request::instance();
			$handle = new Handle();

			//提交数据验证
			$validate = validate("Completion");

			if(!$validate->check($request->post())){
				return $handle->response(400,$validate->getError());
			}

			$list = [
				//试题id
				"question_id" => $handle->base64_decode($request->post("id")),
				//题目
				"completion_name" => $request->post("topic"),
				//题解
				"completion_problems" => $request->post("problems"),
				//难度
				"completion_difficulty" => $request->post("difficulty"),
				//知识点
				"completion_knowledge" => $request->post("knowledge"),
				//答案
				"completion_answer" => $request->post("answer"),
				//分数
				"completion_score" => $request->post("score"),
			];
			
			//实例化填空题模型类
			$completion = model("Completion");
			//添加数据
			if($completion->save($list) == 1){
				return $handle->response(200,"修改成功");
			}else{
				return $handle->response(400,"修改失败");
			}

		}

		//删除
		public function delete(){
			$request = Request::instance();
			$handle = new Handle();

			//试题id
			$id = $handle->base64_decode($request->post("id"));

			//实例化填空题模型类
			$completion = model("Completion");

			if($completion::destroy($id)==1){
				$handle->response(200,"删除成功");
			}else{
				$handle->response(200,"删除失败");
			}
		}

		//空操作
		public function _empty(){
			$this->redirect(url("index"));
		}
	}

 ?>