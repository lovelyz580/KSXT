<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"D:\phpStudy\WWW\ksxt\public/../application/index\view\examination\addPage.html";i:1516103527;s:79:"D:\phpStudy\WWW\ksxt\public/../application/index\view\teacher\alterDetails.html";i:1516264793;}*/ ?>
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
    
	<title>试卷-新增</title>
	<link rel="stylesheet" type="text/css" href="__STATIC__/css/examination/addExam.css">
	<script type="text/javascript" src="__STATIC__/js/examination/addExam.js"></script>
	
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
						<li>添加试题</li>
						<li class="pull-right">
							<form action="<?php echo url('index/Examination/searchExam'); ?>" method="post" id="form">
								<div class="form-group">
									<div class="input">
										<input type="text" name="search" class="form-control" placeholder="搜索试卷">
										<span class="submit glyphicon glyphicon-search"></span>
									</div>
								</div>
							</form>
						</li>
						<li id="patterns" class="pull-right">
							<span>全部题型</span>
							<ul class="list-unstyled text-center">
								<li><a href="#">全部题型</a></li>
								<li><a href="<?php echo url('index/Examination/seePatternExam',['id'=>1]); ?>">单选题</a></li>
								<li><a href="<?php echo url('index/Examination/seePatternExam',['id'=>2]); ?>">填空题</a></li>
								<li><a href="<?php echo url('index/Examination/seePatternExam',['id'=>3]); ?>">问答题</a></li>
							</ul>
						</li>
						<li class="pull-right" id="questions">
							<span class="text-center">题库</span>
							<ul class="list-unstyled text-center">
								<?php if(is_array($question) || $question instanceof \think\Collection || $question instanceof \think\Paginator): $i = 0; $__LIST__ = $question;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
								<li><a href="<?php echo url('index/Examination/seeExam',['id'=>$value['id']]); ?>"><?php echo $value['question_name']; ?></a></li>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</li>
						<li class="pull-right"><button>确认添加</button></li>
					</ul>
				</div>
				<div class="panel-body">
					<table class="table-responsive table">
						<thead>
							<td width="20">
								<input type="checkbox" id="quanxuan">
							</td>
							<td>序号</td>
							<td>题干</td>
							<td>题型</td>
							<td>难度</td>
							<td>知识点</td>
							<td>修改时间</td>
							<td>操作</td>
						</thead>
						<tbody>
							<?php if(is_array($questionPascal) || $questionPascal instanceof \think\Collection || $questionPascal instanceof \think\Paginator): $k = 0; $__LIST__ = $questionPascal;if( count($__LIST__)==0 ) : echo "<tr><td colspan='8' align='center'>还没有试题，快去添加吧！</td></tr>" ;else: foreach($__LIST__ as $key=>$value): $mod = ($k % 2 );++$k;?>
							<tr>
								<td>
									<input type="checkbox" value="<?php echo $value['id']; ?>">
								</td>
								<td><?php echo $k; ?></td>
								<td><?php echo $value['name']; ?></td>
								<td><?php echo $value['pname']; ?></td>
								<td><?php echo $value['difficulty']; ?></td>
								<td><?php echo $value['kname']; ?></td>
								<td><?php echo $value['date']; ?></td>
								<td>
									<button value="<?php echo $value['id']; ?>" t="<?php echo $value['pname']; ?>">查看</button>
								</td>
							</tr>
							<?php endforeach; endif; else: echo "<tr><td colspan='8' align='center'>还没有试题，快去添加吧！</td></tr>" ;endif; ?>
						</tbody>
					</table>
				</div>
			</div>
        </div>
    </div>
    <!-- 查看弹框 -->
    <div class="panel seeSingle panels">
        <div class="panel-heading">
            试题详情查看
            <img src="__STATIC__/images/question/u1865.png">
        </div>
        <div class="panel-body">
            <p class="name"></p>
            <p>A <span class="option1"></span></p>
            <p>B <span class="option2"></span></p>
            <p>C <span class="option3"></span></p>
            <p>D <span class="option4"></span></p>
            <div class="consult">
                <p>参考答案：<span class="answer"><span></p>
                <p>分数：<span class="score"></span></p>
                <p>困难度：<span class="difficulty"></span></p>
                <p class="text-right">
                    <button>展开解析</button>
                </p>
                <p class="analysis">解析：<span></span></p>
            </div>
            <div class="text-center btngroup">
                <button>返回</button>
            </div>
        </div>
    </div>
    <!-- 填空查看 -->
    <div class="panel seeCompletion panels">
        <div class="panel-heading">
            试题详情查看
            <img src="__STATIC__/images/question/u1865.png">
        </div>
        <div class="panel-body">
            <p class="topic"></p>
            <div class="consult">
                <p>参考答案：</p>
                <div class="answer"></div>
                <p><span>分数：</span>
                    <st class="score"></st>
                </p>
                <p><span>困难度：</span>
                    <st class="difficulty"></st>
                </p>
                <p class="text-right">
                    <button>展开解析</button>
                </p>
                <p class="analysis"><span>解析：</span>
                    <st></st>
                </p>
            </div>
            <div class="btngroup text-center">
                <button>返回</button>
            </div>
        </div>
    </div>
    <!-- 问答题 -->
    <div class="panel seeEssay panels">
        <div class="panel-heading">
            <span>查看试题详情</span>
            <img src="__STATIC__/images/question/u1865.png">
        </div>
        <div class="panel-body">
            <p class="topic"></p>
            <div class="consult">
                <p><span>参考答案：</span>
                    <st class="answer"></st>
                </p>
                <p><span>分数：</span>
                    <st class="score"></st>
                </p>
                <p><span>困难度：</span>
                    <st class="difficulty"></st>
                </p>
                <p class="text-right">
                    <button>展开解析</button>
                </p>
                <p class="analysis"><span>题解：</span>
                    <st></st>
                </p>
            </div>
            <div class="btngroup text-center">
                <button>返回</button>
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