<?php
include_once  ('session.php');
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-rtl.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 400
        });
    </script>

</head>
<div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="color: #2aabd2"><i class="glyphicon glyphicon-lock"></i> لــوحة الــتحكم </a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-left">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> الأعدادت <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">الصفحة الشخصية</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../logout.php?id=<?php echo $_SESSION['id']; ?>">تسجيل الخروج</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <section class="container-fluid" style="margin-top: 20px;">
        <div class="row">