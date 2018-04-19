<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"D:\phpStudy\WWW\ksxt1\public/../application/index\view\examination\see.html";i:1516162468;s:80:"D:\phpStudy\WWW\ksxt1\public/../application/index\view\teacher\alterDetails.html";i:1516180014;}*/ ?>
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
    
	<title>试卷</title>
	<link rel="stylesheet" type="text/css" href="__STATIC__/css/examination/examination.css">
	<script type="text/javascript" src="__STATIC__/js/examination/examination.js"></script>
	
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
                
                
    <li class="active">
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
                                    <a href="#">退出登录</a>
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
			<div class="panel text-left exam">
				<div class="panel-heading">
					<ul class="list-unstyled list-inline">
						<li>全部试卷</li>
						<li class="pull-right">
							<form action="<?php echo url('index/Examination/select'); ?>" method="post" id="form">
								<div class="form-group">
									<div class="input">
										<input type="text" name="search" class="form-control" placeholder="搜索试卷">
										<span class="submit glyphicon glyphicon-search"></span>
									</div>
								</div>
							</form>
						</li>
						<li class="pull-right"><button><span></span>删除</button></li>
						<li class="pull-right">
							<a href="javascript:void(0);">添加试卷</a>
						</li>
					</ul>
				</div>

				<div class="panel-body">
					<table class="table-responsive table text-center">
						<thead>
							<td width="20">
								<input type="checkbox" class="quanxuan">
							</td>
							<td>试卷名</td>
							<td>总分</td>
							<td>修改日期</td>
							<td>操作</td>
						</thead>
						<tbody>
							<?php if(is_array($examData) || $examData instanceof \think\Collection || $examData instanceof \think\Paginator): $i = 0; $__LIST__ = $examData;if( count($__LIST__)==0 ) : echo "<tr><td colspan='5'>暂无试卷，快来创建吧！</td></tr>" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
							<tr>
								<td>
									<input type="checkbox" value="<?php echo $value['id']; ?>">
								</td>
								<td class="<?php echo $value['id']; ?>"><a href="<?php echo url('index/Examinationtext/see',['id'=>$value['id']]); ?>"><?php echo $value['examination_name']; ?></a></td>
								<td><?php echo $value['score']; ?>分</td>
								<td><?php echo $value['examination_date']; ?></td>
								<td>
									<div class="btn-group">
										<a href="<?php echo url('index/Examination/alter',['id'=>$value['id']]); ?>" class="btn btn-primary">查看</a>
										<a href="javascript:void(0);" class="btn btn-primary" value="<?php echo $value['id']; ?>" onclick="edit('<?php echo $value['id']; ?>','<?php echo $value['examination_name']; ?>')">编辑</a>
										<a href="javascript:void(0);" class="btn btn-danger" onclick="del('<?php echo $value['id']; ?>')">删除</a>
									</div>
								</td>
							</tr>
							<?php endforeach; endif; else: echo "<tr><td colspan='5'>暂无试卷，快来创建吧！</td></tr>" ;endif; ?>
						</tbody>
					</table>
				</div>

			</div>
        </div>
    </div>
    <!-- 重命名 -->
	<div class="panel altername">
		<div class="panel-heading">
			重命名
			<span class="pull-right glyphicon glyphicon-remove"></span>
		</div>
		<div class="panel-body text-center">
			<div class="col-xs-9">
				<input type="text" class="form-control" id="inputName">
				<div class="namebtn text-left">
					<button>重命名</button>
					<button class="pull-right">取消</button>
				</div>
			</div>
		</div>
	</div>

	<!-- 添加试卷 -->
	<div class="panel addExam">
		<div class="panel-heading">
			添加试卷
			<span class="pull-right glyphicon glyphicon-remove"></span>
		</div>
		<div class="panel-body text-center">
			<div class="col-xs-9">
				<input type="text" class="form-control" id="inputExam" placeholder="请输入试卷名称">
				<div class="namebtn text-left">
					<button>确定</button>
					<button class="pull-right">取消</button>
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