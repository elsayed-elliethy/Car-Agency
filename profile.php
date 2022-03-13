<?php 
SESSION_start();

include "connect.php";

include "includes/functions/functions.php";
include "includes/tempalets/header.php"; 
include "includes/tempalets/Navbar.php";

$sessionUser = ' ';
if(isset($_SESSION['user'])){
    $sessionUser=$_SESSION['user'];
    $getUser=$con->prepare("SELECT * FROM users WHERE username=?");
    $getUser->execute(array($sessionUser));
    $info=$getUser->fetch();


?>

<div class="back-profile"> &nbsp; 

<h2 class=" text-center the-success alert alert-light my-profile"> My Profile  </h2>




        <div class="user-image col-lg-3 col-sm-4">
        <?php
            if(empty($info['avater'])){
                echo "<img src='islam.jpg' class='img-thumbnail profile-img'>";
            }else{
                echo "<img src='admin/uploads/avater/".$info['avater']."' class='img-thumbnail profile-img'>";
            }
        ?>
            
        </div>


<div class="information block" >
    <div class="container">
        <div class="panel-heading1">My Information</div>
        <div class="panel-body1">
            <ul class="list-unstyled">
                    <li><i class="fa fa-unlock-alt fa-fw"></i><span>Name</span> : &nbsp;<?php echo  $_SESSION['user'] ?></li>
                    <li><i class="fa fa-envelope-o fa-fw"></i><span>Email</span> : &nbsp;<?php echo  $info['Email'] ?></li>
                    <li><i class="fa fa-user fa-fw"></i><span>Fullname</span> : &nbsp;<?php echo  $info['Fullname'] ?></li>
                    <li><i class="fa fa-calendar fa-fw"></i><span>Register Date</span> : &nbsp;<?php echo  $info['Date'] ?></li>
                    <li><i class="fa fa-phone fa-fw"></i><span>Phone Number </span> : &nbsp;<?php echo  $info['phone'] ?></li>
                    <li class="edit-info"><a href='member1.php?do=Edit&userid=<?php echo $info['userID']?> ' class="btn btn-secondary edit-link" ><i class="fa fa-edit "></i> Edit Information</a></li>
            </ul>

    </div>   
    </div>
    </div>
<div class="information block" >
    <div class="container">
        <div class="panel-heading1">My Cars</div>
        <div class="panel-body1">
        <div class='row'>
    <?php
    if(! empty(getItems('Member_ID',$info['userID']))){
        foreach(getItems('Member_ID',$info['userID'],1) as $item){
            echo '<div class="col-sm-6 col-lg-3 ">';
            echo'<a href="items.php?itemid='.$item['Item_ID'] .'" class=""><div class="thumbnail item-info new-add-index">';
                echo '<span class="price-tag">$'.$item['Price'].'</span>';
                if (empty($item['img'])){
                    echo '<img src="img.jpg">';
                }else{
                    $img8 = explode(',',$item['img']);
                    echo"<img src='admin\uploads\images\\" . $img8[0] . " 'class=''>";
                }
                echo '<div class="caption text-center caption-index"  >';
                    echo '<h3>'.$item['Name'].'</h3>';
                    echo'<p>'.$item['Description'].'</p>';
                    //echo '<p class="date">'.$item['Add_Data'].'</p>';
                echo '</div>';
                echo'</a></div>';
                echo"<a href='items1.php?do=Edit&itemid=".$item['Item_ID']."' class='btn btn-success control-item'><i class='fa fa-edit'></i> Edit</a>
                <a href='items1.php?do=Delete&itemid=".$item['Item_ID']."' class='btn btn-danger confirm control-item'><i class='fa fa-close'></i> Delete</a>";
            echo'</div>';
        
          
           

            }
        }else{
            echo  "<div class='alert alert-danger the-error not-allow '>Sorry There's No Ads... <a href='newad.php' class='btn btn-success pull-right' >New Ad</a><div>";
        }
    ?>
</div>
    </div>   
    </div>
</div>
</div>
</div>





<!--<div class="information block" >
    <div class="container">
        <div class="panel-heading"> Latest Comments</div>
        <div class="panel-body">
           Test Comments
    </div>   
    </div>
</div>-->


<?php
}else{
    header ('location:login.php');
    exit;
}
 include "includes/tempalets/footer.php";?>
