<?php

include_once ('config.php');
session_start();


if (isset($_POST['login'])){

   $user      = stripcslashes(mysqli_real_escape_string($connectToDB,$_POST['user']));
   $password  = md5($_POST['password']);
    if (empty($user)){
        echo '<div class="alert alert-danger" > رجاء أدخال أسم المستخدم أو البريد الألكتروني </div>';
    }elseif (empty($_POST['password'])){

        echo '<div class="alert alert-danger"> رجاء أدخال كلمة المرور </div>';
    }else{

        $sql = mysqli_query($connectToDB,
  "SELECT * FROM `members` WHERE (`username`= '$user' OR `email`='$user') AND `password` = '$password'");
         if (mysqli_num_rows($sql) != 1){

             echo '<div class="alert alert-danger"> معلومات الدخول غير صحيحة  </div>';
         }else{

             $user = mysqli_fetch_assoc($sql);
             $_SESSION['id']       = $user['user_id'];
             $_SESSION['user']     = $user['username'];
             $_SESSION['email']    = $user['email'];
             $_SESSION['gender']   = $user['gender'];
             $_SESSION['avatar']   = $user['avatar'];
             $_SESSION['about']    = $user['about_user'];
             $_SESSION['facebook'] = $user['facebook'];
             $_SESSION['twitter']  = $user['twitter'];
             $_SESSION['youtube']  = $user['youtube'];
             $_SESSION['date']     = $user['created_at'];
             $_SESSION['role']     = $user['role'];
             echo '<div class="alert alert-success"> تم تسجيل الدخول جارى التحويل للصفحة الرئيسية </div>';
             echo '<meta http-equiv="refresh" content="3; \'index.php\' " />';
         }
    }
}