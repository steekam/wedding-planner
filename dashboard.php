<?php
    session_start();      
  
    if (array_key_exists("id", $_COOKIE) OR array_key_exists("id",$_SESSION)) {
        $_SESSION["id"] = $_COOKIE["id"];
    } else {
        header ("Location: index.php");
    }
    
?>
<?php include('header.php')?>
<body>
   <a href='index.php?logout=1'><button class="btn btn-outline-success" type="submit">Log Out</button></a>
       
</body>
</html>