<?php
include_once ('include/header.php');
include_once ('include/sidebar.php');
?>

<?php

$category_name = $_GET['category'];

$per_page = 3;

if (!isset($_GET['page'])) {
    $page = 1;

} else {

    $page = (int)$_GET['page'];
}

$start_from = ($page - 1) * $per_page;

$category_data  = mysqli_query($connectToDB,"SELECT * FROM `posts` p INNER JOIN `members` m ON p.author = m.user_id WHERE `category` = '$category_name' AND `status` = 'published' ORDER BY `post_id` DESC LIMIT $start_from , $per_page ");
$all_category = mysqli_fetch_all($category_data,MYSQLI_ASSOC);

?>


<article class="col-md-9 col-lg-9">
    <ol class="breadcrumb">
        <li><a href="index.php">الرئيسية</a></li>
        <li class="active"><?= $category_name; ?></li>
    </ol>
  <div class="col-lg-12 art_bg">
      <?php foreach ($all_category as $category) :?>
          <div class="cat_post">
              <div class="col-md-3">
                <img src="<?= $category['image']; ?>" width="100%">
            </div>
              <div class="col-md-9">
                <h1 class="cat_h2"><?= strip_tags($category['title']); ?></h1>
                  <p><?= strip_tags($category['post']); ?></p>
              </div>
              <div class="col-md-12">
                  <hr style=" width: 100%;height: 1px;background-color: blue; margin-top: 0; margin-bottom: 8px;"/>
                  <a href="post.php?id=<?= $category['post_id']; ?>" class="btn btn-success pull-left">أقرأ المزيد</a>
                  <p class="pull-right"><i class="fas fa-user-alt"></i><a href="profile.php?user=<?= $category['user_id']; ?>"><?= $category['username']; ?> </a><i class="fas fa-stopwatch"> <?= $category['created_at']; ?> </i></p>
              </div>
              <div class="clearfix"></div>
          </div>
      <?php endforeach; ?>

  <?php

  $page_sql = mysqli_query($connectToDB, "SELECT * FROM `posts` WHERE `category` = '$category_name'");
  $count_page = mysqli_num_rows($page_sql);

  $total_page = ceil($count_page / $per_page);

  ?>
  <nav class="text-center">
      <ul class="pagination">

  <?php


  for ($i = 1; $i <= $total_page; $i++) {

   echo '<li ' . ($page == $i ? 'class="active"' : '') . '><a href="category.php?category='. $category_name .'&page=' . $i . '">' . $i . '</a></li>';
  }
  ?>
      </ul>
  </nav>


  </div>
</article>
<?php
include_once ('include/footer.php');
?>























