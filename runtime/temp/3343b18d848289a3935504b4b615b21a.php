<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:94:"E:\phpstudy\PHPTutorial\WWW\ksxt\public/../application/index\view\student\personalDetails.html";i:1516258864;s:91:"E:\phpstudy\PHPTutorial\WWW\ksxt\public/../application/index\view\student\alterDetails.html";i:1516265980;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" type="text/css" href="__STATIC__/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/teacher/base.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/teacher/alter.css">
    <script type="text/javascript" src="__STATIC__/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="__STATIC__/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="__STATIC__/js/student/alter.js"></script>
    
        <title>学生-个人信息</title>
        
</head>

<body>
    <div class="container-fluid" style="background-image: url('<?php echo $data['skinImg']; ?>');">
        <div id="nav">
            <ul class="list-unstyled list-inline">
                <li>
                    <img src="__STATIC__/images/teacher/title.png">
                </li>
                
                
                <li>
                    <a href="<?php echo url('index/Studentper/ksxt'); ?>">考试信息</a>
                </li>
                
                
                <li class="tongzhi">
                    <ul class="list-unstyled list-inline">
                        <li>
                            <span id="skin"></span>
                        </li>
                        <li>
                            <span id="notice"></span>
                        </li>
                        <li id="head">
                            <span class="headImg" style="background-image: url('<?php echo $data['headimg']; ?>');"></span>
                            <ul class="list-unstyled" id="xiangxi">
                                <li>
                                    <span class="headImg" style="background-image: url('<?php echo $data['headimg']; ?>');"></span>
                                    <span id="sign"><?php echo $data['sign']; ?></span>
                                </li>
                                <li class="a">
                                    <a href="<?php echo url('index/Studentper/personalDetails'); ?>">个人资料</a>
                                </li>
                                <li class="a">
                                    <a href="#">修改密码</a>
                                </li>
                                <li class="a">
                                    <a href="<?php echo url('index/Studentper/esc'); ?>">退出登录</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        
        <div class="row">
            <div class="content">
                <div class="col-xs-5">
                    <div class="row text-right">
                        <div class="tx" style="background-image: url('<?php echo $data['headimg']; ?>');"></div>
                    </div>
                    <div class="row wenzi">
                        <p>你好啊</p>
                        <p><?php echo $data['name']; ?>&nbsp;同学</p>
                        <p>欢迎使用创客考试系统</p>
                    </div>
                </div>
                <div class="col-xs-7">
                    <div class="form-group">
                        <p>
                            <span>学号：</span>
                            <?php echo $data['user']; ?>
                        </p>
                        <p>
                            <span>性别：</span>
                            <?php echo $data['sex']; ?>
                        </p>

                        <p>
                            <span>院系：</span>
                            <?php echo $data['faculty']; ?>
                        </p>
                        <p>
                            <span>班级：</span>
                            <?php echo $data['class']; ?>
                        </p>
                        <p>
                            <span>电子邮箱：</span>
                            <?php echo $data['email']; ?>
                        </p>
                        <p>
                            <span>个签：</span>
                            <?php echo $data['sign']; ?>
                        </p>
                    </div>
                    <div class="row" id="alter">
                        <a href="<?php echo url('index/Studentper/alterDetails'); ?>">修改个人资料</a>
                    </div>
                    <a href="<?php echo url('index/Studentper/ksxt'); ?>" class="access">
                        进入创客考试
                    </a>
                </div>
            </div>
        </div>
        
        <div class="bottom">
            <p>考试系统</p>
            <p>Copyright &copy; 2016 , 创客小组. All right reserved.</p>
        </div>
        <div id="hint"></div>
    </div>
</body>

</html>