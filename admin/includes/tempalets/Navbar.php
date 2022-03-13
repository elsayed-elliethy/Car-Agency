<nav class="navbar navbar-expand-lg navbar-light bg-light">

<a class="navbar-brand" href="dashboard.php">Home</a>

  
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="app-nav">
    <ul class="navbar-nav mr-auto">
        
    
 
    
    
      <li class="nav-item">
        <a class="nav-link" href="Categories.php">Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="items.php">Cars</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="member.php">Members</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="comments.php">Comments</a>
      </li>
  
      
     
    
 

      </ul>
    <div class="nav-item dropdown ">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" >
        <i class="fa fa-user"></i> <?php echo $_SESSION['username']?>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="../index.php">Visit Shop</a>
        <a class="dropdown-item" href="logout.php">Logout</a>
    </div>
</div>
  </div>
</nav>