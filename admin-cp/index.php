<?php
session_start();
include_once ('inc/header.php');
include_once ('inc/sidebar.php');
include_once ('../include/config.php');


$user = mysqli_query($connectToDB,"SELECT user_id,email,role,username,avatar FROM `members` WHERE `user_id` = '$_SESSION[id]'");
$user = mysqli_fetch_object($user);


$post = mysqli_query($connectToDB,"SELECT * FROM `posts`");
$post = mysqli_num_rows($post);

$All_Users = mysqli_query($connectToDB,"SELECT * FROM `members`");
$All_Users = mysqli_num_rows($All_Users);

$All_Comments = mysqli_query($connectToDB,"SELECT * FROM `comments`");
$All_Comments = mysqli_num_rows($All_Comments);


?>

      <article class="col-lg-9">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading text-center"> أهلا بك <strong><?php echo $user->username; ?></strong></div>
                        <div class="panel-body">
                          <div class="text-center">
                            <img src="../<?php echo $user->avatar; ?>" width="50%" style="max-width: 140px; border: inset #D9EDF7 2px; ">
                            <hr style="width: 70%; height: 1px; background-color: #2aabd2">
                          </div>
                            <div class="text-right">
                                <p> البريد : <?php echo $user->email; ?></p>
                                <p> الصلاحية : <?php echo $user->role; ?></p>
                                <p class="text-center"><a href="edit-user.php?user=<?= $user->user_id; ?>" class="btn btn-info btn-xs">تعديل البيانات</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">

                    <div class="panel panel-success">
                        <div class="panel-heading text-center">ألمقالات</div>
                        <div class="panel-body">
                           <div class="col-md-8">
                               <img  src="data:image/png;base64,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">
                           </div>
                           <div class="col-md-4">
                               <p><strong><?php echo $post; ?></strong></p>
                           </div>
                        </div>
                        <div class="panel-footer text-center"><a href=""><img style="background-color: green" width="50" height="40" src="data:image/png;base64,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"></a></div>
                    </div>
                </div>


                <div class="col-md-3">

                    <div class="panel panel-danger">
                        <div class="panel-heading text-center">الأعضاء</div>
                        <div class="panel-body">
                            <div class="col-md-8">
                                <img src="data:image/png;base64,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">
                            </div>
                            <div class="col-md-4">
                                <p><strong><?php echo $All_Users; ?></strong></p>
                            </div>
                        </div>
                        <div class="panel-footer text-center"><a href=""><img style="background-color: rosybrown" width="50" height="40" src="data:image/png;base64,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"></a></div>
                    </div>
                </div>



                <div class="col-md-3">

                    <div class="panel panel-warning">
                        <div class="panel-heading text-center">التعليقات</div>
                        <div class="panel-body">
                            <div class="col-md-8">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAJMUlEQVR4Xu2af4xU1RXHv+e8YZl9b5aVX0UhCkpdizakIoECxgIu84aFSlALiTHYBq2NWm1sm4ohaEOU1mATIam25Ucb0jSlpRUp7MwsSi0tRUFLY7FpKSLyQxRFd/e9mWXZd07z3maRH7Pze3Y3YV/2j9nMveec+7nnnXPuuUO4xB+6xNePfgD9HnCJE+h/BS5xB+gPgmV/BXQjDFxmjgBxbeBd4jloTn9AC9DeF72tZAC6DQMRMm1RxACdBuFxzBhw7mIF8P8OgHgXC8VxxvkTfRWpvgCkaAC61bpcQngUkMUMHtK1GIG0wtPDStwMZoNUh4AwmoGB540Br+WQrKRb08d6E0TBAHQjqlBrfl9AjzNg+ltLQJJIN4HlFdzadogIeu6idAdCaLOuh4F6T7DAIEwO3g4gzdCnMDT1DE3Emd4AURAA3VY7Vrjjd0y4sdOtaS2jYwXZbYcKMV6T1pcEWMKKBf48j7DHIO9OmtX2XiFyyjE2bwCarJkm2rGFwYMF3n5WXkSx1JulGBHIFFnHhDoR+ZBDFKNZqX+UIrPQuXkB0ETNVIE0BS5P2Min3W+UK4jp5mE1Gk6tJ9AdovIpG3wLzXLfKnQhxY7PCUC3h68Rj/b4gU6U1vBu53560nf/8j36JFgmR55n1m8KcIwN3ET17gfl09C9pKwAdC8GyMfWbgYmKGgzNTt30AJ4lTDMh6BTzI2+Jyh0O0VT0QuDaSX0ZgeQsB4DsEKgB9kLT6CGUy2VMKJLpu4YHpF06k02cC2g95KdWltJfb7sbgHotshwIXmHmSIgmk5R59VKG+PL16aamyGyUyAn2QjXQ08b8ECQAc24rPk4TUW6nHZ0C8BLRn7IqssUuont1J3lVJpLliTMJIFmXThOBArWg1D6KxNtRY2ztVQgGQH49bzUWkcZuBysE3o6NWmyZj5U/iCqZwD6V+CpjMHwMIoZobNgxGsWNn7BBlYWGzQzA2iMTAfrDr9ACUXdSbl2rBLfe4nqfzJ4PFim0Kz07uD12IsBOGmNA9N0JW8+KU8PKkqBy4TlGOg+SzPQUYg9GQF4CetpBpaA8AOKus8UIrBcY7teQVFabsScZZnk6vaaOumQJVDcwwzyFK8ZhregkIoyIwBprH6ZmGdCdBLNTu0p16IKkaNxqx6EJlV5mWPp+mxzNWlOFJVfMowbguApNCdfu7vzgPchGMFh16QZaMuqPGHtBXBTIYvzgNdDthsciLp7dLs1Ah5OCPC+Ybsjc8nXLTClylrHwEL/RMqKeoqlX8817yIA/slN2qx2QE4as9MjcgnoSFivGUBBccID/T1kO1OzAlCQxK3TQW9hqFuVz2kxqCinRF5g6H2dnuB7cNu72fRcDGDzsBqE0y3i4YDR4NblAlDJ771E9Sn/8AU1hlKs5VQ+uvwMprWRTQSd53uaMdS9ORu87gFADxp26vP5KK3UGC9hNjNoEM6EhtDc5k/y1aNNg2tF2vcxMCZXIL8YQOBG1hlAmg07fbbTk6/yco3zGy9SY7WBoTzUDefzCpyrW5NWFIpEEA88Yyw1OCcz2ZY5CCatd1kxOh/yWrEgWFMHT/4jHt4zGtzRxYCVuLWNCLOzpdLMaTBhbSWgAQSbom4ym/KKBcGkdTcUGxT0ItvO/GIAfHauwAmucq/MVCRlrgQT5lKAlgvJs0Y0/b1ilJc6x0tUb2Dw3SB8h6Luc8XIUz+TJMz9TDQOSjMp5uy4UE5mAHFzAojeEOAIN7tXV6oH0G0N4B+L253jEI6wylXUkD5aDAB/jpeILGfoUgFWGLb7eH4AfHLJ6rcZ/AVA55OderFYA4qZp4nItwFdpYpGjrkNxcjomqPxyAyQvqKQHWynZ+YFwB+k8chDIF0tin3c4k7sKS/we4QSTv83OImCvkK285fSAAwaAvI+7q6i7L4hsgvV0modYGAUSO+jaGpNKYbkO9dLWM8x8LCC/si2c3u+87KN8xrNVoAsbnUHXLiR2VticesuEH7t0+Mq95pc54JSjdWEORegLUF3mDCe7PSRUmV2xoGgtzEKbdWDaN5HrefKzA4giAXWXr8pCsUiirkbymFQJhkaNyeI4tWgBQf6GtnO78ul6ywAuBGy4eYNoDMWWItA+FUlW2Mar54khHhQ90OXkp16qlyLD1Jh0nIhCHHMHXhhpzn3vUDSHAmlY5U4HPnGIWktEsELzAiL0tNsO0vL2Q7XLvuF3jFmO2PzzgJn00jT4FpI+6cCHDVs98qy7UxjeIxy6CcEnS+Ax6BHEXVWl3PxgQcnzdugtFmVXuKYM69wAI2R28G6yQN2hmz3llIBaGPNdcLewwAt9q/MRXCIie+hWOvOUmVnmu8lzdWs9BAUj1HM/XFBADQRvlo8489s4CqAHiHbWZWvkX5zAjcOsxBKj4GBBvGPtaSxIKB2Xo2fBmglV1X/iGacdPKVW8i4oLnTbh3p7G5jfKY7x2wXI9fD0P2FKMxnrAAnAKznDqyiOa7/uWKPxiMLQPpbgfeWYbeNz6SoewBNkXEQfbsU60TUATTFzJ/zPzNCC9HakuiJqjK424iE97FhfBHQ+8lO/bwgAKUs/Ny5fqT34uZOg2maQH9q2KkHyyU7mxyNm98C0fNCOMwd7nXU4L9yFz8502A5jNV45AYhfaPzd0KVP1xpApag+hCDh0NpIcWcjd2to0cABOmoa0f8WxzojHz79sVsgCbMxQCt8UC7jagzNVtq7TkAfkXWZK7yU1JnrR+aQ3brrmIWmGuOJKwtBMwF4S6Kur/JNr7HAARe4Ddcvxz5GZPe66dBhj6AaGp9uYsfb5t1OEjdVTycZrR+1GcABBCC8jfyBKBPdP5PL5F2PJLrAiPXrp/7vZeo/jB4/2tcM9f1eY96wHnZIW7FhOBfZV0hgjNgWseK1RRzSq49PmvU6m1kp7b0KQ84D4J/geG1LwPhwa5fkvpFC2DEWWg3Qvg3MOA4/vZJayE/zNK49V0QVgZldsibnu22uNc84DwQSXOkKD8A6NeDxkW5HzLqKNpyoNfqgHzXE5wfJldPBtOtCp6oKnWAXgHlWv/+P185F41T41qKtfyvzwMoeoElTCyeaglK+9LUfgB9aTd6w5Z+D+gN6n1JZ78H9KXd6A1bLnkP+D8idfpuepG06gAAAABJRU5ErkJggg==">
                            </div>
                            <div class="col-md-4">
                                <p><strong><?= $All_Comments; ?></strong></p>
                            </div>
                        </div>
                        <div class="panel-footer text-center"><a href="comment.php"><img style="background-color: darkorange" width="50" height="40" src="data:image/png;base64,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"></a></div>
                    </div>
                </div>

                 <div class="col-md-12">


                     <div class="panel panel-warning">
                         <div class="panel-heading text-center">
                             <b>  جـميع المقالات  </b>
                         </div>
                         <div class="panel-body">

                             <table class="table table-hover">
                                 <thead>
                                 <tr>
                                     <th>رقم المقالة</th>
                                     <th>صورة المقالة</th>
                                     <th>عنوان المقال</th>
                                     <th>الكاتب</th>
                                     <th>تاريخ الانشاء</th>
                                     <th>مشاهدة المقالة</th>
                                     <th>حالة المقالة</th>
                                     <th>تعديل المقالة</th>
                                     <th>حذف المقالة</th>
                                 </tr>
                                 </thead>
                                 <tbody>

                                 <?php

                                 $DATA = mysqli_query($connectToDB, "SELECT * FROM `posts` p INNER JOIN `members` m WHERE p.author = m.user_id ORDER BY `post_id` DESC LIMIT 5");
                                 $counter = 0;
                                 while ($post = mysqli_fetch_assoc($DATA)) {
                                     $counter++;

                                     echo '                    
                      <tr>
                           <td>' . $counter . '</td>
                           <td><img src="../' . $post['image'] . '" class="img-rounded" width="50px"/></td>
                           <td>' . substr($post['title'], 0, 100) . '...</td>
                           <td><b style="background-color: #D9EDF7;">' .$post['username']. '</b></td>
                           <td>' . $post['created_at'] . '</td>
                           <td><a href="../post.php?post-id='.$post['post_id'].'" style="margin-right: 20px;" target="_blank"><i class="far fa-eye fa-lg"></i></a></td>
                           <td>' . ($post['status'] == 'unpublished' ? '<a href="posts.php?status=published&post=' . $post['post_id'] . '" class="btn btn-danger btn-xs"> معطلة </a>' : '<a href="posts.php?status=unpublished&post=' . $post['post_id'] . '" class="btn btn-success btn-xs"> مفعلة </a>') . '</td>
                           <td><a href="edit-post.php?post_id='.$post['post_id'].'" class="btn btn-warning btn-xs">تعديل</a></td>
                           <td><a href="posts.php?delete=' . $post['post_id'] . '" class="btn btn-danger btn-xs">حذف</a></td>
                       </tr>
                      ';

                                 }

                                 ?>

                                 </tbody>
                             </table>
                         </div>
                     </div>


                 </div>


                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading text-center">
                            <b>  جـميع الأعضاء  </b>
                        </div>
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



                                $Users = mysqli_query($connectToDB,"SELECT * FROM `members` ORDER BY `user_id` DESC LIMIT 5");
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
        </div>
      </article>
<?php
include_once ('inc/footer.php');
?>