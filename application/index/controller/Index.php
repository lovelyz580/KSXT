<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Handle;

class Index extends Controller
{


    //页面入口
    public function index()
    {
        return view();
    }

    //登录页面
    public function login(){
        return view();
    }

    //登录效验
    public function loginEfficacy(){
        
        // 初始化操作
        $request = Request::instance();
        $Handle = new Handle();

        //提交数据规范性验证
        $validate = validate("Login");

        if(!$validate->check($request->post())){
            //数据不符合规范
            return $Handle->response(400,$validate->getError());
        }

        //验证验证码
        if(!captcha_check($request->post("captcha"))){
            //验证码错误
            return $Handle->response(400,"验证码错误");
        }

        //判断角色登录类型
        if($request->post("type") == "0"){
            
            //学生登录
            $student = model("Student");

            //验证用户名
            $pass = $student::getByUser($request->post("user"));
            if ($pass == NULL) {
                return $Handle->response(400, "用户名或密码错误");
            }

            //验证密码
            $pwd = $pass->toArray()["password"];
            $password = md5(md5($request->post("password")));
            if ($pwd == $password) {
                //登录成功
                $data = $student->table(["student", "skin", "faculty"])
                        ->where("student.skin_id=skin.id")
                        ->where("student.faculty_id=faculty.id")
                        ->where("student.id", $Handle->base64_decode($pass->toArray()["id"]))
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
                            "skin.skin_img" => "skinImg",
                        ])
                        ->select();
                session("jqmsuser", $data[0]->toArray());
                return $Handle->response(200, "/ksxt/public/personalSDetails");
            }else{
                //登录失败
                return $Handle->response(400,"用户名或密码错误");
            }

        }else if($request->post("type") == "1"){
            
            //教师登录
            $teacher = model("Teacher");

            //验证用户名
            $pass = $teacher::getByUser($request->post("user"));
            if($pass == NULL){
                return $Handle->response(400,"用户名或密码错误");
            }

            //验证密码
            $pwd = $pass->toArray()["password"];
            $password = md5(md5($request->post("password")));

            if($pwd == $password){
                //登录成功
                $data = $teacher->table(["teacher","skin","faculty"])
                            ->where("teacher.skin_id=skin.id")
                            ->where("teacher.faculty_id=faculty.id")
                            ->where("teacher.id",$Handle->base64_decode($pass->toArray()["id"]))
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
                return $Handle->response(200,"/ksxt/public/personalDetails");
            }else{
                //登录失败
                return $Handle->response(400,"用户名或密码错误");
            }

        }else{
            //管理员登录
            
            
        }

    }


    //注册
    public function register(){
        return view("Teacher/register");
    }

    //空方法
    public function _empty(){
        $this->redirect(url("index"));
    }
    
}
