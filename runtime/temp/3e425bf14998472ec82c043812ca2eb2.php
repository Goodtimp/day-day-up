<?php /*a:1:{s:85:"E:\phpstudy\PHPTutorial\WWW\day-day-up\application\index\view\studentlogin\index.html";i:1542891450;}*/ ?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>登录</title>
    <link rel="stylesheet" href="/day-day-up/vendor/layui/src/css/layui.css">
</head>

<body>
    <div class="layui-anim layui-anim-up login-main" id="form-main">
        <form class="layui-form" role="form" action="" method="post">
            <h3>学生登录</h3>
            <div class="ly-input">
                <input type="text" name="sno" required lay-verify="required" placeholder="请输入用户名" autocomplete="off"
                    class="layui-input">
            </div>
            <div class="ly-input">
                <input type="text" name="name" required lay-verify="required" placeholder="请输入姓名" autocomplete="off"
                    class="layui-input">
            </div>

            <div class="ly-input">
                <button class="layui-btn layui-btn-danger ly-submit" id="ly-submit" lay-submit lay-filter="formDemo">登录</button>
            </div>
        </form>

    </div>
</body>

</html>