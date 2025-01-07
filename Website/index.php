<?php
include 'db.php';
session_start();

$stmt = $conn->prepare("SELECT Comments.ID, Username, PostDate, Content FROM Comments JOIN User ON Comments.UserID = User.ID");
$stmt->execute();
$comments = $stmt->fetchAll();
?>

<html>
<link rel="stylesheet" href="/Style/index.css">
    <head>
        <title>Cool Website</title>
    </head>

    <body>
        <div id="websiteLayout">

        <?php
    if(isset($_SESSION['username']))
    {
        $username_ = htmlspecialchars($_SESSION['username']);
        echo "<h4 color='White'> Eingeloggt als: " . $username_ . "<h4>";
    }
    else
    {
        $loginUrl = "http://" . $_SERVER["HTTP_HOST"] . "/Login.php";
        echo "<a href=".$loginUrl." id='whiteTxt'><h4 color='White'> Einloggen <h4></a>";
    }
    ?>

    <div style="margin-left: 20%; margin-right: 5%; margin-bottom: 10%">

    <h1 style="padding-right: 200px;">Kommentare</h1>
    <ul style="outline-style: solid;" class="scrollableList">
        <?php foreach ($comments as $comment): ?>
            <li>
                <strong><?php echo ($comment['Username']); ?></strong> 
                (<?php echo ($comment['PostDate']); ?>): 
                <?php echo ($comment['Content']); ?>
            </li>
        <?php endforeach; ?>
    </ul>

    </div>

    <div id="commentInput">
    <h2>Neuen Kommentar erstellen</h2>
    <form action="add_comments.php" method="post">
        <textarea name="content" placeholder="Dein Kommentar" required></textarea><br>
        <input type="submit" value="Kommentar absenden">
    </form>      
    </div>


    <script>
        // Optional: JavaScript to show or hide comment input
        document.addEventListener("DOMContentLoaded", function() {
            let cmntInput = document.getElementById("commentInput");
            <?php if (!isset($_SESSION['username'])): ?>
                cmntInput.style.display = "none";
            <?php endif; ?>
        });
    </script>

        </div>

    </body>
</html>


