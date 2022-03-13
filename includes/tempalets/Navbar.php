<!--<div class="upper-bar">
  <div class='container'>
      <a href="login.php ">
          <span ></span>
      </a>
  </div>
</div>-->
<div class="the-success33">
<nav class="navbar navbar-expand-lg navbar-light bg-light">

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;

 
 



  
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse navbar-right" id="app-nav">
    <ul class="navbar-nav mr-auto">
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
     <li class="main-links1"><a href="newad.php" class="navbar-brand">Sell Your Car</a></li>
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
