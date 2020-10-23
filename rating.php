<?php
session_start();
include 'include/config.php';

if (!empty($_SESSION['id'])) {
    if (!empty($_POST['star'])) {
        if ($_POST['star'] > 5 && $_POST['star'] <= 0) {
            echo 'هذا التقييم غير صحيح';
        } else {

            $post_id = $_POST['post_id'];
            $user_id = $_SESSION['id'];
            $rate = (int)$_POST['star'];

            $checkRateUser = mysqli_query($connectToDB, "SELECT * FROM `rating` WHERE `user_id` = '$user_id' AND `post_id` = '$post_id'");
            if (!$connectToDB->affected_rows) {

                $insertRating = mysqli_query($connectToDB, "INSERT INTO `rating` (`post_id`,`user_id`,`rating`) VALUES ('$post_id','$user_id','$rate')");
                if ($insertRating) {

                    echo '<br><br><strong style="color: #2aabd2">شكرا للتقييم </strong>';
                } else {

                    echo '<br><br><br><br><strong style="color: #2aabd2">هناك عطل وجارى العمل على اصلاحة الرجاء المحاولة فى وقت اخر</strong>';

                }
            } else {

                echo '<br><br><strong style="color: #2aabd2">عفواٌ لقد قمت بتقييم هذة المقالة من قبل</strong>';
            }
        }

    } else {

        echo '<br><br><strong style="color: #2aabd2">عفواٌ أنت لم تقم بالتقييم</strong>';
    }

} else {
    echo '<br><br><strong style="color: #2aabd2">قم بتسجيل الدخول اولاُ لكي تستطيع التقييم</strong>';
}