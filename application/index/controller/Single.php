<?php 
	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use app\index\model\Handle;

	/**
	* 单选题类
	*/
	class Single extends Controller{
		
		//控制器初始化
		public function _initialize(){
			if(session("jqmtuser") == NULL){
				$this->redirect(url("index"));
			}
		}


		//查询
		public function select(){
			//初始化
			$request = Request::instance();
			$handle = new Handle();
			//题库id
			$id = $handle->base64_decode($request->post("id"));
			//实例化填空题模型类
			$Single = model("Single");
			if($id !=""){
				dump($handle->toArray($Single::all(["question_id"=>1])));
				return;
			}

			//分数查询
			$search = $request->post("search");
			$score = $handle->toArray($Single::all(["single_score"=>$search]));
			if(!$score){
				//题目查询
				//题库id
				$id = $handle->base64_decode($request->post("questionId"));
				dump($handle->toArray($Single->where(["single_name"=>["like","%".$search."%"]])
					->where("question_id",$id)
					->select()));
			}else{
				dump($score);
			}

		}


		//新增
		public function add(){
			//初始化
			$request = Request::instance();
			$handle = new Handle();

			//验证提交数据
			$validate = validate("Single");

			if(!$validate->check($request->post())){
				return $handle->response(400,$validate->getError());
			}

			$list = [
				//题库id
				"question_id" => $handle->base64_decode($request->post("id")),
				//题目
				"single_name" => explode(',',$request->post("topic")),
				//选项
				"options" => $request->post("option"),
				//题解
				"single_problems" => $request->post("problems"),
				//难度
				"single_difficulty" => $request->post("difficulty"),
				//知识点
				"single_knowledge" => $request->post("knowledge"),
				//答案
				"single_answer" => $request->post("answer"),
				//分数
				"single_score" => $request->post("score"),
			];
			

			//实例化填空题模型类
			$Single = model("Single");
			//添加数据
			if($Single->save($list) == 1){
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

			//验证提交数据
			$validate = validate("Single");

			if(!$validate->check($request->post())){
				return $handle->response(400,$validate->getError());
			}

			
			
			$list = [
				//题目
				"single_name" => explode(',',$request->post("topic")),
				//选项
				"options" => $request->post("option"),
				//题解
				"single_problems" => $request->post("problems"),
				//难度
				"single_difficulty" => $request->post("difficulty"),
				//知识点
				"single_knowledge" => $request->post("knowledge"),
				//答案
				"single_answer" => $request->post("answer"),
				//分数
				"single_score" => $request->post("score"),
			];

			//实例化填空题模型类
			$Single = model("Single");
			//添加数据
			if($Single->save($list,["id"=>$request->post("id")]) == 1){
				return $handle->response(200,"修改成功");
			}else{
				return $handle->response(400,"修改失败");
			}
		}

		//删除
		public function delete(){
			//初始化
			$request = Request::instance();
			$handle = new Handle();

			//试题id
			$id = $handle->base64_decode($request->post("id"));

			//实例化填空题模型类
			$Single = model("Single");

			if($Single::destroy($id)==1){
				$handle->response(200,"删除成功");
			}else{
				$handle->response(400,"删除失败");
			}
		}

		//批量删除
		public function deleteAll(){
			//初始化
			$request = Request::instance();
			$handle = new Handle();

			$list = [];

			$id = explode(",",$request->post("id"));
			foreach ($id as $key => $value) {
				$list[$key] = $handle->base64_decode($value);
			}


			//实例化填空题模型类
			$Single = model("Single");

			if($Single::destroy($list) > 0){
				$handle->response(200,"删除成功");
			}else{
				$handle->response(400,"删除失败");
			}
		}

		//空操作
		public function _empty(){
			$this->redirect(url("index"));
		}
	}

 ?>