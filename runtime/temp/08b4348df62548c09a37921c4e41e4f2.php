<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"D:\phpStudy\WWW\ksxt\public/../application/index\view\student\see.html";i:1517479697;s:79:"D:\phpStudy\WWW\ksxt\public/../application/index\view\teacher\alterDetails.html";i:1516264793;}*/ ?>
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
    
	<title>班级-学生查看</title>
	<link rel="stylesheet" type="text/css" href="__STATIC__/css/student/see.css">
	<script type="text/javascript" src="__STATIC__/js/student/see.js"></script>
	
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
						<li>学生查看</li>
						<li class="pull-right">
							<button class="delete">移出</button>
						</li>
					</ul>
				</div>
				<div class="panel-body">
					<table class="table-responsive table">
						<thead>
							<td>
								<input type="checkbox" class="quanxuan">
							</td>
							<td>学号</td>
							<td>姓名</td>
							<td>性别</td>
							<td>院系</td>
							<td>班级</td>
							<td>电子邮件</td>
						</thead>
						<tbody>
							<?php if(is_array($sdata) || $sdata instanceof \think\Collection || $sdata instanceof \think\Paginator): $i = 0; $__LIST__ = $sdata;if( count($__LIST__)==0 ) : echo "<tr><td colspan='7'><h4 class='text-center'>该班级还没有学生报名</h4></td></tr>" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
							<tr>
								<td>
									<input type="checkbox" value="<?php echo $value['id']; ?>">
								</td>
								<td><?php echo $value['user']; ?></td>
								<td><?php echo $value['name']; ?></td>
								<td><?php echo $value['sex']; ?></td>
								<td><?php echo $value['fname']; ?></td>
								<td><?php echo $value['class']; ?></td>
								<td><?php echo $value['email']; ?></td>
							</tr>
							<?php endforeach; endif; else: echo "<tr><td colspan='7'><h4 class='text-center'>该班级还没有学生报名</h4></td></tr>" ;endif; ?>
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