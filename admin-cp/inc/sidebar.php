<?php
if (! session_id()){
    session_start();
}
?>
<aside class="col-lg-3">
    <div class="list-group">
        <?php if ($_SESSION['role'] == 'admin') : ?>
        <a href="" class="list-group-item disabled"><h1 style="color: #2aabd2">قائمة التحكم</h1></a>
        <a href="index.php" class="list-group-item"><i class="fas fa-users-cog" style="color: red"></i><strong> لوحة التحكم </strong></a>
        <a href="setting.php" class="list-group-item"><i class="fas fa-cogs" style="color: blue"></i><strong> أعدادات الموقع </strong></a>
        <a href="category.php" class="list-group-item"><i class="fab fa-accusoft" style="color: green"></i><strong> التصنيفات </strong></a>
        <a href="new-post.php" class="list-group-item"><i class="fas fa-plus" style="color: gold"></i><strong> أضافة مقال جديد </strong></a>
        <a href="posts.php" class="list-group-item"><i class="fab fa-blogger" style="color: slateblue"></i><strong> الـمـقالات </strong></a>
        <a href="users.php" class="list-group-item"><i class="fas fa-users" style="color: fuchsia"></i><strong> الأعضاء </strong></a>
        <a href="comment.php" class="list-group-item"><i class="far fa-comment-alt" style="color: springgreen"></i><strong> التـعليـقات </strong></a>
        <a href="profile.php" class="list-group-item"><i class="fas fa-pager" style="color: slategrey"></i><strong> الصفـحة ألـشخصية </strong></a>
        <?php else:; ?>

            <a href="" class="list-group-item disabled"><h1 style="color: #2aabd2">قائمة التحكم</h1></a>
            <a href="index.php" class="list-group-item"><i class="fas fa-users-cog" style="color: red"></i><strong> لوحة التحكم </strong></a>
            <a href="category.php" class="list-group-item"><i class="fab fa-accusoft" style="color: green"></i><strong> التصنيفات </strong></a>
            <a href="new-post.php" class="list-group-item"><i class="fas fa-plus" style="color: gold"></i><strong> أضافة مقال جديد </strong></a>
            <a href="posts.php" class="list-group-item"><i class="fab fa-blogger" style="color: slateblue"></i><strong> الـمـقالات </strong></a>
            <a href="comment.php" class="list-group-item"><i class="far fa-comment-alt" style="color: springgreen"></i><strong> التـعليـقات </strong></a>
            <a href="profile.php" class="list-group-item"><i class="fas fa-pager" style="color: slategrey"></i><strong> الصفـحة ألـشخصية </strong></a>

        <?php endif; ?>
    </div>

</aside>