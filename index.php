<?php
include('include/header.php');
include('include/sidebar.php');
include_once ('include/config.php');
?>
<article class="col-md-9 col-lg-9 art_bg">
    <!-- start carousel -->

    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top: 20px; margin-bottom: 30px;">

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
        <?php



        $slide_query = mysqli_query($connectToDB,"SELECT * FROM `posts` WHERE `status` = 'published' AND `category` = '$setting[slide]' ORDER BY `post_id` DESC LIMIT $setting[slide_value]");
        $count_slide = mysqli_num_rows($slide_query);

        $x = 0;
        while ($slide = mysqli_fetch_assoc($slide_query)){

        ?>
            <div class="item <?php echo ($x == 0 ? 'active' : '' ); ?>">
                <img style="width: 100%; height: 350px" src="<?php echo $slide['image']; ?>">
                <h3 class="carousel_h3"><a href="post.php?id=<?= $slide['post_id']; ?>"><?php echo $slide['title']; ?></a></h3>
                <div class="carousel-caption">
                    <p><?php echo strip_tags(substr($slide['post'],0,350)); ?></p>
                </div>
            </div>

        <?php
         $x++;
         }
        ?>



        </div><!-- End Carousel Inner -->


        <ul class="nav nav-pills nav-justified sliddd">
            <?php
                for($i=0;$i <$count_slide;$i++){
                    echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="'.($i == 0 ? 'class="active"': '').'"><a href="#"><img style="max-width: 20px; max-height: 20px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAOhklEQVR4Xu1bfXSU1Zn/PfedTPiWWJUPV4VVyMwkogisutoKXZhJ6lqsihxRV8HKcnalC3a11mZm3nkTtHpcKQe3H1Rc5OiuFl09gibvoGitFbX4hSSZgIUW0SofykdAMpn3PnvuJDN5ZzKT+ciErqe95+SPvO9zn/vc3/vc5z5fQ/gLH/QXvn/8FYAToQHv/7t3qGOIuEhAegCqBOQ4Ao+A1IazkGWAaCegnSX2QnAbs2hjjbdU6eaHAy3fgGlApM47HiSul8S1BEwDUFboZqSUe4QmNoF43aeINs3QX4kVyiMXfUkBYF0XbfKNq4HYYgvapQIlPGJKOzRaS7CWu0IbP8m1sXzflwQABqgt4J1nQfoFtMp8Fy+GTkJ2CNAajlHIc4/5p2J42Of0G4AW3VstpPwpQ/t6DmE+A/h1ABGw2A6SByDEEbKsTiZtGAEjmOVZJKhSMp3PsCYLCC0bTynlYSIRdEdGrKR166xigSgaAPXVW/2+O4ixDAKOzALIZmaxljWxoUpvbClEyN//YOZJHYPFDEjMY0lXCIFBWea/yZY217PshT8Wwj9BWxQAW++6vMJZ1vkYE30rfVEJMIGfY8a9VfXhN9Pfb1k4pWzo2FHjYfEYaNZwlqIMkO0ai4MdndqHk378/Bfpc97Vp48cZDkXgWkpBE7rvVH5BUA3uY3w+kJBKBiAth/94+lS6zABUdV78/RbJuu26tDG9xLv1IaHjD11FrH0sYXpBPJk1xgAEnuJ8DoTb3II7ZkJeuOeBK+Pls4Z3D780J1S0l3pGiGllBqJf3XVmz8vBISCANhRV3t2DHITBM5MW+QoM5a4683VBLB6p4CKaZ1LGfKfNIhTCxEqQau0STC/BA0rXHr4+QRvJUenkGsIuDSdL4HrXEZ4Wb7r5Q3AtuC3RlNM/lZo/LcpzCW2CQfPqdTDEfVcHY+y8pgBSy6EEM58BclFRxLvQeB2l2G+rGh5zhwt4j5UL0F39bpuGYvd9eZDuXiq93kBsC04fZjG5a8BOM/OVAIvO4W4coLeeFg9j+jea2KSf1rsF89HYCZ+rPy4vO3s+148pOhbAr4bSeIR+7FSmqOB5rqMpnW5eOYFQHPQ97hgzEthxtjgOCiumbCysWNbcI7TgUPLmelfci1YivfSop0QdE1VfeO73SBcTsAzKd6mRDsc2hS3/sL2vtbMCUBLoOYWAj9sZ8LAa8OPjPCesXzdl3HtkIOeBrG3FJsrgMdRBn/HY4Q3qjmtft88SXjMfhxY8tbBjuiF4/VXjmfj2ycAkeCssRZzREAbbjNMu6yoY4q6rrboVwwZLDvDAnxJAYKXkrRTgGdXGuHGbk3wE2CkLEAw3CEzWBwAdb4nWGBucrKUUUHapZX1Tb97WZ/uGC3LngXE5aXcUcG8pDwmHGJGpW6+pWKRiPW6CaKZPR9MdkCI6myRZVYNaPXXXAyKu67JwUDAY5j1cbSD3npiqitY4AGYoKJGh2PQ5Ep9/f6Wu31jWMiIEGKETfJn3Eb4qkxLZwUg4vc+n+LpMbY7DopJyui16jXTpeRNxUZ7oqwcX7tsHoZVXggw40hkMw68+gQ4Fi0aHgla7zGaZitfocXvW0KE5bZjy2CcW1VvNqcvkBGANr/vPElIenNqEoOu8hhNzyiLT/zF1qKjPiKcceMyDD37ghRZ2iObsecJIw5IsSMhY9xHmHg4Ag3n9Bxfetzd0HRDXgBEgt7/TLnSJLa5GsxJCt1Wf83tIP6PYoUcNOYcjFuU2UfZufJWRPd/VCxr5UbvtrQRE6pD66Itft93ifBLu/3qjDlHp8cavTRAfWGND6uEw9cSkwlY4DLM/9qlTx90PObcBUGji5VyyPjzcObN92Wc/sdfLsGXe+IOZdGDQd/1GE2r40HXaafsSQ2eaJHbaPqFnXkvAFoCPuVUbLAhd8zSOkdVh15pj/i9C5hoddHSARDOQTh7yRpoQ0emsOk8tBc7VywAW/3LeklGxFNveuK2IOD7CQH/ZjOGv3Yb4el9AhAJ+parwKYHAPyPu8GMe4GtAd+vAXyjPwCouYNOn4jT5/wQZRVj4qyi+/fg418tQ8dnu/rLOj5fMP2duqrb/DXTJPFb9mNw1DGoYqq+/phNu1PXbKnzvk+CJiWfMs131zetUU4Rs/i4JBLGpRQoP0UFlYyOfbv7Zfx6yUR40B0yv6+SNpE6334InJykEdLn1jeGMwLQ5dlF2+3Xm0XWWdWhF3dHAt7rGfRYyQAYWEbvuw3zfLVEc8D3lACu7vmgCLrrzaS3mGIDtgVnna+xiAcYaliQ+6qNjfEMTHOw5heCeeHAyl067sdFR8Vk/ZWDrYGaHwJ8T4KzJPx3Vci8PqMGtAS8cwn0ROKlCno8hhlPdkYCM1/NI/GZdQeOYRU46fyZEOVDbH9DIcoHQ1PPnIOxe+3diB3eXxIUWIiLPXrjG616zVWQ/LSN6dtuw5yaDYClBHowSUxY6w6ZN6n/WwO+TwGMKla68lPPxJnz7+9l/e38+u0H2Jgx4yZPvbm2l1Mn+VN3Q7jL+qYnRFr9vgAIoR4+tNJtNH2vGwDlpxZc3UkBjAhDxk3C2GvugtKI9FFSAMC3e4zw8la9Zhwk26+Xo27DHJZNA+4n0B02DbjHHTJ/tGNxbXmsQmaNqQvVipFTajH627bruZtBKQEAdxm7Zt13spA4YJfRJS7WSNdlLw2IBH33MePOHmK+122E7+72DjsK3Wg2+qETpuGMG+JBZcooJQCJyLVNv+IUKaP7EgupdJnHMLVEgjXlFmgJ+FITCoSH3CFzcfwI1M1ScXVJkpxDz5mKM25sGFAACFjiMswVqkjLgnYmF5NodzeYyQRPKgBpYaRKQHpC4RvV5OaAd48AnV4KLTgxAPANLiP8eIvuu4Ak3k5qgMQnVQ1mch8pALQGfMpheMp2BN5wG+GLuwDwqfh/xlcGAJLTXKGNWyJ+37VMeNIm95tuw7wosxHUvdUk6YMeYvmF29gYdyNbg76VYNz2VQBAVYlY6zxJBXAZjnXyau9lBJW1j1bEjtqrsizlRE/Dxh0q58+ScubZ8wHoBByB5FduDczakJq3pLvdRtO9GTUg/qUDs94ChOro6B5dMbSyprHY8c+EECKfTfZFM+AAEOLXt0rcniYdn9uz2mAx3V3fqKLa+OiVD0i/ConxrKve/E4cHL+vEYSa/+8AsOBzPXp4W4vu/QZJSm5Wgr9kOmmkyhhlBaA5UPMPAvxiz7Uho9IhxlTp5ufpsUKxQAywBiR9/dY63yoI3Jq8AQCzyjBTPmAvDegqOh78CBBJfxndxcYulSrfLoDxxW5ezcvmCO16aGFXbqAfgxhzXfXmr1RoPywW/ZgFkqmnRHxgZ58xK9wc8D0ggO/bkNu1V3RMVF1amUplhcpbcdGVGFW7qNe0vU2r8Pnm/y2UXQ89yxZXZOQk1TLTEvCmBnbAUYs6RqubIScALXWzJjCgigs2g8c3u43wo90asjnVUOYns4oBBp9VjRHVl4G0zF01R3e+h0PvNOLwB8mjmx/zLoP2TVU+V8nbY7Hy3wuBscmPSLSqKtT0z+nMshZGWoKzniQW1yYZSHyiRctdrvufO9Lsr50sSKr2l4KiwzGzl8J5yt/k3NCxP2zFvpcezUlnJ5CENVUhc37cWAd9ITACPXYMMQJPdDWEeyUds1eG9JpJVsx6164FRPiJK2QuVYwj/prvMfGKgqQcIGIGWjuP8bTzHggfjWuvwAcCorwHAHrU3dB0c6bl+6wOtwa8PwcoqTbxlhUha1RSsTvhuBoCcdT/jOMASbrE1dDU1h21qnrmlB77ZR3RiFzZmiv7BEC1uwhntM3e8aHyhOXCcYFqXlK3wijpfIpAs/8sAEi0S+KZiW60TO46dydGssmXu0FC915JklT3hW3I5s6o8+vxHoGFU8qGnXbyahYiHjWesCGxlx2o9ejmO2rNDFYfBOs3la0VM/pqpMwJQJdR8a4AUzw11jN4s7ND1qpenXhdXr7xAwmrvq/uztKBI38HoV3r1pv+0GWPvAssoodT0vmQ+8qs8smVyzb0WcvIC4Cus3UoDNBlKRBI3gpJNYme3bZgzaUxjj1cdOU4F0ISMWj0gIXhwYQ7m572jrOQMkoOqnXp4U25WOYFgGKiWlej5Zq6nFM7xSQ+IQdf59HDryo6FVF2VsglJHFnSkUmlyQ53hPzC5am3ZFouVW9SQLOnxFTSsm7u1P1Oo8RtucAsnLPGwDFQfUKgmNhDXRuikWAtASJZY7PxT2qgaKLdvowwc5bCXxLpq7SPPE4CsLTTFiROOvxI6l7/15K+Ui6pqk8gBBikdswe8riuYDNU5AkmerbLZfl6zN1acLCh9D4dnvPrrout/t9k5jIy8zflIxJdg8tFUj+UpPUxhpeY6ZNncdkWN3tCRrV/oIyNDBjfnp3ipQ4ToLmqSaOQvZUkAYkGCtXsyPmfIgF3ZJxMWm9Q8Lx4/ZP9z07ddXbnek0kTu/PVw6vxwNhxiuCuZsySMOWXZwYtnUPyXS1fY5yrmBEKrtdkGKg5MgktjNDjFXVYIK2byiLQqAxCKqYGpB/iwl4ZAqwQEifpIYGzop+pv0QKQvYZv9viqNMJOB6wBcmJWW8ZzUMF+F64Vuvt8AKAaqbA5LPJjSTpdJEmXBYW2VmhYRzNvBdICBwwBFiVilqUeAMA4M9YsTVZ7vswynOsM0By116WFbErdwCPqlAfblVOcYpNTTr8rCRco5QwG3QlLH8kI0KhvXkgGQPBb+WZeAxWILmN3Hrzxy7rIXgcQ2FvxI5zGsshvGwhmlzig5AAn2O/TaEZaUV0uSNZIxo9AOcqmuVogtILxkQa6z/wijv5u2zx8wAOyLqKtwR91Ml+VwuCFRCcnj1Y+kQDycAScIR0B0BKC9LLmNgTanJt5PtOGXcsPpvE4IAAO5gf7y/isA/UXwqz7//wAWTE6bmLon2gAAAABJRU5ErkJggg=="></a></li>';
                }
                ?>
            </ul>

    </div>
    <!-- End Carousel -->

    <hr/>

    <!-- category A -->
    <div class="row">
        <h2 class="tit_cat1"><?= $setting['section_a']; ?></h2>

        <?php

        $section_a = mysqli_query($connectToDB,"SELECT * FROM `posts` p INNER JOIN `members` m ON p.author = m.user_id WHERE `status` = 'published' AND `category` = '$setting[section_a]' ORDER BY `post_id` DESC LIMIT $setting[section_a_value]");
        $data_section_a = mysqli_fetch_all($section_a,MYSQLI_ASSOC);

        ?>
        <?php  foreach ($data_section_a as $data) : ?>
        <div class="col-sm-4 col-md-4" style="margin-bottom: 20px">
            <div class="post">
                <div class="post-img-content">
                    <img src="<?= $data['image']; ?>" class="img-responsive"
                         style="width: 100%;height: 200px;"/>
                    <span class="post-title"><b><?php echo $data['title']; ?></b>
                </div>
                <div class="content">
                    <div class="author">
                        بواسطة <a href="profile.php?user=<?= $data['user_id']; ?>"><b><?= $data['username']; ?></b></a> |
                        بتاريخ
                        <time datetime="2014-01-20"><?= $data['created_at']; ?></time>
                    </div>
                    <div class="text-justify">
                        <?= strip_tags($data['post']); ?>
                    </div>
                    <hr/>
                    <div class="text-left">
                        <a href="post.php?id=<?= $data['post_id']; ?>" class="btn btn-warning btn-sm">اقرأ المزيد &larr;</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
    <hr/>
    <!-- end category A -->
    <!-- tab -->
    <div class="col-md-12">
        <div class="row">
            <div class="tabbable-panel">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#tab_default_1" data-toggle="tab">
                               <?= $setting['tab_a']; ?></a>
                        </li>
                        <li>
                            <a href="#tab_default_2" data-toggle="tab">
                               <?= $setting['tab_b']; ?></a>
                        </li>
                        <li>
                            <a href="#tab_default_3" data-toggle="tab">
                               <?= $setting['tab_c']; ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_default_1">

                            <?php
                            $tab_a = mysqli_query($connectToDB,"SELECT * FROM `posts` WHERE `status` = 'published' AND `category` = '$setting[tab_a]' ORDER BY `post_id` DESC LIMIT $setting[tab_a_value]");
                            $result_a = mysqli_fetch_all($tab_a,MYSQLI_ASSOC);
                            ?>

                               <?php foreach($result_a as $tab_a) :?>
                                <div class="bg_tab_topic">
                                <div class="col-md-3">
                                    <img src="<?= $tab_a['image']; ?>" width="100%"
                                         class="img-thumbnail"/>
                                </div>
                                <div class="col-md-9">
                                    <h3 class="col-md-12 text-justify"
                                        style="margin-top: 8px;background: #009688;padding: 8px;">
                                        <a href="post.php?id=<?= $tab_a['post_id']; ?>" class="a_1"><?= strip_tags($tab_a['title']); ?></a>
                                    </h3>
                                    <p class="col-md-12 text-justify">
                                        <?= strip_tags($tab_a['post']); ?>
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php  endforeach; ?>

                        </div>


                        <div class="tab-pane" id="tab_default_2">

                            <?php
                            $tab_b = mysqli_query($connectToDB,"SELECT * FROM `posts` WHERE `status` = 'published' AND `category` = '$setting[tab_b]' ORDER BY `post_id` DESC LIMIT $setting[tab_b_value]");
                            $result_b = mysqli_fetch_all($tab_b,MYSQLI_ASSOC);
                            ?>

                            <?php foreach($result_b as $tab_b) :?>
                                <div class="bg_tab_topic">
                                    <div class="col-md-3">
                                        <img src="<?= $tab_b['image']; ?>" width="100%"
                                             class="img-thumbnail"/>
                                    </div>
                                    <div class="col-md-9">
                                        <h3 class="col-md-12 text-justify"
                                            style="margin-top: 8px;background: #009688;padding: 8px;">
                                            <a href="post.php?id=<?= $tab_b['post_id']; ?>" class="a_1"><?= strip_tags($tab_a['title']); ?></a>
                                        </h3>
                                        <p class="col-md-12 text-justify">
                                            <?= strip_tags($tab_b['post']); ?>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            <?php  endforeach; ?>

                        </div>


                        <div class="tab-pane" id="tab_default_3">

                            <?php
                            $tab_c = mysqli_query($connectToDB,"SELECT * FROM `posts` WHERE `status` = 'published' AND `category` = '$setting[tab_c]' ORDER BY `post_id` DESC LIMIT $setting[tab_c_value]");
                            $result_c = mysqli_fetch_all($tab_c,MYSQLI_ASSOC);
                            ?>

                            <?php foreach($result_c as $tab_c) :?>
                                <div class="bg_tab_topic">
                                    <div class="col-md-3">
                                        <img src="<?= $tab_c['image']; ?>" width="100%"
                                             class="img-thumbnail"/>
                                    </div>
                                    <div class="col-md-9">
                                        <h3 class="col-md-12 text-justify"
                                            style="margin-top: 8px;background: #009688;padding: 8px;">
                                            <a href="post.php?id=<?= $tab_c['post_id']; ?>" class="a_1"><?= strip_tags($tab_a['title']); ?></a>
                                        </h3>
                                        <p class="col-md-12 text-justify">
                                            <?= strip_tags($tab_c['post']); ?>
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            <?php  endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end Tabs -->

    <!-- start category B -->
    <div class="col-lg-12">
        <h2 class="tit_cat2"><?= $setting['section_b']; ?></h2>
        <div class="row  bg_cat2">
            <?php

            $section_b = mysqli_query($connectToDB,"SELECT * FROM `posts` p INNER JOIN `members` m ON p.author = m.user_id WHERE `status` = 'published' AND `category` = '$setting[section_b]' ORDER BY `post_id` DESC LIMIT $setting[section_b_value]");
            $data_section_b = mysqli_fetch_all($section_b,MYSQLI_ASSOC);

            ?>
            <?php  foreach ($data_section_b as $data) : ?>
            <div class="bg_tab_topic col-md-6">
                <div class="col-md-4">
                    <img src="<?php echo $data['image']; ?>" width="100%" class="circle"/>
                </div>
                <div class="col-md-8">
                    <h3 class="col-md-12 text-justify" style="margin-right: -30px;margin-top: 8px;">
                        <a href="post.php?id=<?= $data['post_id']; ?>"><?= $data['title']; ?></a>
                    </h3>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php endforeach; ?>

            <div class="clearfix"></div>
        </div>
    </div>
</article>
<?php
include('include/footer.php');
?>