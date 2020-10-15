<?php
session_start();
include_once ('config.php');
include_once ('function.php');

$settings = mysqli_query($connectToDB,"SELECT * FROM `settings`");
$setting  = mysqli_fetch_assoc($settings);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $setting['site_name']; ?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Arabic -->
    <link href="css/bootstrap-rtl.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- لينك مكتبة فونت اوسوم -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">

</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><?php echo $setting['site_name']; ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">الرئيسية <span class="sr-only">(current)</span></a></li>
                <?php
                   $CATEGORY = mysqli_query($connectToDB,"SELECT * FROM `category`");
                   while($DATA = mysqli_fetch_assoc($CATEGORY)){

                      echo '<li><a href="category.php?category='.$DATA['category_name'].'">'.$DATA['category_name'].'</a></li>';

                   };
                ?>

            </ul>
            <?php
            if (isset($_SESSION) && !empty($_SESSION)){

                echo '
                        <ul class="nav navbar-nav navbar-left">
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">الإعدادات <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                        <li role="separator" class="divider"></li>
                       
                        
                        <li><a href="#">الصفحة الشخصية</a></li>
                        <li> <a href="logout.php?id=' . $_SESSION['id'] . '">تسجيل الخروج</a></li>
               
                       ';

                    }if(isset($_SESSION) && !empty($_SESSION) && $_SESSION['role'] === 'admin'){

                        echo '<li><a href = "admin-cp/index.php" > لوحة التحكم </a ></li >';
                    }

                    ?>
            </ul>
          </li>
        </ul>

        </div>
    </div>
</nav>
<!-- logo site -->
<section id="logo">
    <img src="<?php echo $setting['logo']; ?>" width="320px" style="border: groove 3px blue;">
</section>

<!-- end logo site -->

<!-- body -->
<section class="container-fluid" style="margin-top: 20px;">
