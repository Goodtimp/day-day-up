<?php /*a:5:{s:84:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\test\addtquestion.html";i:1543150871;s:80:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\header.html";i:1543061840;s:78:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\left.html";i:1543065665;s:83:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\test\onequestion.html";i:1543151265;s:80:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\footer.html";i:1543056846;}*/ ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>教师终端</title>
  <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js">
  </script>
  <link rel="stylesheet" href="/day-day-up/vendor/layui/src/css/layui.css">
</head>

<body class="layui-layout-body">
  <div class="layui-layout layui-layout-admin">
    <div class="layui-header">
  <div class="layui-logo">layui 后台布局</div>
  <!-- 头部区域（可配合layui已有的水平导航） -->
  <ul class="layui-nav layui-layout-left">
    <li class="layui-nav-item"><a href="">题库</a></li>
    <!-- <li class="layui-nav-item"><a href="<?php echo url('studentlogin/index'); ?>?id=1">开始测试1</a></li>
    <li class="layui-nav-item"><a href="<?php echo url('Login/index'); ?>">登录</a></li> -->
   
  </ul>
  <ul class="layui-nav layui-layout-right">
    <li class="layui-nav-item">
      <a href="javascript:;">
        <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
        <?php echo htmlentities($name); ?> 
      </a>
      <dl class="layui-nav-child">
        <dd><a href="">基本资料</a></dd>
        <dd><a href="">安全设置</a></dd>
      </dl>
    </li>
    <li class="layui-nav-item"><a href="<?php echo url('Login/exit_user'); ?>">退了</a></li>
  </ul>
</div>
    <div class="layui-side layui-bg-black">
  <div class="layui-side-scroll">
    <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
    <ul class="layui-nav layui-nav-tree"  lay-filter="test">
      <li class="layui-nav-item layui-nav-itemed">
        <a class="" href="javascript:;">课程</a>
        <dl class="layui-nav-child">
          <?php if(is_array($courses) || $courses instanceof \think\Collection || $courses instanceof \think\Paginator): $i = 0; $__LIST__ = $courses;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cou): $mod = ($i % 2 );++$i;?>
          <dd><a href="<?php echo url('Course/index'); ?>?id=<?php echo htmlentities($cou['Id']); ?>"><?php echo htmlentities($cou['name']); ?></a></dd>
          <?php endforeach; endif; else: echo "" ;endif; ?>
          <dd><a href="<?php echo url('Course/add'); ?>">添加课程</a></dd>
        </dl>
      </li>
      
      <li class="layui-nav-item"><a href="<?php echo url('Test/add'); ?>">创建测试</a></li>
    </ul>
  </div>
</div>


    <div class="layui-body" style="padding-right:100px;">

      <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend><?php echo htmlentities($test_name); ?></legend>
      </fieldset>
     
        <div calss="my-onequestion">
<form class="layui-form" action="addtquestion" method="POST">
  <div class="layui-form-item">
    <label class="layui-form-label">题目类型</label>
    <div class="layui-input-block my-cate">
      <input type="radio" name="type" value="3" title="选择题" checked="">
      <input type="radio" name="type" value="1" title="填空题">
      <input type="radio" name="type" value="1" title="问答题">
      <input type="radio" name="type" value="2" title="判断题">
    </div>
  </div>
  <div class="my-completion">
    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">题目描述</label>
      <div class="layui-input-block">
        <textarea placeholder="请输入题目内容"  lay-verify="content"  class="layui-textarea"></textarea>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">正确答案</label>
      <div class="layui-input-block">
        <input type="text" name="true_answer" lay-verify="choise" autocomplete="off" placeholder="请输入正确答案" class="layui-input">
      </div>
    </div>
  </div>
  <div class="my-choice">
    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">题目描述</label>
      <div class="layui-input-block">
        <textarea placeholder="请输入题目内容，默认A选项为正确选项，学生端获取到题目为乱序。" lay-verify="content"  name="question_content" class="layui-textarea"></textarea>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">正确选项</label>
      <div class="layui-input-block">
        <input type="text" name="true_answer" lay-verify="choise" autocomplete="off" placeholder="请在该选项输入正确答案" class="layui-input">
      </div>
    </div>
    <div class="my-option">
      <div class="layui-form-item">
        <label class="layui-form-label">其他选项</label>
        <div class="layui-input-block">
          <input type="text" name="false_answer" lay-verify="choise" autocomplete="off" placeholder="请输入错误选项" class="layui-input">
        </div>
      </div>
    </div>
    <div class="layui-form-item">
      <div class="layui-input-block">
        <a class="layui-btn layui-btn-primary my-new-option">添加新选项</a>
        <a class="layui-btn layui-btn-primary my-delete-option">删除最后一个选项</a>
      </div>
    </div>
  </div>
  <div class="my-checking">
    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">题目描述</label>
      <div class="layui-input-block">
        <textarea placeholder="请输入题目内容" lay-verify="content"  class="layui-textarea"></textarea>
      </div>
    </div>
    <div class="layui-form-item" pane="">
      <label class="layui-form-label">答案</label>
      <div class="layui-input-block">
        <input type="radio" name="true_answer" value="1" title="True" checked="">
        <input type="radio" name="false_answer" value="0" title="False">

      </div>
    </div>
  </div>

  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit="" lay-filter="demo1">添加题目</button>
    </div>
  </div>
  <script src="/day-day-up/vendor/layui/src/layui.js"></script>
 
  <script>
    
    $(function () {
      $(".my-new-option").click(function () {
        var html = $(".my-option").first().html();
        $(this).parents(".layui-form-item").before(html);
      })
      $(".my-delete-option").click(function () {
        var choise=$(this).parents(".layui-form-item").prev();
        if(!choise.hasClass("my-option"))
        {
          choise.remove();
        }
       
      })
    })
    window.onload = function () {
      choise();
      $(".my-cate .layui-unselect").click(function () {
        choise();
      })

      function choise() {
        $(".my-cate .layui-unselect").each(function () {
          if ($(this).hasClass("layui-form-radioed")) {
            var type = $(this).prev().val();
            if (type == 1) {
              $(".my-checking").hide();
              $(".my-choice").hide();
              $(".my-completion").show();
            } else if (type == 2) {
              $(".my-checking").show();
              $(".my-choice").hide();
              $(".my-completion").hide();
            } else {
              $(".my-checking").hide();
              $(".my-choice").show();
              $(".my-completion").hide();
            }
          }
        });
      }
    }
  </script>
 <script>
    layui.use(['form', 'layedit', 'laydate'], function () {
      var form = layui.form,
        layer = layui.layer,
        layedit = layui.layedit,
        laydate = layui.laydate;

      //日期
      laydate.render({
        elem: '#date'
      });
      laydate.render({
        elem: '#date1'
      });

      //创建一个编辑器
      var editIndex = layedit.build('LAY_demo_editor');

      //自定义验证规则
      form.verify({

        content: function (value) {
          layedit.sync(editIndex);
        }
      });

      //监听指定开关
      form.on('switch(switchTest)', function (data) {
        layer.msg('开关checked：' + (this.checked ? 'true' : 'false'), {
          offset: '6px'
        });
        layer.tips('温馨提示：请注意开关状态的文字可以随意定义，而不仅仅是ON|OFF', data.othis)
      });

      //监听提交
      // form.on('submit(demo1)', function (data) {
      //   layer.alert(JSON.stringify(data.field), {
      //     title: '最终的提交信息'
      //   })
      //   return false;
      // });

      // //表单初始赋值
      // form.val('example', {
      //   "username": "贤心" // "name": "value"
      //   , "password": "123456"
      //   , "interest": 1
      //   , "like[write]": true //复选框选中状态
      //   , "close": true //开关状态
      //   , "sex": "女"
      //   , "desc": "我爱 layui"
      // })
    });
  </script>
</form>
</div>
   
      <div style="padding: 15px;">

      </div>
    </div>
    <div class="layui-footer">
  <!-- 底部固定区域 -->
  @goodtimp & @someonegirl
</div>


  </div>
  <script>
    $(function () {

    })
  </script>

  
</body>

</html>