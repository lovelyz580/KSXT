<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\phpStudy\WWW\ksxt\public/../application/index\view\teacher\alterDetails.html";i:1516264793;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" type="text/css" href="__STATIC__/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/teacher/base.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/teacher/alter.css">
    <script type="text/javascript" src="__STATIC__/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="__STATIC__/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="__STATIC__/js/teacher/alter.js"></script>
    
    <title>教师-修改信息</title>
    
</head>

<body>
    <div class="container-fluid" style="background-image: url('<?php echo $data['skinImg']; ?>');">
        <div id="nav">
            <ul class="list-unstyled list-inline">
                <li>
                    <img src="__STATIC__/images/teacher/title.png">
                </li>
                
                <li>
                    <a href="<?php echo url('index/Question/select'); ?>">题库管理</a>
                </li>
                
                
                <li>
                    <a href="<?php echo url('index/Examination/see'); ?>">试卷管理</a>
                </li>
                
                
                <li>
                    <a href="<?php echo url('index/Course/see'); ?>">课程管理</a>
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
                                    <a href="<?php echo url('index/Teacher/personalDetails'); ?>">个人资料</a>
                                </li>
                                <li class="a">
                                    <a href="#">修改密码</a>
                                </li>
                                <li class="a">
                                    <a href="<?php echo url('index/Teacher/esc'); ?>">退出登录</a>
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
                        <div class="tx" style="background-image: url('<?php echo $data['headimg']; ?>');">
                        	<input type="file" name="file">
                            <button id="alterImg">
                                修改头像
                            </button>
                        </div>
                    </div>
                    <div class="row wenzi">
                        <p>你好啊</p>
                        <p><?php echo $data['name']; ?>&nbsp;老师</p>
                        <p>欢迎使用创客考试系统</p>
                    </div>
                </div>
                <div class="col-xs-7">
                    <form class="form-horizontal" id="form">
                        <div class="form-group">
                            <label class="col-lg-3 col-md-3 col-sm-4 control-label">工号：</label>
                            <div class="col-lg-8 col-md-8 col-sm-7">
                                <p class="form-control-static"><?php echo $data['user']; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-md-3 col-sm-4 control-label">姓名：</label>
                            <div class="col-lg-8 col-md-8 col-sm-7">
                                <input type="text" name="name" value="<?php echo $data['name']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-md-3 col-sm-4 control-label">性别：</label>
                            <div class="col-lg-8 col-md-8 col-sm-7">
                                <label class="radio-inline">
                                    <input type="radio" name="sex" value="1" <?php echo $data['sex']=="男"?"checked":""; ?>> 男
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="sex" value="2" <?php echo $data['sex']=="女"?"checked":""; ?>> 女
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-md-3 col-sm-4 control-label">电子邮件：</label>
                            <div class="col-lg-8 col-md-8 col-sm-7">
                                <input type="text" name="email" value="<?php echo $data['email']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-md-3 col-sm-4 control-label">院系：</label>
                            <div class="col-lg-8 col-md-8 col-sm-7">
                                <select class="form-control">
                                	<?php if(is_array($faculty) || $faculty instanceof \think\Collection || $faculty instanceof \think\Paginator): $i = 0; $__LIST__ = $faculty;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                                		<option value="<?php echo $value['id']; ?>" <?php echo $value['faculty_name']==$data['faculty']?"selected":""; ?>><?php echo $value['faculty_name']; ?></option>
                                	<?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-md-3 col-sm-4 control-label">个签：</label>
                            <div class="col-lg-8 col-md-8 col-sm-7">
                                <input type="text" name="sign" value="<?php echo $data['sign']; ?>" class="form-control">
                            </div>
                        </div>
                    </form>
                    <div class="row" id="alter">
                        <a href="javascript:void(0);">保存</a>
                    </div>
                    <a href="<?php echo url('index/Question/select'); ?>" class="access">
						进入创客题库管理页
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