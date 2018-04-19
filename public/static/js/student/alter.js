$(function () {
    $(".tx").hover(function () {
        $(".tx button").fadeIn(500);
    }, function () {
        $(".tx button").fadeOut(500);
    });

    //修改字段
    $("#alter a").click(function () {
        var name = $("#form input[name=name]").val().trim();
        var sex = $("#form input:checked").val();
        var email = $("#form input[name=email]").val().trim();
        var yx = $("#form option:selected").val();
        var Class = $("#form input[name=Class]").val().trim();
        var sign = $("#form input[name=sign]").val().trim();

        if (name == "") {
            hint("姓名不能为空");
            return;
        } else {
            var partten = /[~!@#$%^&*<>]/;
            if (name.match(partten)) {
                $("#form input[name=name]").val("");
                hint('姓名不能包含特殊字符');
                return;
            } else if (name.length > 15) {
                $("#form input[name=name]").val("");
                hint('姓名长度为1-15位');
                return;
            }
        }

        if (email == "") {
            hint("电子邮件不能为空");
            return;
        } else {
            var partten = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/;
            if (!email.match(partten)) {
                $("#form input[name=email]").val("");
                hint('电子邮件不能包含特殊字符');
                return;
            } else if (email.length > 30) {
                $("#form input[name=email]").val("");
                hint('电子邮件长度为1-30位');
                return;
            }
        }
                if (Class == "") {
            hint("班级不能为空");
            return;
        } else {
            var partten = /[~!@#$%^&*<>]/;
            if (name.match(partten)) {
                $("#form input[name=name]").val("");
                hint('班级不能包含特殊字符');
                return;
            } else if (name.length > 15) {
                $("#form input[name=name]").val("");
                hint('班级长度为1-15位');
                return;
            }
        }

        if (sign == "") {
            hint("个签不能为空");
            return;
        } else {
            var partten = /[~!@#$%^&*<>]/;
            if (sign.match(partten)) {
                $("#form input[name=name]").val("");
                hint('个签不能包含特殊字符');
                return;
            } else if (sign.length > 15) {
                $("#form input[name=name]").val("");
                hint('个签长度为1-30位');
                return;
            }
        }

        $.post("/ksxt/public/alterStudent", {
            name: name,
            sex: sex,
            email: email,
            yx: yx,
            class:Class,
            sign: sign
        }, function (data) {
            data = JSON.parse(data);
            if (data.code == 200) {
                window.location.href = data.message;
            } else if (data.code == 400) {
                hint(data.message);
            }
        });


    });


    //修改头像
    $("#alterImg").click(function () {
        $(".tx input").trigger("click");
    });

    $(".tx input").change(function () {
        var name = $(this).val();
        if (name != "") {
            var file = $(this).get(0).files;
            var status = efficacyName(file[0]);
            if (status == true) {
                var formData = new FormData();
                formData.append("file", file[0]);
                $.ajax({
                    url: "/ksxt/public/alterImg",
                    type: "post",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        console.log("正在进行");
                    },
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.code == 200) {
                            window.location.href = data.message;
                        } else if (data.code == 400) {
                            hint(data.message);
                        }
                        $(".tx input").val("");
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            } else {
                hint(status);
                $(this).val("");
            }
        }
    });



    //提示信息
});

//效验文件是否符合上传要求
function efficacyName(file) {
    var name = file.name;
    name = name.slice(-3);
    var arr = new Array("jpg", "jpeg", "png", "bmp");
    if (file.size > 1024 * 1024 * 1024 * 5) {
        // 头像不能大于5M
        return "文件不能大于5M";
    }
    for (var i = 0; i < arr.length; i++) {
        if (arr[i] == name) {
            return true;
        }
    }
    return "文件格式错误";
}

//提示信息
function hint(value) {
    $("#hint").html(value).fadeIn(500, function () {
        setTimeout(function () {
            $("#hint").fadeOut(500);
        }, 1000);
    });
}


//根据不同浏览器获取路径
function showPicture(imgFile) {
    return window.URL.createObjectURL(imgFile.files[0]);
}