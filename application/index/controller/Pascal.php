<?php 
	
	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use app\index\model\Handle;

	/**
	* 试题类
	*/
	class Pascal extends Controller{
		

		//初始化控制器
		public function _initialize(){
			if(session("jqmtuser")==NULL){
				$this->redirect(url('index'));
			}
		}


		//查看全部试题
		public function see($id){
			$handle = new Handle();
			$data = session("jqmtuser");

			$this->assign("data",$data);
			session("question_id",$id);
			$id = $handle->base64_decode($id);
			session("question",$id);
			$pascal = model("Pascal");

			$data = $pascal->table(["pascal","pattern","knowledge"])
				->where("pascal.pattern_id=pattern.id")
				->where("pascal.knowledge_id=knowledge.id")
				->where("pascal.question_id",$id)
				->field([
					"pascal.id" => "id",
					"pattern.name" => "pname",
					"pascal.name" => "name",
					"pascal.options" => "options",
					"pascal.problems" => "problems",
					"pascal.difficulty" => "difficulty",
					"knowledge.name" => "kname",
					"pascal.single_answer" => "single_answer",
					"pascal.completion_answer" => "completion_answer",
					"pascal.essayquestion_answer" => "essayquestion_answer",
					"pascal.score" => "score",
					"pascal.date" => "date",
				])
				->select();
				// return dump($handle->toArray($data));
			$k = model("Knowledge");
			$datak = $k::all();
			$this->assign("type","0");
			$this->assign("pattern","全部");
			$this->assign("pdata",$data);
			$this->assign("kdata",$handle->toArray($datak));
			$this->assign("questionId",session("question_id"));
			
			return view();
		}

		

		//查看单选题
		public function seeSingle(){
			$handle = new Handle();
			$data = session("jqmtuser");

			$this->assign("data",$data);

			$id = session("question");
			$pascal = model("Pascal");

			$data = $pascal->table(["pascal","pattern","knowledge"])
				->where("pascal.pattern_id=pattern.id")
				->where("pascal.knowledge_id=knowledge.id")
				->where("pascal.question_id",$id)
				->where("pascal.pattern_id","1")
				->field([
					"pascal.id" => "id",
					"pattern.name" => "pname",
					"pascal.name" => "name",
					"pascal.options" => "options",
					"pascal.problems" => "problems",
					"pascal.difficulty" => "difficulty",
					"knowledge.name" => "kname",
					"pascal.single_answer" => "single_answer",
					"pascal.completion_answer" => "completion_answer",
					"pascal.essayquestion_answer" => "essayquestion_answer",
					"pascal.score" => "score",
					"pascal.date" => "date",
				])
				->select();
				// return dump($handle->toArray($data));
			$k = model("Knowledge");
			$datak = $k::all();
			$this->assign("type",0);
			$this->assign("pdata",$data);
			$this->assign("pattern","单选题");
			$this->assign("kdata",$handle->toArray($datak));
			$this->assign("questionId",session("question_id"));
			return view("see");
		}


		//查看填空题
		public function seeCompletion(){
			$handle = new Handle();
			$data = session("jqmtuser");

			$this->assign("data",$data);

			$id = session("question");


			$pascal = model("Pascal");

			$data = $pascal->table(["pascal","pattern","knowledge"])
				->where("pascal.pattern_id=pattern.id")
				->where("pascal.knowledge_id=knowledge.id")
				->where("pascal.question_id",$id)
				->where("pascal.pattern_id","2")
				->field([
					"pascal.id" => "id",
					"pattern.name" => "pname",
					"pascal.name" => "name",
					"pascal.options" => "options",
					"pascal.problems" => "problems",
					"pascal.difficulty" => "difficulty",
					"knowledge.name" => "kname",
					"pascal.single_answer" => "single_answer",
					"pascal.completion_answer" => "completion_answer",
					"pascal.essayquestion_answer" => "essayquestion_answer",
					"pascal.score" => "score",
					"pascal.date" => "date",
				])
				->select();
				// return dump($handle->toArray($data));
			$k = model("Knowledge");
			$datak = $k::all();
			$this->assign("type",0);
			$this->assign("pattern","填空题");
			$this->assign("pdata",$data);
			$this->assign("kdata",$handle->toArray($datak));
			$this->assign("questionId",session("question_id"));
			
			return view("see");
		}

		//查看问答题
		public function seeEssay(){
			$handle = new Handle();
			$data = session("jqmtuser");

			$this->assign("data",$data);

			$id = session("question");
			$pascal = model("Pascal");

			$data = $pascal->table(["pascal","pattern","knowledge"])
				->where("pascal.pattern_id=pattern.id")
				->where("pascal.knowledge_id=knowledge.id")
				->where("pascal.question_id",$id)
				->where("pascal.pattern_id","3")
				->field([
					"pascal.id" => "id",
					"pattern.name" => "pname",
					"pascal.name" => "name",
					"pascal.options" => "options",
					"pascal.problems" => "problems",
					"pascal.difficulty" => "difficulty",
					"knowledge.name" => "kname",
					"pascal.single_answer" => "single_answer",
					"pascal.completion_answer" => "completion_answer",
					"pascal.essayquestion_answer" => "essayquestion_answer",
					"pascal.score" => "score",
					"pascal.date" => "date",
				])
				->select();
				// return dump($handle->toArray($data));
			$k = model("Knowledge");
			$datak = $k::all();
			$this->assign("type",0);
			$this->assign("pdata",$data);
			$this->assign("pattern","问答题");
			$this->assign("kdata",$handle->toArray($datak));
			$this->assign("questionId",session("question_id"));
			
			return view("see");
		}

		//查看指定id试题
		public function seeId(){
			$request = Request::instance();
			$handle = new Handle();

			$id = $handle->base64_decode($request->post("id"));
			$pascal = model("Pascal");
			$data = $pascal->table(["pascal","pattern","knowledge"])
				->where("pascal.pattern_id=pattern.id")
				->where("pascal.knowledge_id=knowledge.id")
				->where("pascal.id",$id)
				->field([
					"pascal.id" => "id",
					"pattern.name" => "pname",
					"pascal.name" => "name",
					"pascal.options" => "options",
					"pascal.problems" => "problems",
					"pascal.difficulty" => "difficulty",
					"knowledge.name" => "kname",
					"pascal.single_answer" => "single_answer",
					"pascal.completion_answer" => "completion_answer",
					"pascal.essayquestion_answer" => "essayquestion_answer",
					"pascal.score" => "score",
					"pascal.date" => "date",
				])
				->select();

			
			return $handle->response(200,"查询成功",$handle->toArray($data)[0]);
		}

		//搜索试题
		public function search(){
			$request = Request::instance();
			$handle = new Handle();
			$data = session("jqmtuser");

			$this->assign("data",$data);

			$id = session("question");
			$pascal = model("Pascal");
			$search = $request->post("search");
			$data = $pascal->table(["pascal","pattern","knowledge"])
				->where("pascal.pattern_id=pattern.id")
				->where("pascal.knowledge_id=knowledge.id")
				->where("pascal.question_id",$id)
				->where([
					"pascal.name"=>[
						"like","%".$search."%"
					]
				])
				->field([
					"pascal.id" => "id",
					"pattern.name" => "pname",
					"pascal.name" => "name",
					"pascal.options" => "options",
					"pascal.problems" => "problems",
					"pascal.difficulty" => "difficulty",
					"knowledge.name" => "kname",
					"pascal.single_answer" => "single_answer",
					"pascal.completion_answer" => "completion_answer",
					"pascal.essayquestion_answer" => "essayquestion_answer",
					"pascal.score" => "score",
					"pascal.date" => "date",
				])
				->select();
				// return dump($handle->toArray($data));
			$k = model("Knowledge");
			$datak = $k::all();
			$this->assign("type",0);
			$this->assign("pdata",$data);
			$this->assign("pattern","全部");
			$this->assign("kdata",$handle->toArray($datak));
			$this->assign("questionId",session("question_id"));
				
			return view("see");
		}

		//新增单选题
		public function addSingle(){
			$request = Request::instance();
			$handle = new Handle();

			$validate = validate("Single");
			if(!$validate->check($request->post())){
				return $handle->response(400,$validate->getError());
			}

			$pascal = model("Pascal");

			if($request->post("add") == "jqm"){
				$status = $pascal->save([
					"question_id" => session("question"),
					"pattern_id" => "1",
					"name" => $request->post("name"),
					"options" => $request->post("option1")."|_|".$request->post("option2")."|_|".$request->post("option3")."|_|".$request->post("option4"),
					"problems" => $request->post("problems"),
					'difficulty' => $request->post("difficulty"),
					"knowledge_id" => $handle->base64_decode($request->post("kname")),
					"single_answer" => $request->post("answer"),
					"score" => $request->post("socre"),
					"date" => time(),

				]);

				if($status == 1){
					return $handle->response(200,"添加成功");
				}else{
					return $handle->response(400,"添加失败");
				}
				return;
			}


			$status = $pascal->save([
				"name" => $request->post("name"),
				"options" => $request->post("option1")."|_|".$request->post("option2")."|_|".$request->post("option3")."|_|".$request->post("option4"),
				"problems" => $request->post("problems"),
				'difficulty' => $request->post("difficulty"),
				"knowledge_id" => $handle->base64_decode($request->post("kname")),
				"single_answer" => $request->post("answer"),
				"score" => $request->post("socre"),
				"date" => time(),

			],["id"=>$handle->base64_decode($request->post("id"))]);

			if($status == 1){
				return $handle->response(200,"/ksxt/public/seePascal");
			}else{
				return $handle->response(400,"修改失败");
			}
		}


		//填空题
		public function addCompletion(){

			$request = Request::instance();
			$handle = new Handle();

			$validate = validate("Completion");

			

			if(!$validate->check($request->post())){
				return $handle->response(400,$validate->getError());
			}

			$pascal = model("Pascal");

			if($request->post("add") == "jqm"){
				$status = $pascal->save([
					"question_id" => session("question"),
					"pattern_id" => "2",
					"name" => $request->post("topic"),
					"problems" => $request->post("analysis"),
					"difficulty" => $request->post("difficulty"),
					"knowledge_id" => $handle->base64_decode($request->post("knowledge")),
					"completion_answer" => str_replace(",","|_|",$request->post("answer")),
					"score" => $request->post("score"),
					"date" => time(),
				]);

				if($status == 1){
					return $handle->response(200,"添加成功");
				}else{
					return $handle->response(400,"添加失败");
				}
			}else{
				$status = $pascal->save([
					"name" => $request->post("topic"),
					"problems" => $request->post("analysis"),
					"difficulty" => $request->post("difficulty"),
					"knowledge_id" => $handle->base64_decode($request->post("knowledge")),
					"completion_answer" => str_replace(",","|_|",$request->post("answer")),
					"score" => $request->post("score"),
					"date" => time(),
				],["id"=>$handle->base64_decode($request->post("id"))]);

				if($status == 1){
					return $handle->response(200,"修改成功");
				}else{
					return $handle->response(400,"修改失败");
				}
			}
		}

		//添加简答题
		public function addEssay(){
			$request = Request::instance();
			$handle = new Handle();

			$validate = validate("Essay");

			if(!$validate->check($request->post())){
				return $handle->response(400,$validate->getError());
			}

			$pascal = model("Pascal");

			if($request->post("add") == "jqm"){
				//添加
				$status = $pascal->save([
					"question_id" => session("question"),
					"pattern_id" => "3",
					"name" => $request->post("topic"),
					"problems" => $request->post("analysis"),
					"difficulty" => $request->post("difficulty"),
					"knowledge_id" => $handle->base64_decode($request->post("knowledge")),
					"essayquestion_answer" => $request->post("answer"),
					"score" => $request->post("score"),
					"date" => time(),
				]);

				if($status == 1){
					return $handle->response(200,"修改成功");
				}else{
					return $handle->response(400,"修改失败");
				}
			}else{
				//编辑
				$status = $pascal->save([
					"name" => $request->post("topic"),
					"problems" => $request->post("analysis"),
					"difficulty" => $request->post("difficulty"),
					"knowledge_id" => $handle->base64_decode($request->post("knowledge")),
					"essayquestion_answer" => $request->post("answer"),
					"score" => $request->post("score"),
					"date" => time(),
				],["id"=>$handle->base64_decode($request->post("id"))]);

				if($status == 1){
					return $handle->response(200,"修改成功");
				}else{
					return $handle->response(400,"修改失败");
				}
			}
		}

		//删除试题
		public function delete(){
			$request = Request::instance();
			$handle = new Handle();

			$id = $handle->base64_decode($request->post("id"));

			$pascal = model("Pascal");

			if($pascal::destroy($id) == 1){
				return $handle->response(200,"删除成功");
			}else{
				return $handle->response(400,"删除失败");
			}
		}
		//删除多个
		public function deletes(){
			$request = Request::instance();
			$handle = new Handle();
			$id = explode(",",$request->post("id"));
			$ids = [];
			foreach ($id as $key => $value) {
				# code...
				$ids[$key] = $handle->base64_decode($value);
			}
			$pascal = model("Pascal");

			if($pascal::destroy($ids) > 0){
				return $handle->response(200,"删除成功");
			}else{
				return $handle->response(400,"删除失败");
			}
		}


		//空操作
		public function _empty(){
			$this->redirect(url('index'));
		}
	}



 ?>