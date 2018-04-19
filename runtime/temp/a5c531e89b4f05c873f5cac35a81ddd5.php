<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"D:\phpStudy\WWW\ksxt\public/../application/index\view\examination\seeStuDes.html";i:1517485811;s:79:"D:\phpStudy\WWW\ksxt\public/../application/index\view\teacher\alterDetails.html";i:1516264793;}*/ ?>
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
    
	<title>试卷考生信息查看</title>
	<link rel="stylesheet" type="text/css" href="__STATIC__/css/examination/studes.css">
	
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
			<div class="panel right text-left">
				<div class="panel-heading">
					<ul class="list-unstyled list-inline">
						<li>试卷考生信息查看</li>
					</ul>
				</div>
				<div class="panel-body">
					<table class="table-responsive table">
						<thead>
							<th>序号</th>
							<th>学号</th>
							<th>姓名</th>
							<th>性别</th>
							<th>班级</th>
							<th>成绩</th>
							<th>等级</th>
							<th>状态</th>
						</thead>
						<tbody>
							<?php if(is_array($student) || $student instanceof \think\Collection || $student instanceof \think\Paginator): $k = 0; $__LIST__ = $student;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($k % 2 );++$k;?>
							<tr>
								<td><?php echo $k; ?></td>
								<td><?php echo $value['user']; ?></td>
								<td><a href="#"><?php echo $value['name']; ?></a></td>
								<td><?php echo $value['sex']; ?></td>
								<td><?php echo $value['class']; ?></td>
								<td><?php echo $value['performance']; ?></td>
								<td><?php echo $value['rank']; ?></td>
								<td>已阅</td>
							</tr>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
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