<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"D:\phpStudy\WWW\ksxt\public/../application/index\view\showpascal\datiPage.html";i:1516936289;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>开始答题-<?php echo $exam['name']; ?></title>
	<link rel="stylesheet" type="text/css" href="__STATIC__/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="__STATIC__/css/showpascal/pascal.css">
    <script type="text/javascript" src="__STATIC__/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="__STATIC__/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="__STATIC__/js/showpascal/pascal.js"></script>
    
</head>
<body>
	<div class="container">
		<div class="panel">
			<div class="panel-heading head">
				<h3 class="text-center"><?php echo $exam['name']; ?></h3>
				<div class="row">
					<div class="col-lg-4 col-lg-offset-1">
						<h4>考试时间：<?php echo $exam['strat']; ?></h4>
					</div>
					<div class="col-lg-3">
						<h4>考试时长：<?php echo $exam['length']; ?>分钟</h4>
					</div>
					<div class="col-lg-3">
						<h4>拖考时长：<?php echo $exam['size']; ?>分钟</h4>
					</div>
				</div>
				<div class="row">
					<p>注意：考试时间不要切换页面，切换页面视为提交试卷处理</p>
				</div>
			</div>
			<div class="panel-body">
				<!-- 单选题 -->
				<?php if(!(!$single)): ?>
				<div class="single panel">
					<div class="panel-heading">
						<h4>单选题</h4>
					</div>
					<div class="panel-body">
						<?php if(is_array($single) || $single instanceof \think\Collection || $single instanceof \think\Paginator): $k = 0; $__LIST__ = $single;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($k % 2 );++$k;?>
						<div class="row">
							<pre><?php echo $k; ?>、<?php echo $value['name']; ?></pre>
							
							<p>
								<input type="radio" name="<?php echo $value['id']; ?>" value="1">
								A、<?php echo $value['options'][0]; ?>
							</p>
							<p>
								<input type="radio" name="<?php echo $value['id']; ?>" value="2">
								B、<?php echo $value['options'][1]; ?>
							</p>
							<p>
								<input type="radio" name="<?php echo $value['id']; ?>" value="3">
								C、<?php echo $value['options'][2]; ?>
							</p>
							<p>
								<input type="radio" name="<?php echo $value['id']; ?>" value="4">
								D、<?php echo $value['options'][3]; ?>
							</p>
							
						</div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
				<?php endif; ?>
				<!-- 填空题 -->
				<?php if(!(!$completion)): ?>
				<div class="completion panel">
					<div class="panel-heading">
						<h4>填空题</h4>
					</div>
					<div class="panel-body">
						<?php if(is_array($completion) || $completion instanceof \think\Collection || $completion instanceof \think\Paginator): $k = 0; $__LIST__ = $completion;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($k % 2 );++$k;?>
						<p class="com" value=<?php echo $value['id']; ?>><?php echo $k; ?>、<?php echo $value['name']; ?></p>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						
					</div>
				</div>
				<?php endif; if(!(!$essay)): ?>
				<div class="essay panel">
					<div class="panel-heading">
						<h4>问答题</h4>
					</div>
					<div class="panel-body">
						<?php if(is_array($essay) || $essay instanceof \think\Collection || $essay instanceof \think\Paginator): $k = 0; $__LIST__ = $essay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($k % 2 );++$k;?>
						<div class="row">
							<p><?php echo $k; ?>、<?php echo $value['name']; ?></p>
							<textarea placeholder="填写答案" rows="5" name="<?php echo $value['id']; ?>"></textarea>
						</div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<div class="row text-right btngroup">
				<button class="btn btn-success submit" value="<?php echo $exam['id']; ?>">提交试卷</button>
			</div>
		</div>
	</div>
</body>
</html>