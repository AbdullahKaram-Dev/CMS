<?php
include_once('inc/header.php');
include_once('inc/sidebar.php');
include_once('../include/config.php');

if (isset($_GET['category']) && !empty($_GET['category'])) {

    $sql = mysqli_query($connectToDB, "SELECT * FROM `category` WHERE `category_id` = '$_GET[category]'");
    $CategoryData = mysqli_fetch_assoc($sql);
}

if (isset($_POST['submit'])) {

    if (empty($_POST['category'])) {

        $message = '<div class="alert alert-danger" role="alert"> يجب أن لا يكون الحقل فارغاَ </div>';

    } else {

        $sql = mysqli_query($connectToDB, "UPDATE `category`  SET `category_name` = '$_POST[category]' WHERE `category_id` = '$_GET[category]'");
        if (isset($sql)) {

            header("LOCATION: category.php");

        }
    }
}


?>

<article class="col-lg-9">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading"><?php echo ' تعديل صنف ' . $CategoryData['category_name']; ?></div>
                <div class="panel-body">


                    <form class="form-horizontal" action="" method="post">
                        <div class="form-group">
                            <label for="category" class="col-sm-4 control-label">تعديل الصنف : </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control"
                                       value="<?php echo $CategoryData['category_name'] ?>" name="category"
                                       id="category" placeholder="أسم التصنيف">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <input type="submit" name="submit" class="btn btn-info" value="تعديل الصنف"/>
                            </div>
                        </div>
                        <?php if (isset($message)) {
                            echo $message;
                        } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <a href="category.php" class="btn btn-info"> العودة لصفحة التصنيفات </a>
</article>

<?php
include_once('inc/footer.php');
?>


