<?php

session_start();
include_once "php/config.php";

// Check if the user is not authenticated; if so, redirect to the login page
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
    exit;
}
?>

<?php include_once "header.php"; ?>

<body>
    <div class="wrapper3" style="overflow:hidden">
        <section class="users">
            <header style="height:10vh">
                <div class="content">
                    <?php
                    // Use prepared statement to prevent SQL injection
                    $sql = $conn->prepare("SELECT * FROM users WHERE unique_id = ?");
                    $sql->bind_param("i", $_SESSION['unique_id']);
                    $sql->execute();
                    $result = $sql->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                    }
                    ?>
                    <img src="php/images/<?php echo $row['img']; ?>" alt="">
                    <div class="details">
                        <span><?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?></span>
                        <p><?php echo htmlspecialchars($row['status']); ?></p>
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
            </header>

            <div class="search" style="height:6vh;">
                <span class="text">Select a user to start a chat</span>
                <input type="text" placeholder="Enter a name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>

            <div class="users-list" style="height:72vh;top:26vh;overflow-y:auto;" class="scrollmanage">
                <!-- The user list content goes here -->
            </div>
        </section>
    </div>

    <script src="javascript/users.js"></script>
    
  
</body>

</html>
