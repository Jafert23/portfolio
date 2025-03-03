<?php
//edit these
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elliots_website_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert new comment into database
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['name']) && !empty($_POST['comment'])) {
    $name = $conn->real_escape_string(strip_tags($_POST['name']));
    $email = $conn->real_escape_string(strip_tags($_POST['email']));
    $comment = $conn->real_escape_string(strip_tags($_POST['comment']));

    $sql = $conn->prepare("INSERT INTO comments (name, email, comment) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $name, $email, $comment);
    $sql->execute();
    $sql->close();
}

// Fetch all comments from database
$result = $conn->query("SELECT name, email, comment FROM comments ORDER BY id DESC");

$conn->close();
?>


    <form name="commentForm" onsubmit="return validateForm()" method="post">
    <h2>Leave a comment</h2>
        Name: <input type="text" name="name"><br>
        Email: <input type="email" name="email"><br>
        Comment: <textarea name="comment"></textarea><br>
        <input type="submit" value="Submit">
    </form>

    <div class="comments-section">
    <h3 class="comments-title">Previous Comments:</h3>
    <div class="comments-container">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='comment-item'>
                        <strong>" . htmlspecialchars($row["name"]) . " (" . htmlspecialchars($row["email"]) . ")</strong><br>
                        <p>" . nl2br(htmlspecialchars($row["comment"])) . "</p>
                      </div><hr>";
            }
        } else {
            echo "<p>No comments yet!</p>";
        }
        ?>
    </div>
</div>