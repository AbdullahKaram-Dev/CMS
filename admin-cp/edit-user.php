<?php
include_once('inc/header.php');
include_once('inc/sidebar.php');
include_once('../include/config.php');

if ($_SESSION['role'] != 'admin'){
    header("LOCATION: index.php");
    exit();
}

$id = intval($_GET['user_id']);
$Data_User = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id' ");
$user = mysqli_fetch_assoc($Data_User);

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];

    if (empty($username)) {

        $message = '<div class="alert alert-danger" role="alert"> حقل الأسم لا يجب ان يكون فارغا </div>';
    } elseif (empty($email)) {

        $message = '<div class="alert alert-danger" role="alert"> حقل البريد الألكتروني لا يجب ان يكون فارغا </div>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<div class="alert alert-danger" role="alert"> يجب اختيار بريد الكتروني صحيح </div>';
    } else {

        $sql = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `username` = '$username' OR `email` = '$email'");
        if (mysqli_num_rows($sql) > 0) {
            if ($username == $user['username'] && $email == $user['email']) {

                if ($_POST['password'] != '' || $_POST['con_password'] != '') {
                    if ($_POST['password'] != $_POST['con_password']) {
                        $message = '<div class="alert alert-danger" role="alert"> كلمة المرور غير متطابقة </div>';
                    } else {
                        $password = md5($_POST['password']);
                        $image = $_FILES['image'];
                        $image_name = $image['name'];
                        $image_tmp = $image['tmp_name'];
                        $image_size = $image['size'];
                        $image_error = $image['error'];

                        if ($image_name != '') {

                            $image_exe = explode('.', $image_name);
                            $image_exe = strtolower(end($image_exe));

                            $allowedExtension = ['gif', 'png', 'jpg', 'jpej'];
                            if (in_array($image_exe, $allowedExtension)) {
                                if ($image_error === 0) {
                                    if ($image_size <= 30000) {

                                        $new_image_name = uniqid('user', false) . '.' . $image_exe;
                                        $image_dir = '../images/avatar/' . $new_image_name;
                                        $image_db = 'images/avatar/' . $new_image_name;
                                        if (move_uploaded_file($image_tmp, $image_dir)) {

                                            $update_user = "UPDATE `members` SET `password` = '$password',
                                    `gender` ='$_POST[gender]',
                                    `avatar`= '$image_db',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                                            $sql = mysqli_query($connectToDB, $update_user);
                                            if ($sql) {

                                                $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                                echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                                            }


                                        } else {

                                            $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                        }


                                    } else {

                                        $message = '<div class="alert alert-danger" role="alert"> MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                                    }

                                } else {

                                    $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                                }
                            } else {
                                $message = '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                            }
                        } else {

                            $update_user = "UPDATE `members` SET `password` = '$password',
                                    `gender` ='$_POST[gender]',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                            $sql = mysqli_query($connectToDB, $update_user);
                            if ($sql) {

                                $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                            }
                        }

                    }

                } else {

                    $image = $_FILES['image'];
                    $image_name = $image['name'];
                    $image_tmp = $image['tmp_name'];
                    $image_size = $image['size'];
                    $image_error = $image['error'];

                    if ($image_name != '') {

                        $image = $_FILES['image'];
                        $image_name = $image['name'];
                        $image_tmp = $image['tmp_name'];
                        $image_size = $image['size'];
                        $image_error = $image['error'];

                        $image_exe = explode('.', $image_name);
                        $image_exe = strtolower(end($image_exe));

                        $allowedExtension = ['gif', 'png', 'jpg', 'jpej'];
                        if (in_array($image_exe, $allowedExtension)) {
                            if ($image_error === 0) {
                                if ($image_size <= 30000) {

                                    $new_image_name = uniqid('user', false) . '.' . $image_exe;
                                    $image_dir = '../images/avatar/' . $new_image_name;
                                    $image_db = 'images/avatar/' . $new_image_name;
                                    if (move_uploaded_file($image_tmp, $image_dir)) {

                                        $update_user = "UPDATE `members` SET
                                    `gender` ='$_POST[gender]',
                                    `avatar`= '$image_db',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                                        $sql = mysqli_query($connectToDB, $update_user);
                                        if ($sql) {

                                            $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                            echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                                        }


                                    } else {

                                        $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                    }


                                } else {

                                    $message = '<div class="alert alert-danger" role="alert"> MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                                }

                            } else {

                                $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                            }
                        } else {
                            $message = '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                        }
                    } else {

                        $update_user = "UPDATE `members` SET
                                    `gender` ='$_POST[gender]',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                        $sql = mysqli_query($connectToDB, $update_user);
                        if ($sql) {

                            $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                            echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                        }
                    }


                }

            } elseif ($username != $user['username'] && $email == $user['email']) {
                $sql = mysqli_query($connectToDB, "SELECT `username` FROM `members` WHERE `username` = '$username'");
                if (mysqli_num_rows($sql) > 0) {
                    $message = '<div class="alert alert-danger" role="alert"> الأسم مسجل بالفعل </div>';

                } else {

                    if ($_POST['password'] != '' || $_POST['con_password'] != '') {
                        if ($_POST['password'] != $_POST['con_password']) {
                            $message = '<div class="alert alert-danger" role="alert"> كلمة المرور غير متطابقة </div>';
                        } else {
                            $password = md5($_POST['password']);
                            $image = $_FILES['image'];
                            $image_name = $image['name'];
                            $image_tmp = $image['tmp_name'];
                            $image_size = $image['size'];
                            $image_error = $image['error'];

                            if ($image_name != '') {

                                $image_exe = explode('.', $image_name);
                                $image_exe = strtolower(end($image_exe));

                                $allowedExtension = ['gif', 'png', 'jpg', 'jpej'];
                                if (in_array($image_exe, $allowedExtension)) {
                                    if ($image_error === 0) {
                                        if ($image_size <= 30000) {

                                            $new_image_name = uniqid('user', false) . '.' . $image_exe;
                                            $image_dir = '../images/avatar/' . $new_image_name;
                                            $image_db = 'images/avatar/' . $new_image_name;
                                            if (move_uploaded_file($image_tmp, $image_dir)) {

                                                $update_user = "UPDATE `members` SET 
                                    `username` = '$username',
                                    `password` = '$password',
                                    `gender` ='$_POST[gender]',
                                    `avatar`= '$image_db',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                                                $sql = mysqli_query($connectToDB, $update_user);
                                                if ($sql) {

                                                    $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                                    echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                                                }


                                            } else {

                                                $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                            }


                                        } else {

                                            $message = '<div class="alert alert-danger" role="alert">MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                                        }

                                    } else {

                                        $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                                    }
                                } else {
                                    $message = '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                                }
                            } else {

                                $update_user = "UPDATE `members` SET `password` = '$password',
                                    `username` = '$username',
                                    `gender` ='$_POST[gender]',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                                $sql = mysqli_query($connectToDB, $update_user);
                                if ($sql) {

                                    $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                    echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                                }
                            }

                        }

                    } else {

                        $image = $_FILES['image'];
                        $image_name = $image['name'];
                        $image_tmp = $image['tmp_name'];
                        $image_size = $image['size'];
                        $image_error = $image['error'];

                        if ($image_name != '') {

                            $image_exe = explode('.', $image_name);
                            $image_exe = strtolower(end($image_exe));

                            $allowedExtension = ['gif', 'png', 'jpg', 'jpej'];
                            if (in_array($image_exe, $allowedExtension)) {
                                if ($image_error === 0) {
                                    if ($image_size <= 30000) {

                                        $new_image_name = uniqid('user', false) . '.' . $image_exe;
                                        $image_dir = '../images/avatar/' . $new_image_name;
                                        $image_db = 'images/avatar/' . $new_image_name;
                                        if (move_uploaded_file($image_tmp, $image_dir)) {

                                            $update_user = "UPDATE `members` SET
                                    `username` = '$username',    
                                    `gender` ='$_POST[gender]',
                                    `avatar`= '$image_db',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                                            $sql = mysqli_query($connectToDB, $update_user);
                                            if ($sql) {

                                                $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                                echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                                            }


                                        } else {

                                            $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                        }


                                    } else {

                                        $message = '<div class="alert alert-danger" role="alert"> MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                                    }

                                } else {

                                    $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                                }
                            } else {
                                $message = '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                            }
                        } else {

                            $update_user = "UPDATE `members` SET
                                    `username` = '$username',
                                    `gender` ='$_POST[gender]',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                            $sql = mysqli_query($connectToDB, $update_user);
                            if ($sql) {

                                $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                            }
                        }

                    }
                }

            } elseif ($username == $user['username'] && $email != $user['email']) {


                $sql = mysqli_query($connectToDB, "SELECT `email` FROM `members` WHERE `email` = '$email'");
                if (mysqli_num_rows($sql) > 0) {
                    $message = '<div class="alert alert-danger" role="alert"> البريد الألكتروني مسجل بالفعل </div>';

                } else {

                    if ($_POST['password'] != '' || $_POST['con_password'] != '') {
                        if ($_POST['password'] != $_POST['con_password']) {
                            $message = '<div class="alert alert-danger" role="alert"> كلمة المرور غير متطابقة </div>';
                        } else {
                            $password = md5($_POST['password']);
                            $image = $_FILES['image'];
                            $image_name = $image['name'];
                            $image_tmp = $image['tmp_name'];
                            $image_size = $image['size'];
                            $image_error = $image['error'];

                            if ($image_name != '') {

                                $image_exe = explode('.', $image_name);
                                $image_exe = strtolower(end($image_exe));

                                $allowedExtension = ['gif', 'png', 'jpg', 'jpej'];
                                if (in_array($image_exe, $allowedExtension)) {
                                    if ($image_error === 0) {
                                        if ($image_size <= 30000) {

                                            $new_image_name = uniqid('user', false) . '.' . $image_exe;
                                            $image_dir = '../images/avatar/' . $new_image_name;
                                            $image_db = 'images/avatar/' . $new_image_name;
                                            if (move_uploaded_file($image_tmp, $image_dir)) {

                                                $update_user = "UPDATE `members` SET 
                                    `email` = '$email',
                                    `password` = '$password',
                                    `gender` ='$_POST[gender]',
                                    `avatar`= '$image_db',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                                                $sql = mysqli_query($connectToDB, $update_user);
                                                if ($sql) {

                                                    $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                                    echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                                                }


                                            } else {

                                                $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                            }


                                        } else {

                                            $message = '<div class="alert alert-danger" role="alert"> MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                                        }

                                    } else {

                                        $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                                    }
                                } else {
                                    $message = '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                                }
                            } else {

                                $update_user = "UPDATE `members` SET `password` = '$password',
                                    `email` = '$email',
                                    `gender` ='$_POST[gender]',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                                $sql = mysqli_query($connectToDB, $update_user);
                                if ($sql) {

                                    $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                    echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                                }
                            }

                        }

                    } else {

                        $image = $_FILES['image'];
                        $image_name = $image['name'];
                        $image_tmp = $image['tmp_name'];
                        $image_size = $image['size'];
                        $image_error = $image['error'];

                        if ($image_name != '') {

                            $image_exe = explode('.', $image_name);
                            $image_exe = strtolower(end($image_exe));

                            $allowedExtension = ['gif', 'png', 'jpg', 'jpej'];
                            if (in_array($image_exe, $allowedExtension)) {
                                if ($image_error === 0) {
                                    if ($image_size <= 30000) {

                                        $new_image_name = uniqid('user', false) . '.' . $image_exe;
                                        $image_dir = '../images/avatar/' . $new_image_name;
                                        $image_db = 'images/avatar/' . $new_image_name;
                                        if (move_uploaded_file($image_tmp, $image_dir)) {

                                            $update_user = "UPDATE `members` SET
                                    `email` = '$email',    
                                    `gender` ='$_POST[gender]',
                                    `avatar`= '$image_db',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                                            $sql = mysqli_query($connectToDB, $update_user);
                                            if ($sql) {

                                                $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                                echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                                            }


                                        } else {

                                            $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                        }


                                    } else {

                                        $message = '<div class="alert alert-danger" role="alert"> MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                                    }

                                } else {

                                    $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                                }
                            } else {
                                $message = '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                            }
                        } else {

                            $update_user = "UPDATE `members` SET
                                    `email` = '$email',
                                    `gender` ='$_POST[gender]',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                            $sql = mysqli_query($connectToDB, $update_user);
                            if ($sql) {

                                $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                            }
                        }

                    }
                }

            } else {
                $message = '<div class="alert alert-danger" role="alert"> الأسم أو البريد الألكتروني مسجل بالفعل </div>';
            }
        } else {

            if ($_POST['password'] != '' || $_POST['con_password'] != '') {
                if ($_POST['password'] != $_POST['con_password']) {
                    $message = '<div class="alert alert-danger" role="alert"> كلمة المرور غير متطابقة </div>';
                } else {
                    $password = md5($_POST['password']);
                    $image = $_FILES['image'];
                    $image_name = $image['name'];
                    $image_tmp = $image['tmp_name'];
                    $image_size = $image['size'];
                    $image_error = $image['error'];

                    if ($image_name != '') {

                        $image_exe = explode('.', $image_name);
                        $image_exe = strtolower(end($image_exe));

                        $allowedExtension = ['gif', 'png', 'jpg', 'jpej'];
                        if (in_array($image_exe, $allowedExtension)) {
                            if ($image_error === 0) {
                                if ($image_size <= 30000) {

                                    $new_image_name = uniqid('user', false) . '.' . $image_exe;
                                    $image_dir = '../images/avatar/' . $new_image_name;
                                    $image_db = 'images/avatar/' . $new_image_name;
                                    if (move_uploaded_file($image_tmp, $image_dir)) {

                                        $update_user = "UPDATE `members` SET
                                    `username` = '$username', 
                                    `email` = '$email',
                                    `password` = '$password',
                                    `gender` ='$_POST[gender]',
                                    `avatar`= '$image_db',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                                        $sql = mysqli_query($connectToDB, $update_user);
                                        if ($sql) {

                                            $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                            echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                                        }


                                    } else {

                                        $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                    }


                                } else {

                                    $message = '<div class="alert alert-danger" role="alert"> MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                                }

                            } else {

                                $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                            }
                        } else {
                            $message = '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                        }
                    } else {

                        $update_user = "UPDATE `members` SET `password` = '$password',
                                    `username` = '$username',
                                    `email` = '$email',
                                    `gender` ='$_POST[gender]',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                        $sql = mysqli_query($connectToDB, $update_user);
                        if ($sql) {

                            $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                            echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                        }
                    }

                }

            } else {

                $image = $_FILES['image'];
                $image_name = $image['name'];
                $image_tmp = $image['tmp_name'];
                $image_size = $image['size'];
                $image_error = $image['error'];

                if ($image_name != '') {

                    $image_exe = explode('.', $image_name);
                    $image_exe = strtolower(end($image_exe));

                    $allowedExtension = ['gif', 'png', 'jpg', 'jpej'];
                    if (in_array($image_exe, $allowedExtension)) {
                        if ($image_error === 0) {
                            if ($image_size <= 30000) {

                                $new_image_name = uniqid('user', false) . '.' . $image_exe;
                                $image_dir = '../images/avatar/' . $new_image_name;
                                $image_db = 'images/avatar/' . $new_image_name;
                                if (move_uploaded_file($image_tmp, $image_dir)) {

                                    $update_user = "UPDATE `members` SET
                                    `username` = '$username',
                                    `email` = '$email',    
                                    `gender` ='$_POST[gender]',
                                    `avatar`= '$image_db',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                                    $sql = mysqli_query($connectToDB, $update_user);
                                    if ($sql) {

                                        $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                        echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                                    }


                                } else {

                                    $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                }


                            } else {

                                $message = '<div class="alert alert-danger" role="alert"> MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                            }

                        } else {

                            $message = '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                        }
                    } else {
                        $message = '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                    }
                } else {

                    $update_user = "UPDATE `members` SET
                                    `username` = '$username',
                                    `email` = '$email',
                                    `gender` ='$_POST[gender]',
                                    `about_user`='$_POST[about]',
                                    `facebook`='$_POST[facebook]',
                                    `twitter`='$_POST[twitter]',
                                    `youtube`='$_POST[youtube]',
                                    `role`='$_POST[role]' WHERE `user_id` = '$id'
                                    ";

                    $sql = mysqli_query($connectToDB, $update_user);
                    if ($sql) {

                        $message = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                        echo '<meta http-equiv="refresh" content="3; \'users.php\'">';
                    }
                }

            }
        }

    }

}


$Data_User = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id' ");
$user = mysqli_fetch_assoc($Data_User);


?>

    <article class="col-lg-9">
        <?php if (isset($message) && !empty($message)) {
            echo $message;
        } ?>
        <div class="panel panel-info">
            <div class="panel-heading"> تعديل بيانات العضو : <?php echo "<b>$user[username]</b>" ?></div>
            <div class="panel-body">

                <form method="post" action="" class="form-horizontal col-md-9" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label"><i class="fas fa-user fa-2x"></i></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="username"
                                   value="<?php echo $user['username']; ?>" id="username" placeholder="أسم المستخدم">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label"><i class="fas fa-envelope-square fa-2x"
                                                                             style="color: dimgrey;"></i></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>"
                                   id="email" placeholder="البريد الألكتروني">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label"><i class="fas fa-lock fa-2x"></i></label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="كلمة المرور">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirm" class="col-sm-2 control-label"><i
                                    class="fas fa-lock fa-2x"></i></label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="con_password" id="password_confirm"
                                   placeholder="تأكيد كلمة المرور">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-sm-2 control-label"><i class="fas fa-venus-mars fa-2x"
                                                                              style="color: #2aabd2;"></i></label>
                        <div class="col-sm-6">
                            <select class="form-control" id="gender" name="gender">
                                <option disabled <?php echo($user['gender'] == '' ? 'selected' : '') ?>>أختر الجنس
                                </option>
                                <option value="male"<?php echo($user['gender'] == 'male' ? 'selected' : '') ?>>ذكر
                                </option>
                                <option value="female" <?php echo($user['gender'] == 'female' ? 'selected' : '') ?>>
                                    أنثي
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-sm-2 control-label"><i class="fas fa-images fa-2x"
                                                                             style="color: green;"></i></label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label"><i
                                    class="fas fa-prescription-bottle fa-2x"
                                    style="color: #66afe9; margin-top: 10px;"></i></label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="about" id="description" rows="3"
                                      placeholder="أضف وصف مختصر عنك"><?php echo $user['about_user']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="facebook" class="col-sm-2 control-label"><i class="fab fa-facebook fa-2x"
                                                                                style="color: darkblue;"></i></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="facebook"
                                   value="<?php echo $user['facebook']; ?>" id="facebook"
                                   placeholder="أدخل رابط الفيس بوك">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="twitter" class="col-sm-2 control-label"><i class="fab fa-twitter fa-2x"
                                                                               style="color: lightblue;"></i></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="twitter"
                                   value="<?php echo $user['twitter']; ?>" id="twitter" placeholder="أدخل رابط تويتر">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="youtube" class="col-sm-2 control-label"><i class="fab fa-youtube fa-2x"
                                                                               style="color: red;"></i></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="youtube"
                                   value="<?php echo $user['youtube']; ?>" id="youtube"
                                   placeholder="أدخل رابط اليوتيوب">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-sm-2 control-label"><i class="fas fa-venus-mars fa-2x"
                                                                            style="color: #2aabd2;"></i></label>
                        <div class="col-sm-6">
                            <select class="form-control" id="role" name="role">
                                <option value="user"<?php echo($user['role'] == 'user' ? 'selected' : '') ?>>عضو
                                </option>
                                <option value="admin" <?php echo($user['role'] == 'admin' ? 'selected' : '') ?>>مدير
                                </option>
                                <option value="writer"<?php echo($user['role'] == 'writer' ? 'selected' : '') ?>>كاتب
                                </option>

                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="submit" class="btn btn-primary">تعديل البيانات</button>
                        </div>
                    </div>
                </form>

                <div class="panel panel-default col-md-3">
                    <div class="panel-body">
                        <img src="../<?php echo $user['avatar']; ?>" width="100%">
                    </div>
                </div>

            </div>
        </div>
    </article>
<?php
include_once('inc/footer.php');
?>