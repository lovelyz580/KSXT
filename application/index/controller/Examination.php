<?php 
	namespace app\index\controller;

	use think\Controller;
	use think\Request;
	use app\index\model\Handle;
	use think\Db;

	/**
	* 试卷管理
	*/
	class Examination extends Controller
	{
		
		//控制器初始化
		public function _initialize(){
			if(session("jqmtuser") == NULL){
				$this->redirect(url("index"));
			}
		}


		//查看试卷页面
		public function see(){
			$handle = new Handle();
			$data = session("jqmtuser");
			$this->assign("data",$data);

			$examination = model("Examination");
			$id = $handle->base64_decode(session("jqmtuser")["id"]);
			$data = $examination::all(["teacher_id"=>$id]);
			
			$this->assign("examData",$handle->toArray($data));
			
			

			return view();
		}

		//查询试卷
		public function select(){

			$request = Request::instance();
			$handle = new Handle();

			$validate = validate("Examination");

			if(!$validate->scene("search")->check($request->post())){
				return $handle->response(400,$validate->getError());
			}

			//实例化题库模型
			$examination = model("Examination");

			//教师id查询
			$id = $handle->base64_decode(session("jqmtuser")["id"]);

			//试卷名称名称查询
			$search = $request->post("search");

			$data = session("jqmtuser");
			$this->assign("data",$data);
			$data = $handle->toArray($examination->where(["examination_name"=>["like","%".$search."%"]])
				->where("teacher_id",$id)
				->select());
			
			$this->assign("examData",$data);

			return view("see");
			
		}

		//重命名试卷
		public function reName(){
			$request = Request::instance();
			$handle = new Handle();

			$validate = validate("Examination");

			if(!$validate->scene("names")->check($request->post())){
				return $handle->response(400,$validate->getError());
			}

			$exam = model("Examination");
			$id = $handle->base64_decode($request->post("id"));
			$status = $exam->save(["examination_name"=>$request->post("name")],[
					"id"=>$id
				]);

			if($status == 1){
				return $handle->response(200,$request->post("name"),["date"=>date("Y-m-d H:i:s")]);
			}else{
				return $handle->response(400,"修改失败");
			}

		}
		

		//试卷添加页面
		public function addPage(){
			$handle = new Handle();
			$data = session("jqmtuser");
			$this->assign("data",$data);
			$id = $handle->base64_decode(session("jqmtuser")['id']);
			$question = model("Question");

			$questionData = $question::all(["teacher_id"=>$id]);
			$data = $handle->toArray($questionData);
			$this->assign("question",$data);
			session("examQuestion",$data[0]["id"]);
			
			$pascal = model("Pascal");
			
			$data = $pascal->table(["pascal","pattern","knowledge"])
				->where("pascal.pattern_id=pattern.id")
				->where("pascal.knowledge_id=knowledge.id")
				->where("pascal.question_id",$handle->base64_decode($data[0]["id"]))
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

			$this->assign("questionPascal",$data);

			return view();
		}

		//查看题库试题
		public function seeExam($id){
			session("examQuestion",$id);
			$handle = new Handle();
			$data = session("jqmtuser");

			$this->assign("data",$data);
			$id = $handle->base64_decode($id);
			$question = model("Question");
			$tid = $handle->base64_decode(session("jqmtuser")['id']);
			$questionData = $question::all(["teacher_id"=>$tid]);
			$data = $handle->toArray($questionData);
			$this->assign("question",$data);
			
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
			$this->assign("questionPascal",$data);
			return view("addPage");
		}

		//查看题库题型试题
		public function seePatternExam($id){
			$handle = new Handle();
			$data = session("jqmtuser");

			$this->assign("data",$data);
			$question = model("Question");
			$tid = $handle->base64_decode(session("jqmtuser")['id']);
			$questionData = $question::all(["teacher_id"=>$tid]);
			$data = $handle->toArray($questionData);
			$this->assign("question",$data);
			$ids = $handle->base64_decode(session("examQuestion"));
			$pascal = model("Pascal");

			$data = $pascal->table(["pascal","pattern","knowledge"])
				->where("pascal.pattern_id=pattern.id")
				->where("pascal.knowledge_id=knowledge.id")
				->where("pascal.question_id",$ids)
				->where("pascal.pattern_id",$id)
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
			$this->assign("questionPascal",$data);
			return view("addPage");
		}
		

		//搜索
		public function searchExam(){
			$request = Request::instance();
			$handle = new Handle();
			$data = session("jqmtuser");

			$this->assign("data",$data);
			$question = model("Question");
			$tid = $handle->base64_decode(session("jqmtuser")['id']);
			$questionData = $question::all(["teacher_id"=>$tid]);
			$data = $handle->toArray($questionData);
			$this->assign("question",$data);
			$id = $handle->base64_decode(session("examQuestion"));
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
			$this->assign("questionPascal",$data);
			return view("addPage");
		}


		//试卷考生信息查看
		public function seeStuDes($id){
			$handle = new Handle();
			//发布试卷id
			$id = $handle->base64_decode($id);

			$data = session("jqmtuser");

			$this->assign("data",$data);

			$model = model("Student");

			$data = $model->table(["student","examineeanswer","published"])
				->where("published.id",$id)
				->where("published.id=examineeanswer.examination_id")
				->where("examineeanswer.student_id=student.id")
				->field([
					"student.id" => "id",
					"published.id" => "pid",
					"student.user" => "user",
					"student.student_name" => "name",
					"student.sex" => "sex",
					"student.class" => "class",
					"examineeanswer.performance" => "performance"
				])
				->select();
			$data = $handle->toArray($data);
			
			foreach ($data as $key => $value) {
				if($value["performance"]>=90){
					$data[$key]["rank"] = "优秀";
				}elseif($value["performance"]>=80){
					$data[$key]["rank"] = "很好";
				}elseif($value["performance"]>=70){
					$data[$key]["rank"] = "好";
				}elseif($value["performance"]>=60){
					$data[$key]["rank"] = "及格";
				}else{
					$data[$key]["rank"] = "不及格";
				}
			}

			$this->assign("student",$data);



			return view();
		}




		//添加试题
		public function addpascal(){
			$request = Request::instance();
			session("examId",NULL);
			session("examName",$request->post("name"));
			return "1";
		}
		//添加试题
		public function add($idexam=""){
			$request = Request::instance();
			$handle = new Handle();

			$ids = explode(",",$request->post("id"));
		
			if($idexam != ""){
				session("examId",$handle->base64_decode($idexam));
			
			}
			

			$exam = model("Examination");
			Db::startTrans();
			$examId = "";
			try{
				if(session("examId") == NULL){
					$dataexam =[
						"teacher_id" => $handle->base64_decode(session("jqmtuser")["id"]),
						"examination_name" => session("examName"),
						"examination_date" => time(),
						"score" => 0
					];
					Db::table("examination")->insert($dataexam);
					
					$examId = Db::name("examination")->getLastInsID();
					
					session("examId",$examId);
				}
				$id = [];
				$pascalId = [];
				foreach ($ids as $key => $value) {
					$status = Db::table("examinationtext")->where('examination_id',session("examId"))
						->where("pascal_id",$handle->base64_decode($value))->select();
					
					if(!$status){
						$pascalId[$key]= $handle->base64_decode($value);
						$id[$key] = [
							"examination_id" => session("examId"),
							"pascal_id" => $handle->base64_decode($value)
						];
						
					}

					
				}
				
				if(sizeof($pascalId) == 0){
					return $handle->response(200,"添加成功");
				}

				Db::table("examinationtext")->insertAll($id);
				

				$pascal = model("Pascal");

				$data = $pascal::all($pascalId);
				$id = $handle->toArray($data);
				$score = Db::table("examination")->where("id",session("examId"))->value("score");
				foreach ($id as $key => $value) {
					$score += $value["score"];
				}
				Db::table("examination")->where("id",session("examId"))->setField("score",$score);

				Db::commit();
			}catch(\Exception $e){
				Db::rollback();
				return $handle->response(400,"添加失败");
			}
			return $handle->response(200,"添加成功");


		}

		//显示试卷详情
		public function showDetails($id){
			$handle = new Handle();
			$data = session("jqmtuser");

			$this->assign("data",$data);

			//发布试卷id
			$id = $handle->base64_decode($id);
			//学生id
			$sid = $handle->base64_decode(session("jqmsuser")["id"]);

			$exam = model("Published");
			$data = $exam->table(["examination","examineeanswer","published"])
				->where("published.id",$id)
				->where("examineeanswer.examination_id=published.id")
				->where("examineeanswer.student_id",$sid)
				->where("examination.id = published.exam_id")
				->field([
					"examination.examination_name" => "name",
					"published.strat" => "strat",
					"published.length" => "length",
					"published.size" => "size",
					"examination.score" => "score",
					"examineeanswer.performance" => "performance"
				])
				->select();
			$data = $handle->toArray($data);

			$this->assign("exam",$data[0]);

			$single = model("Pascal");

			//单选题
			$data = $single->table(["pascal","examinationtext","published"])
				->where("published.id",$id)
				->where("published.exam_id=examinationtext.examination_id")
				->where("examinationtext.pascal_id=pascal.id")
				->where("pascal.pattern_id","1")
				->field([
					"pascal.name" => "name",
					"pascal.options" => "options",
					"pascal.single_answer" => "Sanswer"
				])
				->select();

			$data = $handle->toArray($data);

			$answer = model("Examineeanswer");

			$answer = $answer::get(["examination_id"=>$id,"student_id"=>$sid]);
			$answer = $answer->toArray();

			foreach ($data as $key => $value) {
				$data[$key]["answer"] = $answer["pattern_one"][$key][1];
			}
		

			$this->assign("single",$data);

			//填空题
			$data = $single->table(["pascal","examinationtext","published"])
				->where("published.id",$id)
				->where("published.exam_id=examinationtext.examination_id")
				->where("examinationtext.pascal_id=pascal.id")
				->where("pascal.pattern_id","2")
				->field([
					"pascal.name" => "name",
					"pascal.completion_answer" => "answer"
				])
				->select();

			$data = $handle->toArray($data);

			foreach ($data as $key => $value) {
				$str = $value["name"];
				foreach ($answer["pattern_two"][$key]["answer"] as $key1 => $value1) {
					if($value1 == ""){
						$str=preg_replace("/___/","<span style='color:red;'>_空_</span>", $str,1);
					}else{
						$str=preg_replace("/___/","<span>".$value1."</span>", $str,1);
					}
					
				}
				$data[$key]["name"] = $str;
				$data[$key]["answer"] = str_replace("|_|","，", $data[$key]["answer"]);
			}

			
			$this->assign("completion",$data);


			//问答题
			$data = $single->table(["pascal","examinationtext","published"])
				->where("published.id",$id)
				->where("published.exam_id=examinationtext.examination_id")
				->where("examinationtext.pascal_id=pascal.id")
				->where("pascal.pattern_id","3")
				->field([
					"pascal.name" => "name",
					"pascal.essayquestion_answer" => "answer"
				])
				->select();

			$data = $handle->toArray($data);
			// return dump($answer);
			foreach ($data as $key => $value) {
				if($answer["pattern_three"][$key][1] == ""){
					$data[$key]["Eanswer"] = "<span style='color:red;'>空</span>";
				}else{
					$data[$key]["Eanswer"] = $answer["pattern_three"][$key][1];
				}
			}
			$this->assign("essay",$data);

			return view();
		}



		//修改
		public function alter($id){
			$request = Request::instance();
			$handle = new Handle();
			$data = session("jqmtuser");
			session("examId",$handle->base64_decode($id));
			$this->assign("data",$data);
			$question = model("Question");
			$tid = $handle->base64_decode(session("jqmtuser")['id']);
			$questionData = $question::all(["teacher_id"=>$tid]);
			$data = $handle->toArray($questionData);
			$this->assign("question",$data);

			$pascal = model("Pascal");
			//试卷id
			$this->assign("idpascal",$id);
			$id = $handle->base64_decode($id);

			$data = $pascal->table(["pascal","examinationtext","knowledge","pattern"])
				->where("pascal.id=examinationtext.pascal_id")
				->where("pascal.pattern_id=pattern.id")
				->where("pascal.knowledge_id=knowledge.id")
				->where("examinationtext.examination_id",$id)
				->field([
					"pascal.id" => "id",
					"examinationtext.id" => "tid",
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
				])->select();
			$this->assign("questionPascal",$data);

			return view();
		}

		//删除
		public function delete(){
			//初始化
			$request = Request::instance();
			$handle = new Handle();

			//试卷id
			$id = $request->post("id");

			$id = explode(",",$id);
			$ids = [];
			foreach ($id as $key => $value) {
				# code...
				$ids[$key]=$handle->base64_decode($value);
			}

			//实例化题库模型
			$examination = model("Examination");

			if(sizeof($ids)==1){
				$id = $handle->base64_decode($id[0]);
			
				if($examination::destroy($id) == 1){
					return $handle->response(200,"删除成功");
				}else{
					return $handle->response(400,"删除失败");
				}
			}

			if($examination::destroy($ids)>= 1){
				return $handle->response(200,"删除成功");
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