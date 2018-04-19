$(function(){

    //批量删除
    $(".panel-heading li>button").click(function(){
        $.post("/ksxt/public/deleteExamination",{
            id : function(){
                var st = [];
                $("tbody td>input:checked").each(function(){
                    st.push($(this).attr("value"));
                });
                return st;
            }
        },function(data){
            data = JSON.parse(data);
            if(data.code == 200){
                window.location.href="";
            }else{
                hint("删除失败");
            }
        });
    });


    //全选复选框
    var status = false;
    $(".quanxuan").click(function(){
        if(status){
            $("tbody td>input[type=checkbox]").attr("checked",false);
            status = false;
        }else{
            $("tbody td>input[type=checkbox]").attr("checked",true);
            status = true;
        }
    });


    //保存试卷
    $(".addExam .panel-body .namebtn button:first-child").click(function(){
        var value = $("#inputExam").val().trim();

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
        var id = $(this).attr("value");

        $.post("/ksxt/public/addpascal",{
            name : value
        },function(data){

            if(data == "1"){
                window.location.href="/ksxt/public/addExamPage.html";
            }else{
                hint("稍后再试");
            }
        });
    });



    //添加试卷
    $(".panel-heading ul>li>a").click(function(){
        $(".addExam").fadeIn(500);
    });


    //取消添加试卷
    $(".addExam .panel-heading span").click(function() {
        $(".addExam").fadeOut(500);
    });

    $(".addExam .panel-body .namebtn button:last-child").click(function() {
        $(".addExam").fadeOut(500);
    });



	//搜索试卷
	$(".submit").click(function(){
		var search = $("#form input").val().trim();
        if(search ==""){
            hint("搜索不能为空");
            return;
        }else{
            var pattern = /[~!@#$%^&*<>]/;
            if(search.match(pattern)){
                hint("搜索不能包含特殊字符");
                return;
            }
        }
        
        $("#form").submit();
        $("#form input").val("");
	});



	//取消重命名
    $(".altername .panel-heading span").click(function() {
        $(".altername").fadeOut(500);
    });

    $(".altername .panel-body .namebtn button:last-child").click(function() {
        $(".altername").fadeOut(500);
    });

    //保存名称
    $(".altername .panel-body .namebtn button:first-child").click(function(){
    	var value = $("#inputName").val().trim();

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
    	var id = $(this).attr("value");

    	$.post("/ksxt/public/saveExamName",{
    		id : id,
    		name : value
    	},function(data){
    		data = JSON.parse(data);
    		if(data.code == 200){
    			var id = $(".altername .panel-body .namebtn button:first-child").attr("value");
    			$("."+id).html(data.message);
    			$("."+id).next().next().html(data.data.date);
    			$(".altername").fadeOut(500);
    		}else{
                hint(data.message);
            }
    	});

    });

    
   
});

//打开重命名
function edit(id,name){
	$("#inputName").val(name);
	$(".altername .panel-body .namebtn button:first-child").attr("value",id);
	$(".altername").fadeIn(500);
}

//删除试卷
function del(id){
	$.post("/ksxt/public/deleteExamination",{
		id : id
	},function(data){
		data = JSON.parse(data);
		if(data.code == 200){
			window.location.href="";
		}else{
			hint("删除失败");
		}
	});
}