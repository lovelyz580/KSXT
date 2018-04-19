<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],

// ];

//导入系统路由类
use think\Route;

Route::rule("index","index/index/index");

//登录页面
Route::rule("login","index/Index/login");

//登录效验
Route::rule("le","index/Index/loginEfficacy");

//退出登录
Route::rule("esc","index/Teacher/esc");

//学生退出
Route::rule("sesc","index/Studentper/esc");

//个人信息页
Route::rule("personalDetails","index/Teacher/personalDetails");
//修改个人信息页
Route::rule("alterDetails","index/Teacher/alterDetails");
//修改教师信息
Route::rule("alterTeacher","index/Teacher/alterTeacher");
//修改教师头像
Route::rule("alterImg","index/Teacher/alterImg");

//注册账号
Route::rule("register","index/Index/register");

//题库页面
Route::rule("selectQuestion","index/Question/select");

//题库id查询
Route::rule("selectQ","index/Question/selectId");
//名字模糊查询
Route::rule("search","index/Question/search");

//题库新增
Route::rule("addQuestion","index/Question/add");

//题库添加页面
Route::rule("addQpage","index/Question/addPage");

//题库修改
Route::rule("alterQuestion","index/Question/alter");

//修改题库封面
Route::rule("alterCover","index/Question/alterImg");

//题库删除
Route::rule("deleteQuestion","index/Question/delete");

//试题查询
Route::rule("seePascal","index/Pascal/see");

//试题id查询
Route::rule("seepid","index/Pascal/seeId");

//单选题修改
Route::rule("alterSingle","index/Pascal/addSingle");

//删除试题
Route::rule("deletePascal","index/Pascal/delete");

//填空题修改
Route::rule("alterCompletion","index/Pascal/addCompletion");

//简答题新增
Route::rule("addEssayquestion","index/Pascal/addEssay");

//批量删除试题
Route::rule("deletes","index/Pascal/deletes");

//查看单选题
Route::rule("seeSingle","index/Pascal/seeSingle");

//查看填空题
Route::rule("seeCompletion","index/Pascal/seeCompletion");

//查看填空题
Route::rule("seeEssay","index/Pascal/seeEssay");

//搜索试题
Route::rule("search","index/Pascal/search");

//查看试卷页面
Route::rule("seeExamination","index/Examination/see");

//重命名试卷
Route::rule("saveExamName","index/Examination/reName");

//试卷管理删除
Route::rule("deleteExamination","index/Examination/delete");

//试卷管理查询
Route::rule("selectExamination","index/Examination/select");

//新增试卷页面
Route::rule("addExamPage","index/Examination/addPage");

//添加题库试题
Route::rule("seeQuestionExam","index/Examination/seeExam");

//添加题库题型试题
Route::rule("seePatternExams","index/Examination/seePatternExam");

//试题搜索
Route::rule("searchExam","index/Examination/searchExam");

//添加试题保存试卷名
Route::rule("addpascal","index/Examination/addpascal");

//试卷管理新增
Route::rule("addExamination","index/Examination/add");

//试卷管理修改
Route::rule("alterExamination","index/Examination/alter");

//试卷试题删除
Route::rule("deleteExaminationtext","index/Examinationtext/delete");

//试卷试题预览
Route::rule("seeexam","index/Examinationtext/see");

//课程查看
Route::rule("seeCourse","index/Course/see");

//新增课程
Route::rule("addCourse","index/Course/add");

//删除课程
Route::rule("deleteCourse","index/Course/delete");

//班级查看
Route::rule("seeClass","index/Grade/see");

//新增班级
Route::rule("addClass","index/Grade/add");

//查看单个班级信息
Route::rule("seed","index/Grade/select");

//删除班级信息
Route::rule("deleteClass","index/Grade/delete");

//查看班级报名学生
Route::rule("seeclassStudent","index/Student/see");

//教师删除学生
Route::rule("deleteStu","index/Student/delete");

//教师查看班级发布的试卷
Route::rule("seePublished","index/Published/see");

//发布试卷
Route::rule("addPublished","index/Published/add");

//单个试卷查询
Route::rule("getPD","index/Published/select");

//删除试卷
Route::rule("deletePS","index/Published/delete");

//试卷考生信息查看
Route::rule("seeStuDes","index/Examination/seeStuDes");






//个人信息学生
Route::rule("personalSDetails","index/Studentper/personalDetails");

//修改学生个人信息页
Route::rule("alterSDetails","index/Studentper/alterDetails");

//修改学生信息
Route::rule("alterStudent","index/Studentper/alterStudent");

//修改学生头像
Route::rule("alterImg","index/Studentper/alterImg");

//进入考试系统
Route::rule("ksxt","index/Studentper/ksxt");

//查看已过考试时间的试卷
Route::rule("hasKsxt","index/Studentper/hasKsxt");

//切换报名信息
Route::rule("th","index/Studentper/th");

//学生报名进行考试
Route::rule("baoming","index/Studentper/baoming");

//学生答题页
Route::rule('dati',"index/Showpascal/datiPage");

//是否是考试时间进行判断
Route::rule("ifExam","index/Showpascal/ifExamTime");

//保存考生答案
Route::rule("submitanswer","index/Examineeanswer/saveAnswer");

//查看学生详情答案
Route::rule("seeDetails","index/Examination/showDetails");