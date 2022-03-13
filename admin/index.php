<?php 
SESSION_start();
if(isset ($_SESSION['username'])){
    header('location:dashboard.php');
}
include "connect.php";
include "includes/functions/functions.php";
include "includes/tempalets/header.php"; 
include "includes/languages/arbic.php";

//checked user &pass
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_POST['user'];
    $pass=$_POST['pass'];
    $hashedpass=sha1($pass);
    //echo $hashedpass;
//cecked user in databass 
//استعلام:statment //
$stmt=$con->prepare("SELECT            
                    userID,username, password                 
                    FROM 
                         users
                    WHERE
                           Username=? 
                    AND password=? 
                    AND 
                    GroubID =1
                    LIMIT  1");
$stmt ->execute(array($username,$hashedpass));
$row=$stmt->fetch(); //fetch data 
$count=$stmt->rowCount(); //count 
//echo $count;
//if count >0 record about username
if($count > 0){
    $_SESSION['username']=$username; //session name
    $_SESSION['ID']=$row['userID']; //session id
    header('location:dashboard.php'); //redirect to dashboard page
    exit();


}

}

?>

<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <h2 class="text-center mem " > Admin</h2>
    <input  class="form-control" type="text"  name="user" placeholder="Username" autocomplete="off">
    <input  class="form-control" type="password" name="pass" placeholder="Password" autocomplete="new-password">
    <input  class="btn btn-primary btn-block" type="submit" value="login">
    <h2><a class='alert  btn-success btn-block text-center' href="../index.php"> Skip ...  </a></h2>


</form>

 
<?php 
 include "includes/tempalets/footer.php";
 ?>
