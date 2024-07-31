<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration Form</title>
    <!-- Boxicons CDN Link -->
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
   <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
      <link rel="stylesheet" href="css/popup_style.css">
   <link rel="stylesheet" href="style.css">
   <style>
     .word{
      color: hotpink;
      font-size: 24px;
     }
     .word span a{
      color: violet;
     }

     .bg-img{
  background: url('assets/img/irri.jpg');
  height: 100vh;
  background-size: cover;
  background-position: center;
}
   </style>
  </head>
  <body>
    <div class="bg-img">
      <div class="content">
        <header> Register</header>
        <form action="register.php" method="post">

          <div class="field">
            <span class="bx bx-user"></span>
            <input type="text" name="fname"  placeholder="Enter Your Fullname" required>
          </div>

          <div class="field space">

            <span class="bi bi-geo-alt-fill"></span>
           <select name="designation" required>
          <option value=""> Select your Designation</option>
      <option value="Field-Manager">Field Manager</option>  
      <option value="Area-Manager">Area Manager</option>
      <option value="Section-Manager">Section Manager</option>  
      <option value="Irrigation-Engineer"> Irrigation Engineer</option>
      <option value="Agronomist">Agronomist</option> 
        </select>
          </div>

          <div class="field space">
            <span class="bi bi-envelope-at"></span>
            <input type="email" name="email" placeholder="Email" required>
          </div>

          <div class="field space">
            <span class="bi bi-telephone"></span>
            <input type="phone-number" name="phone" placeholder="phone-number" required>
          </div>


          <div class="field space">
            <span class="bx bx-key"></span>
            <input type="password"  name="password" class="pass-key" required placeholder="Password">
            <span class="show">SHOW</span>
          </div>

          <div class="field space">
            <input type="submit" name="register" value="REGISTER">
          </div><br>
          <div class="word">
    <span>Already have an account?</span>
    <span><a href="index.php">Login Here</a></span>
  </div>
          
        </form>
       <?php
// Assuming you have a valid database connection in $con

$con = mysqli_connect("localhost", "root", "", "irri");

// Check if the connection was successful
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Function to validate if an email address is already taken
function isEmailTaken($con, $email) {
    $query = "SELECT COUNT(*) AS count FROM users WHERE email = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['count'] > 0;
}

// Function to validate if a phone number contains only digits
function isPhoneNumberValid($phone) {
    return preg_match("/^[0-9]{10}$/", $phone) === 1; // Assumes a 10-digit phone number
}

// Function to validate if a password has mixed characters
function isPasswordValid($password) {
    return preg_match('/^(?=.*[0-9])(?=.*[A-Za-z]).{8,}$/', $password) === 1; // Requires at least one digit, one letter, and a minimum length of 8 characters
}

// Process user registration form
if (isset($_POST["register"])) {
   //$id=uniqid();
    $fname = $_POST['fname'];
    $city = $_POST['designation'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $pass1 = md5($password);

    if (isEmailTaken($con, $email)) {
        echo "Email is already taken. Please choose a different email.";
    } elseif (!isPhoneNumberValid($phone)) {
        echo "Invalid phone number. Please provide a 10-digit phone number.";
    } elseif (!isPasswordValid($password)) {
        echo "Password must contain at least one letter, one digit, and be at least 8 characters long.";
    } else {
        // Insert user data into the database
        $sql = "INSERT INTO users VALUES ('','$fname', '$email', '$city', '$phone', '$pass1')";
        //$stmt = $con->prepare($sql);
       //$stmt->bind_param("sssss",$fname, $email, $city, $phone, $pass1);
        $query=mysqli_query($con,$sql);

        if ($query) {
            session_start();
            $_SESSION["username"] = $email;
            echo "
            <div class='popup popup--icon -success js_success-popup popup--visible'>
  <div class='popup__background'></div>
  <div class='popup__content'>
    <h3 class='popup__content__title'>
      Success 
    </h1>
    <p>Registration Successfully</p>
    <p>
    
    <a href='index.php'><button class='button button--success' data-for='success'>Return to Home</button></a>
    </p>
  </div>
</div>";
        } else {
               echo" <div class='popup popup--icon -error js_error-popup popup--visible'>
            <div class='popup__background'></div>
            <div class='popup__content'>
              <h3 class='popup__content__title'>
                Error 
              </h1>
              <p>Registration Failed</p>
              <p>
              <a href=''><button class='button button--error' data-for='js_error-popup'>Close</button></a>
              </p>
            </div>
          </div>";
        }
    }
}
?>


      </div>
    </div>

    <script>
      const pass_field = document.querySelector('.pass-key');
      const showBtn = document.querySelector('.show');
      showBtn.addEventListener('click', function(){
       if(pass_field.type === "password"){
         pass_field.type = "text";
         showBtn.textContent = "HIDE";
         showBtn.style.color = "#3498db";
       }else{
         pass_field.type = "password";
         showBtn.textContent = "SHOW";
         showBtn.style.color = "#222";
       }
      });
    </script>


  </body>
</html>
