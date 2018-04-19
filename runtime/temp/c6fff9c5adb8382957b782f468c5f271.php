<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"D:\phpStudy\WWW\ksxt\public/../application/index\view\pascal\see.html";i:1516033196;s:79:"D:\phpStudy\WWW\ksxt\public/../application/index\view\teacher\alterDetails.html";i:1516264793;}*/ ?>
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
    
    <title>题库-试题查看</title>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/question/pascal.css">
    <script type="text/javascript" src="__STATIC__/js/question/pascal.js"></script>
    
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
                                    <a href="<?php echo url('index/Teacher/esc'); ?>">退出登录</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        
    <div class="row middle">
        <!-- 左边 -->
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
        <div class="col-lg-11 col-md-10 col-sm-10 col-xs-9 right">
            <table class="table-responsive table">
                <thead>
                    <td colspan="2" class="text-left">题库内容</td>
                    <td colspan="3">
                        <div class="col-xs-3">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <?php echo $pattern; ?>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="<?php echo url('index/Pascal/see',['id'=>$questionId]); ?>">全部</a></li>
                                    <li><a href="<?php echo url('index/Pascal/seeSingle'); ?>">单选题</a></li>
                                    <li><a href="<?php echo url('index/Pascal/seeCompletion'); ?>">填空题</a></li>
                                    <li><a href="<?php echo url('index/Pascal/seeEssay'); ?>">问答题</a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="addPascal">
                            添加试题
                            <ul class="list-unstyled pattern">
                                <li id="addSingle">
                                    <a href="javascript:void(0);">单选题</a>
                                </li>
                                <li id="addCompletion">
                                    <a href="javascript:void(0);">填空题</a>
                                </li>
                                <li id="addEssay">
                                    <a href="javascript:void(0);">问答题</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td>
                        <button class="deleteimg">
                            <span></span>删除
                        </button>
                    </td>
                    <td>
                        <form action="<?php echo url('index/Pascal/search'); ?>" method="post" id="form">
                            <div class="form-group has-success has-feedback">
                                <div class="input-group">
                                
                                    <input type="text" class="form-control" placeholder="搜索试题..." name="search">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                                
                                </div>
                            </div>
                        </form>
                    </td>
                </thead>
                <tbody>
                    <tr>
                        <td width="10">
                            <input type="checkbox" class="quanxuan">
                        </td>
                        <td width="50">
                            序号
                        </td>
                        <td class="text-left">
                            题干
                        </td>
                        <td width="60">题型</td>
                        <td>难度</td>
                        <td>知识点</td>
                        <td>修改时间</td>
                        <td width="180">操作</td>
                    </tr>
                    <?php if(is_array($pdata) || $pdata instanceof \think\Collection || $pdata instanceof \think\Paginator): $k = 0; $__LIST__ = $pdata;if( count($__LIST__)==0 ) : echo "<tr><td colspan='8' align='center'>还没有试题，快来添加吧！</td></tr>" ;else: foreach($__LIST__ as $key=>$value): $mod = ($k % 2 );++$k;?>
                    <tr>
                        <td class="check">
                            <input type="checkbox" value="<?php echo $value['id']; ?>">
                        </td>
                        <td><?php echo $k; ?></td>
                        <td class="text-left stem">
                            <p><?php echo $value['name']; ?></p>
                        </td>
                        <td><?php echo $value['pname']; ?></td>
                        <td width="80"><?php echo $value['difficulty']; ?></td>
                        <td><?php echo $value['kname']; ?></td>
                        <td><?php echo $value['date']; ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default" value="<?php echo $value['id']; ?>" t="<?php echo $value['pname']; ?>">查看 </button>
                                <button type="button" class="btn btn-default" value="<?php echo $value['id']; ?>" t="<?php echo $value['pname']; ?>">编辑</button>
                                <button type="button" class="btn btn-default deletePascal" value="<?php echo $value['id']; ?>">删除</button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "<tr><td colspan='8' align='center'>还没有试题，快来添加吧！</td></tr>" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- 查看弹框 -->
    <div class="panel seeSingle">
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
    <!-- 编辑试题 -->
    <div class="panel editSingle">
        <div class="panel-heading">
            <span>编辑试题</span>
            <img src="__STATIC__/images/question/u1865.png">
        </div>
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">试题难度：</label>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <select class="form-control difficulty">
                            <option value="1" v="非常简单">非常简单</option>
                            <option value="2" v="简单">简单</option>
                            <option value="3" v="一般">一般</option>
                            <option value="4" v="困难">困难</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">知识点：</label>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <select class="form-control know">
                            <?php if(is_array($kdata) || $kdata instanceof \think\Collection || $kdata instanceof \think\Paginator): $i = 0; $__LIST__ = $kdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $value['id']; ?>" v="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="knowledge">管理知识点</a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">题干：</label>
                    <div class="col-lg-7 col-md-7 col-sm-8">
                        <textarea class="form-control topic" rows="5" placeholder="请输入题目"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">选项：</label>
                    <div class="col-lg-7 col-md-7 col-sm-8">
                        <div class="form-group">
                            <label class="col-xs-1 control-label">A.</label>
                            <div class="col-xs-10">
                                <input type="text" class="form-control opt1" placeholder="请输入选项">
                            </div>
                            <div class="col-xs-1">
                                <div class="radio">
                                    <label value="A" v="1">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-1 control-label">B.</label>
                            <div class="col-xs-10">
                                <input type="text" class="form-control opt2" placeholder="请输入选项">
                            </div>
                            <div class="col-xs-1">
                                <div class="radio">
                                    <label value="B" v="2">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-1 control-label">C.</label>
                            <div class="col-xs-10">
                                <input type="text" class="form-control opt3" placeholder="请输入选项">
                            </div>
                            <div class="col-xs-1">
                                <div class="radio">
                                    <label value="C" v="3">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-1 control-label">D.</label>
                            <div class="col-xs-10">
                                <input type="text" class="form-control opt4" placeholder="请输入选项">
                            </div>
                            <div class="col-xs-1">
                                <div class="radio">
                                    <label value="D" v="4">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">成绩：</label>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <input type="text" class="form-control score" placeholder="1-100">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">解析：</label>
                    <div class="col-lg-7 col-md-7 col-sm-8">
                        <textarea class="form-control analysis" placeholder="请输入解析(可为空)"></textarea>
                    </div>
                </div>
                <div class="btngroup">
                    <input type="button" value="保存">
                    <input type="button" value="取消">
                </div>
            </form>
        </div>
    </div>
    <!-- 填空查看 -->
    <div class="panel seeCompletion">
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
    <!-- 填空题编辑 -->
    <div class="panel editCompletion">
        <div class="panel-heading">
            <span>编辑试题</span>
            <img src="__STATIC__/images/question/u1865.png">
        </div>
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">试题难度：</label>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <select class="form-control difficulty">
                            <option value="1" v="非常简单">非常简单</option>
                            <option value="2" v="简单">简单</option>
                            <option value="3" v="一般">一般</option>
                            <option value="4" v="困难">困难</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">知识点：</label>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <select class="form-control know">
                            <?php if(is_array($kdata) || $kdata instanceof \think\Collection || $kdata instanceof \think\Paginator): $i = 0; $__LIST__ = $kdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $value['id']; ?>" v="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="knowledge">管理知识点</a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">题干：</label>
                    <div class="col-lg-7 col-md-7 col-sm-8">
                        <textarea class="form-control topic" rows="5" placeholder="请输入题目"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">选项：</label>
                    <div class="col-lg-7 col-md-7 col-sm-6 options">
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                        <input type="button" class="addoption" value="添加选项">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">成绩：</label>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <input type="text" class="form-control score" placeholder="1-100">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">解析：</label>
                    <div class="col-lg-7 col-md-7 col-sm-8">
                        <textarea class="form-control analysis" placeholder="请输入解析(可为空)"></textarea>
                    </div>
                </div>
                <div class="btngroup">
                    <input type="button" value="保存">
                    <input type="button" value="取消">
                </div>
            </form>
        </div>
    </div>
    <!-- 问答题 -->
    <div class="panel seeEssay">
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
    <div class="panel editEssay">
        <div class="panel-heading">
            <span>编辑试题</span>
            <img src="__STATIC__/images/question/u1865.png">
        </div>
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">试题难度：</label>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <select class="form-control difficulty">
                            <option value="1" v="非常简单">非常简单</option>
                            <option value="2" v="简单">简单</option>
                            <option value="3" v="一般">一般</option>
                            <option value="4" v="困难">困难</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">知识点：</label>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <select class="form-control know">
                            <?php if(is_array($kdata) || $kdata instanceof \think\Collection || $kdata instanceof \think\Paginator): $i = 0; $__LIST__ = $kdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $value['id']; ?>" v="<?php echo $value['name']; ?>"><?php echo $value['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="knowledge">管理知识点</a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">题干：</label>
                    <div class="col-lg-7 col-md-7 col-sm-8">
                        <textarea class="form-control topic" rows="5" placeholder="请输入题目"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">答案：</label>
                    <div class="col-lg-7 col-md-7 col-sm-8">
                        <textarea class="form-control answer" rows="5" placeholder="请输入答案"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">题解：</label>
                    <div class="col-lg-7 col-md-7 col-sm-8">
                        <textarea class="form-control analysis" rows="5" placeholder="请输入题解(可为空)"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-2 col-md-2 col-sm-3">成绩：</label>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <input type="text" class="form-control score" placeholder="1-100">
                    </div>
                </div>
                <div class="btngroup">
                    <input type="button" value="保存">
                    <input type="button" value="取消">
                </div>
            </form>
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