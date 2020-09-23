<?php
include_once('inc/header.php');
include_once('inc/sidebar.php');
include_once('../include/config.php');


if (isset($_GET['status']) && isset($_GET['post'])) {

    $sql = mysqli_query($connectToDB, "UPDATE `posts` SET `status` = '$_GET[status]' WHERE `post_id` = '$_GET[post]'");

}

if (isset($_GET['delete']) && !empty($_GET['delete'])) {

    if (is_int($_GET['delete'])) {
        $sql = mysqli_query($connectToDB, "DELETE FROM `posts` WHERE `post_id` = '$id'");
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
        <?php if (isset($message) && !empty($message)) {
            echo $message;
        } ?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <b>  جـميع المقالات  </b>
            </div>
            <div class="panel-body">

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>رقم المقالة</th>
                        <th>صورة المقالة</th>
                        <th>عنوان المقال</th>
                        <th>الكاتب</th>
                        <th>تاريخ الانشاء</th>
                        <th>مشاهدة المقالة</th>
                        <th>حالة المقالة</th>
                        <th>تعديل المقالة</th>
                        <th>حذف المقالة</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $DATA = mysqli_query($connectToDB, "SELECT * FROM `posts` p INNER JOIN `members` m WHERE p.author = m.user_id");
                    $counter = 0;
                    while ($post = mysqli_fetch_assoc($DATA)) {
                        $counter++;

                        echo '                    
                      <tr>
                           <td>' . $counter . '</td>
                           <td><img src="../' . $post['image'] . '" class="img-rounded" width="50px"/></td>
                           <td>' . substr($post['title'], 0, 30) . '...</td>
                           <td><b style="background-color: #D9EDF7;">' . strtoupper($post['username']) . '</b></td>
                           <td>' . $post['created_at'] . '</td>
                           <td><a href="../post.php?post-id='.$post['post_id'].'" style="margin-right: 20px;" target="_blank"><i class="far fa-eye fa-lg"></i></a></td>
                           <td>' . ($post['status'] == 'unpublished' ? '<a href="posts.php?status=published&post=' . $post['post_id'] . '" class="btn btn-danger btn-xs"> معطلة </a>' : '<a href="posts.php?status=unpublished&post=' . $post['post_id'] . '" class="btn btn-success btn-xs"> مفعلة </a>') . '</td>
                           <td><a href="edit-post.php?post_id='.$post['post_id'].'" class="btn btn-warning btn-xs">تعديل</a></td>
                           <td><a href="posts.php?delete=' . $post['post_id'] . '" class="btn btn-danger btn-xs">حذف</a></td>
                       </tr>
                      ';

                    }

                    ?>

                    </tbody>

                </table>

                <a href="posts.php" class="btn btn-info"> تحديث الصفحة </a>
            </div>
        </div>
    </article>


<?php
include_once('inc/footer.php');
?>