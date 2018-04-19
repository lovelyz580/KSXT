

$(function(){
	$(".cover>div").hover(function(){
		$(".shade").slideDown(500);
	},function(){
		$(".shade").slideUp(500);
	});


	$(".shade").click(function(){
		$(".cover input").trigger("click");
	});

	$(".cover input").change(function(){
		var name = $(this).val();
		if(name != ""){
			var file = $(this).get(0).files;
			var status = efficacyName(file[0]);
			if(status){
				var path = showPicture($(".cover input")[0]);
				if($(".newimg").get(0) == undefined){
					$(".cover>div img").remove();
					var str = "<img src='"+path+"' class='img-responsive newimg'>";
					$(".cover>div").append($(str));
				}else{
					$(".newimg").attr("src",path);
				}
			}else{
				var name = $(this).val("");
			}
		}
	});


	$("#submit").click(function(){
		var name = $("form input").val().trim();
		var brief = $("form textarea").val().trim();
		if(name == ""){
			hint("名称不能为空");
			return;
		}else{
			var partten = /[^~!@#$%^&*<>]/;
			if(!name.match(partten)){
				$("form input").val("");
				hint('名称不能包含特殊字符');
				return;
			}else if(name.length > 30){
				hint("名称长度为1-30位");
				return;
			}
		}

		if(brief!=""){
			var partten = /[^~!@#$%^&*<>]/;
			if(!brief.match(partten)){
				$("form textarea").val("");
				hint('简介不能包含特殊字符');
				return;
			}else if(name.length > 30){
				hint("简介长度为1-255位");
				return;
			}
		}

		var status = true;
		var file = "j";

		if($(".cover input").val()!=""){
			file = $(".cover input").get(0).files;
        	status = efficacyName(file[0]);
		}
		
        if (status == true) {
            var formData = new FormData();
            formData.append("file", file[0]);
            formData.append("name",name);
            formData.append("brief",brief);
            formData.append("id","jqm");
            $.ajax({
                url: "/ksxt/public/addQuestion",
                type: "post",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    console.log("正在进行");
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.code == 200) {
                        window.location.href = data.message;
                    } else if (data.code == 400) {
                        hint(data.message);
                    }
                    $(".tx input").val("");
                },
                error: function(data) {
                    console.log(data);
                }
            });
        } else {
            hint(status);
            $(this).val("");
        }
		

	});
});