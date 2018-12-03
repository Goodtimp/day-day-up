<?php /*a:7:{s:82:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\test\editortest.html";i:1543833986;s:80:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\header.html";i:1543833286;s:78:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\left.html";i:1543722768;s:84:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\test\viewquestion.html";i:1543742543;s:88:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\question\questionView.html";i:1543491976;s:83:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\test\onequestion.html";i:1543722388;s:80:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\father\footer.html";i:1543056846;}*/ ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>教师终端</title>
  <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js">
  </script>
  <link rel="stylesheet" href="/vendor/layui/src/css/layui.css">
 

</head>

<body class="layui-layout-body">
  <div class="layui-layout layui-layout-admin">
    <div class="layui-header">
  <div class="layui-logo">教师端</div>
  <!-- 头部区域（可配合layui已有的水平导航） -->
  <ul class="layui-nav layui-layout-left">
    <li class="layui-nav-item"><a href="">题库</a></li>
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
          <dd><a href="/course/<?php echo htmlentities($cou['Id']); ?>"><?php echo htmlentities($cou['name']); ?></a></dd>
          <?php endforeach; endif; else: echo "" ;endif; ?>
          <dd><a href="/course/add">添加课程</a></dd>
        </dl>
      </li>
      
      <li class="layui-nav-item"><a href="/test/add">创建测试</a></li>
    </ul>
  </div>
</div>


    <div class="layui-body" style="padding-right:100px;">

      <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend><?php echo htmlentities($test['name']); ?>

       
        </legend>
        <a href="https://cli.im/api/qrcode/code?text=http://722first.club/stulogin/<?php echo htmlentities($test['Id']); ?>&mhid=50OTDAu7k8ghMHcrLtdWMa0"><button class="layui-btn" style="float:right;">生成测试二维码</button></a>
      </fieldset>
      
        <div class="my-viewquestion">
  <div class="layui-collapse" lay-filter="test">
    <!-- 已经添加的题目部分 -->
    <?php if(is_array($testdetail) || $testdetail instanceof \think\Collection || $testdetail instanceof \think\Paginator): $i = 0; $__LIST__ = $testdetail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$detail): $mod = ($i % 2 );++$i;?>
    <div class="layui-colla-item">
      <h2 class="layui-colla-title">
        <span style="width:80%;overflow: hidden;">
          <?php echo substr($detail["content"],0,60) ?></span>
        <span style="float:right;color:red;"><?php echo htmlentities($detail['questionScore']); ?>分</span>

        <button class="layui-btn layui-btn-primary layui-btn-sm my-btn-delete" value="<?php echo htmlentities($detail['questionId']); ?>"><i class="layui-icon"></i></button>
      </h2>
      <div class="layui-colla-content">
        <div class="layui-card-body question_content">

          <div class="view">
            <div class=""><?php echo htmlentities($detail['num']); ?> .<?php echo htmlentities($detail['content']); ?></div>
<div class="layui-hide right"><?php echo htmlentities($detail['right']); ?></div>
<div class="layui-hide type"><?php echo htmlentities($detail['type']); ?></div>
<div class="options">
    <?php if(is_array($detail['answer']) || $detail['answer'] instanceof \think\Collection || $detail['answer'] instanceof \think\Paginator): $i = 0; $__LIST__ = $detail['answer'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?>
    <input type="radio" name=<?php echo htmlentities($detail['num']); ?> value="<?php echo htmlentities($option); ?>" title="男" checked="false">
    <span class="answer"><?php echo htmlentities($option); ?></span>
    <br/> <?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div class="textbox">
    <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="" class="layui-input">
</div>

          </div>

        </div>
      </div>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>


    <!-- 添加新题目 -->
    <div class="layui-colla-item my-addquesion">
      <h2 class="layui-colla-title">添加新题目</h2>
      <div class="layui-colla-content layui-show">
        <div calss="my-onequestion">
  <form class="layui-form" action="adddetail" method="POST">
    <div class="layui-form-item">
      <label class="layui-form-label">题目类型</label>
      <div class="layui-input-block my-cate">
        <input type="radio" name="type" value="3" title="选择题" checked="">
        <input type="radio" name="type" value="1" title="填空题">
        <input type="radio" name="type" value="1" title="问答题">
        <input type="radio" name="type" value="2" title="判断题">
      </div>
    </div>
  </form>


  <!-- 填空题与问答题 -->

  <div class="my-completion">
    <form class="layui-form" action="/index/test/adddetail" method="POST">
      <input name="test_id" value=<?php echo htmlentities($test['Id']); ?> style="display: none;">

      <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">题目描述</label>
        <div class="layui-input-block">
          <textarea placeholder="请输入题目内容" lay-verify="content" name="content" class="layui-textarea"></textarea>
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">正确答案</label>
        <div class="layui-input-block">
          <input type="text" name="true_answer" lay-verify="choise" autocomplete="off" placeholder="请输入正确答案" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <div class="layui-inline">
          <label class="layui-form-label">做答时间</label>
          <div class="layui-input-inline">
            <input type="text" class="layui-input" name="time" id="question_time1" placeholder="">
          </div>
        </div>
        <div class="layui-inline">
          <label class="layui-form-label">该题分值</label>
          <div class="layui-input-inline">
            <input type="text" name="score" lay-verify="score" name="question_score" placeholder="请输入该题目分值"
              autocomplete="off" class="layui-input">
          </div>
        </div>
      </div>

      <div class="layui-form-item">
        <div class="layui-input-block">
          <button class="layui-btn" name="type" value="1" lay-submit="" lay-filter="demo1">添加题目</button>
        </div>
      </div>
    </form>
  </div>

  <!-- 选择题 -->

  <div class="my-choice">
    <form class="layui-form" action="/index/test/adddetail" method="POST">
      <input name="test_id" value=<?php echo htmlentities($test['Id']); ?> style="display: none;">

      <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">题目描述</label>
        <div class="layui-input-block">
          <textarea placeholder="请输入题目内容，默认A选项为正确选项，学生端获取到题目为乱序。" lay-verify="content" name="content" class="layui-textarea"></textarea>
        </div>
      </div>

      <div class="layui-form-item">
        <div class="layui-inline">
          <label class="layui-form-label">做答时间</label>
          <div class="layui-input-inline">
            <input type="text" class="layui-input" name="time" id="question_time2" placeholder="">
          </div>
        </div>
        <div class="layui-inline">
          <label class="layui-form-label">该题分值</label>
          <div class="layui-input-inline">
            <input type="text" name="score" lay-verify="score" name="question_score" placeholder="请输入该题目分值"
              autocomplete="off" class="layui-input">
          </div>
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
            <input type="text" name="false_answer_1" lay-verify="choise" autocomplete="off" placeholder="请输入错误选项" class="layui-input">
          </div>
        </div>
      </div>

      <div class="layui-form-item">
        <div class="layui-input-block">
          <input name="false_number" value="1" style="display: none;" id="new-option">
          <a class="layui-btn layui-btn-primary my-new-option" name="false_number" value="1">添加新选项</a>
          <a class="layui-btn layui-btn-primary my-delete-option">删除最后一个选项</a>
        </div>
      </div>
      <div class="layui-form-item">
        <div class="layui-input-block">
          <button class="layui-btn" lay-submit="" name="type" value="3" lay-filter="demo1">添加题目</button>
        </div>
      </div>
    </form>
  </div>


  <!-- 判断题 -->

  <div class="my-checking">
    <form class="layui-form" action="/index/test/adddetail" method="POST">
      <input name="test_id" value=<?php echo htmlentities($test['Id']); ?> style="display: none;">

      <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">题目描述</label>
        <div class="layui-input-block">
          <textarea placeholder="请输入题目内容" lay-verify="content" name="content" class="layui-textarea"></textarea>
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">答案</label>
        <div class="layui-input-block">
          <input type="radio" name="answer" value="1" title="True" checked="">
          <input type="radio" name="answer" value="0" title="False">
        </div>
      </div>



      <div class="layui-form-item">
        <div class="layui-inline">
          <label class="layui-form-label">做答时间</label>
          <div class="layui-input-inline">
            <input type="text" class="layui-input" name="time" id="question_time3" placeholder="">
          </div>
        </div>
        <div class="layui-inline">
          <label class="layui-form-label">该题分值</label>
          <div class="layui-input-inline">
            <input type="text" name="score" lay-verify="score" name="question_score" placeholder="请输入该题目分值"
              autocomplete="off" class="layui-input">
          </div>
        </div>
      </div>

      <div class="layui-form-item">
        <div class="layui-input-block">
          <button class="layui-btn" lay-submit="" name="type" value="2" lay-filter="demo1">添加题目</button>
        </div>
      </div>
    </form>
  </div>


  <script src="/vendor/layui/src/layui.js"></script>


  <script>
    $(function () {
      var num_falsechoise = 1
      $(".my-new-option").click(function () {
        var html = $(".my-option").first().html();
        $(this).parents(".layui-form-item").before(html);

        num_falsechoise = num_falsechoise + 1;
        $("#new-option").attr("value", num_falsechoise);
        $(this).parents(".layui-form-item").prev().find("input").attr("name", "false_answer_" + num_falsechoise
          .toString()); //标记每个选项 保证post不冲突

      })
      $(".my-delete-option").click(function () {
        var choise = $(this).parents(".layui-form-item").prev();
        if (!choise.hasClass("my-option")) {
          choise.remove();
          num_falsechoise = num_falsechoise - 1;
          $("#new-option").attr("value", num_falsechoise);
        }

      })
    })
    window.onload = function () {
      choisetype();
      $(".my-cate .layui-unselect").click(function () {
        choisetype();
      })

      function choisetype() {
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
      //时间设置
      laydate.render({
        elem: '#question_time1',
        format: "mm:ss",
        value: "10:00",
        max: "00:59:59",
        min: "00:00:01",
        type: 'time'
      });
      laydate.render({
        elem: '#question_time2',
        format: "mm:ss",
        value: "10:00",
        max: "00:59:59",
        min: "00:00:01",
        type: 'time'
      });
      laydate.render({
        elem: '#question_time3',
        format: "mm:ss",
        value: "10:00",
        max: "00:59:59",
        min: "00:00:01",
        type: 'time'
      });
      //自定义验证规则
      form.verify({
        content: function (value) {
          if (value.length < 1) {
            return '请输入题目描述';
          } else if (value.length > 600) {
            return '学生读题很麻烦，所以题目描述最多600字';
          }
        },
        score: [/^\+?[1-9][0-9]*$/, '请输入正整数分值'],
        choise: function (value) {
          if (value.length < 1) {
            return '请输入答案信息描述';
          } else if (value.length > 600) {
            return '学生读题很麻烦，答案最多600字';
          }
        },
        required: function (value) {
          if (value == null) {
            return '请确定课程时间';
          }
        }
      });
    });
  </script>
</div>
      </div>
    </div>

  </div>

</div>

<script>
  layui.use(['element', 'layer'], function () {
    var element = layui.element;
    var layer = layui.layer;
  });
</script>
<script src="/vendor/layui/src/layui.js"></script>
<script>
  $(function () {
    $(".layui-btn-sm").click(function () {
      var questionId = $(this).attr("value");
      var testId = "<?php echo htmlentities($test['Id']); ?>";
      $.ajax({
        url: "<?php echo url('index/Test/deletedetail'); ?>",
        type: "post",
        data: {
          testid: testId,
          id: questionId
        },
        success: function (data) {
          if(data==0) alert("删除失败");
          window.location.reload();
        },
       
      })
    })
    $(".Motify").each(function () {
      $(this).click(function () {
        $(this).parents(".question_content").children(".view").addClass("layui-hide");
        $(this).parents(".question_content").children(".edit").removeClass("layui-hide");
        alert($(this).parents(".question_content").children(".Save").val());
      })
    });
    $(".Save").each(function () {
      $(this).click(function () {
        $(this).parents(".question_content").children(".view").removeClass("layui-hide");
        $(this).parents(".question_content").children(".edit").addClass("layui-hide");
      })
    })
    $(".view").each(function () {
      var type = $(this).children(".type").text();
      //根据题目类型判断显示输入框还是单选框
      if (type.trim() == 3) {
        $(this).children(".textbox").html("");
        $(this).next().children(".type").val(type.trim());
        var right = $(this).children(".right").text();
        var answer = $(this).children(".options").children(".answer");
        answer.each(function () {
          if ($(this).text().trim() == right.trim()) {
            $(this).prev().prop("checked", true);
          }
        })
      } else {
        var answer = $(this).children(".options").children(".answer").text(); //获取答案，用来输入框的显示
        $(this).children(".options").html("");
        $(this).children(".textbox").children("input").attr("placeholder", answer);
        $(this).next().children(".type").val(type.trim());
      }
    });
  })
</script>

<script>
    layui.use(['form', 'layedit', 'laydate'], function () {
      var form = layui.form,
        layer = layui.layer,
        layedit = layui.layedit,
        laydate = layui.laydate;
      //时间设置
      laydate.render({
        elem: '#question_time1',
        format: "mm:ss",
        value: "10:00",
        max: "00:59:59",
        min: "00:00:01",
        type: 'time'
      });
      laydate.render({
        elem: '#question_time2',
        format: "mm:ss",
        value: "10:00",
        max: "00:59:59",
        min: "00:00:01",
        type: 'time'
      });
      laydate.render({
        elem: '#question_time3',
        format: "mm:ss",
        value: "10:00",
        max: "00:59:59",
        min: "00:00:01",
        type: 'time'
      });
      //自定义验证规则
      form.verify({
        content: function (value) {
          if (value.length < 1) {
            return '请输入题目描述';
          } else if (value.length > 600) {
            return '学生读题很麻烦，所以题目描述最多600字';
          }
        },
        score: [/^\+?[1-9][0-9]*$/, '请输入正整数分值'],
        choise: function (value) {
          if (value.length < 1) {
            return '请输入答案信息描述';
          } else if (value.length > 600) {
            return '学生读题很麻烦，答案最多600字';
          }
        },
        required: function (value) {
          if (value == null) {
            return '请确定课程时间';
          }
        }
      });
    });
  </script>
 
      

      <div style="padding: 15px;">
        
         
      
      </div>
      <div style="margin:0 auto;width:100px;">
          <button class="layui-btn" id="btn-startNow">现在开始</button>
        </div>
    </div>
    <div class="layui-footer">
  <!-- 底部固定区域 -->
  @goodtimp & @someonegirl
</div>


  </div>
  <script>
      $(function () {
        $("#btn-startNow").click(function () {
          var testId = "<?php echo htmlentities($test['Id']); ?>";
          $.ajax({
            url: "<?php echo url('index/test/startnow'); ?>",
            type: "post",
            data: {
              testid: testId,
            },
            success: function (data) {    
              if (data == 0) alert("未知原因，开始失败");
              window.location.href="/test/<?php echo htmlentities($test['Id']); ?>";
            },
            error:function(data){
               alert("操作失败，请重新登录获取清楚session");
            }
          })
        })
      })
    </script>
 <script src="/public/static//js/goodtimp.js">
 </script>
  
</body>

</html>