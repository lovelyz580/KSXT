<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"D:\phpStudy\WWW\ksxt\public/../application/index\view\question\addPage.html";i:1515720901;s:79:"D:\phpStudy\WWW\ksxt\public/../application/index\view\teacher\alterDetails.html";i:1516264793;}*/ ?>
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
    
    <title>题库-新增题库</title>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/question/addpage.css">
	<script type="text/javascript" src="__STATIC__/js/question/addpage.js"></script>
    
</head>

<body>
    <div class="container-fluid" style="background-image: url('<?php echo $data['skinImg']; ?>');">
        <div id="nav">
            <ul class="list-unstyled list-inline">
                <li>
                    <img src="__STATIC__/images/teacher/title.png">
                </li>
                
    <li class="active">
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
        
    <div class="row middle">
        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-3">
            <ul class="list-unstyled left">
                <li class="seeQuestion">
                    <a href="<?php echo url('index/Question/select'); ?>">
							<span></span>查看题库
						</a>
                </li>
                <li class="addQuestion">
                    <a href="<?php echo url('index/Question/addPage'); ?>">
							<span></span>新增题库
						</a>
                </li>
            </ul>
        </div>
        <!-- 右边 -->
        <div class="col-lg-11 col-md-10 col-sm-10 col-xs-9 text-left">
            <div class="panel">
            	<div class="panel-heading">
	            	<h2 class="text-center">新建题库</h2>
            	</div>
            	<div class="panel-body">
            		<div class="row">
		            	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 cover">
		            		<h3>题库封面</h3>
		            		<input type="file" name="file">
		            		<div>
		            			<img src="__STATIC__/images/cover/589.png" class="img-responsive">
		            			<button class="shade">修改封面</button>
		            		</div>
		            	</div>
		            	<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
		            		<form class="form-horizontal">
		            			<div class="form-group">
		            				<label class="control-label col-xs-2">题库名称：</label>
		            				<div class="col-xs-5">
		            					<input type="text" placeholder="请输入题库名称" class="form-control">
		            				</div>
		            			</div>
		            			<div class="form-group">
		            				<label class="control-label col-xs-2">题库简介：</label>
		            				<div class="col-xs-5">
		            					<textarea class="form-control" rows="7" placeholder="请输入题库简介(可不填)"></textarea>
		            				</div>
		            			</div>
		            		</form>
		            		
		            	</div>
		            </div>
		            <div class="row text-center">
            			<button id="submit">创建题库</button>
            		</div>
            	</div>
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