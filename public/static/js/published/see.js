$(function(){


	$(".delete").click(function(){
		var length = $("tbody td>input:checked").length;
		if(length >= 1){
			$.post("/ksxt/public/deletePS",{
				id : function(){
					var st = [];
					$("tbody td>input:checked").each(function(){
						st.push($(this).attr("value"));
					});
					return st;
				}
			},function(data){
				data = JSON.parse(data);
				if(data.code==200){
					window.location.href="";
				}else{
					hint("稍后再试");
				}
			});
		}else{
			hint("请选择一个");
		}
	});


	//修改
	$(".alter").click(function(){
		var value = $(this).attr("value");
		
		$.post("/ksxt/public/getPD",{
			id:value
		},function(data){
			
			data = JSON.parse(data);
			if(data.code == 200){
				$(".edit .panel-heading").html("修改试卷");
				$(".edit .name option").each(function(){
					if($(this).html() == data.data.name){
						$(this).attr("selected","selected");
					}
				});
				$(".strat").val(data.data.strat);
				$(".length").val(data.data.length);
				$(".size").val(data.data.size);
				$(".save").attr("v",value);
				$(".save").attr("st","jqm");
				$(".edit").fadeIn(500);
			}
			
		});
	});



	$(".save").click(function(){
		var name = $(".name option:selected").attr("value");
		var strat = $(".strat").val();
		var length = $(".length").val().trim();
		var size = $(".size").val().trim();
		if(strat == ""){
			hint("请选择考试时间");
			return;
		}

		if(length == ""){
			hint("请输入考试时长");
			return;
		}else if(length<10){
			hint("请输入大于10分钟");
			return;
		}

		if(size == ""){
			hint("请输入延误时长");
			return;
		}



		if($(this).attr("st") == "s"){
			$.post("/ksxt/public/addPublished",{
				name : name,
				strat : strat,
				length : length,
				size : size,
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
			
			var id = $(this).attr("v");
			$.post("/ksxt/public/addPublished",{
				name : name,
				strat : strat,
				length : length,
				size : size,
				id : id
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


	//发布试卷
	$(".add").click(function(){
		$(".edit .panel-heading").html("发布试卷");
		$(".edit .save").attr("st","s");
		$(".edit input").val("");
		$(".edit").fadeIn(500);
	});

	//全选
	$(".quanxuan").click(function(){
		if($(this).attr("st") == "t"){
			$("tbody td>input").attr("checked",false);
			$(this).attr("st","f");
		}else{
			$("tbody td>input").attr("checked",true);
			$(this).attr("st","t");
		}
	});

	//取消按钮
	$(".esc").click(function(){
		$(".edit").fadeOut(500);
	});
});