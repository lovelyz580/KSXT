$(function(){
	$("#login").click(function(){
		//角色类型
		var role = $(".form select option:selected").val();
		//用户名
		var user = $(".form input[name=user]").val().trim();
		//密码
		var pwd = $(".form input[name=password]").val();
		//验证码
		var captcha = $(".form input[name=captcha]").val().trim();

		if(user == ""){
			$(".form input[name=user]").val("");
			hint("用户名不能为空");
			return;
		}else{
			var partten = /^[a-zA-Z0-9_]{6,15}$/;
			if(!user.match(partten)){
				$(".form input[name=user]").val("");
				hint('用户名或密码错误');
				return;
			}
		}

		if(pwd == ""){
			$(".form input[name=password]").val("");
			hint('密码不能为空');
			return;
		}else{
			var partten = /^[a-zA-Z0-9_]{6,15}$/;
			if(!pwd.match(partten)){
				$(".form input[name=password]").val("");
				hint('用户名或密码错误');
				return;
			}
		}

		if(captcha == ""){
			$(".form input[name=captcha]").val("");
			hint("验证码不能为空");
			return;
		}else{
			var partten = /^[a-zA-Z0-9]{4}$/;
			if(!captcha.match(partten)){
				$(".form input[name=captcha]").val("");
				hint('验证码错误');
				return;
			}
		}
		
		$.post("/ksxt/public/le",{
			"type" : role,
			"user" : user,
			"password" : pwd,
			"captcha" : captcha
		},function(data){
			data = JSON.parse(data);
			if(data.code == 400){
				$(".form input[name=password]").val("");
				$(".form input[name=captcha]").val("");
				var yzm = $("#captcha").attr("src");
				$("#captcha").attr("src",yzm);
				hint(data.message);
			}else if(data.code == 200){
				window.location.href=data.message;
			}
		});

	});

	function hint(value){
		$("#hint").html(value).fadeIn(500,function(){
			setTimeout(function(){
				$("#hint").fadeOut(500);
			}, 1000);
		});
	}

	//点击验证码更换图片
	$("#captcha").click(function(){
		var yzm = $("#captcha").attr("src");
		$("#captcha").attr("src",yzm);
	});
	//点击换一张按钮更换一张
	$("#yzm").click(function(){
		var yzm = $("#captcha").attr("src");
		$("#captcha").attr("src",yzm);
	});
});