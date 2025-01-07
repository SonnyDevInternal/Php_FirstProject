<?php
include 'db.php';
session_start();

function generateUserCookie($username)
{
    return hash("md5",  $username . time());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $stmt = $conn->prepare("SELECT ID, Password FROM User WHERE Username = :username");
    $stmt->bindParam(':username', $username);

    if ($stmt->execute()) {
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['Password'])) {
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['username'] = $username;

            $userCookie = generateUserCookie($username);
            setcookie("user", $userCookie, time() + 3600, "/", "", false, true);

            header("Location: index.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Error executing the query.";
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
    <label style="outline-style:solid;text-align: center; padding-bottom: 0%; padding-left: 40%; padding-right: 42.7%; border-radius: 25px;">Login Page</label>
     <div style="margin-top: 8%; margin-left: 45%">
     <form action="userLogin.php" method="post">
        <textarea name="username" placeholder="Username" required></textarea><br>
        <textarea name="password" placeholder="Password" required></textarea><br>
        <input style="margin-top: 10%; margin-left: -12%" class="Entry" type="submit" value="Login">
    </form> 
      </div>
       </div>
    </body>
</html>