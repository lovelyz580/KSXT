$(function(){

    $(".panel-heading>ul>li>button").click(function(){
        var length = $("tbody td input:checked").length;
        if(length>0){
            //进行添加
            $.post("/ksxt/public/addExamination",{
                id : function(){
                    var val = [];
                    $("tbody td input:checked").each(function(){
                        val.push($(this).attr("value"));
                    });
                    return val;
                }
            },function(data){
                data = JSON.parse(data);
                if(data.code == 200){
                    hint(data.message);
                }else{
                    hint(data.message);
                }
            });
        }else{
            hint("请至少选择一个");
        }
    });



    //全选试题复选框
    var quanxuan = false;
    $("#quanxuan").change(function(){
        if(quanxuan){
            $("tbody td input[type=checkbox]").attr("checked",false);
            quanxuan = false;
        }else{
            $("tbody td input[type=checkbox]").attr("checked",true);
            quanxuan = true;
        }
        
    });



	
    //搜索
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
    });



    //单选解析按钮
    $(".seeSingle .consult button").click(function() {
        var html = $(this).html();
        if (html == "展开解析") {
            $(this).html("收起解析");
            $(".seeSingle .analysis").slideDown(500);
        } else {
            $(this).html("展开解析");
            $(".seeSingle .analysis").slideUp(500);
        }
    });

    //填空题解析按钮
    $(".seeCompletion .consult button").click(function() {
        var html = $(this).html();
        if (html == "展开解析") {
            $(this).html("收起解析");
            $(".seeCompletion .consult .analysis").slideDown(500);
        } else {
            $(this).html("展开解析");
            $(".seeCompletion .consult .analysis").slideUp(500);
        }
    });

    //问答题解析按钮
    $(".seeEssay .consult p>button").click(function() {
        var html = $(this).html();
        if (html == "展开解析") {
            $(this).html("收起解析");
            $(".seeEssay .consult .analysis").slideDown(500);
        } else {
            $(this).html("展开解析");
            $(".seeEssay .consult .analysis").slideUp(500);
        }
    });

    //单选题查看返回按钮
    $(".seeSingle .btngroup button").click(function() {
        $(".seeSingle").fadeOut(500);
    });
    //填空题返回按钮
    $(".seeCompletion .btngroup button").click(function() {
        $(".seeCompletion").fadeOut(500);
    });
    //简答题查看返回按钮
    $(".seeEssay .btngroup button").click(function() {
        $(".seeEssay").fadeOut(500);
    });

    //返回按钮
    $(".panel-heading img").click(function() {
        $(".panels").fadeOut(500);
    });

    //查看按钮
    $("table tbody tr td button").click(function() {
        var type = $(this).attr("t");
        var id = $(this).attr("value");
        if (type == "单选题") {
            //显示该试题信息
            $.post("/ksxt/public/seepid", {
                id: id
            }, function(data) {
                data = JSON.parse(data);
                if (data.code == 200) {
                    $(".seeSingle .name").html(data.data.name);
                    $(".seeSingle .option1").html(data.data.options[0]);
                    $(".seeSingle .option2").html(data.data.options[1]);
                    $(".seeSingle .option3").html(data.data.options[2]);
                    $(".seeSingle .option4").html(data.data.options[3]);
                    $(".seeSingle .answer").html(data.data.single_answer);
                    $(".seeSingle .score").html(data.data.score);
                    $(".seeSingle .difficulty").html(data.data.difficulty);
                    $(".seeSingle .analysis span").html(data.data.problems);
                    $(".seeSingle").fadeIn(500);
                } else {
                    hint("请刷新后再试");
                }

            });

        } else if (type == "填空题") {
            //显示该试题信息
            $.post("/ksxt/public/seepid", {
                id: id
            }, function(data) {
                data = JSON.parse(data);
                if (data.code == 200) {
                    $(".seeCompletion .topic").html(data.data.name);
                    for (var i = 0; i < data.data.completion_answer.length; i++) {
                        var str = '<p><span>答案' + (i + 1) + '：</span>' + data.data.completion_answer[i] + '</p>';
                        $(".seeCompletion .answer").append($(str));
                    }

                    $(".seeCompletion .analysis st").html(data.data.problems);
                    $(".seeCompletion .score").html(data.data.score);
                    $(".seeCompletion .difficulty").html(data.data.difficulty);
                    $(".seeCompletion").fadeIn(500);
                } else {
                    hint("请刷新后再试");
                }

            });

        } else if (type == "简答题") {
            $.post("/ksxt/public/seepid", {
                id: id
            }, function(data) {
                data = JSON.parse(data);
                if (data.code == 200) {
                    $(".seeEssay .topic").html(data.data.name);
                    $(".seeEssay .answer").html(data.data.essayquestion_answer);
                    $(".seeEssay .score").html(data.data.score);
                    $(".seeEssay .difficulty").html(data.data.difficulty);
                    $(".seeEssay .analysis st").html(data.data.problems);
                    $(".seeEssay").fadeIn(500);
                } else {
                    hint("请刷新后再试");
                }
            });
        }

    });

});

