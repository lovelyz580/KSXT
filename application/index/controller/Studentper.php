<?php 
    namespace app\index\controller;

    use think\Controller;
    use think\Request;
    use app\index\model\Handle;

    /**
    * 学生类
    */
   
   class Studentper extends Controller
   {
       //控制器初始化
        public function _initialize(){
            if(session("jqmsuser") == NULL){
                $this->redirect(url("index"));
            }
        }

       //个人信息页
        public function personalDetails() {

            $data = session("jqmsuser");

            $this->assign("data", $data);

            return view("student/personalDetails");
        }

        //修改学生信息显示页
        public function alterDetails() {
            $handle = new Handle();

            $faculty = model("Faculty");
            $fac = $handle->toArray($faculty::all());

            $data = session("jqmsuser");

            $this->assign("data", $data);
            $this->assign("faculty", $fac);

            return view("student/alterDetails");
        }

        /**
         * 修改学生信息
         * 
         */
        public function alterStudent() {
            //初始化操作
            $request = Request::instance();
            $handle = new Handle();

            $validate = validate("Astudent");

            if (!$validate->check($request->post())) {
                return $handle->response(400, $validate->getError());
            }

            //学生id
            $id = $handle->base64_decode(session("jqmsuser")["id"]);

            $data = [
                "student_name" => $request->post("name"),
                "sex" => $request->post("sex"),
                "email" => $request->post("email"),
                "faculty_id" => $handle->base64_decode($request->post("yx")),
                "sign" => $request->post("sign"),
                "class" => $request->post("class"),
            ];

            $student = model("Student");

            $status = $student->save($data, ['id' => $id]);
            if ($status == 1) {

                $data = $student->table(["student", "skin", "faculty"])
                        ->where("student.skin_id=skin.id")
                        ->where("student.faculty_id=faculty.id")
                        ->where("student.id", $id)
                        ->field([
                            "student.id" => "id",
                            "student.user" => "user",
                            "student.student_name" => "name",
                            "student.sex" => "sex",
                            "faculty.faculty_name" => "faculty",
                            "student.class" => "class",
                            "student.headimg" => "headimg",
                            "student.email" => "email",
                            "student.sign" => "sign",
                            "skin.skin_name" => "skinName",
                            "skin.skin_img" => "skinImg"
                        ])
                        ->select();

                session("jqmsuser", $data[0]->toArray());

                return $handle->response(200, "/ksxt/public/personalSDetails");
            } else {
                return $handle->response(400, "修改失败");
            }
        }

        //修改头像
        public function alterImg() {
            $handle = new Handle();
            $student = model("Student");
            $file = $_FILES["file"];
            $status = $handle->imageType($file);
            $time = time();

            if ($status == true) {
                $path = ROOT_PATH . "public" . DS . "static" . DS . "images" . DS . "portrait" . DS . $time . substr($file["name"], -4);
                $img = session("jqmsuser")["headimg"];
                $img = substr($img, strrpos($img, "/") + 1);
                $pa = substr($path, 0, strrpos($path, DS)) . DS . $img;

                if (unlink($pa)) {
                    move_uploaded_file($file["tmp_name"], $path);
                    $path = "/ksxt/public/static/images/portrait/" . $time . substr($file["name"], -4);
                    $student = model("Student");
                    $id = $handle->base64_decode(session("jqmsuser")["id"]);
                    $status = $student->save(["headimg" => $path], ["id" => $id]);

                    if ($status == 1) {
                        $data = $student->table(["student", "skin", "faculty"])
                                ->where("student.skin_id=skin.id")
                                ->where("student.faculty_id=faculty.id")
                                ->where("student.id", $id)
                                ->field([
                                    "student.id" => "id",
                                    "student.user" => "user",
                                    "student.student_name" => "name",
                                    "student.sex" => "sex",
                                    "faculty.faculty_name" => "faculty",
                                    "student.class" => "class",
                                    "student.headimg" => "headimg",
                                    "student.email" => "email",
                                    "student.sign" => "sign",
                                    "skin.skin_name" => "skinName",
                                    "skin.skin_img" => "skinImg"
                                ])
                                ->select();
                        session("jqmsuser", $data[0]->toArray());

                        return $handle->response(200, "alterDetails");
                    } else {
                        return $handle->response(400, "修改失败");
                    }
                }
            } else {
                $handle->response(400, $status);
            }
        }


        //进入考试系统
        public function ksxt() {
            $handle = new Handle();
            $data = session("jqmsuser");
            $this->assign("data", $data);

            //拉取试卷
            $id = $handle->base64_decode(session("jqmsuser")['id']);
            $entry = model("published");
            $data =  $entry->table(["entryform","examination","published","class"])
                ->where("entryform.student_id",$id )
                ->where("entryform.class_id=published.class_id")
                ->where("entryform.class_id=class.id")
                ->where("published.exam_id=examination.id")
                ->where("published.strat+published.size",">",time())
                ->order("published.strat","desc")
                ->field([
                    "published.id" => "id",
                    "examination.examination_name" => "name",
                    "examination.score" => "score",
                    "published.length" => "length",
                    "published.strat" => "strat",
                    "published.size" => "size",
                    "class.class_name" => "cname"
                ])
               ->select();
            $data = $handle->toArray($data);
            $this->assign("sdata",$data);


            //获取报名信息
            //教师信息
            $teacher = model("Teacher");

            $data = $teacher::all();

            $data = $handle->toArray($data);

            $this->assign("teacher",$data);

            //课程信息
            if(sizeof($data)>0){
                $id = $handle->base64_decode($data[0]["id"]);

                $course = model("Course");

                $data = $course::all(["teacher_id"=>$id]);

                $data = $handle->toArray($data);
                $this->assign("course",$data);


            }else{
                $this->assign("course",[]);
            }
            

            //班级信息
            if(sizeof($data)>0){
                $id = $handle->base64_decode($data[0]["id"]);

                $classg = model("Classg");

                $data = $classg::all(["course_id"=>$id]);

                $data = $handle->toArray($data);

                $this->assign("class",$data);


            }else{
                $this->assign("class",[]);
            }
            

            return view("student/ksxt");

        }

        //已过考试时间的试卷
        public function hasKsxt(){
            $handle = new Handle();
            $data = session("jqmsuser");
            $this->assign("data", $data);

            //拉取试卷
            //学生id
            $id = $handle->base64_decode(session("jqmsuser")['id']);
            $entry = model("published");
            $data =  $entry->table(["entryform","examination","published","class"])
                ->where("entryform.student_id",$id )
                ->where("entryform.class_id=published.class_id")
                ->where("entryform.class_id=class.id")
                ->where("published.exam_id=examination.id")
                ->where("published.strat+published.size","<",time())
                ->order("published.strat","desc")
                ->field([
                    "published.id" => "id",
                    "examination.examination_name" => "name",
                    "examination.score" => "score",
                    "published.length" => "length",
                    "published.strat" => "strat",
                    "class.class_name" => "cname",
                ])
               ->select();
            $data = $handle->toArray($data);

            foreach ($data as $key => $value) {
                $strat = strtotime($value["strat"]);
                $time = time();
                if($strat+$value["length"] < $time){
                    $data[$key]["status"] = "已过时间";
                }else{
                    if($strat+$value["length"] > $time && $time > $strat){
                        $data[$key]["status"] = "正在考试";
                    }elseif($strat > $time){
                        $data[$key]["status"] = "即将考试";
                    }
                    
                }
            }

            $this->assign("sdata",$data);


            //获取报名信息
            //教师信息
            $teacher = model("Teacher");

            $data = $teacher::all();

            $data = $handle->toArray($data);

            $this->assign("teacher",$data);

            //课程信息
            if(sizeof($data)>0){
                $id = $handle->base64_decode($data[0]["id"]);

                $course = model("Course");

                $data = $course::all(["teacher_id"=>$id]);

                $data = $handle->toArray($data);
                $this->assign("course",$data);


            }else{
                $this->assign("course",[]);
            }
            

            //班级信息
            if(sizeof($data)>0){
                $id = $handle->base64_decode($data[0]["id"]);

                $classg = model("Classg");

                $data = $classg::all(["course_id"=>$id]);

                $data = $handle->toArray($data);

                $this->assign("class",$data);


            }else{
                $this->assign("class",[]);
            }

            return view("student/hasKsxt");
        }




        //更换报名信息
        public function th(){
            $request = Request::instance();
            $handle = new Handle();

            if($request->post("c") == "jqm"){
                $id = $handle->base64_decode($request->post("id"));
                $classg = model("Classg");

                $data = $classg::all(["course_id"=>$id]);

                $data = $handle->toArray($data);

                return $handle->response(200,"成功",$data);

                return;
            }

            //课程信息
            $id = $handle->base64_decode($request->post("id"));
        
            $course = model("Course");

            $data = $course::all(["teacher_id"=>$id]);

            $data = $handle->toArray($data);
                
            $info = [];
            $info["course"] = $data;

            //班级信息
            if(sizeof($data)>0){
                $id = $handle->base64_decode($data[0]["id"]);

                $classg = model("Classg");

                $data = $classg::all(["course_id"=>$id]);

                $data = $handle->toArray($data);

                $info["class"] = $data;


            }else{
                $info["class"] = [];
            }
            
            return $handle->response(200,"获取成功",$info);
        }

        //报名进行考试
        public function baoming(){
            $request = Request::instance();
            $handle = new Handle();

            
            $code = $request->post("code");

            $classg = model("Classg");

            $data = $classg::where("id",$handle->base64_decode($request->post("grade")))
                ->value("invitation_code");
            if($data == $code){
                $entryform = model("Entryform");

                $data = $entryform::where(["class_id" => $handle->base64_decode($request->post("grade")),
                    "student_id" => $handle->base64_decode(session("jqmsuser")["id"])])->find();

                
                    
                if(!(!$data)){
                    return $handle->response(400,"不要重复报名");
                }
                

                $data = [
                    //班级id
                    "class_id" => $handle->base64_decode($request->post("grade")),
                    "student_id" => $handle->base64_decode(session("jqmsuser")["id"]),
                    "entryform_date" => time(),
                ];

                $status = $entryform->save($data);

                if($status == 1){
                    return $handle->response(200,"报名成功");
                }else{
                    return $handle->response(400,"报名失败");
                }
            }else{
                return $handle->response(400,"邀请码错误");
            }
        }


        //修改皮肤
        public function alterSkin() {
            $handle = new Handle();
            $teacher = model("Teacher");
        }

        //退出登录
        public function esc(){
            session("jqmsuser",NULL);
            $this->redirect(url("index/Index/login"));
        }

        //空操作
        public function _empty(){
            $this->redirect(url('index'));
        }
   }

 ?>




    