<?php 
ob_start();
SESSION_start();

include "connect.php";
include "includes/tempalets/header.php"; 
include "includes/functions/functions.php";
//Number Of Latest cars
$numItems=8; 
$latestItems=  getLatest("*","items","Item_ID",$numItems); //Latest Items Array 


?>


<!--start-navbar-->

<!--<div class="upper-bar">
  <div class='container'>
      <a href="login.php ">
          <span ></span>
      </a>
  </div>
</div>-->
<div class="the-success33">
<nav class="navbar navbar-expand-lg navbar-light bg-light">

<!--<form class="form-inline d-flex justify-content-center md-form form-sm  wrap" action='' method="POST">
<i class="fa fa-search the-success35"></i>

  <input class="form-control   the-success the-success34" type="text" name="brand" placeholder=" What are you looking for ? "

    aria-label="Search">
    
    
</form> -->
&nbsp; &nbsp; &nbsp; 
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;

<form class="form-inline d-flex justify-content-center md-form form-sm searchBox " action='' method="POST">
<div class="searchBox">

<input class="searchInput"type="text" name="brand" placeholder="Search...">
<button class="searchButton" href="#">
    <i class="fa fa-search">
    </i>
</button>
</div>
</form>


&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
&nbsp; &nbsp; &nbsp;

  
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse navbar-right" id="app-nav">
    <ul class="navbar-nav mr-auto">
    &nbsp;&nbsp;
    <li class="main-links1"><a href="allcat.php" class="navbar-brand">All Cars</a></li>
    <?php
        foreach(getCat()as $cat){
            echo 
            '<li class="main-links1"> 
            <a href="categories.php?pageid=' .$cat['ID']. '&pagename='.$cat['Name'].'" class="navbar-brand" >
            ' .$cat['Name']. '</a>
            </li>';
        } 

    ?> 
        <li class="main-links1"><a href="newad.php" class="navbar-brand">Sell YourCar</a></li>

    </ul>
    <div class="nav-item dropdown ">

      <?php
          if(isset ($_SESSION['user'])){?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
         data-toggle="dropdown" aria-haspopup="true" >

        <i class='fa fa-user'></i> <?php echo $_SESSION['user'] ;?></a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="profile.php">My Profile</a>
        
       <!-- <a class="dropdown-item" href="member.php?do=Edit&userID=<?php //echo $_SESSION['ID'] ?>">Edit Profile</a>-->
        
      
        <a class="dropdown-item" href="newad.php">New Car</a>
        <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
            <?php
              $userStatus= checkUserStatus($_SESSION['user'] );
              if($userStatus==1){
                  // user is not active
              }
              ?> 
              
              <?php
                }else{
              ?> 
            <a class="nav-link " href="login.php"  >
            <i class='fa fa-user'></i> Login 
            </a>
        <?php } ?>
    </div>
  </div>
</nav>
</div>

<!--end-navbar-->
<!-- slider  -->
<div id="carouselExampleFade" class="carousel slide carousel-fade slider-index1" data-ride="carousel">
      
      <div class="carousel-inner1">
        
        
        <div class="carousel-item active slider-index1">
          <img src="image/slid11.jpg" class="d-block w-100" data-ride="carousel">
          <h2 class="h21">Find Your Dream Car ... !</h2>
          <p>It is easy to get a dream car, but not at the right price,
             but we have what you want from the cars and the right prices</p>
     
        </div>
        <div class="carousel-item slider-index1">
          <img src="image/slid33.jpg" class="d-block w-100" data-ride="carousel">
          <h2 class="h21">Own a Car with Low Price </h2>
          <p>Own your new car now, have a look at our cars and choose your 
            favorite type , with the right price. Contact us when you need help.</p>
         
        </div>
        <div class="carousel-item slider-index1">
          <img src="image/slid222.jpg" class="d-block w-100" data-ride="carousel">
          <h2 class="h21"> Rent a Car with Low Price </h2>

          <p>Take a look at our cars and choose your favorite type for 
            rent at the right price. contact us when you need help.</p>
         
        </div>
        
      <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    </div>
    <!-- end slider -->

<?php


if(isset($_POST['brand'])){
    



$brand = $_POST['brand'];
$stmt =$con->prepare("SELECT * FROM items WHERE Brand = '$brand'
 OR Country_Made='$brand' 
 OR Description like  '%$brand%'  
 OR Color ='$brand'
 
 
  ");
$stmt->execute();


while($items=$stmt->fetchAll())
{
  echo'<div class="alert  text-center the-success4    "><h4>Search results  for  "<span> '.$_POST['brand'].' </span>" </h4></div>';

?>

 <div class="container">
<div class='row'>
    <?php
        foreach($items as $item){
          
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
        }
        
    ?>

    </div>
</div>
<?php
if(   empty($item)){
  echo'<div class="alert  text-center the-success4    "><h4>SEARCH RESULTS FOR "<span> '.$_POST['brand'].' </span>" </h4></div>';

  echo'<div class="alert  text-center the-success3    "><h2>Your search returns no results.</h2></div>';
}

}else{

    ?>
    

    <div class="brands">
    <a href="tags.php?name=bmw"><img style="width:7%;margin:.7%" src="image\brands\bmw.png"></a>
    <a href="tags.php?name=ford"><img style="width:7%;margin:.7%" src="image\brands\ford.png"></a>
    <a href="tags.php?name=nissan"><img style="width:8.5%;margin:.6%" src="image\brands\nissan.png"></a>
    <a href="tags.php?name=jeep"><img style="width:7%;margin:.6%" src="image\brands\jeep.png"></a>
    <a href="tags.php?name=ferrari"><img style="width:7%;margin:.6%" src="image\brands\ferrari.png"></a>
    <a href="tags.php?name=Chevrolet"><img style="width:7%;margin:.7%" src="image\brands\chevrolet.png"></a>
    <a href="tags.php?name=lamborghini"><img style="width:7.5%;margin:.6%" src="image\brands\lamborghini.png"></a>
    <a href="tags.php?name=hyundai"><img style="width:7%;margin:.7%" src="image\brands\hyundai.png"></a>
    <a href="tags.php?name=fiat"><img style="width:7.5%;margin:.6%" src="image\brands\fiat.png"></a>
    <a href="tags.php?name=kia"><img style="width:8%;margin:.6%" src="image\brands\kia.png"></a>
    <a href="tags.php?name=mercedes"><img style="width:7%;margin:.7%" src="image\brands\mercedes.png"></a>


    </div>
    <div class=" advanced ">
    <div class="container  "><h4 class="   alert-light  text-center the-success33 "> Vehicle Search </h4>
    <form class="form-search" action="search.php" method="GET">
    <!--<input type="hidden" name="make" value="<php echo $make ; ?>" />--> 
      <!--<input type="text" class="form-control" placeholder="Search" name="q">-->
      <div class=row>
        <div class=" search-select col-lg-5  ">
            
            <select name="q">
                <option class="text-center">All Brands</option>
                <?php
                    $stmt = $con->prepare("SELECT DISTINCT Brand FROM items ORDER BY  Brand");
                    $stmt->execute();
                    $cars = $stmt->fetchAll();
                    $count = $stmt->rowCount();
                    
                    foreach($cars as $car){
                        
                        echo "<option class='text-center' value='" . $car['Brand'] . "'";
                        
                        echo ">" . $car['Brand'] . "</option>";

                    }
                ?>
            </select>
            </div>
            <div class=" search-select col-lg-5 ">

            <select name="q1">
                <option class="text-center">All Status</option>
                <option class="text-center">New Car</option>
                <option class="text-center">Used Car</option>
                <option class="text-center">Rent Car</option>
                
 
            
            </select>

            </div>
          
        
      
            <div class=" col-lg-1 ">

      <button type="submit" >Search</button>
      </div> 
      </div> 
    </form>
    </div>
    </div>

  


  <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <i class="fas fa-car "></i> - New Additions !
                </div>
                <div class="panel-body ">
                <div class="container">
<div class='row'>
               

                    <?php 
                        if(! empty ($latestItems)) {           
                        foreach ($latestItems as $item){
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
                    }else{
                        echo 'There\'s No cars To Show  ';
                        echo'<div> <a href="items.php?do=Add" class="btn btn-primary "><i class="fa fa-plus" ></i> Add item </a></div>'; 

                    }
                    ?>
                  
            
                
                 </div>

                </div>
                </div>
                </div>
                <div class="your-car">
                  <img src="image/hands-car.jpg" class="your-car-img">
                  <img src="logo1.jpg" class="your-car-logo">
                  <span>is in your hands</span>
                </div>




                <div class=container>
                <div class="row  about-cat about-cat2">
                     <div class="col-lg-5  img-index">
                     <a href="categories.php?pageid=1&pagename=NewCar"><img src="image/new.jpg"></a>
                     </div>
                     <div class="col-lg-7 text-center cat-caption">
                     <h2 class="mem">NewCar</h2>
                     <p>We own many new cars available to the site by the admin and members</p>
                     <a href="categories.php?pageid=1&pagename=NewCar" class="click">Click Here</a>
                     </div>
                     </div>

 <hr>           
                    <div class="row  about-cat">
                     <div class="col-lg-7 text-center cat-caption">
                     <h2 class="mem">ForRent</h2>
                     <p >We own many cars for rent available to the site by the admin and members</p>
                     <a href="categories.php?pageid=3&pagename=ForRent" class="click">Click Here</a>
                     </div>
                     <div class="col-lg-5 img-index">
                     <a href="categories.php?pageid=3&pagename=ForRent"><img src="image/for rent.jpg"></a>
                     </div>
                     </div>

  <hr> 
                     <div class="row  about-cat">
                     <div class="col-lg-5  img-index">
                     <a href="categories.php?pageid=2&pagename=UsedCar"><img src="image/use.png"></a>
                     </div>
                     <div class="col-lg-7 text-center cat-caption">
                     <h2 class="mem">UsedCar</h2>
                     <p>We own many used cars available to the site by the admin and members</p>
                     <a href="categories.php?pageid=2&pagename=UsedCar" class="click">Click Here</a>
                     </div>
                     </div>

  <hr> 

                     <div class="row  about-cat about-cat1">
                     <div class="col-lg-7 text-center cat-caption">
                     <h2 class="mem">Sell Your Car</h2>
                     <p>Sell ​​your car through this link, note: shoot the car 3 
                       photos with different destinations.</p>
                     <a href="newad.php" class="click">Click Here</a>
                     </div>
                     <div class="col-lg-5 img-index">
                     <a href="newad.php"><img src="image/sale.jpg"></a>
                     </div>
                     </div>
                     
                     <div class="index-contact1">
                       <img src="image/banner-contact-us.png">
                       <a href="contact-us.php" class="click">Click Here</a>
                     </div>
                  </div>

                </div>




<?php
}


?>

<?php 
    include "includes/tempalets/footer.php";
    ob_end_flush();
?>
