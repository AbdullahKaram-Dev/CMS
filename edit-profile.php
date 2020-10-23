<?php
include_once ('include/header.php');
include_once ('include/sidebar.php');
$id = (int) $_GET['user'];
if ($_SESSION['id'] != $id){

    header("LOCATION: index.php");
    exit();
}

$userData = mysqli_query(
    $connectToDB,
    "SELECT * FROM `members` WHERE `user_id` = '$id'");

if (mysqli_num_rows($userData) != 1) {

    header("LOCATION: index.php");
    exit();

}
$user = mysqli_fetch_assoc($userData);
?>

<article class="col-md-9 col-lg-9">
    <ol class="breadcrumb">
        <li><a href="index.php">الرئيسية</a></li>
        <li class="active">تعديل الصفحة الشخصية للعضو <?= ucwords($user['username']); ?></li>
    </ol>
    <div class="col-lg-12 art_bg">
        <form method="post" action="include/update-user.php" id="update_user" class="form-horizontal col-md-9" enctype="multipart/form-data" style="margin-top: 20px">
            <input type="hidden" value="<?= $user['user_id']; ?>" name="user"/>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label"><i class="fas fa-user fa-2x"></i></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>" id="username" placeholder="أسم المستخدم">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label"><i class="fas fa-envelope-square fa-2x" style="color: dimgrey;"></i></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>" id="email" placeholder="البريد الألكتروني">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label"><i class="fas fa-lock fa-2x"></i></label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password" id="password" placeholder="كلمة المرور">
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirm" class="col-sm-2 control-label"><i
                        class="fas fa-lock fa-2x"></i></label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="con_password" id="password_confirm" placeholder="تأكيد كلمة المرور">
                </div>
            </div>
            <div class="form-group">
                <label for="gender" class="col-sm-2 control-label"><i class="fas fa-venus-mars fa-2x" style="color: #2aabd2;"></i></label>
                <div class="col-sm-6">
                    <select class="form-control" id="gender" name="gender">
                        <option disabled <?php echo($user['gender'] == '' ? 'selected' : '') ?>>أختر الجنس
                        </option>
                        <option value="male"<?php echo($user['gender'] == 'male' ? 'selected' : '') ?>>ذكر
                        </option>
                        <option value="female" <?php echo($user['gender'] == 'female' ? 'selected' : '') ?>>أنثي
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-sm-2 control-label"><i class="fas fa-images fa-2x" style="color: green;"></i></label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" name="image" id="image">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label"><i
                        class="fas fa-prescription-bottle fa-2x"
                        style="color: #66afe9; margin-top: 10px;"></i></label>
                <div class="col-sm-6">
                     <textarea class="form-control" name="about" id="description" rows="3" placeholder="أضف وصف مختصر عنك"><?php echo $user['about_user']; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="facebook" class="col-sm-2 control-label"><i class="fab fa-facebook fa-2x" style="color: darkblue;"></i></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="facebook" value="<?php echo $user['facebook']; ?>" id="facebook" placeholder="أدخل رابط الفيس بوك">
                </div>
            </div>
            <div class="form-group">
                <label for="twitter" class="col-sm-2 control-label"><i class="fab fa-twitter fa-2x" style="color: lightblue;"></i></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="twitter" value="<?php echo $user['twitter']; ?>" id="twitter" placeholder="أدخل رابط تويتر">
                </div>
            </div>
            <div class="form-group">
                <label for="youtube" class="col-sm-2 control-label"><i class="fab fa-youtube fa-2x"
                                                                       style="color: red;"></i></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="youtube" value="<?php echo $user['youtube']; ?>" id="youtube" placeholder="أدخل رابط اليوتيوب">
                </div>
            </div>
                <div id="update_result"></div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="submit" class="btn btn-primary">تعديل البيانات</button>
                </div>
            </div>
        </form>


    </div>
</article>
<?php include_once ('include/footer.php'); ?>























