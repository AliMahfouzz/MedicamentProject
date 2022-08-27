<div class="main-nav d-none d-lg-block">
  <nav class="site-navigation text-right text-md-center" role="navigation">
    <ul class="site-menu js-clone-nav d-none d-lg-block">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="addproduct.php">Add Products</a></li>
      <li><a href="viewproducts.php">View All Products</a></li>
      <li><a href="viewproductsorders.php">View All Orders</a></li>
      <li class="has-children">
        <a href="#"><?php echo $_SESSION['username'] ?></a>
        <ul class="dropdown">
          <!-- <li><a href="#">Drugs</a></li> -->
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </li>
      <!-- <li><a href="#">About</a></li>
                <li><a href="contact.php">Contact</a></li> -->
    </ul>
  </nav>
</div>