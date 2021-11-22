<!DOCTYPE html>
<html>
<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Management Panel</title>
    <link rel="icon" href="../assets/images/profile.jpg">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/sweetalert/sweetalert.css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Management</b> Panel</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Welcome to Personal CV Management Panel</p>
        <form onsubmit="return false;" method="post">
            <div class="form-group has-feedback">
                <input name="userName" type="text" class="form-control" placeholder="User Name" autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input name="password" type="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" onclick="login();" class="btn btn-primary btn-block btn-flat">
                        Login
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
