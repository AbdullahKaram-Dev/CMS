<?php
require_once 'config.php';
session_start();


if (isset($_POST['submit'])) {

    foreach ($_POST as $key => $value){

        $$key = strip_tags($_POST[$key]);
    }

    if (empty($title)){
        echo '<div class="alert alert-danger" role="alert"> من فضلك أدخل عنوان للتعليق </div>';
    } elseif (empty($comment)){
        echo '<div class="alert alert-danger" role="alert"> من فضلك أدخل تعليق </div>';
    } else {

        $user_id = $_SESSION['id'];
        $created_at = date('Y-m-d');

        $add_comment = mysqli_query($connectToDB,"INSERT INTO `comments` (`post_id`,`user_id`,`title`,`comment`,`created_at`)
          VALUES ('$id','$user_id','$title','$comment','$created_at')");
        if (! $add_comment) {

            echo '<div class="alert alert-danger" role="alert"> هناك خطأ جارى العمل على أصلاحة حاول مرة أخرى  </div>';

        } else {

            echo '<div class="alert alert-success" role="alert"> تم تسجيل التعليق بنجاح فى انتظار المراجعة  </div>';
        }
    }


}


?>