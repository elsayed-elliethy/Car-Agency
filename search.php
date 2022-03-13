<?php 
ob_start();
session_start();
include "connect.php";
include "includes/tempalets/header.php"; 
include "includes/functions/functions.php";
include "includes/tempalets/Navbar.php";
?>
   
   <div class="container">

<?php

$q = $_GET['q'];


$q1 = $_GET['q1'];
if($q1 == 'New Car'){$q1 = 1;}
if($q1 == 'Used Car'){$q1 = 2;}
if($q1 == 'Rent Car'){$q1 = 3;}
if($q1 == 'All Status'){$q1 = '';}

    if (isset($_GET['q']) && isset($_GET['q1'])){
        $make = $_GET['q'];
        $category = $_GET['q1'];
        echo "<h1 class='text-center mem'>" . $make . "</h1>";
        echo'<div class="row">';            

        $makeItems = getAllFroms("*", "items", "WHERE Brand like '%$q%'","And cat_ID like '%$q1%' ", "Item_ID");

        foreach ($makeItems as $item){
            
            echo '<div class="col-sm-6 col-lg-3">';
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
        echo '</div>';


    
        if($make == 'All Brands'){
            header('location: allcat.php');
            exit();
        }
    }
    echo '</div>';

    




?>










</div>


<?php  include "includes/tempalets/footer.php";

    ob_end_flush();
?>