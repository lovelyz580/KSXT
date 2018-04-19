<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"E:\phpstudy\PHPTutorial\WWW\ksxt\public/../application/index\view\index\login.html";i:1518517662;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>考试系统</title>
    <link rel="stylesheet" type="text/css" href="__STATIC__/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/login/base.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/login/login.css">
    <script type="text/javascript" src="__STATIC__/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="__STATIC__/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="__STATIC__/js/login/login.js"></script>
</head>

<body>
    <div class="loginbg">
        <!-- 头部 -->
        <div class="header">
            <img src="__STATIC__/images/login/title1.png">
        </div>
        <div class="middle">
            <!-- 表单 -->
            <div class="form">
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-2">
                        	<label class="control-label">角&nbsp;&nbsp;&nbsp;色:</label>
                        </div>
                        <div class="col-xs-6">
                        	<select class="form-control">
                        		<option value="0">学生</option>
                        		<option value="1">教师</option>
                        		<option value="2">管理员</option>
                        	</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-2">
                        	<label class="control-label">用户名:</label>
                        </div>
                        <div class="col-xs-6">
                        	<input type="text" name="user" class="form-control" placeholder="请输入用户名">
                        </div>
                        <div class="col-xs-4 info">
                        	<label class="control-label">
                        		<a href="<?php echo url('index/Index/register'); ?>">注册账号</a>
                        	</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-2">
                        	<label class="control-label">密&nbsp;&nbsp;&nbsp;码:</label>
                        </div>
                        <div class="col-xs-6">
                        	<input type="password" name="password" class="form-control" placeholder="请输入密码">
                        </div>
                        <div class="col-xs-4 info">
                        	<label class="control-label">
                        		<a href="#">忘记密码</a>
                        	</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-2">
                        	<label class="control-label">验证码:</label>
                        </div>
                        <div class="col-xs-3">
                        	<input type="text" name="captcha" class="form-control" placeholder="验证码">
                        </div>
                        <div class="col-xs-3">
                        	<img src="<?php echo captcha_src(); ?>" id="captcha">
                        </div>
                        <div class="col-xs-4 info">
                        	<label class="control-label">
                        		<a href="javascript:void;" id="yzm">看不清,换一张</a>
                        	</label>
                        </div>
                    </div>
                    <div class="form-group text-center">
                    	<button id="login">登录</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 底部 -->
        <div class="bottom">
            <p>考试系统</p>
            <p>Copyright © 2016 , 玩客小组. All right reserved.</p>
        </div>
        <div id="hint"></div>
    </div>
</body>

</html>