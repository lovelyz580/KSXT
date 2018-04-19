<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\phpStudy\WWW\ksxt\public/../application/index\view\examination\showDetails.html";i:1517132169;s:79:"D:\phpStudy\WWW\ksxt\public/../application/index\view\student\alterDetails.html";i:1516265978;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" type="text/css" href="__STATIC__/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/teacher/base.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/teacher/alter.css">
    <script type="text/javascript" src="__STATIC__/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="__STATIC__/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="__STATIC__/js/student/alter.js"></script>
    
    <title>学生-修改信息</title>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/examination/showDetails.css">
    
</head>

<body>
    <div class="container-fluid" style="background-image: url('<?php echo $data['skinImg']; ?>');">
        <div id="nav">
            <ul class="list-unstyled list-inline">
                <li>
                    <img src="__STATIC__/images/teacher/title.png">
                </li>
                
                
    <li>
        <a href="<?php echo url('index/Studentper/ksxt'); ?>">考试信息</a>
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
                                    <a href="<?php echo url('index/Studentper/personalDetails'); ?>">个人资料</a>
                                </li>
                                <li class="a">
                                    <a href="#">修改密码</a>
                                </li>
                                <li class="a">
                                    <a href="<?php echo url('index/Studentper/esc'); ?>">退出登录</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        
	<div class="container">
		<div class="panel">
			<div class="panel-heading">
				<ul class="list-unstyled list-inline text-center">
					<li><h3><?php echo $exam['name']; ?></h3></li>
				</ul>
				<ul class="list-unstyled">
					<li>考试时间：<?php echo $exam['strat']; ?></li>
					<li>考试时长：<?php echo $exam['length']; ?>分钟</li>
					<li>拖考时长：<?php echo $exam['size']; ?>分钟</li>
					<li>总分：<?php echo $exam['score']; ?>分</li>
					<li>成绩：<?php echo $exam['performance']; ?>分</li>
				</ul>
			</div>
			<div class="panel-body">
				<?php if(!(!$single)): ?>
				<div class="single">
					<h3>一、单选题</h3>
					<?php if(is_array($single) || $single instanceof \think\Collection || $single instanceof \think\Paginator): $k = 0; $__LIST__ = $single;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($k % 2 );++$k;?>
					<div class="row">
						<p><pre><?php echo $k; ?>、<?php echo $value['name']; ?></pre></p>
						<p class="opt <?php if($value['answer'] == 1 && $value['answer'] == $value['Sanswer']): ?>answer<?php endif; ?>" style="color:<?php if($value['answer'] == 1 && $value['answer'] != $value['Sanswer']): ?>red<?php endif; ?>;">A <?php echo $value['options'][0]; ?></p>
						<p class="opt <?php if($value['answer'] == 2 && $value['answer'] == $value['Sanswer']): ?>answer<?php endif; ?>" style="color:<?php if($value['answer'] == 2 && $value['answer'] != $value['Sanswer']): ?>red<?php endif; ?>;">B <?php echo $value['options'][1]; ?></p>
						<p class="opt <?php if($value['answer'] == 3 && $value['answer'] == $value['Sanswer']): ?>answer<?php endif; ?>" style="color:<?php if($value['answer'] == 3 && $value['answer'] != $value['Sanswer']): ?>red<?php endif; ?>;">C <?php echo $value['options'][2]; ?></p>
						<p class="opt <?php if($value['answer'] == 4 && $value['answer'] == $value['Sanswer']): ?>answer<?php endif; ?>" style="color:<?php if($value['answer'] == 4 && $value['answer'] != $value['Sanswer']): ?>red<?php endif; ?>;">D <?php echo $value['options'][3]; ?></p>
						<p><span>参考答案：
						<?php switch($value['Sanswer']): case "1": ?>A<?php break; case "2": ?>B<?php break; case "3": ?>B<?php break; case "4": ?>D<?php break; endswitch; ?>
						</span></p>
					</div>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<?php endif; if((!(!$completion))): ?>
				<div class="completion">
					<h3>二、填空题</h3>
					<?php if(is_array($completion) || $completion instanceof \think\Collection || $completion instanceof \think\Paginator): $k = 0; $__LIST__ = $completion;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($k % 2 );++$k;?>
					<div class="row">
						<p><?php echo $k; ?>、<?php echo $value['name']; ?></p>
						<p>参考答案：<span><?php echo $value['answer']; ?></span></p>
					</div>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<?php endif; if(!(!$essay)): ?>
				<div class="essay">
					<h3>三、问答题</h3>
					<?php if(is_array($essay) || $essay instanceof \think\Collection || $essay instanceof \think\Paginator): $k = 0; $__LIST__ = $essay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($k % 2 );++$k;?>
					<div class="row">
						<p><?php echo $k; ?>、<?php echo $value['name']; ?></p>
						<p class="answer"><?php echo $value['Eanswer']; ?></p>
						<p>参考答案：<span class="answer"><?php echo $value['answer']; ?></span></p>
					</div>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<?php endif; ?>
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