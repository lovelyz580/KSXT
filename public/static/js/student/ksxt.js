$(function () {

	//浏览考过的试卷
	$("tbody td .a").click(function(){
		var d = $(this).attr("value");
		if(d == "正在考试"){
			return false;
		}
	});


	//开始考试
	$("tbody .btn-group a").click(function(){
		//判断是否是考试时间
		var id = $(this).attr("value");
		var th = $(this);
		

		$.ajax({
			type : "post",
			url : "/ksxt/public/ifExam",
			data : {
				id : id
			},
			async : false,
			success : function(data){
				data = JSON.parse(data);
				if(data.code == 200){
					window.location.href= th.attr("href");
				}else{
					hint(data.message);
				}
			},
			error : function(data){
				console.log(data);
			}
		});


		
		return false;
	
	});




	$(".save").click(function(){
		var teacher = $(".teacher option:selected").val();
		var course = $(".course option:selected").val();
		var grade = $(".class option:selected").val();
		var gradeCode = $(".code").val().trim();

		if(teacher == undefined){
			hint("请选择教师");
			return;
		}
		if(course == undefined){
			hint("请选择课程");
			return;
		}
		if(grade == undefined){
			hint("请选择班级");
			return;
		}

		if(gradeCode == ""){
			hint("授权码不能为空");
			return;
		}else{
			var pattern = /[~!@#$%^&*<>]/;
			if(gradeCode.match(pattern)){
				hint("授权码不能包含特殊字符");
				return;
			}
		}
		$.post("/ksxt/public/baoming",{
			teacher : teacher,
			course : course,
			grade : grade,
			code : gradeCode
		},function(data){
			data = JSON.parse(data);
			if(data.code == 200){
				window.location.href="";
			}else{
				hint(data.message);
			}
		});
	});



	//更换班级
	$(".course").change(function(){
		var id = $(this).children("option:selected").attr("value");
		$.post("/ksxt/public/th",{
			id : id,
			c : "jqm"
		},function(data){
			data = JSON.parse(data);
			if(data.code==200){
				$(".class").html("");
				for(var i = 0;i<data.data.length;i++){
					var str = "<option value='" + data.data[i].id + "'>";
						str += data.data[i].class_name;
						str += "</option>";
					$(".class").append($(str));
				}
			}
		});
	});


	//更换报名班级
	$(".teacher").change(function(){
		var id = $(this).children("option:selected").attr("value");
		$.post("/ksxt/public/th",{
			id : id
		},function(data){
			data = JSON.parse(data);
			if(data.code == 200){
				$(".course").html("");
				for(var i = 0;i<data.data.course.length;i++){
					var str = "<option value='" + data.data.course[i].id + "'>";
						str += data.data.course[i].course_name;
						str += "</option>";
					$(".course").append($(str));
				}
				$(".class").html("");
				for(var i = 0;i<data.data.class.length;i++){
					var str = "<option value='" + data.data.class[i].id + "'>";
						str += data.data.class[i].class_name;
						str += "</option>";
					$(".class").append($(str));
				}
			}
		});

	});



	//取消报名对话框
	$(".edit .esc").click(function(){
		$(".edit").fadeOut(500);
	});


	//打开报名对话框
    $(".baom").click(function () {
        $(".edit").fadeIn(500);
    });
});
