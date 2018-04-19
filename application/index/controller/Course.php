<?php 
	
	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use app\index\model\Handle;

	/**
	* 课程类
	*/
	class Course extends Controller
	{
		
		//控制器初始化
		public function _initialize(){
			if(session("jqmtuser") == NULL){
				$this->redirect(url("index"));
			}
		}

		//查看课程页
		public function see(){

			$handle = new Handle();
			$data = session("jqmtuser");
			$this->assign("data",$data);

			$course = model("Course");

			//教师id
			$id = $handle->base64_decode(session("jqmtuser")["id"]);

			$data = $course::all(["teacher_id"=>$id]);
			$data = $handle->toArray($data);

			$this->assign("dataC",$data);


			return view();
		}

		//添加课程修改课程
		public function add(){
			$request = Request::instance();
			$handle = new Handle();

			$validate = validate("Course");

			if(!$validate->check($request->post())){
				return $handle->response(400,$validate->getError());
			}

			$course = model('Course');

			if($request->post("alter") == "jqm"){
				$status = $course->save([
					"course_name" => $request->post("name"),
					"course_date" => time(),
				],["id"=>$handle->base64_decode($request->post("id"))]);

				if($status == 1){
					return $handle->response(200,'修改成功');
				}else{
					return $handle->response(400,"修改失败");
				}
				return;
			}

			$status = $course->save([
				"teacher_id" => $handle->base64_decode(session("jqmtuser")["id"]),
				"course_name" => $request->post("name"),
				"course_date" => time(),
			]);

			if($status == 1){
				return $handle->response(200,'新增成功');
			}else{
				return $handle->response(400,"新增失败");
			}
		}

		//删除课程
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

				$course = model("Course");

				$status = $course::destroy($ids);

				if($status>=1){
					return $handle->response(200,"删除成功");
				}else{
					return $handle->response(400,"删除失败");
				}

			}else{
				return $handle->response(400,"请选择课程");
			}

		}

		//空操作
		public function _empty(){
			$this->redirect(url("index"));
		}
	}

 ?>