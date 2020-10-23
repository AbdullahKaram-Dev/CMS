<?php
include_once ('include/header.php');
include_once ('include/sidebar.php');

$id = (int) $_GET['user'];

$userData = mysqli_query(
       $connectToDB,
"SELECT * FROM `members` WHERE `user_id` = '$id'");

if (mysqli_num_rows($userData) != 1) {

    header("LOCATION: index.php");
    exit();

}
  $user = mysqli_fetch_object($userData);
?>

<article class="col-md-9 col-lg-9">
    <ol class="breadcrumb">
        <li><a href="index.php">الرئيسية</a></li>
        <li class="active"> الصفحة الشخصية للعضو <?= ucwords($user->username); ?></li>
    </ol>
    <div class="col-lg-12 art_bg">
        <div class="page-header">
            <?php if ($_SESSION['id'] == $user->user_id)
            {
               echo '<a href="edit-profile.php?user='.$user->user_id.'" ><i class="pull-left fa fa-pencil-square" aria-hidden="true"></i></a>';
            }
            ?>
            <div class="col-lg-12">
                <div class="col-md-2">
                    <img src="<?= $user->avatar; ?>" class="img-thumbnail" width="100%">
                </div>
                <div class="col-md-10">
                    <h1><?= ucwords($user->username); ?> <small><?php if ( $user->role == 'admin'){echo 'مدير الموقع';} elseif ($user->role == 'writer'){echo 'كاتب';} else {echo 'عضو';} ?></small></h1>

                    <?php if ($user->gender == 'male') :?>
                    <img class="img-circle" src="data:image/png;base64,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">
                    <?php else:?>
                    <img class="img-circle" src="data:image/png;base64,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">
                    <?php endif; ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-lg-12" style="margin-top: 20px">
      <div class="row">
           <div class="col-md-6">
               <div class="panel panel-info">
                   <div class="panel-heading">
                       <h3 class="panel-title">نبذة عن العضو</h3>
                   </div>
                   <div class="panel-body">
                       <p class="text-right"> <?= strip_tags($user->about_user); ?> </p>
                   </div>
               </div>
           </div>
          <div class="col-md-6">


              <div class="panel panel-info">

                  <div class="panel-heading"><h3>معلومات عن العضو</h3></div>
                  <ul class="list-group">
                      <li class="list-group-item"><b> تاريخ التسجيل: </b><?= $user->created_at ?></li>
                      <li class="list-group-item"><b>Facebook: <a href="<?= $user->facebook; ?>" target="_blank"><i class="fab fa-facebook fa-lg" style="color: darkblue;"></i></a></b></li>
                      <li class="list-group-item"><b>Youtube: <a href="<?= $user->youtube; ?>" target="_blank"><i class="fab fa-youtube fa-lg" style="color: red;"></i></a></b></li>
                      <li class="list-group-item"><b>Twitter: <a href="<?= $user->twitter; ?>" target="_blank"><i class="fab fa-twitter fa-lg" style="color: lightblue;"></i></a></b></li>
                  </ul>
              </div>

          </div>
      </div>
    </div>
</article>
<?php include_once ('include/footer.php'); ?>























