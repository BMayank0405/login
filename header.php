<nav class="navbar navbar-default navbar-fixed-top" id="header">
 <div class="container">
   <div class="navbar-header">
     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"></button>

     <a class="navbar-brand c_brand" href="#myPage"><img class="img-responsive" src="images/logo.png" width="50" height="40"><span>Even Cargo</span></a>
   </div>

   <div class="collapse navbar-collapse" id="myNavbar">
     <ul class="nav navbar-nav navbar-right">
       <li><a href="lan.php">HOME</a></li>
       <li><a href="">

       <?php

         if(isset($_SESSION['staff_name']))
         {
           echo $_SESSION['staff_name'];
           echo "</a></li><li><a href='logout.php'>Sign Off</a></li>";
         }
         else
         {
           echo "STAFF ACCOUNT";
         }

       ?>
       </a></li>
     </ul>
   </div>
 </div>
</nav>
