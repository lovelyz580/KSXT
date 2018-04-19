<?php 
	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use app\index\model\Handle;

	/**
	* 学生类
	*/
	class Student extends Controller
	{
		
		//控制器初始化
		public function _initialize(){
			if(session("jqmtuser") == NULL){
				$this->redirect(url("index"));
			}
		}

		//查看学生
		public function see($id){
			$handle = new Handle();
			$data = session("jqmtuser");

			$this->assign("data",$data);

			$id = $handle->base64_decode($id);


			$student = model("Student");

			$data = $student->table(["student","entryform","faculty"])
				->where("student.id=entryform.student_id")
				->where("student.faculty_id=faculty.id")
				->where("entryform.class_id",$id)
				->field([
					"entryform.id" => "id",
					"student.user" => "user",
					"student.student_name" => "name",
					"student.sex" => "sex",
					"faculty.faculty_name" => "fname",
					"student.class" => "class",
					"student.email" => "email", 
				])
				->select();
			$data = $handle->toArray($data);
			
			$this->assign("sdata",$data);
			return view();

		}


		//删除学生
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

				$course = model("Entryform");

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