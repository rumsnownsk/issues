<!doctype html>
<html lang="ru">
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/css/admin/admin.css">

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Issues</title>
</head>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <h3>Only for admin</h3>

        <!-- Login Form -->
        <form id="login_form">


            <input type="text" id="username" class="fadeIn second" name="username" placeholder="username">
            <span id="err_username" class="text-danger"></span>

            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
            <span id="err_pass" class="text-danger"></span>

            <input type="checkbox" name="rememberme" id="rememberme" value="on"
                   class="form-control" title="">
            <label for="rememberme" class="rememberme">Click, and I'll remember you</label>

            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>

            <a href="/" class="underlineHover">На главную</a>

    </div>
</div>


<script src="/js/jquery-3.4.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/admin.js"></script>

</body>


</html>


