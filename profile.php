<?php 
include_once ('include/header.php');
include_once ('include/sidebar.php');

$id = (int) $_GET['user'];

$userData = mysqli_query(
       $connectToDB,
"SELECT * FROM `members` WHERE `user_id` = '$id'");

if (mysqli_num_rows($userData) != 1) {

    header("LOCATION: index.php");

}
  $user = mysqli_fetch_object($userData);
?>

<article class="col-md-9 col-lg-9">
    <ol class="breadcrumb">
        <li><a href="index.php">الرئيسية</a></li>
        <li class="active"> الصفحة الشخصية للعضو <?= ucwords($user->username); ?></li>
    </ol>
    <div class="col-lg-12 art_bg">
        <div class="page-header">
            <h1><?= ucwords($user->username); ?> <small><?= ($user->role == 'admin' ? 'المدير' : '') ?></small></h1>
        </div>

    </div>
</article>
<?php include_once ('include/footer.php'); ?>























