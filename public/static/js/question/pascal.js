var opt = 0; //选项数据
$(function() {

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




    //查看按钮
    $(".btn-group button:first-child").click(function() {
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

    //编辑按钮
    $(".btn-group button:nth-child(2)").click(function() {
        var type = $(this).attr("t");
        var id = $(this).attr("value");
        if (type == "单选题") {
            $.post("/ksxt/public/seepid", {
                id: id
            }, function(data) {
                data = JSON.parse(data);
                if (data.code == 200) {
                    $(".editSingle .panel-heading span").html("编辑试题");
                    $(".editSingle .topic").val(data.data.name);
                    $(".editSingle .opt1").val(data.data.options[0]);
                    $(".editSingle .opt2").val(data.data.options[1]);
                    $(".editSingle .opt3").val(data.data.options[2]);
                    $(".editSingle .opt4").val(data.data.options[3]);
                    var answer = data.data.single_answer;
                    $(".editSingle .radio label").each(function() {
                        $(this).removeClass("active");
                    });
                    $(".editSingle .radio label[value=" + answer + "]").addClass("active");
                    $(".editSingle .score").val(data.data.score);
                    $(".editSingle .analysis").val(data.data.problems);
                    $(".editSingle .btngroup input:first-child").attr("values", data.data.id);
                    $(".editSingle .difficulty option[v=" + data.data.difficulty + "]").attr("selected", "selected");
                    $(".editSingle .know option[v=" + data.data.kname + "]").attr("selected", "selected");
                    $(".editSingle .btngroup input:first-child").attr("a", "jqm");
                    $(".editSingle").fadeIn(500);
                } else {
                    hint("请刷新后再试");
                }

            });
            $(".paneledit").fadeIn(500);
        } else if (type == "填空题") {
            $.post("/ksxt/public/seepid", {
                id: id
            }, function(data) {
                data = JSON.parse(data);
                if (data.code == 200) {
                    $(".editCompletion .panel-heading span").html("编辑试题");
                    $(".editCompletion .difficulty option[v=" + data.data.difficulty + "]").attr("selected", "selected");
                    $(".editCompletion .know option[v=" + data.data.kname + "]").attr("selected", "selected");

                    $(".editCompletion .topic").val(data.data.name.replace(/___/g, "|_|"));
                    opt = data.data.completion_answer.length;
                    $(".editCompletion .options").html("");
                    var st = data.data.name;
                    for (var i = 0; i < data.data.completion_answer.length; i++) {
                        var length = st.indexOf("___");
                        st = st.replace("___", "|_|");
                        var str = '<div class="form-group">';
                        str += '<div class="input-group">';
                        str += '<span class="input-group-addon">' + (i + 1) + '</span>';
                        str += '<input type="text" class="form-control" value="' + data.data.completion_answer[i] + '">';
                        str += '<span class="input-group-addon" onclick="deleteo(this)" v="' + length + '">删除</span>';
                        str += '</div></div>';
                        $(".editCompletion .options").append($(str));
                    }
                    $(".editCompletion .btngroup input:first-child").attr("values",data.data.id);
                    $(".editCompletion .analysis").val(data.data.problems);
                    $(".editCompletion .score").val(data.data.score);
                    $(".editCompletion").fadeIn(500);
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
                    $(".editEssay .panel-heading span").html("编辑试题");
                    $(".editEssay .difficulty option[v=" + data.data.difficulty + "]").attr("selected", "selected");
                    $(".editEssay .know option[v=" + data.data.kname + "]").attr("selected", "selected");
                    $(".editEssay .topic").val(data.data.name);
                    $(".editEssay .answer").val(data.data.essayquestion_answer);
                    $(".editEssay .analysis").val(data.data.problems);
                    $(".editEssay .score").val(data.data.score);
                    $(".editEssay .btngroup input:first-child").attr("values",data.data.id);
                    $(".editEssay").fadeIn(500);
                } else {
                    hint("请刷新后再试");
                }
            });
        }

    });
    //单选题保存按钮
    $(".editSingle .btngroup input:first-child").click(function() {
        var id = $(this).attr("values");
        var name = $(".editSingle .topic").val();
        var option1 = $(".editSingle .opt1").val();
        var option2 = $(".editSingle .opt2").val();
        var option3 = $(".editSingle .opt3").val();
        var option4 = $(".editSingle .opt4").val();
        var answer = $(".editSingle .radio label.active").attr("v");
        var socre = $(".editSingle .score").val();
        var problems = $(".editSingle .analysis").val(); //题解
        var difficulty = $(".editSingle .difficulty option:selected").val(); //难度
        var kname = $(".editSingle .know option:selected").val(); //知识点

        if (name == "") {
            hint("题干不能为空");
            return;
        } else {
            var pattern = /[~!@#$%^&*<>]/;
            if (name.match(pattern)) {
                hint("题干不能包含特殊字符");
                return;
            }
        }

        if (option1 != "" && option2 != "" && option3 != "" && option4 != "") {
            var pattern = /[~!@#$%^&*<>]/;
            if (!option1.match(pattern) && !option2.match(pattern) && !option3.match(pattern) && !option4.match(pattern)) {

            } else {
                hint("选项不能包含特殊字符");
                return;
            }
        } else {
            hint("选项不能为空");
            return;
        }

        if (socre == "") {
            hint("成绩不能为空");
            return;
        } else {
            var pattern = /^\d{1,3}$/;

            if (!socre.match(pattern)) {
                hint("成绩为1-100数字");
                return;
            }
        }
        if (problems != "") {
            var pattern = /[~!@#$%^&*<>]/;
            if (problems.match(pattern)) {
                hint("解析不能为特殊字符");
                return;
            }
        }
        if ($(this).attr("a") == "a") {
            $.post("/ksxt/public/alterSingle", {
                id: id,
                name: name,
                option1: option1,
                option2: option2,
                option3: option3,
                option4: option4,
                answer: answer,
                socre: socre,
                problems: problems,
                difficulty: difficulty,
                kname: kname,
                add: "jqm"
            }, function(data) {
                data = JSON.parse(data);
                if (data.code == 200) {
                    window.location.href = "";
                } else if (data.code == 400) {
                    hint(data.message);
                }
            });
            return;
        }
        $.post("/ksxt/public/alterSingle", {
            id: id,
            name: name,
            option1: option1,
            option2: option2,
            option3: option3,
            option4: option4,
            answer: answer,
            socre: socre,
            problems: problems,
            difficulty: difficulty,
            kname: kname
        }, function(data) {
            data = JSON.parse(data);
            if (data.code == 200) {
                window.location.href = "";
            } else if (data.code == 400) {
                hint(data.message);
            }
        });

    });
    var editCompletion = true;
    //填空题保存按钮
    $(".editCompletion .btngroup input:first-child").click(function() {
        var difficulty = $(".editCompletion .difficulty option:selected").attr("value"); //难度
        var knowledge = $(".editCompletion .know option:selected").attr("value"); //知识点
        var topic = $(".editCompletion .topic").val().trim();
        var score = $(".editCompletion .score").val().trim();
        var analysis = $(".editCompletion .analysis").val().trim();
        editCompletion = true;


        if (topic == "") {
            hint("题干不能为空");
            return;
        } else {
            var pattern = /[~!@#$%^&*]/;
            if (topic.match(pattern)) {
                hint("题干不能包含特殊字符");
                editCompletion = false;
                return;
            }
        }
        $(".options input").each(function() {
            var str = $(this).val().trim();
            if (str == "") {
                hint("选项不能为空");
                editCompletion = false;
                return;
            } else {
                var pattern = /[~!@#$%^&*_]/;
                if (str.match(pattern)) {
                    hint("选项不能包含特殊字符");
                    editCompletion = false;
                    return;
                }

            }
        });

        if (score == "") {
            hint("成绩不能为空");
            return;
        } else {
            var pattern = /^\d{1,3}$/;

            if (!score.match(pattern)) {
                hint("成绩为1-100数字");
                return;
            }

        }

        if (analysis != "") {
            var pattern = /[~!@#$%^&*_]/;
            if (analysis.match(pattern)) {
                hint("解析不能包含特殊字符");
                editCompletion = false;
                return;
            }
        }
        var id = $(this).attr("values");
        //是否提交数据
        if (editCompletion) {
            if ($(this).attr("a") == "a") {
                //添加
                $.post("/ksxt/public/alterCompletion", {
                    id : "jqm",
                    difficulty : difficulty,
                    knowledge : knowledge,
                    topic : topic,
                    score : score,
                    analysis : analysis,
                    add : "jqm",
                    answer : function() {
                        var str = [];
                        $(".options input").each(function() {
                            var st = $(this).val().trim();
                            str.push(st);
                        });
                        return str;
                    }

                }, function(data) {
                    data = JSON.parse(data);
                    if(data.code == 200){
                        window.location.href="";
                    }else{
                        hint("稍后再试");
                    }
                });
            } else {
                //编辑
                $.post("/ksxt/public/alterCompletion", {
                    id : id,
                    difficulty : difficulty,
                    knowledge : knowledge,
                    topic : topic,
                    score : score,
                    analysis : analysis,
                    answer : function() {
                        var str = [];
                        $(".options input").each(function() {
                            var st = $(this).val().trim();
                            str.push(st);
                        });
                        return str;
                    }

                }, function(data) {
                    data = JSON.parse(data);
                    if(data.code == 200){
                        window.location.href="";
                    }else{
                        hint("稍后再试");
                    }
                });
            }

        }
    });

    //简答题
    $(".editEssay .btngroup input:first-child").click(function(){
        var difficulty = $(".editEssay .difficulty option:selected").attr("value"); //难度
        var knowledge = $(".editEssay .know option:selected").attr("value"); //知识点
        var topic = $(".editEssay .topic").val().trim();
        var score = $(".editEssay .score").val().trim();
        var analysis = $(".editEssay .analysis").val().trim();
        var answer = $(".editEssay .answer").val().trim();

        if(topic == ""){
            hint("题干不能为空");
            return;
        }else{
            var pattern = /[~!@#$%^&*><_]/;
            if(topic.match(pattern)){
                hint("题干不能包含特殊字符");
                return;
            }
        }

        if(answer == ""){
            hint("答案不能为空");
            return;
        }else{
            var pattern = /[~!@#$%^&*><_]/;
            if(answer.match(pattern)){
                hint("答案不能包含特殊字符");
                return;
            }
        }

        if(analysis != ""){
            var pattern = /[~!@#$%^&*><_]/;
            if(analysis.match(pattern)){
                hint("题解不能包含特殊字符");
                return;
            }
        }

        if(score == ""){
            hint("成绩不能为空");
        }else{
            var pattern = /^\d{1,3}$/;
            if(!score.match(pattern)){
                hint("成绩为1-100数字");
                return;
            }
        }
        var id = $(this).attr("values");
        if($(this).attr("a") == "a"){
            $.post("/ksxt/public/addEssayquestion",{
                id : "jqm",
                difficulty : difficulty,
                knowledge : knowledge,
                topic : topic,
                score : score,
                analysis : analysis,
                answer : answer,
                add : "jqm"
            },function(data){
                data = JSON.parse(data);
                if(data.code == 200){
                    window.location.href="";
                }else{
                    hint("稍后再试");
                }
            });
        }else{
            $.post("/ksxt/public/addEssayquestion",{
                id : id,
                difficulty : difficulty,
                knowledge : knowledge,
                topic : topic,
                score : score,
                analysis : analysis,
                answer : answer
            },function(data){
                data = JSON.parse(data);
                if(data.code == 200){
                    window.location.href="";
                }else{
                    hint("稍后再试");
                }
            });

        }



    });

    //删除试题
    $(".deletePascal").click(function() {
        var id = $(this).attr("value");

        $.post("/ksxt/public/deletePascal", {
            id: id
        }, function(data) {
            data = JSON.parse(data);
            if (data.code == 200) {
                window.location.href = "";
            } else {
                hint(data.message);
            }
        });
    });

    //批量删除
    $(".deleteimg").click(function(){
        var length = $(".check input:checked").length;
        if(length > 0){
            $.post("/ksxt/public/deletes",{
                id : function(){
                    var str = [];
                    $(".check input:checked").each(function(){
                        str.push($(this).attr("value"));
                    });
                    return str;
                }
            },function(data){
                data = JSON.parse(data);
                if(data.code == 200){
                    window.location.href="";
                }else{
                    hint("请稍后再试");
                }
            });
        }else{
            hint("至少选择一个");
        }
    });
    var checked = false;

    //全选
    $(".quanxuan").change(function(){
        if(checked){
            $(".check input:checkbox").removeAttr("checked");
            checked = false;
        }else{
            $(".check input:checkbox").attr("checked","checked");
            checked = true;
        }
        
    });

    //添加单选试题
    $("#addSingle").click(function() {
        $(".editSingle .btngroup input:first-child").attr("a", "a");
        $(".editSingle .btngroup input:first-child").attr("values", "jqm");
        $(".editSingle .panel-heading span").html("添加试题");
        $(".editSingle .form-group input").val("");
        $(".editSingle .difficulty option:selected").removeAttr("selected");
        $(".editSingle .know option:selected").removeAttr("selected");
        $(".editSingle textarea").val("");
        $(".editSingle .radio label").each(function() {
            $(this).removeClass("active");
        });
        $(".editSingle").fadeIn(500);
    });

    //添加填空题
    $("#addCompletion").click(function() {
        opt = 0;
        $(".editCompletion .btngroup input:first-child").attr("a", "a");
        $(".editCompletion .btngroup input:first-child").attr("values", "jqm");
        $(".editCompletion .panel-heading span").html("添加试题");
        $(".editCompletion .options").html("");
        $(".editCompletion .form-group input").val("");
        $(".editCompletion .difficulty option:selected").removeAttr("selected");
        $(".editCompletion .know option:selected").removeAttr("selected");
        $(".editCompletion textarea").val("");
        

        $(".editCompletion .addoption").val("添加选项");
        $(".editCompletion").fadeIn(500);
    });

    //添加问答题
    $("#addEssay").click(function(){
        $(".editEssay .btngroup input:first-child").attr("a", "a");
        $(".editEssay .btngroup input:first-child").attr("values", "jqm");
        $(".editEssay .panel-heading span").html("添加试题");
        $(".editEssay .form-group input").val("");
        $(".editEssay .difficulty option:selected").removeAttr("selected");
        $(".editEssay .know option:selected").removeAttr("selected");
        $(".editEssay textarea").val("");
        $(".editEssay").fadeIn(500);
    });


    //单选题查看返回按钮
    $(".seeSingle .btngroup button").click(function() {
        $(".seeSingle").fadeOut(500);
    });
    //填空题返回按钮
    $(".seeCompletion .btngroup button").click(function() {
        $(".seeCompletion").fadeOut(500);
    });

    //单选题编辑返回按钮
    $(".editSingle .btngroup input:last-child").click(function() {
        $(".editSingle").fadeOut(500);
    });

    //填空题编辑返回按钮
    $(".editCompletion .btngroup input:last-child").click(function() {
        $(".editCompletion").fadeOut(500);
    });
    //填空题删除选项按钮
    $(".editCompletion .input-group span:last-child").click(function() {
        deleteo(this);
    });


    //添加填空题选项按钮

    $(".editCompletion .addoption").click(function() {
        opt++;
        if (opt < 6) {
            var length = $(".editCompletion .topic").val().length;
            var str = '<div class="form-group">';
            str += '<div class="input-group">';
            str += '<span class="input-group-addon">' + opt + '</span>';
            str += '<input type="text" class="form-control">';
            str += '<span class="input-group-addon" onclick="deleteo(this)" v="' + length + '">删除</span>';
            str += '</div></div>';
            $(".options").append($(str));
            str = $(".editCompletion .topic").val();
            $(".editCompletion .topic").val(str + "|_|");
        } else {
            hint("不能再添加了");
        }
    });


    //简答题查看返回按钮
    $(".seeEssay .btngroup button").click(function() {
        $(".seeEssay").fadeOut(500);
    });

    //简答题编辑返回按钮
    $(".editEssay .btngroup input:last-child").click(function() {
        $(".editEssay").fadeOut(500);
    });

    //返回按钮
    $(".panel-heading img").click(function() {
        $(".panel").fadeOut(500);
    });

    //单选题答案切换
    $(".editSingle .radio label").click(function() {
        $(".editSingle .radio label").each(function() {
            $(this).attr("class", "");
        });
        $(this).addClass("active");
    });

    //搜索试题
    $(".glyphicon-search").click(function(){
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
});

function deleteo(value) {
    $(value).parent().parent().remove();
    opt--;
    var str = $(".editCompletion .topic").val();
    var length = parseInt($(value).attr("v"));
    var stt1 = str.substring(0, length);
    var stt2 = str.substring(length + 3);
    $(".editCompletion .topic").val(stt1 + stt2);
}