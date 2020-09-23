<?php
include_once ('inc/header.php');
include_once ('inc/sidebar.php');
include_once ('../include/config.php');


if (isset($_GET['user_id']) && !empty($_GET['user_id'])){

    $sql = mysqli_query($connectToDB,"DELETE FROM `members` WHERE `user_id` = '$_GET[user_id]'");
    if ($sql){

        echo  $message = '<div class="alert alert-success " role="alert">  تم حذف المستخدم بنجاح جارى التحويل  </div>';
        echo  '<meta http-equiv="refresh" content="2; \'users.php\'" />';
    }

}





?>

<article class="col-lg-9">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><b>أدارة المستخدمين</b></div>
                <div class="panel-body">


                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>رقم المستخدم</th>
                            <th>صورة المستخدم</th>
                            <th>أسم المستخدم</th>
                            <th>البريد الألكتروني</th>
                            <th>الجنس</th>
                            <th>الصفحة الشخصية</th>
                            <th>تعديل البيانات</th>
                            <th>حذف المستخدم</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php



                        $Users = mysqli_query($connectToDB,"SELECT * FROM `members`");
                        $counter = 0;
                        while($User_Data = mysqli_fetch_assoc($Users)){
                            $counter++;

                            echo '                    
                      <tr>
                           <td>' . '('.$counter.')'.($User_Data['user_id'] == $_SESSION['id'] ? '<i class="fas fa-star fa-1x" style="color: gold"></i>' : '').'</td>
                           <td><img src="../'.$User_Data['avatar'].'" class="img-circle" width="50px" /></td>
                           <td>'.$User_Data['username'].'</td>
                           <td>'.$User_Data['email'].'</td>
                           <td>'.($User_Data['gender'] == 'male' ? '<i class="fas fa-male fa-3x" style="color: lightblue"></i>' : '<i class="fas fa-female fa-3x" style="color: pink"></i>').'</td>
                           <td><a class="btn btn-success btn-xs" target="_blank" href="../profile.php?user_id='.$User_Data['user_id'].'">الصفحة الشخصية</a></td>           
                           <td><a href="edit-user.php?user_id='.$User_Data['user_id'].'" class="btn btn-warning btn-xs">'.($User_Data['user_id'] == $_SESSION['id'] ? 'تعديل بيناتك' : 'تعديل بيانات العضو').'</a></td>
                           <td><a href="users.php?user_id='.$User_Data['user_id'].'" class="btn btn-danger btn-xs">حذف العضو</a></td>
                       </tr>
                      ';

                        }

                        ?>

                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
</article>

<?php
include_once ('inc/footer.php');
?>




