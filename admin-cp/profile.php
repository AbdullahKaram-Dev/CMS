<?php
include_once ('inc/header.php');
include_once ('inc/sidebar.php');
include_once ('../include/config.php');

$user = mysqli_query($connectToDB,"SELECT * FROM members WHERE user_id = '$_SESSION[id]'");
$user = mysqli_fetch_object($user);


if (isset($_GET['status']) && isset($_GET['post'])) {

    $sql = mysqli_query($connectToDB, "UPDATE `posts` SET `status` = '$_GET[status]' WHERE `post_id` = '$_GET[post]'");
    if (isset($sql)){

        $message = "<div class='alert alert-success' role='alert'> تم تعديل وضع المقالة الى ".$_GET['status']."  وجارى التحديث الأن</div>";

        echo '<meta http-equiv="refresh" content="1; \'profile.php\'" >';

    }else{


        $message = "<div class='alert alert-danger' role='alert'> لم يتم التحديث هناك خطأ وجارى العمل على اصلاحة .... </div>";

        echo '<meta http-equiv="refresh" content="1; \'profile.php\'" >';
    }
}

if (isset($_GET['delete']) && !empty($_GET['delete'])) {

    if (is_numeric($_GET['delete'])) {
        $sql = mysqli_query($connectToDB, "DELETE FROM `posts` WHERE `post_id` = '$_GET[delete]'");
        if (isset($sql)) {

            $message = '<div class="alert alert-success" role="alert"> تم الحذف بنجاح  </div>';
        } else {

            $message = '<div class="alert alert-danger" role="alert"> ...حدث خطأ أثناء الحذف وجارى العمل على أصلاحة  </div>';
        }
    } else {

        $message = '<div class="alert alert-danger" role="alert"> هذا المعرف غير موجود  </div>';
    }
}



?>

    <article class="col-lg-9">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row">
                <div class="panel panel-info">
                    <?php if (isset($message) && !empty($message)){ echo $message; }  ?>
                    <div class="panel-heading">مرحباً بك يا <b> <?php echo ucfirst($user->username); ?> </b> فى صفحتك الشخصية</div>
                    <div class="panel-body">
                       <div class="col-md-9">
                           <p><b> الأسم : <?php echo $user->username; ?></b></p>
                           <p><b> البريد الألكتروني : <?php echo $user->email; ?></b></p>
                           <p><b> الجنس : <?php echo ($user->gender == 'male' ? '<i class="fas fa-male fa-lg" style="color: blue"></i>' : '<i class="fas fa-female fa-lg" style="color: rosybrown"></i>') ; ?></b></p>
                           <p><b> تاريخ التسجيل : <?php echo $user->created_at; ?></b></p>
                           <p><b> روابط التواصل : <a href="<?php echo $user->youtube; ?>" target="_blank"><i class="fab fa-youtube fa-lg" style="color: red;"></i> </a>  <a href="<?php echo $user->facebook; ?>" target="_blank"><i class="fab fa-facebook fa-lg"></i> </a>  <a href="<?php echo $user->twitter; ?>" target="_blank"><i class="fab fa-twitter fa-lg"></i> </a>  </b></p>
                       </div>
                       <div class="col-md-3">
                           <img src="../<?php echo $user->avatar; ?>" class="img-thumbnail" style="border: dashed darkslateblue 2px;" width="100%">
                       </div>
                        <div class="col-md-12">
                           <hr style="width: 100%; height: 2px;background-color: blue;">
                            <p><strong>الوصف المختصر :</strong></p>
                            <p class="bg-warning"><?php echo strip_tags($user->about_user); ?></p>
                            <a href="edit-user.php?user_id=<?php echo $user->user_id; ?>" class="btn btn-danger center-block">تعديل البيانات </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-12">
          <div class="panel panel-info">
              <div class="panel-heading"><strong>أخر المواضيع التى قمت بنشرها </strong></div>
                <div class="panel-body">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>رقم المقالة</th>
                            <th>صورة المقالة</th>
                            <th>عنوان المقال</th>
                            <th>تاريخ الانشاء</th>
                            <th>مشاهدة المقالة</th>
                            <th>حالة المقالة</th>
                            <th>تعديل المقالة</th>
                            <th>حذف المقالة</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        $DATA = mysqli_query($connectToDB, "SELECT * FROM `posts` WHERE `author` = '$_SESSION[id]' LIMIT 3");
                        $counter = 0;
                        while ($post = mysqli_fetch_assoc($DATA)) {
                            $counter++;

                            echo '                    
                      <tr>
                           <td>' . $counter . '</td>
                           <td><img src="../' . $post['image'] . '" class="img-rounded" width="50px"/></td>
                           <td>' . substr($post['title'], 0, 30) . '...</td>
                           <td>' . $post['created_at'] . '</td>
                           <td><a href="../post.php?post-id='.$post['post_id'].'" style="margin-right: 20px;" target="_blank"><i class="far fa-eye fa-lg"></i></a></td>
                           <td>' . ($post['status'] == 'unpublished' ? '<a href="profile.php?status=published&post=' . $post['post_id'] . '" class="btn btn-danger btn-xs"> معطلة </a>' : '<a href="profile.php?status=unpublished&post=' . $post['post_id'] . '" class="btn btn-success btn-xs"> مفعلة </a>') . '</td>
                           <td><a href="edit-post.php?post_id='.$post['post_id'].'" class="btn btn-warning btn-xs">تعديل</a></td>
                           <td><a href="profile.php?delete=' . $post['post_id'] . '" class="btn btn-danger btn-xs">حذف</a></td>
                       </tr>
                      ';

                        }

                        ?>

                        </tbody>

                    </table>


                </div>
          </div>
        </div>
    </article>

<?php
include_once ('inc/footer.php');
?>