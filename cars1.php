<?php  
    ob_start();
    session_start();
    $pageTitle = 'Show Car';
    include "init1.php";
    
    $carid = isset($_GET['carid']) && is_numeric($_GET['carid']) ? intval($_GET['carid']) : 0;//لازم الايدى يكون رقم مينفعش يكون حروف لو رقم اطبعهولى ولو اى حاجة غير رقم اطبعى 0
            
    $stmt = $con->prepare("SELECT cars.*, categories.Name AS cat_name, users.fullName  FROM cars
                            INNER JOIN categories ON categories.ID = cars.cat_ID
                            INNER JOIN users ON users.userID = cars.user_ID 
                            WHERE car_ID = ?
                            AND Approve = 1");
    $stmt->execute(array($carid));
    
    $count = $stmt->rowCount();//موجود ف كام صف

    if($count > 0){ 

        $car = $stmt->fetch();
        ////////////////////
       
        
    

    ?>
    <style>
         .active{
            border: 1.5px solid #2c3e50!important;
        }
            
    </style>


<h1 class="text-center"><?php echo $car['Make']; ?></h1>
<div class="container">
    <div class="row">
        <div class="col-md-5">
        
        <div class="mySlides">
        <div class="numbertext">1 / 3</div>
            <div class="img-slide"> 
                <?php
                    $img8 = explode(',',$car['img']);
                    echo "<img style='max-height:100%;width:100%' class='img-responsive img-thumbnail center-block' src='admin/uploads/images2/" . $img8[0] . "' alt=''/>";


                ?>
            </div> 
        </div>

        <div class="mySlides">
        <div class="numbertext">2 / 3</div>
            <div class="img-slide"> 
                <?php
                        
                    echo "<img style='max-height:100%;width:100%' class='img-responsive img-thumbnail center-block' src='admin/uploads/images2/" . $img8[1] . "' alt=''/>";


                ?>
            </div>
        </div>

        <div class="mySlides">
        <div class="numbertext">3 / 3</div>
            <div class="img-slide"> 
                <?php
                        
                    echo "<img style='max-height:100%;width:100%' class='img-responsive img-thumbnail center-block' src='admin/uploads/images2/" . $img8[2] . "' alt=''/>";
            
            
                ?>
            </div>
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
        <div class="row row-images">
        <div class="column">
        <?php
                    
                    echo "<img  class='demo cursor' style='width:100%' onclick='currentSlide(1)'  alt='The first side' src='admin/uploads/images2/" . $img8[0] . "' />";
                
                
                    ?>  </div>
        <div class="column">
        <?php
                    
                    echo "<img class='demo cursor' style='width:100%' onclick='currentSlide(2)' alt='The second side'  src='admin/uploads/images2/" . $img8[1] . "' alt=''/>";
                
                
                    ?>  </div>
        <div class="column">
        <?php
                    
                    echo "<img  class='demo cursor' style='width:100%' onclick='currentSlide(3)' alt='The thirds side'  src='admin/uploads/images2/" . $img8[2] . "' alt=''/>";
                
                
                    ?>  </div>
        
        </div>
    </div>


        <div class="col-md-7 item-info">
            <!--<h2><php echo $car['Make'];    ?></h2>-->
            
            <ul class="list-unstyled">
                <li>
                    <i class="fa fa-car fa-fw"></i>
                    <span>Model</span>: <?php echo $car['Model'];    ?>
                </li>
                <li>
                    <i class="fa fa-money fa-fw"></i>
                    <span>Price</span> : <?php echo "$" . $car['Price'];    ?>
                </li>
                <li>
                    <i class="fa fa-paint-brush" aria-hidden="true"></i>
                    <span>Color</span> : 
                    <?php 
                        if($car['Color'] == 1){echo 'Black';}
                        if($car['Color'] == 2){echo 'Blue';}
                        if($car['Color'] == 3){echo 'Red';}
                        if($car['Color'] == 4){echo 'White';}
                        if($car['Color'] == 5){echo 'Silver';}
                        if($car['Color'] == 6){echo 'Gray';}
                    ?>
                </li>
                <li>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span>First registration</span> : <?php echo $car['First registration'];    ?>
                </li>
                <li>
                    <i class="fa fa-car fa-fw"></i>
                    <span>Status</span> : 
                    <?php  
                        if($car['Status'] == 1){echo 'New Vechile';};  
                        if($car['Status'] == 2){echo 'Used Vechile';};  

                     ?>
                </li>
                <li>
                    <i class="fa fa-car fa-fw"></i>
                    <span>Fuel</span> : 
                    <?php 
                        if($car['Fuel'] == 1){echo 'Diesel';}
                        if($car['Fuel'] == 2){echo 'Electric';}
                        if($car['Fuel'] == 3){echo 'Gas';}
                        if($car['Fuel'] == 4){echo 'Petrol';}
                    
                    ?>
                </li>
                <li>
                    <i class="fa fa-car fa-fw"></i>
                    <span>Gearbox</span> : 
                    <?php    
                        if($car['Gearbox'] == 1){echo 'Automatic';}
                        if($car['Gearbox'] == 2){echo 'Manual';}
                        if($car['Gearbox'] == 3){echo 'Semi-Automatic';}
                    ?>
                </li>
                <li>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span>Add_Date</span> : <?php echo $car['Add_Date'];    ?>
                </li>
                <li>
                    <i class="fa fa-tag fa-fw"></i>
                    <span>Category</span> : <a href="categories1.php?pageid=<?php  echo $car['cat_ID'] ?>"> <?php echo $car['cat_name'];    ?></a>
                </li>
                <li>
                    <i class="fa fa-user fa-fw"></i>
                    <span>Seller</span> :  <?php echo $car['fullName'];  if($car['cat_name'] == 'Rent Cars'){ echo ' <a href="contact-us.php">
                        <span class="btn btn-default show-car-btn">Contact Us To Rent </span>
                    </a>';}else{ echo '<a href="contact-us.php">
                        <span class="btn btn-default show-car-btn">Contact Us To Buy </span>
                    </a>';} ?>
                </li>
                <li class="tags-items">
                    <i class="fa fa-tag fa-fw"></i>
                    <span >Tags</span> : 
                    <?php 
                        $allTags = explode(",",$car['tags']);
                        foreach ($allTags as $tag){
                            $tag1 = str_replace(' ', '', $tag);
                            $lowertag = strtolower($tag);
                            if (!empty($tag)){
                                echo "<a href='tags.php?name={$lowertag}'>" . $tag1 . '</a>';
                            }
                            
                        }
                    
                    ?>
                </li>
            </ul>
        </div>
    </div>
    
</div>

<!--java script-->
<script>


</script>



 <?php
    } else{
        echo "<div class='alert alert-danger'> there is no such id or this item is waiting approval </div>";
    }
 
    include $tpl . 'footer1.php';
    ob_end_flush();
 ?>