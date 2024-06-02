<?php 

session_start();
include_once "php/config.php";

// Check if the user is authenticated; if not, redirect to the login page
if (!isset($_SESSION['unique_id'])){
  header("location: login.php");
  exit;
}
?>

<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="chat-area">
      <div class="changesize">
        <header>
          <?php 
            // Use mysqli_real_escape_string to escape user input
            $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
            // Use prepared statement to prevent SQL injection
            $sql = $conn->prepare("SELECT * FROM users WHERE unique_id = ?");
            $sql->bind_param("i", $user_id);
            $sql->execute();
            $result = $sql->get_result();

            if($result->num_rows > 0){
              $row = $result->fetch_assoc();
            } else {
              header("location: users.php");
              exit;
            }
          ?>
          <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?></span>
            <p><?php echo htmlspecialchars($row['status']); ?></p>
          </div>
        </header>
      </div>
      
      <div class="chat-box" style="position:fixed;top:80px;bottom:80px; width:100%;background:transparent" class="scrollmanage">
        <!-- Display chat messages here -->
      </div>

      <div class="changesize1">
        <form action="#" class="typing-area">
          <input type="text" class="incoming_id" name="incoming_id" value="<?php echo htmlspecialchars($user_id); ?>" hidden>
          <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
          <button><i class="fab fa-telegram-plane"></i></button>
        </form>
      </div>
    </section>
  </div>

  <script src="javascript/conversation.js"></script>

</body>
</html>
