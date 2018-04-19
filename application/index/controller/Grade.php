<?php 
	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use app\index\model\Handle;

	/**
	* 班级类
	*/
	class Grade extends Controller
	{
		
		//初始化控制器
		public function _initialize(){
			if(session("jqmtuser") == NULL){
				$this->redirect(url("index"));
			}
		}

		//班级查看
		public function see($id){
			$handle = new Handle();
			$data = session("jqmtuser");
			$this->assign("data",$data);

			//课程id
			$id = $handle->base64_decode($id);
			session("courseId",$id);
			$grade = model("classg");

			$data = $grade::all(["course_id"=>$id]);

			$data = $handle->toArray($data);

			$this->assign("grade",$data);


			return view();
		}

		//查看班级信息
		public function select(){
			$request = Request::instance();
			$handle = new Handle();

			$grade = model("classg");
			$id = $handle->base64_decode($request->post('id'));
			$data = $grade::get($id);
			return $handle->response(200,"获取成功",$data->toArray());

		}

		//新增班级
		public function add(){
			$request = Request::instance();
			$handle = new Handle();

			$validate = validate("Grade");
			if(!$validate->check($request->post())){
				return $handle->response(400,$validate->getError());
			}

			$grade = model("classg");
			if($request->post("add") == "jqm"){
				//添加
				
				$status = $grade->save([
					"course_id" => session("courseId"),
					"class_name" => $request->post("name"),
					"class_restrict" => $request->post("sum"),
					"invitation_code" => $request->post("code"),
					"class_date" => time()
				]);
				if($status == 1){
					return $handle->response(200,"新增成功");
				}else{
					return $handle->response(400,"新增失败");
				}
			}else{
				//修改
				//
				$status = $grade->save([
					"class_name" => $request->post("name"),
					"class_restrict" => $request->post("sum"),
					"invitation_code" => $request->post("code"),
					"class_date" => time()
				],["id"=>$handle->base64_decode($request->post("id"))]);
				if($status == 1){
					return $handle->response(200,"新增成功");
				}else{
					return $handle->response(400,"新增失败");
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

				$course = model("classg");

				$status = $course::destroy($ids);

				if($status>=1){
					return $handle->response(200,"删除成功");
				}else{
					return $handle->response(400,"删除失败");
				}

			}else{
				return $handle->response(400,"请选择班级");
			}
		}


		//空操作
		public function _empty(){
			$this->redirect(url("index"));
		}
	}

 ?>