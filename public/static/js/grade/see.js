$(function(){


	//删除
	$(".delete").click(function(){
		if($(".options .active").length != 1){
			hint("请选择一个");
			return;
		}

		$.post("/ksxt/public/deleteClass",{
			id : function(){
				var st = [];
				$(".options .active").each(function(){
					st.push($(this).attr("value"));
				});
				return st;
			}
		},function(data){
			data = JSON.parse(data);
			if(data.code == 200){
				window.location.href="";
			}else{
				hint(data.message);
			}
		});
	});


	//编辑
	$(".alter").click(function(){
		if($(".options .active").length != 1){
			hint("请选择一个");
			return;
		}
		$.post("/ksxt/public/seed",{
			id : function(){
				return $(".options .active").attr("value");
			}
		},function(data){
			data = JSON.parse(data);
			if(data.code == 200){
				$(".grade .panel-heading").html("编辑课程");
				$(".grade .save").attr("st","so");
				$(".grade input[name=name]").val(data.data.class_name);
				$(".grade input[name=sum]").val(data.data.class_restrict);
				$(".grade input[name=code]").val(data.data.invitation_code);
				$(".grade").fadeIn(500);
			}else{
				hint('稍后再试');
			}
		});
		
	});


	//保存班级信息
	$(".grade .save").click(function(){
		var name = $(".grade input[name=name]").val().trim();
		var sum = $(".grade input[name=sum]").val().trim();
		var code = $(".grade input[name=code]").val().trim();

		if(name == ""){
			hint("班级名称不能为空");
			return;
		}else{
			var pattern = /[~!@#$%^&*<>]/;
			if(name.match(pattern)){
				hint("班级名称不能包含特殊字符");
				return;
			}
		}

		if(sum == ""){
			hint("人数不能为空");
			return;
		}else{
			var pattern = /^[\d]+$/;
			if(!sum.match(pattern)){
				hint("人数为数值型");
				return;
			}
		}

		if(code == ""){
			hint("邀请码不能为空");
			return;
		}else{
			var pattern = /[~!@#$%^&*<>]/;
			if(code.match(pattern)){
				hint("邀请码不能包含特殊字符");
				return;
			}
		}

		var type = $(this).attr("st");
		if(type == "s"){
			//添加
			$.post("/ksxt/public/addClass",{
				name : name,
				sum : sum,
				code : code,
				add : "jqm"
			},function(data){
				data = JSON.parse(data);
				if(data.code == 200){
					window.location.href="";
				}else{
					hint(data.message);
				}
			});
		}else{
			//修改
			
			$.post("/ksxt/public/addClass",{
				name : name,
				sum : sum,
				code : code,
				id : function(){
					return $(".options .active").attr("value");
				}
			},function(data){
				data = JSON.parse(data);
				if(data.code == 200){
					window.location.href="";
				}else{
					hint(data.message);
				}
			});

		}
		

	});




	//新增班级
	$(".addgrade").click(function(){

		$(".grade .panel-heading").html("新增课程");
		$(".grade .save").attr("st","s");
		$(".grade input").val("");
		$(".grade").fadeIn(500);
	});



	//关闭模态框
	$(".esc").click(function(){
		$(".grade").fadeOut(500);
	});

	//选择班级
	$(".options span").click(function(){
		if(!$(this).attr("s")){
			$(this).addClass("active");
			$(this).attr("s","t");
		}else{
			$(this).removeClass("active");
			$(this).attr("s",null);
		}
	});


	//鼠标移动显示学生试卷按钮
	$(".options>div").hover(function(){
		$(this).children("a").slideDown(300);
	},function(){
		$(this).children("a").slideUp(300);
	});


});