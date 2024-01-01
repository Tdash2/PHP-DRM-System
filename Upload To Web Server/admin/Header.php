
<style>
body
{
  background:#ffffff;
  font-family: 'Encode Sans', sans-serif;
}
/* navigation bar */
#scanfcode
{
  border-radius:0px;
  background:#cfcfcf;
  padding:10px;
  font-size:17px;
}
/* logo or main heading */
#logo
{
  font-size:20px;
  font-weight:bolder;
  color:#000000;
  letter-spacing:2px;
}
/* navigation links*/
#link a
{
  color:#000000;
  margin:0 20px 0 10px;
  letter-spacing:1.5px;
}
/* navigation link with right border */
#first-link
{
  padding-right:6px;
  border-right:solid 1px #ccc;
}
/* sign up link button and toggle button */
#button-link ,#toogle-button
{
  color:#f2f2f2;
  border-style: solid;
  border-width: 1px;
  border-color: rgba(0,0,0,.2);
  border-radius: 2px;
  background-color: #fa6a48;
  line-height: 17px;
}
#button-link a
{
  color:#f2f2f2;
}

</style>
<nav id="scanfcode" class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" id="toogle-button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
       <span class="glyphicon glyphicon-menu-hamburger"></span>                     
      </button>
      <a id="logo" class="navbar-brand" href="home.php"><?php echo $appName; ?> Key </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
 
      <ul id="link" class="nav navbar-nav navbar-right">
         <li class="dropdown" id="first-link">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Products <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="newProduct.php">New Product</a></li>
          <li><a href="updateVer.php">New Update</a></li>
          <li><a href="viewProducts.php">View Products</a></li>
            
          </ul>
        </li>
         <li class="dropdown" id="first-link">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Trials Keys <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="viewTrialHWID.php">View Used HWIDS</a></li>
            <li><a href="trials.php">View Trials Keys</a></li>
            <li><a href="viewTrialEmalis.php">View Used Email</a></li>
          </ul>
        </li>
        </li>
         <li class="dropdown" id="first-link">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Actvation Keys <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="newkey.php">New Actvation Key</a></li>
            <li><a href="home.php">View Curent Keys</a></li>
          </ul>
        </li>
                <li><a href='logout.php'>Logout</a></li>

        
      </ul>
      
    </div>
  </div>
</nav>
</body>
</html>

