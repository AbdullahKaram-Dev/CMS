<?php
include_once('inc/header.php');
include_once('inc/sidebar.php');
include_once('../include/config.php');


if (isset($_GET['status']) && isset($_GET['comment'])) {

    $sql = mysqli_query($connectToDB, "UPDATE `comments` SET `status` = '$_GET[status]' WHERE `comment_id` = '$_GET[comment]'");

}

if (isset($_GET['delete']) && !empty($_GET['delete'])) {


    $id = $_GET['delete'];

    $Query = mysqli_query($connectToDB, "DELETE FROM `comments` WHERE `comment_id` = '$id'");
    if ($connectToDB->query($Query) === true) {

        $message = '<div class="alert alert-success" role="alert"> تم الحذف بنجاح  </div>';
    } else {

        $message = '<div class="alert alert-danger" role="alert">حدث خطأ أثناء الحذف وجارى العمل على أصلاحة  </div>';
    }

}


?>

    <article class="col-lg-9">
        <?php if (isset($message) && !empty($message)) {
            echo $message;
        } ?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <b> جـميع المقالات </b>
            </div>
            <div class="panel-body">

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>رقم التعليق</th>
                        <th>عنوان التعليق</th>
                        <th>التعليق</th>
                        <th>الكاتب</th>
                        <th>تاريخ الانشاء</th>
                        <th>مشاهدة</th>
                        <th>حالة التعليق</th>
                        <th>تعديل التعليق</th>
                        <th>حذف التعليق</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php


                    $per_page = 3;

                    if (!isset($_GET['page'])) {
                        $page = 1;

                    } else {

                        $page = (int)$_GET['page'];
                    }

                    $start_from = ($page - 1) * $per_page;


                    $DATA = mysqli_query($connectToDB, "SELECT *  FROM `comments` c INNER JOIN `members` m WHERE c.user_id = m.user_id ORDER BY `comment_id` DESC LIMIT $start_from , $per_page");
                    $counter = 0;
                    while ($comment = mysqli_fetch_assoc($DATA)) {
                        $counter++;

                        echo '                    
                      <tr>
                           <td>' . $counter . '</td>
                           <td>' . substr($comment['title'], 0, 100) .'</td>
                           <td>' . substr($comment['comment'], 0, 200) . '</td>
                           <td><b style="background-color: #D9EDF7;">' . $comment['username'] . '</b></td>
                           <td>' . $comment['created_at'] . '</td>
                           <td><a href="../post.php?id=' . $comment['post_id'] . '" style="margin-right: 20px;" target="_blank"><i class="far fa-eye fa-lg"></i></a></td>
                           <td>' . ($comment['status'] == 'unpublished' ? '<a href="comment.php?status=published&comment=' . $comment['comment_id'] . '&page=' . $page . '" class="btn btn-danger btn-xs"> معطلة </a>' : '<a href="comment.php?status=unpublished&comment=' . $comment['comment_id'] . '&page=' . $page . '" class="btn btn-success btn-xs"> مفعلة </a>') . '</td>
                           <td><a href="edit-comment.php?post_id=' . $comment['comment_id'] . '" class="btn btn-warning btn-xs">تعديل</a></td>
                           <td><a href="comment.php?delete=' . $comment['comment_id'] . '&page=' . $page . '" class="btn btn-danger btn-xs">حذف</a></td>
                       </tr>
                      ';

                    }

                    ?>

                    </tbody>

                </table>
                <?php

                $page_sql = mysqli_query($connectToDB, "SELECT * FROM `comments`");
                $count_page = mysqli_num_rows($page_sql);


                $total_page = ceil($count_page / $per_page);
                ?>
                <nav class="text-center">
                    <ul class="pagination">

                        <?php
                        for ($i = 1; $i <= $total_page; $i++) {

                            echo '<li ' . ($page == $i ? 'class="active"' : '') . '><a href="comment.php?page=' . $i . '">' . $i . '</a></li>';
                        }
                        ?>
                    </ul>
                </nav>


                <a href="comment.php" class="btn btn-info"> تحديث الصفحة </a>
            </div>
        </div>
    </article>


<?php
include_once('inc/footer.php');
?>