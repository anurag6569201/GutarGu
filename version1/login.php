<?php 
session_start();
if(isset($_SESSION['unique_id'])){
  header("location: users.php");
  exit;
}

include_once "header.php";

require 'php/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  if (!empty($email) && !empty($password)) {
    // Sanitize and validate email input
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    // Retrieve user information from the database
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['unique_id'] = $user['unique_id'];
      header("location: users.php");
      exit;
    } else {
      $error = "Invalid email or password.";
    }
  } else {
    $error = "Please enter both email and password.";
  }
}

?>
<?php include_once "header.php"; ?>
<body style="display:flex;align-items:center;justify-content:center;height:100vh">
  <div class="wrapper1">
    <section class="form login">
      <header>Gutar Gu</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
    </section>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>
