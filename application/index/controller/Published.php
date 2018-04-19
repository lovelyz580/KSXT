<?php 

	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use app\index\model\Handle;

	/**
	* 发布试卷类
	*/
	class Published extends Controller
	{
		
		//初始化控制器
		public function _initialize(){
			if(session("jqmtuser") == NULL){
				$this->redirect(url("index"));
			}
		}
		//查看试卷页面
		public function see($id){
			$handle = new Handle();
			$data = session("jqmtuser");
			$this->assign("data",$data);

			$published = model("Published");
			//班级ID
			$id = $handle->base64_decode($id);
			session("classId",$id);
			$data = $published->table(["published","examination"])
				->where('published.exam_id=examination.id')
				->where("published.class_id",$id)
				->field([
					"published.id" => "id",
					"published.exam_id" => "sid",
					"examination.examination_name" => "name",
					"published.strat" => "strat",
					"published.length" => "length",
					"published.size" => "size",
					"published.date" => "date"
				])
				->select();

			$this->assign("pdata",$handle->toArray($data));

			$exam = model("Examination");
			$id = $handle->base64_decode(session("jqmtuser")["id"]);
			$data = $exam::all(["teacher_id"=>$id]);
			$data = $handle->toArray($data);
			$this->assign("edata",$data);


			return view();
		}

		//单个查询
		public function select(){
			$request = Request::instance();
			$handle = new Handle();

			$id = $request->post("id");
			$id = $handle->base64_decode($id);
			$published = model("Published");	
			$data = $published->table(["published","examination"])
				->where("published.exam_id=examination.id")
				->where("published.id",$id)
				->field([
					"published.id" => "id",
					"published.strat" => "strat",
					"published.length" => "length",
					"published.size" => "size",
					"examination.examination_name" => "name"
				])	
				->select();

			return $handle->response(200,"获取成功",$data[0]);
		}

		//发布试卷
		public function add(){
			$request = Request::instance();
			$handle = new Handle();

			$published = model("Published");

			$strat = $request->post("strat");

			$strat = strtotime($strat);



			$data = [
				"class_id" => session("classId"),
				"exam_id" => $handle->base64_decode($request->post("name")),
				"strat" => $strat,
				"length" => $request->post("length"),
				"size" => $request->post("size"),
				"date" => time()
			];
			if($request->post("add")=="jqm"){
				$status = $published->save($data);
				if($status == 1){
					return $handle->response(200,"发布成功");
				}else{
					return $handle->response(400,"发布失败");
				}
			}else{
				//修改
				$data = [
					"exam_id" => $handle->base64_decode($request->post("name")),
					"strat" => $request->post("strat"),
					"length" => $request->post("length"),
					"size" => $request->post("size"),
					"date" => time()
				];
				$status = $published->save($data,["id"=>$handle->base64_decode($request->post("id"))]);
				if($status == 1){
					return $handle->response(200,"发布成功");
				}else{
					return $handle->response(400,"发布失败");
				}
			}
			
			
		}


		//删除
		public function delete(){
			$request = Request::instance();
			$handle = new Handle();

			$id = $request->post("id");

			if($id != NULL){
				$id = explode(',',$id);
				$ids = [];
				foreach ($id as $key => $value) {
					$ids[$key] = $handle->base64_decode($value);
				}

				$course = model("Published");

				$status = $course::destroy($ids);

				if($status>=1){
					return $handle->response(200,"删除成功");
				}else{
					return $handle->response(400,"删除失败");
				}

			}else{
				return $handle->response(400,"请选择试卷");
			}
		}


		//空操作
		public function _empty(){
			$this->redirect(url("index"));
		}
	}

 ?>