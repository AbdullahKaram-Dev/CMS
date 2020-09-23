<?php

include_once('config.php');
session_start();

if (isset($_POST['submit'])) {

    $username = strip_tags($_POST['username']);
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $about = strip_tags($_POST['about']);
    $facebook = htmlspecialchars($_POST['facebook']);
    $twitter = htmlspecialchars($_POST['twitter']);
    $youtube = htmlspecialchars($_POST['youtube']);
    $date = date('Y-m-d'); //Date if you want create_at or update_at .


    if (empty($username)) {

        echo '<div class="alert alert-danger" role="alert">من فضلك أدخل أسم المستخدم</div>';

    } elseif (empty($email)) {

        echo '<div class="alert alert-danger" role="alert">من فضلك أدخل بريدك الأكتروني</div>';

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        echo '<div class="alert alert-danger" role="alert"> من فضلك أدخل بريد الكتروني صالح</div>';

    } elseif (empty($_POST['password'])) {

        echo '<div class="alert alert-danger" role="alert">من فضلك أدخل كلمة المرور</div>';

    } elseif (empty($_POST['con_password'])) {

        echo '<div class="alert alert-danger" role="alert">من فضلك قم بعمل تأكيد كلمة المرور</div>';

    } elseif ($_POST['password'] != $_POST['con_password']) {

        echo '<div class="alert alert-danger" role="alert"> كلمة المرور غير متطابقة </div>';

    } else {

        $sql_username = mysqli_query($connectToDB,"SELECT `username` FROM `members` WHERE  `username` = '$username'");
        $sql_email = mysqli_query($connectToDB,"SELECT `email` FROM `members` WHERE  `email` = '$email'");

        if (mysqli_num_rows($sql_username) > 0) {
            echo '<div class="alert alert-danger" role="alert"> هذا الاسم موجود بالفعل من فضلك اختر اسم اخر </div>';
        } elseif (mysqli_num_rows($sql_email) > 0) {
            echo '<div class="alert alert-danger" role="alert"> هذا البريد موجود بالفعل من فضلك اختر بريد اخر </div>';
        } else {

            if (isset($_FILES['image'])) {

                $image = $_FILES['image'];
                $imageName = $image['name'];
                $imageTmp = $image['tmp_name'];
                $imageSize = $image['size'];
                $imageError = $image['error'];
                $imageExe = explode('.', $imageName);
                $imageExe = strtolower(end($imageExe));

                $allowedExtensions = ['png', 'gif', 'jpg', 'jpeg'];

                if (in_array($imageExe, $allowedExtensions)) {
                    if ($imageError === 0) {
                        if ($imageSize <= 3000000) {
                            $new_name_image = uniqid('user', false) . '.' . $imageExe;
                            $image_Path = '../images/avatar/' . $new_name_image;
                            $image_DB = 'images/avatar/' . $new_name_image;

                            if (move_uploaded_file($imageTmp, $image_Path)) {

                                $password = md5($_POST['password']);
                                $insert = "INSERT INTO `members` (`username`,`email`,`password`,`gender`,`avatar`,`about_user`,`facebook`,`twitter`,`youtube`,`created_at`,`role`)
                                           VALUES ('$username','$email','$password','$gender','$image_DB','$about','$facebook','$twitter','$youtube','$date','user')";
                                $insert_data = mysqli_query($connectToDB,$insert);

                                if (isset($insert_data)){
                                    $user_info = mysqli_query($connectToDB,"SELECT * FROM `members` WHERE `username` = '$username'");
                                    $user = mysqli_fetch_assoc($user_info);
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

                                    echo '<div class="alert alert-success" role="alert">  تـهانينا تم تسجيلك بنجـاح </div>';
                                    echo '<meta http-equiv="refresh" content="3; \'index.php\' "/>';

                                }else{

                                    echo '<div class="alert alert-danger" role="alert"> عذراّ هناك خطأ جارى العمل على أصلاحة </div>';
                                }


                            } else {

                                echo '<div class="alert alert-danger" role="alert"> حدث خطأ وجارى العمل على أصلاحة </div>';

                            }
                        } else {

                            echo '<div class="alert alert-danger" role="alert">  عذرا حجم الصورة كبير جدا يجب أن لا يتعدى  (MB 3) </div>';
                        }

                    } else {

                        echo '<div class="alert alert-danger" role="alert"> حدث خطأ وجارى العمل على أصلاحة </div>';
                    }

                } else {
                    echo '<div class="alert alert-danger" role="alert">  مسموح فقط بصور صيغة (png,gif,jpg,jpeg) </div>';
                }

            } else {

                $password = md5($_POST['password']);
                $insert = "INSERT INTO `members` (`username`,`email`,`password`,`gender`,`avatar`,`about_user`,`facebook`,`twitter`,`youtube`,`created_at`,`role`)
                                           VALUES ('$username','$email','$password','$gender','images/avatar/Anonymous-Avatar.png','$about','$facebook','$twitter','$youtube','$date','user')";
                $insert_data = mysqli_query($connectToDB,$insert);
                if (isset($insert_data)){
                   $user_info = mysqli_query($connectToDB,"SELECT * FROM `members` WHERE `username` = '$username'");
                   $user = mysqli_fetch_assoc($user_info);
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

                    echo '<div class="alert alert-success" role="alert">   تـهانينا تم تسجيلك بنجـاح جارى الأن تحويلك للصفحة الرئيسية  </div>';
                    echo '<meta http-equiv="refresh" content="3; \'index.php\' "/>';

                }

            }
        }
    }


}












