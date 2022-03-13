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
        if ( $do == 'Manage') {    //Manage Page // 
           
            $stmt=$con->prepare("SELECT 
                                            comments.*,items.Name AS Item_Name,users.username AS Member
                                        FROM
                                             comments 
                                        INNER JOIN 
                                            items
                                        ON 
                                            items.Item_ID= comments.item_id
                                        INNER JOIN 
                                            users
                                        ON
                                            users.UserID = comments.user_id
                                        ORDER BY c_id DESC ");
            //Execute The State
            $stmt->execute();
            //Assign To Variable
            $rows=$stmt->fetchAll(); 
            
                if(! empty ($rows)){

                
             
        ?> 
        <h1 class="text-center mem" > Manage Comments</h1>
        <div class="container ">  
            <div class ="table-responsive">
            <table class="main-table table table-bordered text-center ">
                <tr>
                    <td>ID</td>
                    <td>Comment</td>
                    <td>Car Name</td>
                    <td>User Name</td>
                    <td>Added Date</td>
                    <td>Control</td>
                </tr>
                <?php
                    foreach($rows as $row){
                        echo"<tr>";
                            echo"<td>".$row['c_id']."</td>";
                            
                            echo"<td>".$row['comment']."</td>";
                            echo"<td>".$row['Item_Name']."</td>";
                            echo"<td>".$row['Member']."</td>";
                            echo"<td>".$row['comment_date']."</td>";
                            echo"<td>
                                <a href='comments.php?do=Edit&comid=".$row['c_id']."' class='btn btn-success btn-edit-delete-active'><i class='fa fa-edit'></i> Edit</a>
                                <a href='comments.php?do=Delete&comid=".$row['c_id']."' class='btn btn-danger confirm btn-edit-delete-active'><i class='fa fa-close'></i> Delete</a>";
                                 if ($row['status']==0){

                                     echo "<a href='comments.php?do=Approve&comid=".$row['c_id']."' class='btn btn-info confirm activate btn-edit-delete-active'><i class='fa fa-magic'></i> Approve</a>";

                                 }
                                echo "</td>";
                            echo"</tr>";
                    }
                ?>
            

            </table>
        </div>          
    </div>
                <?php }else{

                    echo '<div class="container">';
                    echo '<div class="nice-message">There\'s No Comments To Show</div> ';
                    echo '</div>'; 
                    
                }?>
    
    <?php
     }elseif ( $do == 'Edit' ) { //Edit Page
            
            //if(isset($_GET['userID']) && is_numeric($_GET['userID'])){       //لو فيه رجويست جيه ف الرابط يوزر اي دي وهل كان رقم 
                    //echo intval($_GET['userID'] ) ;                      //integer value
           // }else{
             //   echo 0; 
           // }
                   //دي اختصار للاف اللي فوق بحيث؟ تعني الصح وال: تعني الالس
                   $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
                   //استعلام:statment
                    $stmt=$con->prepare("SELECT * FROM  comments WHERE c_id =?  LIMIT  1");

                    $stmt ->execute(array($comid));

                    $row=$stmt->fetch(); //fetch data 

                    $count=$stmt->rowCount(); //count 
        if($count >0){ ?>
        <h1 class="text-center mem" > Edit Comment</h1>
        
        <div class="container edit">
            <form class="form-horizontal" action="?do=Update" method="POST">
                <input type="hidden" name="comid"  value="<?php echo $comid ?>">
            <!-- start comment field-->
            <div class="form-group">
                <label class="col-sm-2 control-label" >Comment</label>
                <div class=" col-sm-7">
                <textarea class="form-control" name="comment"><?php echo $row['comment']?></textarea>

                </div>
            </div>
            <!--end comment Field-->
           
            
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
             echo "<h1 class='text-center mem'>Update Comment</h>"."<br>";
             echo "<div class='container'>";
             if($_SERVER['REQUEST_METHOD']=='POST'){
                    //get variable from the form
                    $comid   = $_POST['comid'];
                    $comment = $_POST['comment'];
                      
                    $stmt=$con -> prepare("UPDATE comments SET comment = ? WHERE c_id =?");

                    $stmt->execute(array($comment,$comid));

                    //echo success message
                   $theMsg=  "<div class='alert alert-success'>" . $stmt->rowCount().'Record Updated</div>';
                    redirectHome($theMsg,'back');
                
    
                //update the data with info

             }else{
                $theMsg= "<div class alert alert-danger>Sorry You Cant Browse This Page Directly</div>";
                redirectHome($theMsg);
                }


             echo "</div>";
        }elseif($do=='Delete'){

            //Delete Comment Page
            echo "<h1 class='text-center mem'>Delete Comment</h>"."<br>";
            echo "<div class='container'>";
            $comid=isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid'] ) : 0;
            //استعلام:statment
            $stmt=$con->prepare("SELECT * FROM  comments WHERE c_id =? ");
            $stmt ->execute(array($comid));
            $count=$stmt->rowCount(); //count 
            if($stmt->rowCount()>0){ 
                $stmt=$con->prepare("DELETE FROM comments WHERE c_id=:zuser");
                $stmt->bindparam(":zuser",$comid); //bind parameter بتربط بين القيمه اللي ف الريجويست واللي موجوده ف الداتا
                $stmt->execute();
                $theMsg = "<div class='alert alert-success mem text-center'>".$stmt->rowCount().'Record Delete</div>';
                redirectHome($theMsg,'back');
            }else{
                $theMsg ="<div class='alert alert-danger mem  text-center'>This ID is Not Exist</div>";
                redirectHome($theMsg);
            }
            echo"</div>";

        }elseif($do=='Approve'){
            //Activate Member Page
            echo "<h1 class='text-center mem'>Approve Comment</h>"."<br>";
            echo "<div class='container'>";
            $comid=isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid'] ) : 0;
            //استعلام:statment
            $stmt=$con->prepare("SELECT * FROM  comments WHERE c_id =?  LIMIT  1");
            $stmt ->execute(array($comid));
            $count=$stmt->rowCount(); //count 
            if($stmt->rowCount()>0){ 
                $stmt=$con->prepare("UPDATE  comments SET status=1 WHERE c_id=? ");
                $stmt->execute(array($comid));
                $theMsg = "<div class='alert alert-success mem text-center'>".$stmt->rowCount().'Record Updated</div>';
                redirectHome($theMsg,'back');
            }else{
                $theMsg ="<div class='alert alert-danger mem  text-center'>This ID is Not Exist</div>";
                redirectHome($theMsg,'back');
            }
            echo"</div>";

        } 
                    echo"</div>";

 include "includes/tempalets/footer.php";
    }else{
        header('location:index.php');
        exit();
    }