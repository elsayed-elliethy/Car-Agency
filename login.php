<?php 
SESSION_start();

if(isset ($_SESSION['user'])){
    header('location:index.php');
}


include "connect.php";
include "includes/tempalets/header.php"; 
include "includes/functions/functions.php";

    //checked user &pass
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset ($_POST['login'])){
        $user=$_POST['username'];
        $pass=$_POST['password'];
        $hashedpass=sha1($pass);
        //echo $hashedpass;
    //cecked user in databass 
    //استعلام:statment //
    $stmt=$con->prepare("SELECT            
                        *           
                        FROM 
                            users
                        WHERE
                            Username=? 
                        AND password=?  ");
    $stmt ->execute(array($user,$hashedpass));
    $get=$stmt->fetch();
    $count=$stmt->rowCount(); //count 
    //echo $count;
    //if count >0 record about username
    if($count > 0){
        $_SESSION['user']=$user; //register session name
        $_SESSION['uid']=$get['userID']; //register User ID in Session
        foreach($get as $user ){
            if ($get['GroubID'] == 1){
                header('location: admin/index.php');
                exit();
            }else{
                header('location: index.php');
                exit();
            }
        }
    
    }
    }else{  

        $formErrors=array();
        //upload variables
        $avaterName=$_FILES['avater']['name'];
        $avaterSize=$_FILES['avater']['size'];
        $avaterTmp=$_FILES['avater']['tmp_name'];
        $avaterType=$_FILES['avater']['type'];
        //list of allowed file typed to upload
        $avaterAllowedExtention = array("jpg","png","jpeg","gif");
        $username   =$_POST['username'];
        $username2   =$_POST['username2'];
        $phone   =$_POST['phone'];

        $password   =$_POST['password'];
        $password2  =$_POST['password2'];
        $email      =$_POST['email'];
        if(isset($username)){
             $filterdUser = filter_var($username,FILTER_SANITIZE_STRING);
                if(strlen($filterdUser)<4){
                    $formErrors[]='Username Must Be Larger Than 4 Characters';
                }
            }
        if(isset($username2)){
            $filterdUser = filter_var($username2,FILTER_SANITIZE_STRING);
                if(strlen($filterdUser)<7){
                    $formErrors[]='FullName Must Be Larger Than 7 Characters';
                }
            }
            if(isset($phone)){
                $filterdUser = $phone;
                    if(strlen($filterdUser)<11){
                        $formErrors[]='Phone Must Be Larger Than 11 Number';
                    }
                }
        if(isset($password )&& isset($password2)){
            if(empty($password)){
                $formErrors[]='Sorry Password Cant Be Empty';

            }
                if(sha1($password)!==sha1($password2)){
                $formErrors[]='Sorry Password Is Not Match';

                }  

            }
        if(isset($email)){
            $filterdEmail = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
                if(filter_var($filterdEmail,FILTER_VALIDATE_EMAIL)!=true){ 
                    $formErrors[]='This Email Is Not  Valid';

                }
            }
            if (empty($formErrors)){
                //Check If User Exist in Database
                $check=checkItem("Username","users",$username);
                if($check==1){
                    $formErrors[]='This User Is Exists';
                }else{
               //insert userInfo In Database
               $avater = rand(0,100000000).'_'.$avaterName;
               move_uploaded_file($avaterTmp,"admin\uploads\avater\\".$avater);
               ///////////
                $stmt =$con->prepare("INSERT INTO 
                                    users (username ,password,Email,RegStatus,Date,avater,Fullname,Phone)
                                    VALUES (:zuser,:zpass,:zmail,0,now(),:zavater,:zfullname,:zphone)");
                $stmt->execute(array(
                    'zuser'=>$username,
                    'zpass'=>sha1($password),
                    'zmail'=>$email,
                    'zavater'=>$avater,
                    'zfullname'=>$username2,
                    'zphone'=> $phone

                ));
                
                //echo success message
                $successMsg='Congrats ';
                if (isset($successMsg)){
                    echo '<div class="mem text-center ">'.$successMsg.'</div>';
                }

                
               
            }
            }

        }
    }

?>
<div class="login1">
<div class="container  ">
    <h1 class='text-center h-login mem'><span data-class="login"  class="selected ">Login</span> | <span data-class="signup">Signup</span></h1>
    <!--start login form-->
  
    <form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <div class="user-icon">
        <img src="image/user.png">
        <h2>WELCOME</h2>

        </div>
    
        <input class="form-control the-success1 " type="text" name="username" autocomplete="off" placeholder="Type your username">
        <input class="form-control the-success1 " type="password" name="password" autocomplete="new-password" placeholder="Type your password">
        <input class="btn btn-primary btn-block the-success1" name='login' type="submit" value="Login">

    </form>
    <!--end login form-->
    <!--start signup form-->
    <form class=" signup" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
        <input class="form-control the-success2 " type="text" name="username" autocomplete="off" placeholder="Type your username">
        <input class="form-control the-success2" type="password" name="password" autocomplete="new-password" placeholder="Type a password">
        <input class="form-control the-success2 " type="password" name="password2" autocomplete="new-password" placeholder="Type your password again">
        <input class="form-control the-success2" type="email" name="email" autocomplete="off" placeholder="Type a Valid email">
        
        <input class="form-control the-success2 " type="text" name="username2" autocomplete="off" placeholder="Type your FullName">
        <input class="form-control the-success2 " type="text" name="phone" autocomplete="off" placeholder="Type your Phone">

        <!-- start Avater field-->
        <div class="form-group">
            <div class="col-sm-12 ">
            <label class="custom-file-label upload-image the-success2 " for="customFile">Your Image</label>
            <input type="file" class="img-user live-img " id="customFile" name="avater">
            </div>   
        </div>
    <!--end Avater Field-->
        <input class="btn btn-success btn-block the-success2"  name="signup" type="submit" value="Signup">
</form>
<!--end signup form-->
    <div class="the-errors text-center">
       <?php 
            if (!empty($formErrors)){
                foreach($formErrors as $error){
                    echo '<div class="alert alert-danger the-error">'.$error.'</div>' ;
                }
            }
           
       ?>
    
    </div>
</div>
</div>


<?php include "includes/tempalets/footer.php";?>
