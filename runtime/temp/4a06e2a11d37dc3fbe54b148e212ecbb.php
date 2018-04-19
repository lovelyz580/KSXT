<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"D:\phpStudy\WWW\ksxt\public/../application/index\view\course\see.html";i:1518517009;s:79:"D:\phpStudy\WWW\ksxt\public/../application/index\view\teacher\alterDetails.html";i:1516264793;}*/ ?>
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
    
	<title>课程查看</title>
	<link rel="stylesheet" type="text/css" href="__STATIC__/css/course/see.css">
	<script type="text/javascript" src="__STATIC__/js/course/see.js"></script>
	
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
						<li>查看课程</li>
						<li class="pull-right">
							<button class="delete">删除</button>
						</li>
						<li class="pull-right">
							<button class="rename">重命名</button>
						</li>
						<li class="pull-right">
							<button class="addCourse">创建课程</button>
						</li>
					</ul>
				</div>
				<div class="panel-body">
					<?php if(is_array($dataC) || $dataC instanceof \think\Collection || $dataC instanceof \think\Paginator): $i = 0; $__LIST__ = $dataC;if( count($__LIST__)==0 ) : echo "<h4 class='text-center'>还没有课程，赶快创建吧！</h4>" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
					<div class="options pull-left">
						<span value="<?php echo $value['id']; ?>"></span>
						<a href="<?php echo url('index/Grade/see',['id'=>$value['id']]); ?>">
							<img src="__STATIC__/images/question/2ea074b2c20b425baadf2cec32badf36.jpg" class="img-responsive">
						</a>
						<p><?php echo $value['course_name']; ?></p>
					</div>
					<?php endforeach; endif; else: echo "<h4 class='text-center'>还没有课程，赶快创建吧！</h4>" ;endif; ?>
				</div>
			</div>
        </div>
    </div>
   	<div class="panel cname">
   		<div class="panel-heading">
   			<span>新增课程</span>
   		</div>
   		<div class="panel-body">
   			<div class="row">
   				<div class="col-xs-10 col-xs-offset-1">
   					<div class="form-group">
		   				<input type="text" placeholder="请输入课程名称" class="form-control">
		   			</div>
		   			<div>
		   				<button class="pull-left save">保存</button>
		   				<button class="pull-right esc">取消</button>
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