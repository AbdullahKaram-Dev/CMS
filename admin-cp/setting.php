<?php
include_once('inc/header.php');
include_once('inc/sidebar.php');
include_once('../include/config.php');


if (isset($_POST['submit'])) {

    $Settings = mysqli_query($connectToDB, "SELECT * FROM `settings`");
    if (mysqli_num_rows($Settings) != 1) {

        $image = $_FILES['image'];
        $imageName = $image['name'];
        $imageTmp = $image['tmp_name'];
        $imageSize = $image['size'];
        $imageError = $image['error'];

        if ($imageName != '') {

            $imageExe = explode('.', $imageName);
            $imageExe = strtolower(end($imageExe));

            $allowedExtensions = ['png', 'gif', 'jpg', 'jpeg'];

            if (in_array($imageExe, $allowedExtensions)) {
                if ($imageError === 0) {
                    if ($imageSize <= 3000000) {
                        $new_name_image = uniqid('logo', false) . '.' . $imageExe;
                        $image_Path = '../images/' . $new_name_image;
                        $image_DB = 'images/' . $new_name_image;
                        if (move_uploaded_file($imageTmp, $image_Path)) {

                            $insert = mysqli_query($connectToDB, "INSERT INTO `settings` 
(`site_name`,`logo`,`slide`,`slide_value`,`section_a`,`section_a_value`,`section_b`,`section_b_value`,`tab_a`,`tab_a_value`,`tab_b`,`tab_b_value`,`tab_c`,`tab_c_value`,`facebook`,`twitter`,`google`,`github`) 
VALUES
 ('$_POST[site_name]','$image_DB','$_POST[slide]','$_POST[slide_num]','$_POST[section1]','$_POST[section_1_num]','$_POST[section2]','$_POST[section_2_num]','$_POST[tab1]','$_POST[tab_1_num]','$_POST[tab2]','$_POST[tab_2_num]','$_POST[tab3]','$_POST[tab_3_num]','$_POST[facebook]','$_POST[twitter]','$_POST[google]','$_POST[github]')");
                            if (isset($insert)) {

                                $message = '<div class="alert alert-success" role="alert"> تم تحديث الأعدادات جارى التحديث </div>';
                                echo '<meta http-equiv="refresh" content="2; \'setting.php\'">';
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


            $insert = mysqli_query($connectToDB, "INSERT INTO `settings` 
(`site_name`,`slide`,`slide_value`,`section_a`,`section_a_value`,`section_b`,`section_b_value`,`tab_a`,`tab_a_value`,`tab_b`,`tab_b_value`,`tab_c`,`tab_c_value`,`facebook`,`twitter`,`google`,`github`) 
VALUES
 ('$_POST[site_name]','$_POST[slide]','$_POST[slide_num]','$_POST[section1]','$_POST[section_1_num]','$_POST[section2]','$_POST[section_2_num]','$_POST[tab1]','$_POST[tab_1_num]','$_POST[tab2]','$_POST[tab_2_num]','$_POST[tab3]','$_POST[tab_3_num]','$_POST[facebook]','$_POST[twitter]','$_POST[google]','$_POST[github]')");
            if (isset($insert)) {

                $message = '<div class="alert alert-success" role="alert">  تم تحديث الأعدادات جارى التحديث </div>';
                echo '<meta http-equiv="refresh" content="2; \'setting.php\'">';

            }


        }

    } else {


        $image = $_FILES['image'];
        $imageName = $image['name'];
        $imageTmp = $image['tmp_name'];
        $imageSize = $image['size'];
        $imageError = $image['error'];

        if ($imageName != '') {

            $imageExe = explode('.', $imageName);
            $imageExe = strtolower(end($imageExe));

            $allowedExtensions = ['png', 'gif', 'jpg', 'jpeg'];

            if (in_array($imageExe, $allowedExtensions)) {
                if ($imageError === 0) {
                    if ($imageSize <= 3000000) {
                        $new_name_image = uniqid('logo', false) . '.' . $imageExe;
                        $image_Path = '../images/' . $new_name_image;
                        $image_DB = 'images/' . $new_name_image;
                        if (move_uploaded_file($imageTmp, $image_Path)) {

                            $insert = mysqli_query($connectToDB, "UPDATE `settings` SET 
`site_name` = '$_POST[site_name]',`logo` = '$image_DB',`slide` = '$_POST[slide]',`slide_value` = '$_POST[slide_num]',`section_a` = '$_POST[section1]',`section_a_value` = '$_POST[section_1_num]',`section_b` = '$_POST[section2]',`section_b_value` = '$_POST[section_2_num]',`tab_a` = '$_POST[tab1]',`tab_a_value` = '$_POST[tab_1_num]',`tab_b` = '$_POST[tab2]',`tab_b_value` = '$_POST[tab_2_num]',`tab_c` = '$_POST[tab3]',`tab_c_value` = '$_POST[tab_3_num]',`facebook` = '$_POST[facebook]',`twitter` = '$_POST[twitter]',`google` = '$_POST[google]',`github`= '$_POST[github]'");
                            if (isset($insert)) {

                                $message = '<div class="alert alert-success" role="alert"> تم تحديث الأعدادات جارى التحديث </div>';
                                echo '<meta http-equiv="refresh" content="2; \'setting.php\'">';
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


            $insert = mysqli_query($connectToDB, "UPDATE `settings` SET 
`site_name` = '$_POST[site_name]',`slide` = '$_POST[slide]',`slide_value` = '$_POST[slide_num]',`section_a` = '$_POST[section1]',`section_a_value` = '$_POST[section_1_num]',`section_b` = '$_POST[section2]',`section_b_value` = '$_POST[section_2_num]',`tab_a` = '$_POST[tab1]',`tab_a_value` = '$_POST[tab_1_num]',`tab_b` = '$_POST[tab2]',`tab_b_value` = '$_POST[tab_2_num]',`tab_c` = '$_POST[tab3]',`tab_c_value` = '$_POST[tab_3_num]',`facebook` = '$_POST[facebook]',`twitter` = '$_POST[twitter]',`google` = '$_POST[google]',`github`= '$_POST[github]'");
            if (isset($insert)) {

                $message = '<div class="alert alert-success" role="alert">  تم تحديث الأعدادات جارى التحديث </div>';
                echo '<meta http-equiv="refresh" content="2; \'setting.php\'">';

            }


        }


    }

}


$Setting = mysqli_query($connectToDB, "SELECT * FROM `settings`");
$Setting = mysqli_fetch_object($Setting);


function category()
{
    global $connectToDB;
    $category = mysqli_query($connectToDB, "SELECT * FROM `category`");
    if (!empty($category)) {
        return $category = mysqli_fetch_all($category, MYSQLI_ASSOC);
    }
    return [];
}


?>

    <article class="col-lg-9">
        <?php if (isset($message) && !empty($message)) {
            echo $message;
        } ?>
        <div class="panel panel-info">
            <div class="panel-heading"><strong><em>أعدادات الموقع</em></strong></div>
            <div class="panel-body">


                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label">أسم الموقع</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="<?php echo $Setting->site_name; ?>"
                                   name="site_name" id="site" placeholder="أسم الموقع الخاص بك">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image" class="col-sm-2 control-label">شعار الموقع</label>
                        <div class="col-sm-5">
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="slide" class="col-sm-2 control-label">الواجهة</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="slide" name="slide">
                                <option value="" selected>أختر الصنف</option>
                                <?php foreach (category() as $cat): ?>
                                    <option value="<?php echo $cat['category_id']; ?>" <?php echo($cat['category_name'] == $Setting->slide ? 'selected' : '') ?>><?php echo $cat['category_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <label for="slide_num" class="col-sm-2 control-label">عدد المقالات</label>
                        <div class="col-sm-1">
                            <input type="number" class="form-control" value="<?php echo $Setting->slide_value; ?>"
                                   name="slide_num" id="site" min="3" max="9">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="section1" class="col-sm-2 control-label">القسم الأول</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="section1" name="section1">
                                <option value="" selected>أختر الصنف</option>
                                <?php foreach (category() as $cat): ?>
                                    <option value="<?php echo $cat['category_id']; ?>" <?php echo($cat['category_name'] == $Setting->section_a ? 'selected' : '') ?>><?php echo $cat['category_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label for="section_1_num" class="col-sm-2 control-label">عدد المقالات</label>
                        <div class="col-sm-1">
                            <input type="number" class="form-control" value="<?php echo $Setting->section_a_value; ?>"
                                   name="section_1_num" id="section_1_num" min="3" max="9">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="section2" class="col-sm-2 control-label">القسم الثاني</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="section2" name="section2">
                                <option value="" selected>أختر الصنف</option>
                                <?php foreach (category() as $cat): ?>
                                    <option value="<?php echo $cat['category_id']; ?> " <?php echo($cat['category_name'] == $Setting->section_b ? 'selected' : '') ?>><?php echo $cat['category_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label for="section_2_num" class="col-sm-2 control-label">عدد المقالات</label>
                        <div class="col-sm-1">
                            <input type="number" class="form-control" value="<?php echo $Setting->section_b_value; ?>"
                                   name="section_2_num" id="section_2_num" min="3" max="9">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tab1" class="col-sm-2 control-label">التاب الأول</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="tab1" name="tab1">
                                <option value="" selected>أختر الصنف</option>
                                <?php foreach (category() as $cat): ?>
                                    <option value="<?php echo $cat['category_id']; ?>" <?php echo($cat['category_name'] == $Setting->tab_a ? 'selected' : '') ?>><?php echo $cat['category_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label for="tab_1_num" class="col-sm-2 control-label">عدد المقالات</label>
                        <div class="col-sm-1">
                            <input type="number" class="form-control" value="<?php echo $Setting->tab_a_value; ?>"
                                   name="tab_1_num" id="tab_1_num" min="3" max="9">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tab2" class="col-sm-2 control-label">التاب الثاني</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="tab2" name="tab2">
                                <option value="" selected>أختر الصنف</option>
                                <?php foreach (category() as $cat): ?>
                                    <option value="<?php echo $cat['category_id']; ?>" <?php echo($cat['category_name'] == $Setting->tab_b ? 'selected' : '') ?>><?php echo $cat['category_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label for="tab_2_num" class="col-sm-2 control-label">عدد المقالات</label>
                        <div class="col-sm-1">
                            <input type="number" class="form-control" value="<?php echo $Setting->tab_b_value; ?>"
                                   name="tab_2_num" id="tab_2_num" min="3" max="9">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tab3" class="col-sm-2 control-label">التاب الثالث</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="tab3" name="tab3">
                                <option value="" selected>أختر الصنف</option>
                                <?php foreach (category() as $cat): ?>
                                    <option value="<?php echo $cat['category_id']; ?>" <?php echo($cat['category_name'] == $Setting->tab_c ? 'selected' : '') ?>><?php echo $cat['category_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label for="tab_3_num" class="col-sm-2 control-label">عدد المقالات</label>
                        <div class="col-sm-1">
                            <input type="number" class="form-control" value="<?php echo $Setting->tab_c_value; ?>"
                                   name="tab_3_num" id="tab_3_num" min="3" max="9">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="facebook" class="col-sm-2 control-label"
                               style="text-decoration-line: underline ; color: mediumslateblue">Facebook</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php echo $Setting->facebook; ?>"
                                   name="facebook" id="facebook" placeholder="أدخل الرابط">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="twitter" class="col-sm-2 control-label"
                               style="text-decoration-line: underline ; color: mediumslateblue">Twitter</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php echo $Setting->twitter; ?>"
                                   name="twitter" id="twitter" placeholder="أدخل الرابط">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="google" class="col-sm-2 control-label"
                               style="text-decoration-line: underline ; color: mediumslateblue">Google</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php echo $Setting->google; ?>"
                                   name="google" id="google" placeholder="أدخل الرابط">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="github" class="col-sm-2 control-label"
                               style="text-decoration-line: underline ; color: mediumslateblue">Github</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?php echo $Setting->github; ?>"
                                   name="github" id="github" placeholder="أدخل الرابط">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="submit" class="btn btn-info">Sign in</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </article>
<?php
include_once('inc/footer.php');
?>