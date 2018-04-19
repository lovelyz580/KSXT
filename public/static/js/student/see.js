$(function(){



	//删除
	$(".delete").click(function(){
		if($("tbody td input:checked").length >=1){
			$.post("/ksxt/public/deleteStu",{
				id : function(){
					var st = [];
					$("tbody td input:checked").each(function(){
						st.push($(this).attr("value"));
					});
					return st;
				}
			},function(data){
				data = JSON.parse(data);
				if(data.code == 200){
					window.location.href="";
				}else{
					hint("稍后再试");
				}
			});
		}else{
			hint("至少选择一个");
		}
	});

	$(".quanxuan").click(function(){
		if($(this).attr("st") == "t"){
			$("tbody td input[type=checkbox]").attr("checked",false);
			$(this).attr("st",'f');
		}else{
			$("tbody td input[type=checkbox]").attr("checked",true);
			$(this).attr("st",'t');
		}
		
	})

});