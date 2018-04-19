$(function() {
    $(".option label").click(function() {
        if ($(this).attr("status") == "1") {
            $(this).attr("status", "2");
            $(this).removeClass("actives");
        } else {
            $(this).attr("status", "1");
            $(this).addClass("actives");
        }
    });


    //修改封面
    $(".alter .img button").click(function() {
        $(".img input").trigger("click");
    });

    //打开修改封面浮层
    $(".altercover").click(function() {
        var size = $(".actives").length;
        if (size != 1) {
            hint("请选择一个进行修改");
            return;
        }
        var id = $(".actives").attr("value");
        $.post("/ksxt/public/selectQ", {
            id: id
        }, function(data) {
            data = JSON.parse(data);
            if (data.code == 200) {
                $(".img img").attr("src", data.data.question_img);
                $(".alter textarea").val(data.data.brief);
                $(".alterbtn button:first-child").attr("qid", data.data.id);
                $(".alter").fadeIn(500);
            } else {
                hint("请稍后再试");
            }

        });


    });

    //关闭修改封面浮层
    $(".alterbtn button:last-child").click(function() {
        $(".alter").fadeOut(500);
    });

    //保存简介
    $(".alterbtn button:first-child").click(function() {
        var id = $(this).attr("qid");

        var brief = $(".alter textarea").val().trim();

        if (brief == "") {
            hint("简介不能为空");
            return;
        }
        var partten = /[^~!@#$%^&*<>]/;
        if (!brief.match(partten)) {
            $(".alter textarea").val("");
            hint('简介不能包含特殊字符');
            return;
        }

        $.post("/ksxt/public/alterQuestion", {
            id: id,
            name: "jqm",
            brief: brief
        }, function(data) {
            data = JSON.parse(data);
            if (data.code == 200) {
                $(".alter").fadeOut(500, function() {
                    hint("修改成功");
                });
            } else if (data.code == 400) {
                hint(data.message);
            }
        });

    });

    //取消重命名
    $(".altername .panel-heading span").click(function() {
        $(".altername").fadeOut(500);
    });

    $(".altername .panel-body .namebtn button:last-child").click(function() {
        $(".altername").fadeOut(500);
    });

    //重命名
    $(".rename").click(function() {
        var size = $(".actives").length;
        if (size != 1) {
            hint("请选择一个进行修改");
            return;
        }
        var id = $(".actives").attr("value");
        $.post("/ksxt/public/selectQ", {
            id: id,
        }, function(data) {
            data = JSON.parse(data);
            if (data.code == 200) {
                //打开修改名称浮层
                $(".altername .panel-body input").val(data.data.question_name);
                $(".altername .panel-body .namebtn button:first-child").attr("qid", data.data.id);
                $(".altername").fadeIn(500);
            } else {
                hint("请稍后再试");
            }

        });

    });

    //保存名称
    $(".altername .panel-body .namebtn button:first-child").click(function() {
        var id = $(this).attr("qid");

        var name = $(".altername .panel-body input").val().trim();

        if (name == "") {
            hint("名称不能为空");
            return;
        } else if (name.length > 30) {
            hint("名称长度为1-30位");
            return;
        }


        var partten = /[^~!@#$%^&*<>]/;
        if (!name.match(partten)) {
            $(".alter textarea").val("");
            hint('名称不能包含特殊字符');
            return;
        }

        $.post("/ksxt/public/alterQuestion", {
            id: id,
            name: name,
            brief: "jqmdfd"
        }, function(data) {
            data = JSON.parse(data);
            if (data.code == 200) {
                $(".alter").fadeOut(500, function() {
                    $(".altername").fadeOut(500, function() {
                        var id = $(".altername .panel-body .namebtn button:first-child").attr("qid");
                        var d = $(".option .radio label[value=" + id + "]").parent().parent().children("p")[0];
                        $(d).html(name);
                        $(".actives").removeClass("actives");
                        hint("修改成功");
                    });
                });
            } else if (data.code == 400) {
                hint(data.message);
                return;
            }
        });


    })
    //删除
    $(".delete").click(function() {
        var size = $(".actives").length;
        if (size < 1) {
            hint("请选择一个进行修改");
            return;
        }

        $.post("deleteQuestion", {
            id: function() {
                var arr = [];
                $(".actives").each(function() {
                    arr.push($(this).attr("value"));
                });
                return arr;
            }
        }, function(data) {
            data = JSON.parse(data);
            if (data.code == 200) {
                window.location.href = data.message;
            } else {
                hint("删除失败");
            }

        });
    });

    //搜索
    $("#form .glyphicon-search").click(function() {
        $("#form").submit();
    });

    //上传封面
    $(".img input").change(function() {
        var id = $(".alterbtn button:first-child").attr("qid");
        var name = $(this).val();
        if (name != "") {
            var file = $(this).get(0).files;
            var status = efficacyName(file[0]);
            if (status == true) {
                var formData = new FormData();
                formData.append("file", file[0]);
                formData.append("id", id);

                $.ajax({
                    url: "/ksxt/public/alterCover",
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
                            var id = $(".alterbtn button:first-child").attr("qid");
                            var d = $(".option .radio label[value=" + id + "]").parent().parent().children("a")[0];
                            $($(d).children("img")[0]).attr("src",data.message);
                            $(".img img").attr("src",data.message);
                        } else if (data.code == 400) {
                            hint(data.message);
                        }
                        $(".tx input").val("");
                    },
                    error: function(data) {}
                });
            } else {
                $(this).val("");
                hint(status);
            }
        }
    });
})