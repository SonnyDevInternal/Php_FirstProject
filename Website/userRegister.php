<?php
include 'db.php';
session_start();

function generateUserCookie($username)
{
    return hash("md5",  $username.time());
}

function isUsernameTaken($username, $conn) //returns either true or false, or -1 for internal errors
{
    $stmt = $conn->prepare("SELECT ID FROM User WHERE Username = :username");

    $stmt->bindParam(':username', $username);

    if($stmt->execute())
    {
        $user = $stmt->fetch();

        if($user)
        {
            return 1;
        }
        else
        {
            return 0;
        }

    }
    else
    {
        return -1;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);

    if(isUsernameTaken($username, $conn))
    {
        echo("Username is already taken!");
        exit("Username Taken!");
    }

    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO User (Username, Password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    if($stmt->execute())
    {
        header("Location: userLogin.php");
    }
}
?>

<html>
<link rel="stylesheet" href="/Style/Login.css">
    <title>Login Page</title>

    <head>
    </head>

    <body>
       <div id="FG">
    <label style="outline-style:solid;text-align: center; padding-bottom: 0%; padding-left: 36.4%; padding-right: 42.7%; border-radius: 25px;">Register Page</label>
    <div style="margin-top: 8%; margin-left: 45%">
     <form action="userRegister.php" method="post">
        <textarea name="username" placeholder="Username" required></textarea><br>
        <textarea name="password" placeholder="Password" required></textarea><br>
        <input style="margin-top: 10%; margin-left: -12%" class="Entry" type="submit" value="Register">
    </form> 
      </div>
       </div>
    </body>
</html>