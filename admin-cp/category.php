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


