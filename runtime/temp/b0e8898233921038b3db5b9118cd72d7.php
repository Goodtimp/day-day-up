<?php /*a:2:{s:86:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\studentanswer\index.html";i:1543383393;s:91:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\question\studentquestion.html";i:1543401325;}*/ ?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>题目</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>

    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/day-day-up/vendor/layui/src/css/layui.css">
    <style>
        #form-main{
            margin: 20px;
        }
    </style>
</head>

<body>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
                <legend><?php echo htmlentities($testName); ?></legend>
    <div class="layui-anim layui-anim-up login-main" id="form-main">
            
        <form class="layui-form" role="form" action="" method="post">
    <div class="layui-form-item layui-form-text">
        <h3 style="text-indent: 2em;">
            <?php echo htmlentities($Num); ?> : <?php echo htmlentities($content); ?>
        </h3>
    </div>

    <div class="my-choice-answer">
        <div class="layui-form-item">
            <div class="layui-input-block my-cate" style="margin-left:1em">
                <?php if(is_array($answers) || $answers instanceof \think\Collection || $answers instanceof \think\Paginator): $i = 0; $__LIST__ = $answers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$answer): $mod = ($i % 2 );++$i;?>
                <input type="radio" value=<?php echo htmlentities($answer); ?> title="<?php echo htmlentities($answer); ?>" checked="">
                <br />
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    </div>
    <div class="my-checking-answer">
        <div class="layui-form-item">
            <div class="layui-input-block" >
                <input type="radio" value="T" title="正确" checked="">
                <br>
                <input type="radio" value="F" title="错误">

            </div>
        </div>
    </div>
    <div class="my-completion-answer">
        <div class="layui-form-item layui-form-text">
            <div class="layui-input-block" style="margin-left:1em">
                <textarea placeholder="请输入答案" ; class="layui-textarea"></textarea>
            </div>
        </div>
    </div>

    <div class="layui-form-item layui-form-text">
        <div class="ly-input" style="margin-left:2em">
            <button class="layui-btn layui-btn-danger ly-submit" id="ly-submit" lay-submit lay-filter="formDemo">提交</button>
        </div>
    </div>
</form>


<script src="/day-day-up/vendor/layui/src/layui.js"></script>
<script>
    $(function () {
        var type = "<?php echo $type  ?>"

        $(".my-completion-answer").hide();
        $(".my-checking-answer").hide();
        $(".my-choice-answer").hide();
        if (type == 2) {
            $(".my-checking-answer").show().find("input").attr("name", "answerContent");
        } else if (type == 1) {
            $(".my-completion-answer").show().find("textarea").attr("lay-verify", "answerContent").attr("name",
                "answerContent");

        } else {
            $(".my-choice-answer").show().find("input").attr("name", "answerContent");

        }

    })
</script>
<script>
    layui.use(['form', 'layedit', 'laydate'], function () {
        var form = layui.form
  ,layer = layui.layer
  ,layedit = layui.layedit
  ,laydate = layui.laydate;

        //自定义验证规则
        form.verify({
            answerContent: function (value) {
                if (value.length < 1) {
                    return '请输入答案';
                } else if (value.length > 600) {
                    return '所以题目做答请控制在600字';
                }
            },

        });


    });
</script>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>

</body>

</html>