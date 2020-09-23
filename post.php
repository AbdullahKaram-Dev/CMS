<?php
include_once('include/header.php');
include_once('include/sidebar.php');
?>
    <article class="col-md-9 col-lg-9">
        <ol class="breadcrumb">
            <li><a href="index.php">الرئيسية</a></li>
            <li><a href="#">عنوان القسم</a></li>
            <li class="active">عنوان المقال</li>
        </ol>
        <div class="col-lg-12 art_bg">
            <div class="cat_post">
                <div class="col-md-12">
                    <h1 class="cat_h2"><strong style="color: blue;">*</strong><i> عنوان المقال </i><strong
                                style="color: blue;">*</strong></h1>
                    <img src="images/logo.jpg" width="100%" style="border: groove 1px blue;">
                </div>

                <strong></strong>
                <div class="col-md-12">
                    <div class="col-md-12 author_post">
                        <p class="pull-right"><i class="fas fa-user-alt"></i><a href="profile.php"> عبدالله </a></p>
                        <p class="pull-left"> 2020-11-2 <i class="fas fa-stopwatch"></i></p>
                    </div>
                    <p>المقال المقال المقال المقال المقال المقال المقال المقال المقال المقال المقال المقال المقال المقال
                        المقال المقال المقال المقال المقال المقال المقال المقال المقال المقال المقال المقال</p>
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
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-md-2"></div>
                    <label for="title-comment" class="col-sm-2 control-label">عنوان التعليق</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="title-comment" placeholder="ضع عنوان تعليقك هنا">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2"></div>
                    <label for="comment" class="col-sm-2 control-label">التعليق</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" id="comment" rows="4" placeholder="ضع تعليقك هنا"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4"></div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary">أضافة التعليق</button>
                    </div>
                </div>
            </form>
        </div>
    </article>
<?php
include_once('include/footer.php');
?>