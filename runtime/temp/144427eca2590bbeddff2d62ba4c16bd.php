<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"D:\phpStudy\WWW\ksxt1\public/../application/index\view\question\select.html";i:1515722096;s:80:"D:\phpStudy\WWW\ksxt1\public/../application/index\view\teacher\alterDetails.html";i:1516180014;}*/ ?>
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
    
    <title>题库-题库查看</title>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/question/question.css">
    <script type="text/javascript" src="__STATIC__/js/question/question.js"></script>
    
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
            <div class="panel text-left">
                <div class="panel-heading">
                    全部题库
                    <ul class="list-unstyled list-inline pull-right">
                        <li>
                            <div class="form-group has-success has-feedback" style="width:200px; display: inline-block;">
                            	<form method="post" action="<?php echo url('index/Question/search'); ?>" id="form">
	                                <div class="input-group">
	                                    <input type="text" class="form-control" placeholder="搜索题库..." name="search">
	                                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
	                                </div>
	                            </form>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-unstyled list-inline pull-right">
                        <li>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default altercover">
                                    <span></span> 修改
                                </button>
                                <button type="button" class="btn btn-default rename">重命名</button>
                                <button type="button" class="btn btn-default delete">
                                    <span></span> 删除
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="panel-body">
                    <?php if(is_array($question) || $question instanceof \think\Collection || $question instanceof \think\Paginator): $i = 0; $__LIST__ = $question;if( count($__LIST__)==0 ) : echo "
						<div class='empty text-center'>
							<p>没有查询到题库，快来创建吧！</p>
							<a href='selectQuestion'>创建题库</a>
						</div>
                    " ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                    <div class="option">
                        <div class="radio">
                            <label value="<?php echo $value['id']; ?>">
                            </label>
                        </div>
                        <a href="<?php echo url('index/Pascal/see',['id'=>$value['id']]); ?>">
                        	<img src="<?php echo $value['question_img']; ?>" class="img-responsive">
                        </a>
                        <p><?php echo $value['question_name']; ?></p>
                    </div>
                    <?php endforeach; endif; else: echo "
						<div class='empty text-center'>
							<p>没有查询到题库，快来创建吧！</p>
							<a href='selectQuestion'>创建题库</a>
						</div>
                    " ;endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- 修改题库信息 -->
    <div class="alter text-center">
        <p>题库封面</p>
        <div class="img">
            <input type="file">
            <img src="__STATIC__/images/question/u589.png" class="img-responsive">
            <button>修改封面</button>
        </div>
        <p>题库简介</p>
        <textarea class="form-control"></textarea>
        <div class="alterbtn">
            <button>保存</button>
            <button>关闭</button>
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
				<input type="text" class="form-control">
				<div class="namebtn">
					<button>重命名</button>
					<button>取消</button>
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