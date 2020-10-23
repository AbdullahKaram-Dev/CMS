<?php
session_start();
include '../include/config.php';

if (isset($_POST['submit'])) {

    $id = intval($_POST['user']);
    $Data_User = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id' ");
    $user = mysqli_fetch_assoc($Data_User);

    $username = $_POST['username'];
    $email = $_POST['email'];

    if (empty($username)) {

        echo '<div class="alert alert-danger" role="alert"> حقل الأسم لا يجب ان يكون فارغا </div>';
    } elseif (empty($email)) {

        echo '<div class="alert alert-danger" role="alert"> حقل البريد الألكتروني لا يجب ان يكون فارغا </div>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="alert alert-danger" role="alert"> يجب اختيار بريد الكتروني صحيح </div>';
    } else {

        $sql = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `username` = '$username' OR `email` = '$email'");
        if (mysqli_num_rows($sql) > 0) {
            if ($username == $user['username'] && $email == $user['email']) {

                if ($_POST['password'] != '' || $_POST['con_password'] != '') {
                    if ($_POST['password'] != $_POST['con_password']) {
                        echo '<div class="alert alert-danger" role="alert"> كلمة المرور غير متطابقة </div>';
                    } else {
                        $password = md5($_POST['password']);
                        if (isset($_FILES['image'])) {
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

                                            $update_user = "UPDATE `members` SET `password` = '$password',
`gender` ='$_POST[gender]',
`avatar`= '$image_db',
`about_user`='$_POST[about]',
`facebook`='$_POST[facebook]',
`twitter`='$_POST[twitter]',
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                                            $sql = mysqli_query($connectToDB, $update_user);
                                            if ($sql) {

                                                session_unset();
                                                $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                                                $user = mysqli_fetch_assoc($user_info);
                                                $_SESSION['id'] = $user['user_id'];
                                                $_SESSION['user'] = $user['username'];
                                                $_SESSION['email'] = $user['email'];
                                                $_SESSION['gender'] = $user['gender'];
                                                $_SESSION['avatar'] = $user['avatar'];
                                                $_SESSION['about'] = $user['about_user'];
                                                $_SESSION['facebook'] = $user['facebook'];
                                                $_SESSION['twitter'] = $user['twitter'];
                                                $_SESSION['youtube'] = $user['youtube'];
                                                $_SESSION['date'] = $user['created_at'];
                                                $_SESSION['role'] = $user['role'];

                                                echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                                echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";
                                            }


                                        } else {

                                            echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                        }


                                    } else {

                                        echo '<div class="alert alert-danger" role="alert"> MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                                    }

                                } else {

                                    echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                            }
                        } else {

                            $update_user = "UPDATE `members` SET `password` = '$password',
`gender` ='$_POST[gender]',
`about_user`='$_POST[about]',
`facebook`='$_POST[facebook]',
`twitter`='$_POST[twitter]',
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                            $sql = mysqli_query($connectToDB, $update_user);
                            if ($sql) {

                                session_unset();
                                $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                                $user = mysqli_fetch_assoc($user_info);
                                $_SESSION['id'] = $user['user_id'];
                                $_SESSION['user'] = $user['username'];
                                $_SESSION['email'] = $user['email'];
                                $_SESSION['gender'] = $user['gender'];
                                $_SESSION['avatar'] = $user['avatar'];
                                $_SESSION['about'] = $user['about_user'];
                                $_SESSION['facebook'] = $user['facebook'];
                                $_SESSION['twitter'] = $user['twitter'];
                                $_SESSION['youtube'] = $user['youtube'];
                                $_SESSION['date'] = $user['created_at'];
                                $_SESSION['role'] = $user['role'];

                                echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";
                            }
                        }

                    }

                } else {

                    if (isset($_FILES['image'])) {
                        $image = $_FILES['image'];
                        $image_name = $image['name'];
                        $image_tmp = $image['tmp_name'];
                        $image_size = $image['size'];
                        $image_error = $image['error'];

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
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                                        $sql = mysqli_query($connectToDB, $update_user);
                                        if ($sql) {

                                            session_unset();
                                            $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                                            $user = mysqli_fetch_assoc($user_info);
                                            $_SESSION['id'] = $user['user_id'];
                                            $_SESSION['user'] = $user['username'];
                                            $_SESSION['email'] = $user['email'];
                                            $_SESSION['gender'] = $user['gender'];
                                            $_SESSION['avatar'] = $user['avatar'];
                                            $_SESSION['about'] = $user['about_user'];
                                            $_SESSION['facebook'] = $user['facebook'];
                                            $_SESSION['twitter'] = $user['twitter'];
                                            $_SESSION['youtube'] = $user['youtube'];
                                            $_SESSION['date'] = $user['created_at'];
                                            $_SESSION['role'] = $user['role'];

                                            echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                            echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";
                                        }


                                    } else {

                                        echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                    }


                                } else {

                                    echo '<div class="alert alert-danger" role="alert"> MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                                }

                            } else {

                                echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                        }
                    } else {

                        $update_user = "UPDATE `members` SET
`gender` ='$_POST[gender]',
`about_user`='$_POST[about]',
`facebook`='$_POST[facebook]',
`twitter`='$_POST[twitter]',
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                        $sql = mysqli_query($connectToDB, $update_user);
                        if ($sql) {

                            session_unset();
                            $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                            $user = mysqli_fetch_assoc($user_info);
                            $_SESSION['id'] = $user['user_id'];
                            $_SESSION['user'] = $user['username'];
                            $_SESSION['email'] = $user['email'];
                            $_SESSION['gender'] = $user['gender'];
                            $_SESSION['avatar'] = $user['avatar'];
                            $_SESSION['about'] = $user['about_user'];
                            $_SESSION['facebook'] = $user['facebook'];
                            $_SESSION['twitter'] = $user['twitter'];
                            $_SESSION['youtube'] = $user['youtube'];
                            $_SESSION['date'] = $user['created_at'];
                            $_SESSION['role'] = $user['role'];

                            echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                            echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";
                        }
                    }


                }

            } elseif ($username != $user['username'] && $email == $user['email']) {
                $sql = mysqli_query($connectToDB, "SELECT `username` FROM `members` WHERE `username` = '$username'");
                if (mysqli_num_rows($sql) > 0) {
                    echo '<div class="alert alert-danger" role="alert"> الأسم مسجل بالفعل </div>';

                } else {

                    if ($_POST['password'] != '' || $_POST['con_password'] != '') {
                        if ($_POST['password'] != $_POST['con_password']) {
                            echo '<div class="alert alert-danger" role="alert"> كلمة المرور غير متطابقة </div>';
                        } else {
                            $password = md5($_POST['password']);
                            if (isset($_FILES['image'])) {

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
`username` = '$username',
`password` = '$password',
`gender` ='$_POST[gender]',
`avatar`= '$image_db',
`about_user`='$_POST[about]',
`facebook`='$_POST[facebook]',
`twitter`='$_POST[twitter]',
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                                                $sql = mysqli_query($connectToDB, $update_user);
                                                if ($sql) {

                                                    session_unset();
                                                    $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                                                    $user = mysqli_fetch_assoc($user_info);
                                                    $_SESSION['id'] = $user['user_id'];
                                                    $_SESSION['user'] = $user['username'];
                                                    $_SESSION['email'] = $user['email'];
                                                    $_SESSION['gender'] = $user['gender'];
                                                    $_SESSION['avatar'] = $user['avatar'];
                                                    $_SESSION['about'] = $user['about_user'];
                                                    $_SESSION['facebook'] = $user['facebook'];
                                                    $_SESSION['twitter'] = $user['twitter'];
                                                    $_SESSION['youtube'] = $user['youtube'];
                                                    $_SESSION['date'] = $user['created_at'];
                                                    $_SESSION['role'] = $user['role'];

                                                    echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                                    echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";
                                                }


                                            } else {

                                                echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                            }


                                        } else {

                                            echo '<div class="alert alert-danger" role="alert">MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                                        }

                                    } else {

                                        echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                                    }
                                } else {
                                    echo '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                                }
                            } else {

                                $update_user = "UPDATE `members` SET `password` = '$password',
`username` = '$username',
`gender` ='$_POST[gender]',
`about_user`='$_POST[about]',
`facebook`='$_POST[facebook]',
`twitter`='$_POST[twitter]',
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                                $sql = mysqli_query($connectToDB, $update_user);
                                if ($sql) {

                                    session_unset();
                                    $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                                    $user = mysqli_fetch_assoc($user_info);
                                    $_SESSION['id'] = $user['user_id'];
                                    $_SESSION['user'] = $user['username'];
                                    $_SESSION['email'] = $user['email'];
                                    $_SESSION['gender'] = $user['gender'];
                                    $_SESSION['avatar'] = $user['avatar'];
                                    $_SESSION['about'] = $user['about_user'];
                                    $_SESSION['facebook'] = $user['facebook'];
                                    $_SESSION['twitter'] = $user['twitter'];
                                    $_SESSION['youtube'] = $user['youtube'];
                                    $_SESSION['date'] = $user['created_at'];
                                    $_SESSION['role'] = $user['role'];

                                    echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                    echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";
                                }
                            }

                        }

                    } else {

                        if (isset($_FILES['image'])) {
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
`username` = '$username',    
`gender` ='$_POST[gender]',
`avatar`= '$image_db',
`about_user`='$_POST[about]',
`facebook`='$_POST[facebook]',
`twitter`='$_POST[twitter]',
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                                            $sql = mysqli_query($connectToDB, $update_user);
                                            if ($sql) {


                                                session_unset();
                                                $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                                                $user = mysqli_fetch_assoc($user_info);
                                                $_SESSION['id'] = $user['user_id'];
                                                $_SESSION['user'] = $user['username'];
                                                $_SESSION['email'] = $user['email'];
                                                $_SESSION['gender'] = $user['gender'];
                                                $_SESSION['avatar'] = $user['avatar'];
                                                $_SESSION['about'] = $user['about_user'];
                                                $_SESSION['facebook'] = $user['facebook'];
                                                $_SESSION['twitter'] = $user['twitter'];
                                                $_SESSION['youtube'] = $user['youtube'];
                                                $_SESSION['date'] = $user['created_at'];
                                                $_SESSION['role'] = $user['role'];

                                                echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                                echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";

                                            }


                                        } else {

                                            echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                        }


                                    } else {

                                        echo '<div class="alert alert-danger" role="alert"> MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                                    }

                                } else {

                                    echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                            }
                        } else {

                            $update_user = "UPDATE `members` SET
`username` = '$username',
`gender` ='$_POST[gender]',
`about_user`='$_POST[about]',
`facebook`='$_POST[facebook]',
`twitter`='$_POST[twitter]',
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                            $sql = mysqli_query($connectToDB, $update_user);
                            if ($sql) {

                                session_unset();
                                $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                                $user = mysqli_fetch_assoc($user_info);
                                $_SESSION['id'] = $user['user_id'];
                                $_SESSION['user'] = $user['username'];
                                $_SESSION['email'] = $user['email'];
                                $_SESSION['gender'] = $user['gender'];
                                $_SESSION['avatar'] = $user['avatar'];
                                $_SESSION['about'] = $user['about_user'];
                                $_SESSION['facebook'] = $user['facebook'];
                                $_SESSION['twitter'] = $user['twitter'];
                                $_SESSION['youtube'] = $user['youtube'];
                                $_SESSION['date'] = $user['created_at'];
                                $_SESSION['role'] = $user['role'];

                                echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";
                            }
                        }

                    }
                }

            } elseif ($username == $user['username'] && $email != $user['email']) {


                $sql = mysqli_query($connectToDB, "SELECT `email` FROM `members` WHERE `email` = '$email'");
                if (mysqli_num_rows($sql) > 0) {
                    echo '<div class="alert alert-danger" role="alert"> البريد الألكتروني مسجل بالفعل </div>';

                } else {

                    if ($_POST['password'] != '' || $_POST['con_password'] != '') {
                        if ($_POST['password'] != $_POST['con_password']) {
                            echo '<div class="alert alert-danger" role="alert"> كلمة المرور غير متطابقة </div>';
                        } else {
                            $password = md5($_POST['password']);
                            if (isset($_FILES['image'])) {

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
`email` = '$email',
`password` = '$password',
`gender` ='$_POST[gender]',
`avatar`= '$image_db',
`about_user`='$_POST[about]',
`facebook`='$_POST[facebook]',
`twitter`='$_POST[twitter]',
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                                                $sql = mysqli_query($connectToDB, $update_user);
                                                if ($sql) {

                                                    session_unset();
                                                    $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                                                    $user = mysqli_fetch_assoc($user_info);
                                                    $_SESSION['id'] = $user['user_id'];
                                                    $_SESSION['user'] = $user['username'];
                                                    $_SESSION['email'] = $user['email'];
                                                    $_SESSION['gender'] = $user['gender'];
                                                    $_SESSION['avatar'] = $user['avatar'];
                                                    $_SESSION['about'] = $user['about_user'];
                                                    $_SESSION['facebook'] = $user['facebook'];
                                                    $_SESSION['twitter'] = $user['twitter'];
                                                    $_SESSION['youtube'] = $user['youtube'];
                                                    $_SESSION['date'] = $user['created_at'];
                                                    $_SESSION['role'] = $user['role'];

                                                    echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                                    echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";
                                                }


                                            } else {

                                                echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                            }


                                        } else {

                                            echo '<div class="alert alert-danger" role="alert"> MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                                        }

                                    } else {

                                        echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                                    }
                                } else {
                                    echo '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                                }
                            } else {

                                $update_user = "UPDATE `members` SET `password` = '$password',
`email` = '$email',
`gender` ='$_POST[gender]',
`about_user`='$_POST[about]',
`facebook`='$_POST[facebook]',
`twitter`='$_POST[twitter]',
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                                $sql = mysqli_query($connectToDB, $update_user);
                                if ($sql) {

                                    session_unset();
                                    $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                                    $user = mysqli_fetch_assoc($user_info);
                                    $_SESSION['id'] = $user['user_id'];
                                    $_SESSION['user'] = $user['username'];
                                    $_SESSION['email'] = $user['email'];
                                    $_SESSION['gender'] = $user['gender'];
                                    $_SESSION['avatar'] = $user['avatar'];
                                    $_SESSION['about'] = $user['about_user'];
                                    $_SESSION['facebook'] = $user['facebook'];
                                    $_SESSION['twitter'] = $user['twitter'];
                                    $_SESSION['youtube'] = $user['youtube'];
                                    $_SESSION['date'] = $user['created_at'];
                                    $_SESSION['role'] = $user['role'];

                                    echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                    echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";
                                }
                            }

                        }

                    } else {

                        if (isset($_FILES['image'])) {

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
`email` = '$email',    
`gender` ='$_POST[gender]',
`avatar`= '$image_db',
`about_user`='$_POST[about]',
`facebook`='$_POST[facebook]',
`twitter`='$_POST[twitter]',
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                                            $sql = mysqli_query($connectToDB, $update_user);
                                            if ($sql) {

                                                session_unset();
                                                $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                                                $user = mysqli_fetch_assoc($user_info);
                                                $_SESSION['id'] = $user['user_id'];
                                                $_SESSION['user'] = $user['username'];
                                                $_SESSION['email'] = $user['email'];
                                                $_SESSION['gender'] = $user['gender'];
                                                $_SESSION['avatar'] = $user['avatar'];
                                                $_SESSION['about'] = $user['about_user'];
                                                $_SESSION['facebook'] = $user['facebook'];
                                                $_SESSION['twitter'] = $user['twitter'];
                                                $_SESSION['youtube'] = $user['youtube'];
                                                $_SESSION['date'] = $user['created_at'];
                                                $_SESSION['role'] = $user['role'];

                                                echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                                echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";
                                            }


                                        } else {

                                            echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                        }


                                    } else {

                                        echo '<div class="alert alert-danger" role="alert"> MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                                    }

                                } else {

                                    echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                            }
                        } else {

                            $update_user = "UPDATE `members` SET
`email` = '$email',
`gender` ='$_POST[gender]',
`about_user`='$_POST[about]',
`facebook`='$_POST[facebook]',
`twitter`='$_POST[twitter]',
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                            $sql = mysqli_query($connectToDB, $update_user);
                            if ($sql) {

                                session_unset();
                                $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                                $user = mysqli_fetch_assoc($user_info);
                                $_SESSION['id'] = $user['user_id'];
                                $_SESSION['user'] = $user['username'];
                                $_SESSION['email'] = $user['email'];
                                $_SESSION['gender'] = $user['gender'];
                                $_SESSION['avatar'] = $user['avatar'];
                                $_SESSION['about'] = $user['about_user'];
                                $_SESSION['facebook'] = $user['facebook'];
                                $_SESSION['twitter'] = $user['twitter'];
                                $_SESSION['youtube'] = $user['youtube'];
                                $_SESSION['date'] = $user['created_at'];
                                $_SESSION['role'] = $user['role'];

                                echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";
                            }
                        }

                    }
                }

            } else {
                echo '<div class="alert alert-danger" role="alert"> الأسم أو البريد الألكتروني مسجل بالفعل </div>';
            }
        } else {

            if ($_POST['password'] != '' || $_POST['con_password'] != '') {
                if ($_POST['password'] != $_POST['con_password']) {
                    echo '<div class="alert alert-danger" role="alert"> كلمة المرور غير متطابقة </div>';
                } else {
                    $password = md5($_POST['password']);
                    if (isset($_FILES['image'])) {


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
`username` = '$username', 
`email` = '$email',
`password` = '$password',
`gender` ='$_POST[gender]',
`avatar`= '$image_db',
`about_user`='$_POST[about]',
`facebook`='$_POST[facebook]',
`twitter`='$_POST[twitter]',
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                                        $sql = mysqli_query($connectToDB, $update_user);
                                        if ($sql) {

                                            session_unset();
                                            $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                                            $user = mysqli_fetch_assoc($user_info);
                                            $_SESSION['id'] = $user['user_id'];
                                            $_SESSION['user'] = $user['username'];
                                            $_SESSION['email'] = $user['email'];
                                            $_SESSION['gender'] = $user['gender'];
                                            $_SESSION['avatar'] = $user['avatar'];
                                            $_SESSION['about'] = $user['about_user'];
                                            $_SESSION['facebook'] = $user['facebook'];
                                            $_SESSION['twitter'] = $user['twitter'];
                                            $_SESSION['youtube'] = $user['youtube'];
                                            $_SESSION['date'] = $user['created_at'];
                                            $_SESSION['role'] = $user['role'];

                                            echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                            echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";

                                        }


                                    } else {

                                        echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                    }


                                } else {

                                    echo '<div class="alert alert-danger" role="alert"> MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                                }

                            } else {

                                echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                        }
                    } else {

                        $update_user = "UPDATE `members` SET `password` = '$password',
`username` = '$username',
`email` = '$email',
`gender` ='$_POST[gender]',
`about_user`='$_POST[about]',
`facebook`='$_POST[facebook]',
`twitter`='$_POST[twitter]',
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                        $sql = mysqli_query($connectToDB, $update_user);
                        if ($sql) {

                            session_unset();
                            $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                            $user = mysqli_fetch_assoc($user_info);
                            $_SESSION['id'] = $user['user_id'];
                            $_SESSION['user'] = $user['username'];
                            $_SESSION['email'] = $user['email'];
                            $_SESSION['gender'] = $user['gender'];
                            $_SESSION['avatar'] = $user['avatar'];
                            $_SESSION['about'] = $user['about_user'];
                            $_SESSION['facebook'] = $user['facebook'];
                            $_SESSION['twitter'] = $user['twitter'];
                            $_SESSION['youtube'] = $user['youtube'];
                            $_SESSION['date'] = $user['created_at'];
                            $_SESSION['role'] = $user['role'];

                            echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                            echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";
                        }
                    }

                }

            } else {

                if (isset($_FILES['image'])) {

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
`username` = '$username',
`email` = '$email',    
`gender` ='$_POST[gender]',
`avatar`= '$image_db',
`about_user`='$_POST[about]',
`facebook`='$_POST[facebook]',
`twitter`='$_POST[twitter]',
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                                    $sql = mysqli_query($connectToDB, $update_user);
                                    if ($sql) {

                                        session_unset();
                                        $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                                        $user = mysqli_fetch_assoc($user_info);
                                        $_SESSION['id'] = $user['user_id'];
                                        $_SESSION['user'] = $user['username'];
                                        $_SESSION['email'] = $user['email'];
                                        $_SESSION['gender'] = $user['gender'];
                                        $_SESSION['avatar'] = $user['avatar'];
                                        $_SESSION['about'] = $user['about_user'];
                                        $_SESSION['facebook'] = $user['facebook'];
                                        $_SESSION['twitter'] = $user['twitter'];
                                        $_SESSION['youtube'] = $user['youtube'];
                                        $_SESSION['date'] = $user['created_at'];
                                        $_SESSION['role'] = $user['role'];

                                        echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                                        echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";
                                    }


                                } else {

                                    echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى  </div>';

                                }


                            } else {

                                echo '<div class="alert alert-danger" role="alert"> MP3 حجم الصورة كبير جدا لا يجب ان يتعدى   </div>';
                            }

                        } else {

                            echo '<div class="alert alert-danger" role="alert"> حدث خطأ أثناء رفع الصورة حاول مرة أخرى </div>';

                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert"> (\'gif\',\'png\',\'jpg\',\'jpej\') يجب أختيار امتداد صورة  </div>';
                    }
                } else {

                    $update_user = "UPDATE `members` SET
`username` = '$username',
`email` = '$email',
`gender` ='$_POST[gender]',
`about_user`='$_POST[about]',
`facebook`='$_POST[facebook]',
`twitter`='$_POST[twitter]',
`youtube`='$_POST[youtube]'
WHERE `user_id` = '$id'
";

                    $sql = mysqli_query($connectToDB, $update_user);
                    if ($sql) {

                        session_unset();
                        $user_info = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$id'");
                        $user = mysqli_fetch_assoc($user_info);
                        $_SESSION['id'] = $user['user_id'];
                        $_SESSION['user'] = $user['username'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['gender'] = $user['gender'];
                        $_SESSION['avatar'] = $user['avatar'];
                        $_SESSION['about'] = $user['about_user'];
                        $_SESSION['facebook'] = $user['facebook'];
                        $_SESSION['twitter'] = $user['twitter'];
                        $_SESSION['youtube'] = $user['youtube'];
                        $_SESSION['date'] = $user['created_at'];
                        $_SESSION['role'] = $user['role'];

                        echo '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح جارى التحويل  ...</div>';
                        echo "<meta http-equiv='refresh' content='3; edit-profile.php?user=" . $id . "'>";
                    }
                }

            }
        }

    }

} else {

    header("LOCATION: index.php");
}


?>