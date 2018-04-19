$(function(){


	//提交答题内容
	$(".submit").click(function(){

		$.post("/ksxt/public/submitanswer",{
			single : function(){
				var single = [];
				$(".single input[type=radio]:checked").each(function(){
					var xh = $(this).attr("name");
					var answer = $(this).attr("value");
					single.push(xh + "-" + answer);
				});
				return single;
			},
			completion : function(){
				var completion = [];
				$(".completion .com").each(function(){
					var str = "";
					var i = 0;
					$(this).children("input[type=text]").each(function(){
						if(i==0){
							i++;
							str += $(this).val().trim();
						}else{
							str += "|_|" + $(this).val().trim();
						}
					});
					var key = $(this).attr("value");
					completion.push(key + "-" + str);
				});
				return completion;
			},
			essay : function(){
				var essay = [];
				$(".essay textarea").each(function(){
					var str = $(this).val().trim();
					var xh = $(this).attr("name");
					essay.push(xh + "-" + str);
				});
				return essay;
			},
			exam : $(".submit").attr("value")
		},function(data){
			data = JSON.parse(data);
			if(data.code==200){
				window.location.href="";
			}else{
				alert(data.message);
			}
		});

		


	});



});