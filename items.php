<?php 
ob_start();
SESSION_start();

include "connect.php";
include "includes/tempalets/header.php"; 

include "includes/functions/functions.php";
include "includes/tempalets/Navbar.php";

$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
//استعلام:statment
 $stmt=$con->prepare("SELECT items.*, 
                        categories.Name AS Category_Name,
                      
                        users.username FROM items
                        INNER JOIN categories ON categories.ID=items.Cat_ID 
                        INNER JOIN users ON users.userID=items.Member_ID
                        WHERE Item_ID =? 
                        AND Approve = 1");

 $stmt ->execute(array($itemid));
 $count = $stmt -> rowCount();
if($count>0){
 $item=$stmt->fetch(); //fetch data 

?>
    <div class="title4-img"> &nbsp; 

<h2 class="  alert alert-light  the-success text-center"><?php echo $item['Name']?></h2>
</div>
<div class="container  ">
    <div class="row ">
        <div class="col-lg-5 item-img">
            <!-- Container for the image gallery -->


<!-- Full-width images with number text -->

<div class="mySlides">
  <div class="numbertext">1 / 3</div>
  <?php
    $img8 = explode(',',$item['img']);
    echo "<img style='width:100%' class='img-responsive img-thumbnail center-block' src='admin/uploads/images/" . $img8[0] . "' alt=''/>";


    ?>
</div>

<div class="mySlides">
  <div class="numbertext">2 / 3</div>
  <?php
            
    echo "<img style='width:100%' class='img-responsive img-thumbnail center-block' src='admin/uploads/images/" . $img8[1] . "' alt=''/>";


    ?>
</div>

<div class="mySlides">
  <div class="numbertext">3 / 3</div>
  <?php
            
            echo "<img style='width:100%' class='img-responsive img-thumbnail center-block' src='admin/uploads/images/" . $img8[2] . "' alt=''/>";
        
        
            ?>
</div>



<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

<!-- Image text -->
<div class="caption-container">
  <p id="caption"></p>
</div>

<!-- Thumbnail images -->
<!--<div class="row">
  <div class="column">
    <img class="demo cursor" style="width:100%" onclick="currentSlide(1)" alt="The Woods">
  </div>
  <div class="column">
    <img class="demo cursor" src="img_5terre.jpg" style="width:100%" onclick="currentSlide(2)" alt="Cinque Terre">
  </div>
  <div class="column">
    <img class="demo cursor" src="img_mountains.jpg" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
  </div>
  
</div>-->
<div class="row img-columns">
  <div class="column">
  <?php
            
            echo "<img  class='demo cursor' style='width:100%' onclick='currentSlide(1)' alt='The First Side' src='admin/uploads/images/" . $img8[0] . "' />";
        
        
            ?>  </div>
  <div class="column">
  <?php
            
            echo "<img class='demo cursor' style='width:100%' onclick='currentSlide(2)' alt='The Second Side'  src='admin/uploads/images/" . $img8[1] . "' alt=''/>";
        
        
            ?>  </div>
  <div class="column">
  <?php
            
            echo "<img  class='demo cursor' style='width:100%' onclick='currentSlide(3)' alt='The Third Side'  src='admin/uploads/images/" . $img8[2] . "' alt=''/>";
        
        
            ?>  </div>
  
</div>

        </div>
        <div class="col-lg-7 item-infor">
            <p><?php echo $item['Description'] ?></p>
            <ul class="list-unstyled">
                <li><i class="fa fa-calendar fa-fw"></i><div><span>Added Date  </span> : &nbsp; <?php echo $item['Add_Data'] ?></div></li>
                <li><i class="fa fa-money fa-fw"></i><div><span> Price  </span> : &nbsp; <?php echo  '$'.$item['Price'] ?></div></li>
                <li><i class="fa fa-car fa-fw"></i><div><span>Brand </span> : &nbsp; <?php echo $item['Brand']; ?></div></li>
                <li><i class="fas fa-brush fa-fw"></i><div><span>Color </span> : &nbsp; <?php echo $item['Color']; ?></div></li>
                <li><i class="fa fa-calendar fa-fw"></i><div><span>First Registration</span> : &nbsp; <?php echo $item['First registration'] ?></div></li>
                <li><i class="fa fa-money fa-fw"></i><div><span> Fuel  </span> : &nbsp; <?php echo $item['Fuel'] ?></div></li>
                <li><i class="fa fa-car fa-fw"></i><div><span>Gearbox </span> : &nbsp; <?php echo $item['Gearbox']; ?></div></li>
                <li><i class="fa fa-building fa-fw"></i><div><span> Made in  </span> : &nbsp; <?php echo $item['Country_Made'] ?></div></li>
                <li><i class="fa fa-tags fa-fw"></i><div><span> Categories  </span>:  &nbsp; <?php echo $item['Category_Name'] ?></div></li>
                <li><i class="fa fa-user fa-fw"></i><div><span> Seller    </span>  : &nbsp;  <?php echo $item['username'] ?></div></li>
                <li><i class="fa fa-tags fa-fw"></i><div><span> Tags </span>:  <?php 
                        $allTags = explode(",",$item['tags']);
                        foreach ($allTags as $tag){
                            $tag1 = str_replace(' ', '', $tag);
                            $lowertag = strtolower($tag);
                            if (!empty($tag)){
                                echo "<a href='tags.php?name={$lowertag} ' class='btn btn-light' style='margin-right:10px'>" . $tag1 . '</a>';
                            }
                            
                        }
                    
                    ?></div></li>

            </ul>
        </div>
    </div>
</div>


<!--java script-->
<script>
var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

</script>
</div>
<div class="container">

<hr class="custom-hr">
<?php if (isset($_SESSION['user'])){?>
    <div class="col-lg-onset-3">
      <div class="add-comment">
      <h3 class=" text-center"> Your Comment </h3>
      <form action="<?php echo $_SERVER['PHP_SELF'].'?itemid='.$item['Item_ID']?>" method="POST">
        <textarea class="form-control" name="comment"></textarea>
        <input class="btn btn-info" type="submit" value="Add Your Comment">
      </form>
    <?php
      if ($_SERVER['REQUEST_METHOD']=='POST'){
          $comment  =FILTER_VAR($_POST['comment'],FILTER_SANITIZE_STRING);
          $userid   =$_SESSION['uid'];
          $itemid   =$item['Item_ID'];
          if(! empty($comment)){

              $stmt = $con->prepare ("INSERT INTO
                  comments(comment,status ,comment_date,item_id,user_id)
                  VALUES(:zcomment,1,NOW(),:zitemid,:zuserid)");
              $stmt->execute(array(
                  'zcomment'=>$comment,
                  'zitemid'=>$itemid,
                  'zuserid'=> $userid

                ));
                if($stmt){
                  echo'<div  class="alert alert-info text-center ">Comment Added</div>';
                }
           }
      } 
      ?>
      </div>
</div>
<?php } else{?>
  <div class="col-lg-onset-3">
  <div class="add-comment">
  <h3 class=" text-center"> Your Comment </h3>
  <form>
    <textarea class="form-control"></textarea>
  </form>
  </div>
</div>
<div class="alert alert-info text-center"><a  href="login.php" class="btn btn-info btn-block">Login To Add Comment </a></div>
<?php } ?>
</div>
<div class="container">

<?php 

      $stmt=$con->prepare("SELECT 
                            comments.*,users.username AS member ,users.Avater AS avater 
                            FROM
                              comments 
                           
                    
                            INNER JOIN 
                              users
                            ON

                              users.UserID = comments.user_id
                            WHERE status =1 AND Item_ID=? 
                            ORDER BY c_id DESC ");
//Execute The State
      $stmt->execute(array($item['Item_ID']));
//Assign To Variable
      $comments=$stmt->fetchAll(); 
      ?>

<?php
        echo'<div class="comment-scroll">';

      foreach($comments as $comment){
        echo '<hr class="custom-hr">';

        echo'<div class="container row  comment-box">';
        echo '<div class="col-lg-2 col-sm-3 ">';

       
          if(empty($comment['avater'])){
            echo "<img src='islam.jpg' class='img-thumbnail member-img'>";
        }else{
            echo "<img src='admin/uploads/avater/".$comment['avater']."' class='img-thumbnail member-img'>";
        }
        echo '<br>';
        echo'<span class="member-n">'.$comment["member"].'<span>';

        echo'</div>';
        echo '<div class="col-lg-9 col-sm-9 member-c">'. $comment["comment"].'<span>'.$comment['comment_date'].'</span></div>';
        echo'</div>';

      
      
    }
    echo'</div>';


?>
    
</div>







<?php
}else{
    echo '<div class="alert alert-danger the-error text-center ">There\'s No Such ID -OR- This Item Is Waiting Approval</div>';
}
?>
<?php
 include "includes/tempalets/footer.php";
 ob_end_flush();
 ?>
 
