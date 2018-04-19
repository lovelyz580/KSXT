<?php 
	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use app\index\model\Handle;

	/**
	* 教师类
	*/
	class Teacher extends Controller
	{
		
		//初始化控制器
		public function _initialize(){
			if(session("jqmtuser") == NULL){
				return $this->redirect(url("index"));
			}
		}

		//个人信息页
		public function personalDetails(){
			
			$data = session("jqmtuser");

			$this->assign("data",$data);

			return view();
		}

		//修改信息显示页
		public function alterDetails(){
			$handle = new Handle();

			$faculty = model("Faculty");
			$fac = $handle->toArray($faculty::all());

			$data = session("jqmtuser");

			$this->assign("data",$data);
			$this->assign("faculty",$fac);

			return view();
		}

		/**
		 * 修改教师信息
		 * 
		 */
		public function alterTeacher(){
			//初始化操作
			$request = Request::instance();
			$handle = new Handle();

			$validate = validate("Ateacher");

			if(!$validate->check($request->post())){
				return $handle->response(400,$validate->getError());
			}

			//教师id
			$id = $handle->base64_decode(session("jqmtuser")["id"]);

			$data = [
				"teacher_name" => $request->post("name"),
				"sex" => $request->post("sex"),
				"email" => $request->post("email"),
				"faculty_id" => $handle->base64_decode($request->post("yx")),
				"sign" => $request->post("sign"),
			];

			$teacher = model("Teacher");

			$status = $teacher->save($data,['id'=>$id]);

			if($status == 1){
				$data = $teacher->table(["teacher","skin","faculty"])
                            ->where("teacher.skin_id=skin.id")
                            ->where("teacher.faculty_id=faculty.id")
                            ->where("teacher.id","1")
                            ->field([
                                    "teacher.id" => "id",
                                    "teacher.user" => "user",
                                    "teacher.teacher_name" => "name",
                                    "teacher.sex" => "sex",
                                    "faculty.faculty_name" => "faculty",
                                    "teacher.headimg" => "headimg",
                                    "teacher.email" => "email",
                                    "teacher.sign" => "sign",
                                    "skin.skin_name" => "skinName",
                                    "skin.skin_img" => "skinImg"
                                ])
                            ->select();
                		session("jqmtuser",$data[0]->toArray());
						
						return $handle->response(200,"personalDetails");
			}else{
				return $handle->response(400,"修改失败");
			}
			
		}

		//修改头像
		public function alterImg(){
			$handle = new Handle();
			$teacher = model("Teacher");
			$file = $_FILES["file"];
			$status = $handle->imageType($file);
			$time = time();
			if($status == true){
				$path = ROOT_PATH."public".DS."static".DS."images".DS."portrait".DS.$time.substr($file["name"],-4);
				$img = session("jqmtuser")["headimg"];
				$img = substr($img,strrpos($img,"/")+1);
				$pa = substr($path,0,strrpos($path,DS)).DS.$img;
				
				if(unlink($pa)){
					move_uploaded_file($file["tmp_name"],$path);
					$path = "/ksxt/public/static/images/portrait/".$time.substr($file["name"],-4);
					$id = $handle->base64_decode(session("jqmtuser")["id"]);
					$status = $teacher->save(["headimg"=>$path],["id"=>$id]);

					if($status == 1){
						$data = $teacher->table(["teacher","skin","faculty"])
                            ->where("teacher.skin_id=skin.id")
                            ->where("teacher.faculty_id=faculty.id")
                            ->where("teacher.id","1")
                            ->field([
                                    "teacher.id" => "id",
                                    "teacher.user" => "user",
                                    "teacher.teacher_name" => "name",
                                    "teacher.sex" => "sex",
                                    "faculty.faculty_name" => "faculty",
                                    "teacher.headimg" => "headimg",
                                    "teacher.email" => "email",
                                    "teacher.sign" => "sign",
                                    "skin.skin_name" => "skinName",
                                    "skin.skin_img" => "skinImg"
                                ])
                            ->select();
                		session("jqmtuser",$data[0]->toArray());
						
						return $handle->response(200,"alterDetails");
					}else{
						return $handle->response(400,"修改失败");
					}
				}
			}else{
				$handle->response(400,$status);
			}

		}

		//修改皮肤
		public function alterSkin(){
			$handle = new Handle();
			$teacher = model("Teacher");
		}

		//退出登录
		public function esc(){
			session('jqmtuser',NULL);
			$this->redirect(url("index/Index/login"));
		}

		//空操作
		public function _empty(){
			return $this->redirect(url("index"));
		}
	}
 ?>