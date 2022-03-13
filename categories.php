<?php 
SESSION_start();
//if(isset ($_SESSION['username'])){
   // header('location:dashboard.php');
//}
include "connect.php";
include "includes/tempalets/header.php"; 
include "includes/functions/functions.php";
include "includes/tempalets/Navbar.php";



?>

    <div class="title1-img"> &nbsp; 
    <h2 class=" the-success text-center alert alert-light"><?php echo $_GET['pagename']?></h2>
    </div>
    <div class="container">
<div class='row'>
    <?php
        foreach(getItems('Cat_ID',$_GET['pageid']) as $item){
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
            echo'</div>';


        }
    ?>
</div>
</div>


<?php include "includes/tempalets/footer.php";?>
