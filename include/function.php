<?php

function register()
{

    if (isset($_SESSION['id'])) {

        echo '<div class="alert alert-danger" role="alert"> عذرا انت مسجل بالفعل لا يمكنك التسجيل مرة أخرى </div>';

    } else {

        echo '
        
            <form  method="post" action="include/register.php" class="form-horizontal" id="register" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label"><i class="fas fa-user fa-2x"></i></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="username" id="username" placeholder="أسم المستخدم">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label"><i class="fas fa-envelope-square fa-2x" style="color: dimgrey;"></i></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" id="email" placeholder="البريد الألكتروني">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label"><i class="fas fa-lock fa-2x"></i></label>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="password" id="password" placeholder="كلمة المرور">
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirm" class="col-sm-2 control-label"><i class="fas fa-lock fa-2x"></i></label>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="con_password" id="password_confirm" placeholder="تأكيد كلمة المرور">
            </div>
        </div>
        <div class="form-group">
            <label for="gender" class="col-sm-2 control-label"><i class="fas fa-venus-mars fa-2x" style="color: #2aabd2;"></i></label>
            <div class="col-sm-6">
                <select  class="form-control" id="gender" name="gender">
                    <option selected disabled>أختر الجنس</option>
                    <option value="male">ذكر</option>
                    <option value="female">أنثي</option>
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
            <label for="description" class="col-sm-2 control-label"><i class="fas fa-prescription-bottle fa-2x" style="color: #66afe9; margin-top: 10px;"></i></label>
            <div class="col-sm-6">
                <textarea  class="form-control" name="about" id="description" rows="3" placeholder="أضف وصف مختصر عنك"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="facebook" class="col-sm-2 control-label"><i class="fab fa-facebook fa-2x" style="color: darkblue;"></i></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="facebook" id="facebook" placeholder="أدخل رابط الفيس بوك">
            </div>
        </div>
        <div class="form-group">
            <label for="twitter" class="col-sm-2 control-label"><i class="fab fa-twitter fa-2x" style="color: lightblue;"></i></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="twitter" id="twitter" placeholder="أدخل رابط تويتر">
            </div>
        </div>
        <div class="form-group">
            <label for="youtube" class="col-sm-2 control-label"><i class="fab fa-youtube fa-2x" style="color: red;"></i></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="youtube" id="youtube" placeholder="أدخل رابط اليوتيوب">
            </div>
        </div>
            <div class="col-md-2"></div>
            <div class="col-md-5 form-group text-right">
            <div id="result"></div>
            </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="submit" class="btn btn-primary">تسجيل</button>
            </div>
        </div>
    </form>
        ';

    }

}


function login()
{

    if (isset($_SESSION['id'])) {

        echo '
        
        
        <div class="panel panel-default">
<div class="panel-heading text-center"><strong> مرحبا يا : ' . ucwords($_SESSION['user']) . '</strong></div>
<div class="panel-body">
    <div class="text-center" style="margin-bottom: 20px">
        <img src="' . $_SESSION['avatar'] . '" style="width: 70px">
    </div>
    <hr style=" width: 200px;height: 2px;background-color: blue;">
        <div class="col-md-12">
            <div class="row">
                <p><strong> البريد الألكتروني : </strong>' . $_SESSION['email'] . '</p>
                <p><strong> رابط الفيس بوك : </strong><a href="' . $_SESSION['facebook'] . '" target="_blank"><i class="fab fa-facebook fa-lg" style="color: darkblue;"></i></a></p>
                <p><strong> رابط تويتر : </strong><a href="' . $_SESSION['twitter'] . '" target="_blank"><i class="fab fa-twitter fa-lg" style="color: lightblue;"></i></a></p>
                <p><strong> رابط اليوتيوب : </strong><a href="' . $_SESSION['youtube'] . '" target="_blank"><i class="fab fa-youtube fa-lg" style="color: red;"></i></a></p>

            </div>
        </div>
    <div class="panel-footer">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
               ';

        if ($_SESSION['role'] == 'admin') {
            echo ' <a href="admin-cp/index.php" class="btn btn-success pull-left"> لوحة التحكم </a>';

        }

        echo '
                
                </div>
                <div class="col-md-6">
                     <a href="" class="btn btn-primary pull-right"> الصفحة الشخصية </a>
                </div>
                </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        ';


    } else {

        echo '

        <div class="panel panel-default">
        <div class="panel-body">
           <div class="text-center" style="margin-bottom: 20px">
        <img src="images/non-avatar.png" style="width: 70px">
           </div>
     <hr style=" width: 200px;height: 2px;background-color: blue;">

        <form class="form-horizontal" id="login" action="include/login.php" method="post">
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label text-center"><i class="fas fa-user fa-2x"></i></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="user" placeholder="أدخل أسم المستخدم أو البريد ألالكترونى">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label text-center"><i class="fas fa-lock fa-2x"></i></label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" placeholder="أدخل كلمة المرور">
            </div>
        </div>
        <div id="log_result" style="text-align: center;">

        </div>
        <div class="form-group">
            <div class="col-sm-10 pull-left">
                <button type="submit" name="login" class="btn btn-primary">تسجيل الدخول</button>
            </div>
        </div>
    </form>
    <div class="panel-footer col-md-12">
       <div class="col-md-12">
             <a href="register.php"><P> أذا لم تمكن مسجل يمكنك التسجيل من  </P></a>
            </div>
       </div>
    </div>
    </div>
         ';
    }
}


