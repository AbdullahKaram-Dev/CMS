<?php
include_once('include/header.php');
include_once('include/sidebar.php');

$id = intval($_GET['id']);
$Select_Post = mysqli_query($connectToDB,"SELECT * FROM `posts` p INNER JOIN `members` m ON p.author = m.user_id WHERE `post_id` = $id");
$post = mysqli_fetch_object($Select_Post);

?>
    <article class="col-md-9 col-lg-9">
        <ol class="breadcrumb">
            <li><a href="index.php">الرئيسية</a></li>
            <li><a href=""><?= $post->category; ?></a></li>
            <li class="active"><?= strip_tags($post->title); ?></li>
        </ol>
        <div class="col-lg-12 art_bg">
            <div class="cat_post">
                <div class="col-md-12">
                    <h1 class="cat_h2"><strong style="color: blue;">*</strong><i> <?= strip_tags($post->title); ?> </i><strong
                                style="color: blue;">*</strong></h1>
                    <img src="<?= $post->image; ?>" width="100%" style="border: groove 1px blue;max-height: 400px">
                </div>

                <strong></strong>
                <div class="col-md-12">
                    <div class="col-md-12 author_post">
                        <p class="pull-right"><i class="fas fa-user-alt"></i><a href="profile.php?user=<?= $post->user_id; ?>"> <?= $post->username; ?> </a></p>
                        <p class="pull-left"> <?= $post->created_at; ?> <i class="fas fa-stopwatch"></i></p>
                    </div>
                    <p><?= strip_tags($post->post); ?></p>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <!-- comment area -->
        <div class="col-md-12">
            <div class="row">
                <div class="cat_post">
                    <div class="col-md-2">
                        <img src="images/logo.jpg" class="rounded-circle"  width="100%" style="border: solid 3px #719CBD;">
                    </div>
                    <div class="col-md-10">
                        <h1 class="cat_h2"><i class="far fa-comments" style="color: #66afe9;"></i> عنوان التعليق </h1>
                        <p>المقال المقال المقال المقال المقال المقال المقال المقال المقال المقال</p>
                    </div>
                    <div class="col-md-12">
                        <hr style=" width: 100%;height: 1px;background-color: blue; margin-top: 0; margin-bottom: 8px;"/>
                        <p class="pull-left"> 2020-11-2 <i class="fas fa-stopwatch"></i></p>
                        <p class="pull-right"> تم التعليق بواسطة <i class="fas fa-user-alt"></i><a href="profile.php"> عبدالله </a></p>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="cat_post">
                    <div class="col-md-2">
                        <img src="images/logo.jpg" class="rounded-circle"  width="100%" style="border: solid 3px #719CBD;">
                    </div>
                    <div class="col-md-10">
                        <h1 class="cat_h2"><i class="far fa-comments" style="color: #66afe9;"></i> عنوان التعليق </h1>
                        <p>المقال المقال المقال المقال المقال المقال المقال المقال المقال المقال</p>
                    </div>
                    <div class="col-md-12">
                        <hr style=" width: 100%;height: 1px;background-color: blue; margin-top: 0; margin-bottom: 8px;"/>
                        <p class="pull-left"> 2020-11-2 <i class="fas fa-stopwatch"></i></p>
                        <p class="pull-right"> تم التعليق بواسطة <i class="fas fa-user-alt"></i><a href="profile.php"> عبدالله </a></p>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="cat_post">
                    <div class="col-md-2">
                        <img src="images/logo.jpg" class="rounded-circle"  width="100%" style="border: solid 3px #719CBD;">
                    </div>
                    <div class="col-md-10">
                        <h1 class="cat_h2"><i class="far fa-comments" style="color: #66afe9;"></i> عنوان التعليق </h1>
                        <p>المقال المقال المقال المقال المقال المقال المقال المقال المقال المقال</p>
                    </div>
                    <div class="col-md-12">
                        <hr style=" width: 100%;height: 1px;background-color: blue; margin-top: 0; margin-bottom: 8px;"/>
                        <p class="pull-left"> 2020-11-2 <i class="fas fa-stopwatch"></i></p>
                        <p class="pull-right"> تم التعليق بواسطة <i class="fas fa-user-alt"></i><a href="profile.php"> عبدالله </a></p>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
        </div>
        <!-- end comment are -->

        <div class="col-lg-12 art_bg" style="margin-top: 20px; padding-top: 20px;">
            <h2><i class="far fa-comments" style="color: #66afe9;"> أترك تعليقك لنا</i></h2>
            <hr style=" width: 100%;height: 1px;background-color: blue; margin-top: 0; margin-bottom: 20px;"/>
            <form class="form-horizontal" id="comments" action="include/comment.php" method="post">
                <div class="form-group">
                    <div class="col-md-2"></div>
                    <label for="title-comment" class="col-sm-2 control-label">عنوان التعليق</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="title" id="title-comment" placeholder="ضع عنوان تعليقك هنا">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2"></div>
                    <label for="comment" class="col-sm-2 control-label">التعليق</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="comment" id="comment" rows="4" placeholder="ضع تعليقك هنا"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4"></div>
                    <div class="col-sm-6">
                        <div id="com_result"></div>
                        <button type="submit" name="submit" class="btn btn-primary">أضافة التعليق</button>
                    </div>
                </div>
            </form>
        </div>
    </article>
<?php
include_once('include/footer.php');
?>