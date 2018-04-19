$(function(){

	//删除
	$(".delete").click(function(){
		var length = $(".options .active").length;

		if(length >= 1){
			$.post("/ksxt/public/deleteCourse",{
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
		}else{
			hint("请选择一个");
		}
	});


	//重命名
	$(".rename").click(function(){
		var length = $(".options .active").length;

		if(length == 1){
			$(".cname .panel-heading span").html("重命名");
			$(".cname input").val($(".options .active").next().next().html());
			$(".cname .save").attr("t","s");
			$(".cname").fadeIn(500);
		}else{
			hint("请选择一个");
		}

	});



	//选择课程
	$(".options span").click(function(){
		if(!$(this).attr('st')){
			$(this).addClass("active");
			$(this).attr('st',"t");
		}else{
			$(this).removeClass("active");
			$(this).attr('st',null);
		}
	})


	//保存课程名称
	$(".cname .save").click(function(){
		var value = $(".cname input").val().trim();
		if(value == ""){
			hint("名称不能为空");
			return;
		}else{
			var pattern = /[~!@#$%^&*<>]/;
			if(value.match(pattern)){
				hint("名称不能包含特殊字符");
				return;
			}
		}

		var type = $(this).attr("t");
		if(type == "s"){
			//修改
			$.post("/ksxt/public/addCourse",{
				id : function(){
					var st = $(".options .active").attr("value");
					return st;
				},
				name : value,
				alter: "jqm"
			},function(data){
				data = JSON.parse(data);
				if(data.code == 200){
					$(".options .active").next().next().html(value);
					$(".options .active").removeClass("active");
					$(".cname").fadeOut(500);
				}else{
					hint(data.message);
				}
			});
		}else{
			//新增
			$.post("/ksxt/public/addCourse",{
				name : value
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


	//新增课程
	$(".addCourse").click(function(){
		$(".cname .panel-heading span").html("新增课程");
		$(".cname input").val("");
		$(".cname .save").attr("t","n");
		$(".cname").fadeIn(500);
	});

	//取消对话框
	$(".cname .esc").click(function(){
		$(".cname").fadeOut(500);
	});


});