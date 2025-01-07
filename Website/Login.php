<html>
<link rel="stylesheet" href="/Style/Login.css">
    <title>Login Page</title>

    <head>
    </head>

    <body>
       <div id="FG">
    <label style="outline-style:solid;text-align: center; padding-bottom: 0%; padding-left: 40%; padding-right: 42.7%; border-radius: 25px;">Login Page</label>
     <div style="margin-top: 10%;">
     <?php 
    $loginUrl = "http://" . $_SERVER["HTTP_HOST"] . "/userLogin.php";
    $registerUrl = "http://" . $_SERVER["HTTP_HOST"] . "/userRegister.php";

    echo '<a href="'.$loginUrl.'"><button class="Entry" type="button">Login</button></a>';
    echo '<a href="'.$registerUrl.'"><button class="Entry" type="button">Register</button></a>';
    ?>
      </div>
       </div>
    </body>
</html>