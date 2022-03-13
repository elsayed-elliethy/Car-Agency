<?php 
    ob_start();
    session_start();
    $pageTitle = 'About Us';
    include "connect.php";
    include "includes/tempalets/header.php"; 
    include "includes/functions/functions.php";

    include "includes/languages/arbic.php";
    include 'includes/tempalets/Navbar.php'; 
    

    
    ?>
    <style>
            .active1{
            
                color:white!important;
                font-family:unset;

                
                
              
                
            }
            .active1 li{
 
    color: red;
    font-weight: bolder;
    /* font-size: 50px; */
    text-shadow: rgb(14, 56, 70) 3px 3px 3px;
    margin: 2% auto;
    font-family: unset;
    
            }
            
        </style>
    <div class="title2-img"> &nbsp; 
   <h2 class=" the-success text-center alert alert-light"> About Us </h2>
        </div >  
        
<h1 class="col-lg-5 welcome-about"> WELCOME TO <span>YOURCAR<span></h1>

<div class=" about-page">
    
    <div class="about-one">
  
    <div class="about-p">

    <a href="index.php">YourCar.com</a> 
    is a leading digital marketplace and solutions provider for the automotive
     industry that connects car shoppers with sellers. Launched in 2020 and headquartered in Egypt, 
     the Company empowers shoppers with the data, resources and digital tools needed to make informed 
     buying decisions and seamlessly connect with automotive retailers. In a rapidly changing market, <a href="index.php">
         YourCar.com</a> enables dealerships and OEMs with innovative technical solutions and data-driven intelligence
          to better reach and influence ready-to-buy shoppers, increase inventory turn and gain market share. In march 2020,
           <a href="index.php">YourCar.com</a> acquired Dealer Inspire®, an innovative technology company building
      solutions that future-proof dealerships with more efficient operations, a faster and easier car buying process,
       and connected digital experiences that sell and service more vehicles.
</div>
</div>

      <hr>  
    <div class="row">
    <?php 
        $do = '';

            if(isset($_GET['do'])){
                $do = $_GET['do'];
            } 
            ?>
         <ul class="text-center ul-about list-unstyled  ">
            
                
                <a href="?do=about1" <?php if($do=="about1") {echo "class='active1'";}   ?>><li><i class="fas fa-tasks"> </i> &nbsp;Leadership</li></a>
                    
                    
                

                
                    <a href="?do=about2"  <?php if($do=="about2") {echo "class='active1'";}   ?>><li><i class="fas fa-edit"> </i> &nbsp;Editorial</li></a>
                
                
                    <a href="?do=about3" <?php if($do=="about3") {echo "class='active1'";}   ?>><li><i class="fas fa-magic"> </i> &nbsp;Founders</li></a>
                
            
        </ul>

        <?php 
        $do = '';

            if(isset($_GET['do'])){
                $do = $_GET['do'];
            } 
            if($do == 'about1'){

                $users = getAllFrom("users","userID","where GroubID = 1");
              

                foreach($users as $user){
            
                    echo'<div class="about-lead ">';
               
                        echo '<div class="thumbnail1 item-box text-center ">';

                            echo "<div class='img-link1'>";
                            echo "<img class='img-responsive img-thumbnail center-block img-circle' src='admin/uploads/avater/" . $user['avater'] . "' alt=''/>";
                            //echo "<img class='img-responsive img-thumbnail center-block' src='admin/uploads/images/" . $item['Image'] . "' alt=''/>";
                        echo "</div>";
                        echo '</div>';
                        echo '<div class="caption1">';
                                echo "<h3 >"  . $user['Fullname']  . "</h3>";
                                echo '<p>' . $user['jop'] . '</p>';
                                

                        echo '</div>';
                        
                        echo '</div>';
                      
                    
                }
            }elseif($do == 'about2'){

                $users = getAllFrom("users","userID","where GroubID = 1");
                foreach($users as $user){
                    echo'<div class="about-lead ">';
               
                    echo '<div class="thumbnail1 item-box text-center ">';

                        echo "<div class='img-link1'>";
                        echo "<img class='img-responsive img-thumbnail center-block img-circle' src='admin/uploads/avater/" . $user['avater'] . "' alt=''/>";
                        //echo "<img class='img-responsive img-thumbnail center-block' src='admin/uploads/images/" . $item['Image'] . "' alt=''/>";
                    echo "</div>";
                    echo '</div>';
                    echo '<div class="caption1">';
                            echo "<h3 >"  . $user['Fullname']  . "</h3>";
                            echo '<p> Editor-in-Chief </p>';
                            

                    echo '</div>';
                    
                    echo '</div>';
                }
                
            }elseif($do == 'about3'){

                $users = getAllFrom("users","userID","where GroubID = 1");
                foreach($users as $user){
                    echo'<div class="about-lead ">';
               
                    echo '<div class="thumbnail1 item-box text-center ">';

                        echo "<div class='img-link1'>";
                        echo "<img class='img-responsive img-thumbnail center-block img-circle' src='admin/uploads/avater/" . $user['avater'] . "' alt=''/>";
                        //echo "<img class='img-responsive img-thumbnail center-block' src='admin/uploads/images/" . $item['Image'] . "' alt=''/>";
                    echo "</div>";
                    echo '</div>';
                    echo '<div class="caption1">';
                            echo "<h3 >"  . $user['Fullname']  . "</h3>";
                         
                            

                    echo '</div>';
                    
                    echo '</div>';
                }
            }
            ?>
    </div>

</div>






















<?php 
    include "includes/tempalets/footer.php";
    ob_end_flush();
?>
