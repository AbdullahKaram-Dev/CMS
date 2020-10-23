<?php
include_once ('inc/header.php');
include_once ('inc/sidebar.php');
include_once ('../include/config.php');

if (isset($_POST['submit'])){
    if (empty($_POST['category'])){

        $message = '<div class="alert alert-danger" role="alert"> يجب وضع أسم للصنف </div>';

    }else{

        $category_name = strip_tags($_POST['category']);
        $sql = mysqli_query($connectToDB,"INSERT INTO `category` (`category_name`) VALUES  ('$category_name')");
        if (isset($sql)){

            $message = '<div class="alert alert-success" role="alert"> تم الأضافة بنجاح </div>';

        }
    }
}

if (isset($_GET['delete']) && !empty($_GET['delete'])){

    $id = $_GET['delete'];
    $delete = mysqli_query($connectToDB,"DELETE FROM `category` WHERE (`category_id`) = '$id'");
    if (isset($delete)){

        $DeleteMessage = '<div class="alert alert-success" role="alert"> تم الحذف بنجاح </div>';
    }
}

$per_page = 2;


if (!isset($_GET['page'])){

    $page = 1;
}else{

    $page = (int)$_GET['page'];
}


$start_from = ($page - 1) * $per_page;



?>

<article class="col-lg-9">
   <div class="row">
       <div class="col-md-8">

           <div class="panel panel-info">
               <div class="panel-heading">التصنيفات</div>
               <div class="panel-body">
                   <table class="table table-hover">
                     <thead>
                       <tr>
                          <th>رقم الصنف</th>
                          <th>أسم الصنف</th>
                          <th>مشاهدة</th>
                          <th>تعديل</th>
                          <th>حذف</th>
                       </tr>
                     </thead>
                      <tbody>

                      <?php

                      $DATA = mysqli_query($connectToDB,"SELECT * FROM `category` LIMIT $start_from , $per_page");
                      $counter = 0;
                      while($CATEGORY_DATA = mysqli_fetch_assoc($DATA)){
                          $counter++;

                      echo '                    
                      <tr>
                           <td>'.$counter.'</td>
                           <td>'.$CATEGORY_DATA['category_name'].'</td>
                           <td><a href="../category.php?category='.$CATEGORY_DATA['category_name'].'"><img  width="35" height="35" src="data:image/png;base64,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"></a></td>
                           <td><a href="edit-category.php?category='.$CATEGORY_DATA['category_id'].'" class="btn btn-success btn-xs">تعديل</a></td>
                           <td><a href="category.php?delete='.$CATEGORY_DATA['category_id'].'" class="btn btn-danger btn-xs">حذف</a></td>
                       </tr>
                      ';

                      }

                      ?>

                      </tbody>
                   </table>
                   <?php

                   $sql = mysqli_query($connectToDB,"SELECT * FROM `category`");
                   $count = mysqli_num_rows($sql);


                   $total_page = ceil($count / $per_page);

                   ?>

                   <nav class="text-center">
                       <ul class="pagination">

                           <?php

                           for ($i = 1; $i <= $total_page; $i++){

                               echo '<li '.($page == $i ? 'class="active"': '').'><a href="category.php?page='.$i.'">'.$i.'</a></li>';

                           }

                           ?>
                       </ul>
                   </nav>


                   <?php if (isset($DeleteMessage)){ echo $DeleteMessage; }  ?>
               </div>
           </div>
           <a href="category.php"  class="btn btn-info"> تحديث الصفحة </a>
       </div>
       <div class="col-md-4">
           <div class="panel panel-info">
               <div class="panel-heading">أضافة صنف جديد</div>
               <div class="panel-body">


                   <form class="form-horizontal" action="" method="post">
                       <div class="form-group">
                           <label for="category" class="col-sm-4 control-label">أسم التصنيف</label>
                           <div class="col-sm-8">
                               <input type="text" class="form-control" name="category" id="category" placeholder="أسم التصنيف">
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-sm-offset-4 col-sm-8">
                               <?php if (isset($message)){ echo $message; } ?>
                               <input type="submit" name="submit" class="btn btn-info" value="أضافة"/>
                           </div>
                       </div>
                   </form>

               </div>
           </div>
       </div>
   </div>
</article>

<?php
include_once ('inc/footer.php');
?>


