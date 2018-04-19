<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"D:\phpStudy\WWW\ksxt\public/../application/index\view\grade\see.html";i:1516205123;s:79:"D:\phpStudy\WWW\ksxt\public/../application/index\view\teacher\alterDetails.html";i:1516264793;}*/ ?>
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
    
	<title>班级查看</title>
	<link rel="stylesheet" type="text/css" href="__STATIC__/css/grade/see.css">
	<script type="text/javascript" src="__STATIC__/js/grade/see.js"></script>
	
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
                
                
    <li class="active">
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
        <div class="col-lg-11 col-md-10 col-sm-10 col-xs-9">
			<div class="panel text-left right">
				<div class="panel-heading">
					<ul class="list-unstyled list-inline">
						<li>班级管理</li>
						<li class="pull-right">
							<button class="delete">删除</button>
						</li>
						<li class="pull-right">
							<button class="alter">编辑</button>
						</li>
						<li class="pull-right">
							<button class="addgrade">新增</button>
						</li>
					</ul>
				</div>
				<div class="panel-body">
					<?php if(is_array($grade) || $grade instanceof \think\Collection || $grade instanceof \think\Paginator): $i = 0; $__LIST__ = $grade;if( count($__LIST__)==0 ) : echo "<h3 class='text-center'>还没有班级，赶快创建吧！</h3>" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
					<div class="options pull-left">
						<span value="<?php echo $value['id']; ?>"></span>
						<div>
							<img src="__STATIC__/images/question/bad62b5cdbd97bb11ca6a431b308d331.jpg" class="img-responsive">
							<a href="<?php echo url('index/Student/see',['id'=>$value['id']]); ?>" class="btn btn-danger">学生</a>
							<a href="<?php echo url('index/Published/see',['id'=>$value['id']]); ?>" class="btn btn-danger">试卷</a>
						</div>
						<p><?php echo $value['class_name']; ?></p>
					</div>
					<?php endforeach; endif; else: echo "<h3 class='text-center'>还没有班级，赶快创建吧！</h3>" ;endif; ?>
				</div>
			</div>
        </div>
    </div>
    <div class="panel grade">
    	<div class="panel-heading">
    		班级新增
    	</div>
    	<div class="panel-body">
    		<form class="form form-horizontal">
    			<div class="form-group">
    				<label class="control-label col-xs-4">名称：</label>
    				<div class="col-xs-6">
    					<input type="text" name="name" class="form-control" placeholder="输入课程名称">
    				</div>
    			</div>
    			<div class="form-group">
    				<label class="control-label col-xs-4">限制人数：</label>
    				<div class="col-xs-6">
    					<input type="number" name="sum" class="form-control" placeholder="班级容纳人数">
    				</div>
    			</div>
    			<div class="form-group">
    				<label class="control-label col-xs-4">邀请码：</label>
    				<div class="col-xs-6">
    					<input type="text" name="code" class="form-control" placeholder="进班钥匙">
    				</div>
    			</div>
    		</form>
    		<div class="text-center">
				<button class="save">保存</button>
				<button class="esc">取消</button>
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