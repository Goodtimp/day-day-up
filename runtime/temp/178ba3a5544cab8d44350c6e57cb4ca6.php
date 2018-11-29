<?php /*a:1:{s:86:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\studentfinish\index.html";i:1543410908;}*/ ?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>考试反馈</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/day-day-up/vendor/layui/dist/css/layui.css" media="all">
</head>

<body>
        <div style="padding-left:10px;">
    <h1><?php echo htmlentities($name); ?> 结束,你的分数为: <?php echo htmlentities($score); ?></h1>
   
    <?php if(is_array($details) || $details instanceof \think\Collection || $details instanceof \think\Paginator): $i = 0; $__LIST__ = $details;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$detail): $mod = ($i % 2 );++$i;?>
        <h3>问题 ： <?php echo htmlentities($detail['content']); ?></h3>
        
        <h4 style="color:red;"> 你的答案：<?php echo $detail["answerContent"]>0?"":$detail["answer"][0]; ?></h4>
        <h4 style="color:red;">  <?php echo $detail["thisScore"]>0?"":$detail["answer"][0]; ?></h4>
        <p style="color:red;"><?php echo htmlentities($detail['thisScore']); ?></p>
      
    <?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</body>

</html>
