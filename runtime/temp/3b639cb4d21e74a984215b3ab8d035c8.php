<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"D:\phpStudy\WWW\ksxt\public/../application/index\view\published\see.html";i:1517310865;s:79:"D:\phpStudy\WWW\ksxt\public/../application/index\view\teacher\alterDetails.html";i:1516264793;}*/ ?>
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
    
	<title>发布试卷查看</title>
	<link rel="stylesheet" type="text/css" href="__STATIC__/css/published/see.css">
	<script type="text/javascript" src="__STATIC__/js/published/see.js"></script>
	
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
						<li>班级试卷查看</li>
						<li class="pull-right">
							<button class="delete">删除</button>
						</li>
						<li class="pull-right">
							<button class="add">发布试卷</button>
						</li>
					</ul>
				</div>
				<div class="panel-body">
					<table class="table table-responsive">
						<thead>
							<td>
								<input type="checkbox" class="quanxuan">
							</td>
							<td>序号</td>
							<td>试卷名</td>
							<td>考试时间</td>
							<td>考试时长</td>
							<td>延误时长</td>
							<td>发布时间</td>
							<td>操作</td>
						</thead>
						<tbody>
							<?php if(is_array($pdata) || $pdata instanceof \think\Collection || $pdata instanceof \think\Paginator): $k = 0; $__LIST__ = $pdata;if( count($__LIST__)==0 ) : echo "<tr><td colspan='8'><h4 class='text-center'>还没有试卷，赶快发布吧！</h4></td></tr>" ;else: foreach($__LIST__ as $key=>$value): $mod = ($k % 2 );++$k;?>
							<tr>
								<td>
									<input type="checkbox" value="<?php echo $value['id']; ?>">
								</td>
								<td><?php echo $k; ?></td>
								<td><a href="<?php echo url('index/Examination/seeStuDes',['id'=>$value['id']]); ?>"><?php echo $value['name']; ?></a></td>
								<td><?php echo $value['strat']; ?></td>
								<td><?php echo $value['length']; ?></td>
								<td><?php echo $value['size']; ?></td>
								<td><?php echo $value['date']; ?></td>
								<td>
									<button value="<?php echo $value['id']; ?>" class="alter">编辑</button>
								</td>
							</tr>
							<?php endforeach; endif; else: echo "<tr><td colspan='8'><h4 class='text-center'>还没有试卷，赶快发布吧！</h4></td></tr>" ;endif; ?>
						</tbody>
					</table>
				</div>
			</div>
        </div>
    </div>
    <div class="panel edit">
    	<div class="panel-heading">
    		发布试卷
    	</div>
    	<div class="panel-body">
    		<form class="form form-horizontal">
    			<div class="form-group">
    				<label class="control-label col-xs-12 col-lg-4 col-md-5 col-sm-5">试卷名称：</label>
    				<div class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
    					<select class="form-control name">
    						<?php if(is_array($edata) || $edata instanceof \think\Collection || $edata instanceof \think\Paginator): $i = 0; $__LIST__ = $edata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
    						<option value="<?php echo $value['id']; ?>"><?php echo $value['examination_name']; ?></option>
    						<?php endforeach; endif; else: echo "" ;endif; ?>
    					</select>
    				</div>
    			</div>
    			<div class="form-group">
    				<label class="control-label col-xs-12 col-lg-4 col-md-5 col-sm-5">考试时间：</label>
    				<div class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
    					<input type="datetime-local" class="form-control strat">
    				</div>
    			</div>
    			<div class="form-group">
    				<label class="control-label col-xs-12 col-lg-4 col-md-5 col-sm-5">考试时长：</label>
    				<div class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
    					<input type="number" class="form-control length" placeholder="请输入与考试时长">
    				</div>
    			</div>
    			<div class="form-group">
    				<label class="control-label col-xs-12 col-lg-4 col-md-5 col-sm-5">延误时长</label>
    				<div class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
    					<input type="number" class="form-control size" placeholder="请输入延误时长">
    				</div>
    			</div>
    		</form>
    		<div class="btngroup text-center">
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