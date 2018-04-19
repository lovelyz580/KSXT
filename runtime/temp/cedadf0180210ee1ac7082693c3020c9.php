<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"D:\phpStudy\WWW\ksxt\public/../application/index\view\examinationtext\see.html";i:1516523898;s:79:"D:\phpStudy\WWW\ksxt\public/../application/index\view\teacher\alterDetails.html";i:1516264793;}*/ ?>
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
    
	<title>试卷预览</title>
	<link rel="stylesheet" type="text/css" href="__STATIC__/css/examinationtext/exam.css">
	
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
                                    <a href="<?php echo url('index/Teacher/esc'); ?>">退出登录</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        
	<div class="panel">
		<div class="panel-heading">
			试卷预览
		</div>
		<div class="panel-body">
			<h2 class="text-center"><?php echo $name['examination_name']; ?></h2>
			<?php if(!(!$single)): ?>
			<div class="single">
				<h3>一、单选题</h3>
				<?php if(is_array($single) || $single instanceof \think\Collection || $single instanceof \think\Paginator): $k = 0; $__LIST__ = $single;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($k % 2 );++$k;?>
				<div class="row">
					<p><pre><?php echo $k; ?>、<?php echo $value['name']; ?></pre></p>
					<p class="opt <?php if($value['answer'] == 1): ?>answer<?php endif; ?>">A <?php echo $value['options'][0]; ?></p>
					<p class="opt <?php if($value['answer'] == 2): ?>answer<?php endif; ?>">B <?php echo $value['options'][1]; ?></p>
					<p class="opt <?php if($value['answer'] == 3): ?>answer<?php endif; ?>">C <?php echo $value['options'][2]; ?></p>
					<p class="opt <?php if($value['answer'] == 4): ?>answer<?php endif; ?>">D <?php echo $value['options'][3]; ?></p>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<?php endif; if((!(!$completion))): ?>
			<div class="completion">
				<h3>二、填空题</h3>
				<?php if(is_array($completion) || $completion instanceof \think\Collection || $completion instanceof \think\Paginator): $k = 0; $__LIST__ = $completion;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($k % 2 );++$k;?>
				<div class="row">
					<p><?php echo $k; ?>、<?php echo $value['name']; ?></p>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<?php endif; if(!(!$essay)): ?>
			<div class="essay">
				<h3>三、问答题</h3>
				<?php if(is_array($essay) || $essay instanceof \think\Collection || $essay instanceof \think\Paginator): $k = 0; $__LIST__ = $essay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($k % 2 );++$k;?>
				<div class="row">
					<p><?php echo $k; ?>、<?php echo $value['name']; ?></p>
					<p class="answer"><?php echo $value['essayquestion_answer']; ?></p>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<?php endif; ?>
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