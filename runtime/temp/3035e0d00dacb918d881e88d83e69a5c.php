<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"E:\phpstudy\PHPTutorial\WWW\ksxt\public/../application/index\view\student\ksxt.html";i:1517038144;s:91:"E:\phpstudy\PHPTutorial\WWW\ksxt\public/../application/index\view\student\alterDetails.html";i:1516265980;}*/ ?>
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
    
    <title>学生-考试信息</title>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/student/ksxt.css">
    <script type="text/javascript" src="__STATIC__/js/student/ksxt.js"></script>
    
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
        
    <div class="row middle" style="height: 700px;">
        <div class="col-lg-1 col-md-2 col-sm-2 col-xs-3">
            <ul class="list-unstyled left">
                <li class="seeQuestion">
                    <a href="<?php echo url('index/Studentper/ksxt'); ?>">
                            <span></span>未过时间试卷
                        </a>
                </li>
                <li class="addQuestion">
                    <a href="<?php echo url('index/Studentper/hasKsxt'); ?>">
                            <span></span>已过时间试卷
                        </a>
                </li>
            </ul>
        </div>
        <!-- 右边 -->
        <div class="col-lg-11 col-md-10 col-sm-10 col-xs-9">
            <div class="panel text-left exam">
                <div class="panel-heading">
                    <ul class="list-unstyled list-inline">
                        <li>即将考试试卷</li>
                        <li class="pull-right">
                            <button class="baom">立即报名</button>
                        </li>
                    </ul>
                </div>
                <div class="panel-body">
                    <table class="table-responsive table text-center">
                        <thead>
                            <tr>
                                <td>试卷名</td>
                                <td>总分</td>
                                <td>班级</td>
                                <td>考试日期</td>
                                <td>考试时长</td>
                                <td>拖考时长</td>
                                <td>操作</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($sdata) || $sdata instanceof \think\Collection || $sdata instanceof \think\Paginator): $i = 0; $__LIST__ = $sdata;if( count($__LIST__)==0 ) : echo "
                            <tr>
                                <td colspan='7'>
                                    <h4>还没有试卷~~~~</h4></td>
                            </tr>" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['score']; ?>分</td>
                                <td><?php echo $value['cname']; ?></td>
                                <td><?php echo $value['strat']; ?></td>
                                <td><?php echo $value['length']; ?>分钟</td>
                                <td><?php echo $value['size']; ?>分钟</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo url('index/Showpascal/datiPage',['id'=>$value['id']]); ?>" class="btn btn-success" value="<?php echo $value['id']; ?>">开始考试</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "
                            <tr>
                                <td colspan='7'>
                                    <h4>还没有试卷~~~~</h4></td>
                            </tr>" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   <div class="panel edit">
        <div class="panel-heading">
            报名
        </div>
        <div class="panel-body">
            <form class="form form-horizontal">
                <div class="form-group">
                    <label class="control-label col-xs-12 col-lg-4 col-md-5 col-sm-5">教师：</label>
                    <div class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
                        <select class="form-control name teacher">
                            <?php if(is_array($teacher) || $teacher instanceof \think\Collection || $teacher instanceof \think\Paginator): $i = 0; $__LIST__ = $teacher;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['teacher_name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-lg-4 col-md-5 col-sm-5">课程：</label>
                    <div class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
                        <select class="form-control name course">
                            <?php if(is_array($course) || $course instanceof \think\Collection || $course instanceof \think\Paginator): $i = 0; $__LIST__ = $course;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['course_name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-lg-4 col-md-5 col-sm-5">班级：</label>
                    <div class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
                        <select class="form-control name class">
                            <?php if(is_array($class) || $class instanceof \think\Collection || $class instanceof \think\Paginator): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['class_name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-lg-4 col-md-5 col-sm-5">授权码：</label>
                    <div class="col-xs-12 col-lg-6 col-md-6 col-sm-6">
                        <input type="text" class="form-control code" placeholder="请输入授权码">
                    </div>
                </div>
            </form>
            <div class="btngroup text-center">
                <button class="save">报名</button>
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