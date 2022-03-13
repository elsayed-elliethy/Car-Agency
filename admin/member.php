<?php
    session_start();
    if(isset($_SESSION['username'])){
        include "connect.php";
        include "includes/tempalets/header.php"; 
        include "includes/functions/functions.php";
        include "includes/languages/arbic.php";
        include 'includes/tempalets/Navbar.php';
        $do=isset($_GET['do']) ? $_GET['do'] : 'Manage';
            //start manage page 
        if ( $do == 'Manage') {    //Manage Page //members // 
            $query='';
                if(isset($_GET['page'])&& $_GET['page']=='Pending'){
                    $query='WHERE GroubID !=1  AND RegStatus=0' ;


                }
            // select All Users Excepts Admin ==(WHERE GroubID !=1)
            $stmt=$con->prepare("SELECT * FROM users 
             
                $query
                ORDER BY userID DESC
             ");
            //Execute The State
            $stmt->execute();
            //Assign To Variable
            $rows=$stmt->fetchAll(); 
            
                if(! empty ($rows)){

                
             
        ?> 
        <h1 class="text-center mem" > Manage Member</h1>
        <div class="container ">  
            <div class ="table-responsive">
            <table class="main-table table table-bordered text-center ">
                <tr>
                    <td>#ID</td>
                    <td>Image</td>
                    <td>Username</td>
                    <td>Email</td>
                    <td>Full Name</td>
                    <td>Registerd Date</td>
                    <td>Control</td>
                </tr>
                <?php
                    foreach($rows as $row){
                        echo"<tr>";
                            echo"<td>".$row['userID']."</td>";
                            echo"<td class='user-image'>";
                            if (empty($row['avater']) ){
                                echo"<img src='img.jpg' class='avater' >";  
                            }else{
                                echo"<img src='uploads/avater/" . $row['avater']. " ' class='avater' >";
                                                      }
                           
                            echo"</td>" ;
                            echo"<td>".$row['username']."</td>";
                            echo"<td>".$row['Email']."</td>";
                            echo"<td>".$row['Fullname']."</td>";
                            echo"<td>".$row['Date']."</td>";
                            echo"<td>
                                <a href='member.php?do=Edit&userid=".$row['userID']."' class='btn btn-success btn-edit-delete-active'><i class='fa fa-edit'></i> Edit</a>
                                <a href='member.php?do=Delete&userid=".$row['userID']."' class='btn btn-danger confirm btn-edit-delete-active'><i class='fa fa-close'></i> Delete</a>";
                                 if ($row['RegStatus']==0){

                                     echo "<a href='member.php?do=Activate&userid=".$row['userID']."' class='btn btn-info confirm activate btn-edit-delete-active'><i class='fa fa-magic'></i> Activate</a>";

                                 }
                                echo "</td>";
                            echo"</tr>";
                    }
                ?>
            

            </table>
        </div>          
            <a href="member.php?do=add" class="btn btn-primary"><i class="fa fa-plus" ></i>Add New Member</a>
    </div>
                <?php }else{

                    echo '<div class="container">';
                    echo '<div class="nice-message">There\'s No Members To Show</div> ';
                    echo '<a href="member.php?do=add" class="btn btn-primary "><i class="fa fa-plus" ></i>Add New Member</a>';
                    echo '</div>'; 
                    
                }?>
    
    <?php
     }elseif($do=='add') {?>
        <h1 class="text-center mem" > Add New Member</h1>
        <div class="container edit">
            <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
                
            <!-- start Username field-->
            <div class="form-group">
                <label class="col-sm-2 control-label" >Username</label>
                <div class=" col-sm-7">
                    <input type="text" name="username" class="form-control"  autocomplete="off" required="required" placeholder="Username">

                </div>
            </div>
            <!--end Username Field-->
            <!-- start Password field-->
            <div class="form-group ">
                <label class="col-sm-2 control-label" >Password</label>
                <div class=" col-sm-7">
                    <input type="password" name="password" class="password  form-control"  autocomplete="new-password" required="required"placeholder="Password">
                    <i class=" fa fa-eye fa-2x showpass"></i>
                </div>
            </div>
            <!--end Password Field-->
            <!-- start Email field-->
            <div class="form-group">
                <label class="col-sm-2 control-label" >Email</label>
                <div class=" col-sm-7">
                    <input type="email" name="email" class="form-control"   autocomplete="off" required="required"placeholder="Email">
                </div>
            </div>
            <!--end Email Field-->
            <!-- start Fullname field-->
            <div class="form-group">
                <label class="col-sm-2 control-label" >Fullname</label>
                <div class=" col-sm-7">
                    <input type="text" name="fullname"  class="form-control" required="required"placeholder="Fullname">
                </div>
            </div>
            <!--end Fullname Field-->
            <!-- start Avater field-->
                <div class="form-group">
                    <label class="col-sm-2 control-label" >User-Image</label>
                    <div class="col-sm-7 ">
                    <label class="custom-file-label upload-image  " for="customFile">Choose Image</label>
                    <input type="file" class="form-control" id="customFile" name="avater">
                    </div>   
                </div>
            <!--end Avater Field-->
            <!-- start submit field-->
                <div class="form-group">
                <div class=" col-sm-offset-4 col-sm-7">
                    <input type="submit" value="Add Member" class="btn btn-primary">
                </div>
            </div>
            <!--end submit Field-->
            </form>
            
        </div>


       <?php }elseif($do=='Insert'){
             
             if($_SERVER['REQUEST_METHOD']=='POST'){
                echo "<h1 class='text-center mem'>Insert Member</h>"."<br>";
                echo "<div class='container'>";
                    
                    //upload variables
                    $avaterName=$_FILES['avater']['name'];
                    $avaterSize=$_FILES['avater']['size'];
                    $avaterTmp=$_FILES['avater']['tmp_name'];
                    $avaterType=$_FILES['avater']['type'];
                    //list of allowed file typed to upload
                    $avaterAllowedExtention = array("jpg","png","jpeg","gif");
                    //get variable from the form
                    $user = $_POST['username'];
                    $pass =$_POST['password'];
                    $email= $_POST['email'];
                    $name = $_POST['fullname'];
                    $hashpass=sha1($_POST['password']);
                //validate the form 
                 $formErrors=array();
                 if(strlen($user)<4){
                     $formErrors[]='<div class="alert alert-danger">Username Cant Be less than <strong>4</strong>Characters</div>';
                 }
                 if(strlen($user)>20){
                    $formErrors[]='<div class="alert alert-danger">Username Cant Be More than <strong>20</strong>Characters</div>';
                }
                if(empty($user)){
                    $formErrors[]='<div class="alert alert-danger">Username Cant Be Empty</div>';
                }
                if(empty($pass)){
                    $formErrors[]='<div class="alert alert-danger">Password Cant Be Empty</div>';
                }
                if(empty($email)){
                    $formErrors[]='<div class="alert alert-danger">Email Cant Be Empty</div>';
                }
                if(empty($name)){
                    $formErrors[]='<div class="alert alert-danger">Fullname Cant Be Empty</div>';
                
                }if(empty($avaterName)){
                    $formErrors[]='<div class="alert alert-danger">Image Is Required</div>';

                }

                foreach($formErrors as $error){
                    echo $error.'<br>';
                }
                //check if there's no error  //statment
                if (empty($formErrors)){
                    //تحميل الصوره باسم مختلف حتي لو
                    // تشابه الاسم ف التحميل من قبل
                    //upload اليوزر وبعدها بتحملها علي ملف 
                    $avater = rand(0,100000000).'_'.$avaterName;
                    move_uploaded_file($avaterTmp,"uploads\avater\\".$avater);
                    ///////////
                    //Check If User Exist in Database
                    $check=checkItem("Username","users",$user);
                    if($check==1){
                        $theMsg="<div class='alert alert-danger'>Sorry This User Is Exist</div>";
                        redirectHome($theMsg,'back');
                    }else{
                    //insert userInfo In Database
                    $stmt =$con->prepare("INSERT INTO 
                                        users (username ,password,Email,Fullname,RegStatus,Date,avater)
                                        VALUES (:zuser,:zpass,:zmail,:zname,1,now(),:zavater)");
                    $stmt->execute(array(
                        'zuser'     =>$user,
                        'zpass'     =>$hashpass,
                        'zmail'     =>$email,
                        'zname'     =>$name,
                        'zavater'   =>$avater
                        
                    ));
                 $count=$stmt->rowCount(); //count 
                    //echo success message
                 
                    $theMsg= "<div class='alert alert-success'>".$stmt->rowCount().'Record Insert</div>';
                    redirectHome( $theMsg,'back',3);
                }
                }

               
                

             }else{

                 echo '<div class="container">';
                 $theMsg= '<div class="mem text-center alert-danger">Sorry You Cant Browse This Page Directly</div>';
                 redirectHome( $theMsg);
                 echo '</div>';
             }

             echo "</div>";
        }
        elseif ( $do == 'Edit' ) { //Edit Page
            
            //if(isset($_GET['userID']) && is_numeric($_GET['userID'])){       //لو فيه رجويست جيه ف الرابط يوزر اي دي وهل كان رقم 
                    //echo intval($_GET['userID'] ) ;                      //integer value
           // }else{
             //   echo 0; 
           // }
                   //دي اختصار للاف اللي فوق بحيث؟ تعني الصح وال: تعني الالس
                   $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
                   //استعلام:statment
                    $stmt=$con->prepare("SELECT * FROM  users WHERE userID =?  LIMIT  1");

                    $stmt ->execute(array($userid));

                    $row=$stmt->fetch(); //fetch data 

                    $count=$stmt->rowCount(); //count 
        if($count >0){ ?>
        <h1 class="text-center mem" > Edit Member</h1>
        
        <div class="container edit">
            <form class="form-horizontal" action="?do=Update" method="POST">
                <input type="hidden" name="userid"  value="<?php echo $userid ?>">
            <!-- start Username field-->
            <div class="form-group">
                <label class="col-sm-2 control-label" >Username</label>
                <div class=" col-sm-7">
                    <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>"
                     autocomplete="off" required="required">

                </div>
            </div>
            <!--end Username Field-->
            <!-- start Password field-->
            <div class="form-group ">
                <label class="col-sm-2 control-label" >Password</label>
                <div class=" col-sm-7">
                <input type="hidden" name="oldpassword"  value="<?php echo $row['password'] ?>">
                    <input type="password" name="newpassword" class="form-control" placeholder="Leave Blank  If You Don't Want To Change" autocomplete="new-password">
                </div>
            </div>
            <!--end Password Field-->
            <!-- start Email field-->
            <div class="form-group">
                <label class="col-sm-2 control-label" >Email</label>
                <div class=" col-sm-7">
                    <input type="email" name="email" class="form-control" value="<?php echo $row['Email'] ?>"  autocomplete="off" required="required">
                </div>
            </div>
            <!--end Email Field-->
            <!-- start Fullname field-->
            <div class="form-group">
                <label class="col-sm-2 control-label" >Fullname</label>
                <div class=" col-sm-7">
                    <input type="text" name="fullname"  value="<?php echo $row['Fullname'] ?>" class="form-control" required="required">
                </div>
            </div>
            <!--end Fullname Field-->
            
            <!-- start submit field-->
                <div class="form-group">
                <div class=" col-sm-offset-4 col-sm-7">
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </div>
            <!--end submit Field-->
            </form>
            
        </div>   

      <?php 
        }else{
            echo '<div class="container">';
            $theMsg='<div class="alert alert-danger">theres No Such ID</div>';
            redirectHome($theMsg,'back');
            echo'</div>';
        
            }
        } elseif($do=='Update'){
             echo "<h1 class='text-center mem'>Update Member</h>"."<br>";
             echo "<div class='container'>";
             if($_SERVER['REQUEST_METHOD']=='POST'){
                    //get variable from the form
                    $id   = $_POST['userid'];
                    $user = $_POST['username'];
                    $email= $_POST['email'];
                    $name = $_POST['fullname'];
                //Password Trick
                $pass=empty($_POST['newpassword'])?$_POST['oldpassword']: sha1($_POST['newpassword']);
                 /*$pass='';
                 if(empty($_POST['newpassword'])){
                        $pass=$_POST['oldpassword'];
                 }else{
                     $pass=sha1($_POST['newpassword']);
                 }*/
                                 //validate the form 
                 $formErrors=array();
                 if(strlen($user)<4){
                     $formErrors[]='<div class="alert alert-danger">Username Cant Be less than <strong>4</strong>Characters</div>';
                 }
                 if(strlen($user)>20){
                    $formErrors[]='<div class="alert alert-danger">Username Cant Be More than <strong>20</strong>Characters</div>';
                }
                if(empty($user)){
                    $formErrors[]='<div class="alert alert-danger">Username Cant Be Empty</div>';
                }
                if(empty($email)){
                    $formErrors[]='<div class="alert alert-danger">Email Cant Be Empty</div>';
                }
                if(empty($name)){
                    $formErrors[]='<div class="alert alert-danger">Fullname Cant Be Empty</div>';
                }
                foreach($formErrors as $error){
                    echo $error.'<br>';
                }
                //check if there's no error

                   if (empty($formErrors)){
                               $stmt2 = $con->prepare("SELECT 
                                        *
                                FROM 
                                        users
                                WHERE
                                        username = ?
                                AND 
                                        userID != ?");

                    $stmt2->execute(array($user, $id));

                    $count = $stmt2->rowCount();

                    if ($count == 1) {

                    $theMsg = '<div class="alert alert-danger">Sorry This User Is Exist</div>';

                    redirectHome($theMsg, 'back');

                    } else{
                    $stmt=$con -> prepare("UPDATE users SET username=?,Email=?,Fullname=?,password=? WHERE userID =?");

                    $stmt->execute(array($user,$email,$name,$pass,$id));

                    //echo success message
                   $theMsg=  "<div class='alert alert-success'>" . $stmt->rowCount().'Record Updated</div>';
                    redirectHome($theMsg,'back');
                }
            }
                //update the data with info

             }else{
                $theMsg= "<div class alert alert-danger>Sorry You Cant Browse This Page Directly</div>";
                redirectHome($theMsg);
                }


             echo "</div>";
        }elseif($do=='Delete'){

            //Delete Member Page
            echo "<h1 class='text-center mem'>Delete Member</h>"."<br>";
            echo "<div class='container'>";
            $userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid'] ) : 0;
            //استعلام:statment
            $stmt=$con->prepare("SELECT * FROM  users WHERE userID =?  LIMIT  1");
            $stmt ->execute(array($userid));
            $count=$stmt->rowCount(); //count 
            if($stmt->rowCount()>0){ 
                $stmt=$con->prepare("DELETE FROM users WHERE userID=:zuser");
                $stmt->bindparam(":zuser",$userid); //bind parameter بتربط بين القيمه اللي ف الريجويست واللي موجوده ف الداتا
                $stmt->execute();
                $theMsg = "<div class='alert alert-success mem text-center'>".$stmt->rowCount().'Record Delete</div>';
                redirectHome($theMsg,'back');
            }else{
                $theMsg ="<div class='alert alert-danger mem  text-center'>This ID is Not Exist</div>";
                redirectHome($theMsg);
            }
            echo"</div>";

        }elseif($do=='Activate'){
            //Activate Member Page
            echo "<h1 class='text-center mem'>Activate Member</h>"."<br>";
            echo "<div class='container'>";
            $userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid'] ) : 0;
            //استعلام:statment
            $stmt=$con->prepare("SELECT * FROM  users WHERE userID =?  LIMIT  1");
            $stmt ->execute(array($userid));
            $count=$stmt->rowCount(); //count 
            if($stmt->rowCount()>0){ 
                $stmt=$con->prepare("UPDATE  users SET RegStatus=1 WHERE UserID=? ");
                $stmt->execute(array($userid));
                $theMsg = "<div class='alert alert-success mem text-center'>".$stmt->rowCount().'Record Updated</div>';
                redirectHome($theMsg);
            }else{
                $theMsg ="<div class='alert alert-danger mem  text-center'>This ID is Not Exist</div>";
                redirectHome($theMsg);
            }
            echo"</div>";

        } 
                    echo"</div>";

 include "includes/tempalets/footer.php";
    }else{
        header('location:index.php');
        exit();
    }