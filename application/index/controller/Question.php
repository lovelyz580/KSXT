<?php 
	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use app\index\model\Handle;

	/**
	* 题库管理类
	*/
	class Question extends Controller{
		
		//控制器初始化
		public function _initialize(){
			if(session("jqmtuser") == NULL){
				$this->redirect(url("index"));
			}
		}
		
		//查询题库
		public function select(){
			//初始化操作
			$handle = new Handle();

			$data = session("jqmtuser");
			$id = $handle->base64_decode($data['id']);
			$question = model("Question");

			$questionData = $question::all(["teacher_id"=>$id]);

			$this->assign("data",$data);
			$this->assign("question",$handle->toArray($questionData));
			return view();
		}

		//题库id查询
		public function selectId(){
			//初始化操作
			$request = Request::instance();
			$handle = new Handle();

			$id = $handle->base64_decode($request->post("id"));

			$question = model("Question");

			$data = $question::get($id);

			if($data != NULL){
				return $handle->response(200,"查询成功",$data->toArray());
			}else{
				return $handle->response(400,"查询失败");
			}
		}
		//题库名称查询
		public function search(){
			//初始化操作
			$request = Request::instance();
			$handle = new Handle();

			$data = session("jqmtuser");
			$id = $handle->base64_decode($data['id']);
			$question = model("Question");

			$search = $request->post("search");
			$questionData = $question->where([
					"question_name"=>[
						"like","%".$search."%"
					]
				])
				->where("teacher_id",$id)
				->select();
			$this->assign("data",$data);
			$this->assign("question",$handle->toArray($questionData));
			return $this->fetch('select');
		}


		//添加题库
		public function add(){
			//初始化操作
			$request = Request::instance();
			$handle = new Handle();

			//验证提交数据
			$validate = validate("Question");
			if(!$validate->check($request->post())){
				//不符合规范
				return $handle->response("400",$validate->getError());
			}

			//教师id
			$id = $handle->base64_decode(session("jqmtuser")["id"]);
			//题库名称
			$name = $request->post("name");
			$brief = $request->post("brief");
			$time = time();
			//实例化题库模型
			$question = model("Question");
			
			if($request->post("file")!="j"){
				$path = ROOT_PATH."public".DS."static".DS."images".DS."cover".DS.$time.substr($_FILES["file"]["name"],-4);
				move_uploaded_file($_FILES["file"]["tmp_name"],$path);
				$path = "/ksxt/public/static/images/cover/".$time.substr($_FILES["file"]["name"],-4);

				
				//保存数据
				$question->data([
					"teacher_id" => $id,
					"question_name" => $name,
					"brief" => $brief,
					"question_img" => $path,
					"question_date" => time()
				]);
			}else{
				//保存数据
				$question->data([
					"teacher_id" => $id,
					"question_name" => $name,
					"brief" => $brief,
					"question_date" => time()
				]);
			}

			$code = $question->save();

			//判断是否插入成功
			if($code == 1){
				return $handle->response(200,"selectQuestion");
			}else{
				return $handle->response(400,"添加失败");
			}

		}

		//加添页面
		public function addPage(){
			$data = session("jqmtuser");

			$this->assign("data",$data);

			return view();
		}

		//修改题库名称
		public function alter(){
			//初始化操作
			$request = Request::instance();
			$handle = new Handle();

			//验证提交数据
			$validate = validate("Question");
			if(!$validate->check($request->post())){
				//不符合规范
				return $handle->response("400",$validate->getError());
			}

			if($request->post("name") != "jqm"){
				//题库id
				$id = $handle->base64_decode($request->post("id"));
				//题库简介
				$name = $request->post("name");

				//实例化题库模型
				$question = model("Question");

				$code = $question->save([
					"question_name" => $name,
					"question_date" => time()
				],["id"=>$id]);

				//判断是否插入成功
				if($code == 1){
					return $handle->response(200,"修改成功");
				}else{
					return $handle->response(400,"修改失败");
				}

				return;
			}

			//题库id
			$id = $handle->base64_decode($request->post("id"));
			//题库简介
			$brief = $request->post("brief");

			//实例化题库模型
			$question = model("Question");

			$code = $question->save([
				"brief" => $brief,
				"question_date" => time()
			],["id"=>$id]);

			//判断是否插入成功
			if($code == 1){
				return $handle->response(200,"修改成功");
			}else{
				return $handle->response(400,"修改失败");
			}
		}

		//修改题库封面
		public function alterImg(){
			$handle = new Handle();
			$Question = model("Question");
			$file = $_FILES["file"];
			$status = $handle->imageType($file);
			$time = time();
			if($status == true){
				$path = ROOT_PATH."public".DS."static".DS."images".DS."cover".DS.$time.substr($file["name"],-4);
				$id = $handle->base64_decode($_POST["id"]);
				$img = $Question::get($id)->toArray()["question_img"];
				$img = substr($img,strrpos($img,"/")+1);
				$pa = substr($path,0,strrpos($path,DS)).DS.$img;
				if(unlink($pa)){
					move_uploaded_file($file["tmp_name"],$path);
					$path = "/ksxt/public/static/images/cover/".$time.substr($file["name"],-4);
					$status = $Question->save(["question_img"=>$path],["id"=>$id]);

					if($status == 1){
						//修改成功
						return $handle->response(200,$path);
					}else{
						return $handle->response(400,"修改失败");
					}
				}
			}else{
				$handle->response(400,$status);
			}
		}


		//题库删除
		public function delete(){
			//初始化操作
			$request = Request::instance();
			$handle = new Handle();

			//题库id
			$id = explode(",",$request->post("id"));

			$data = [];

			foreach ($id as $key => $value) {
				$data[$key] = $handle->base64_decode($value);
			}

			//实例化题库模型
			$question = model("Question");

			//判断是否删除成功
			if($question::destroy($data) >= 1){
				return $handle->response(200,"selectQuestion");
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