<?php
include_once('inc/header.php');
include_once('inc/sidebar.php');
include_once('../include/config.php');

$title = '';
$post = '';
$date = date('Y-m-d');

if (isset($_POST['submit'])) {

    $title = strip_tags($_POST['title']);
    $post = $_POST['post'];
    $status = $_POST['status'];
    $category_Post = $_POST['category'];


    if (empty($title)) {

        $message = '<div class="alert alert-danger"> عنوان المقالة لا يجب ان يكون فارغاٌ </div>';
    } elseif (empty($post)) {

        $message = '<div class="alert alert-danger"> محتوى المقالة لا يجب ان يكون فارغاٌ </div>';
    } elseif (empty($category_Post)) {

        $message = '<div class="alert alert-danger"> الصنف التابع للمقالة لا يجب ان يكون فارغاٌ </div>';
    } elseif (empty($status)) {

        $message = '<div class="alert alert-danger"> حالة المقالة لا يجب ان تكون فارغة </div>';
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
                        $new_name_image = uniqid('post', false) . '.' . $imageExe;
                        $image_Path = '../images/posts/' . $new_name_image;
                        $image_DB = 'images/post/' . $new_name_image;
                        if (move_uploaded_file($imageTmp, $image_Path)) {

                            $insert = mysqli_query($connectToDB, "INSERT INTO `posts`(`title`,`post`,`category`,`image`,`author`,`status`,`created_at`) VALUES ('$title','$post','$category_Post','$image_DB','$_SESSION[id]','$status','$date')");
                            if (isset($insert)) {

                                $message = '<div class="alert alert-success" role="alert"> تم اضافة المقالة بنجاح جارى تحويلك للصفحة الرئيسية </div>';
                                echo '<meta http-equiv="refresh" content="3; \'posts.php\'" />';

                            }
                        } else {

                            $message = '<div class="alert alert-danger" role="alert"> حدث خطأ اثناء رفع الصورة من فضلك حاول مرة أخرى </div>';

                        }
                    } else {

                        $message = '<div class="alert alert-danger" role="alert"> عذرا حجم الصورة كبير جدا يجب أن لا يتعدى  (MB 3) </div>';

                    }
                } else {

                    $message = '<div class="alert alert-danger" role="alert"> حدث خطأ وجارى العمل على أصلاحة </div>';

                }
            } else {

                $message = '<div class="alert alert-danger" role="alert"> من فضلك أختر صورة صحيحة </div>';

            }
        } else {

            $message = '<div class="alert alert-danger" role="alert"> يجب عليك أختيار صورة  </div>';

        }


    }

}


?>

    <article class="col-lg-9">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-12">
                <?php if (isset($message) && !empty($message)) {
                    echo $message;
                } ?>
                <div class="panel panel-info">
                    <div class="panel-heading"><b> أضافة مقال جديد </b></div>
                    <div class="panel-body">


                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label" style="border: solid 2px #D9EDF7;">
                                    عنوان المقالة <i class="fas fa-book-reader fa-1x"
                                                     style="color: darkorange;"></i></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="<?php echo $title; ?>"
                                           id="title" placeholder=" أدخل عنوان المقال ">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="post" class="col-sm-2 control-label" style="border: solid 2px #D9EDF7;">
                                    المقالة <i class="fas fa-clipboard fa-1x" style="color: lightseagreen;"></i></label>
                                <div class="col-sm-10">
                                    <textarea rows="8" class="form-control" name="post"
                                              id="post"><?php echo $post; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category" class="col-sm-2 control-label" style="border: solid 2px #D9EDF7;">
                                    أختر التصنيف <i class="fas fa-dna fa-1x" style="color: blueviolet;"></i> </label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="category" name="category">
                                        <option selected value=""> أختيار الصنف التابع للمقال</option>
                                        <?php
                                        $categories = mysqli_query($connectToDB, "SELECT * FROM `category`");
                                        while ($category = mysqli_fetch_assoc($categories)) {

                                            echo '<option value="' . $category['category_name'] . '">' . $category['category_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image" class="col-sm-2 control-label" style="border: solid 2px #D9EDF7;">
                                    صورة المقالة <i class="fas fa-images fa-1x" style="color: greenyellow;"></i>
                                </label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="image" id="image"/>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label" style="border: solid 2px #D9EDF7;">
                                    حالة المقالة <i class="fas fa-unlock fa-1x" style="color: #66afe9"></i> </label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status" id="status">
                                        <option value="published" selected>مفعلة</option>
                                        <option value="unpublished">غير مفعلة</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" class="btn btn-info"> أضافة المقال</button>
                                </div>
                            </div>


                        </form>


                    </div>
                </div>
                <!-- here -->
                <a href="new-post.php" class="btn btn-info"> تحديث الصفحة </a>
            </div>
        </div>
    </article>

<?php
include_once('inc/footer.php');
?>