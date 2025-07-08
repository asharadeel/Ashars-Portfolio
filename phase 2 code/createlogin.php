<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ashars_ - Sign Up</title>
    <link rel="stylesheet" href="css files/reset.css" type="text/css">
    <link rel="stylesheet" href="css files/general.css" type="text/css">
    <link rel="stylesheet" href="css files/login.css" type="text/css">

    <script src="javascript/general.js" defer></script>
</head>
<body>
<nav class = "top">
        <a href = "homepage.html"><img src = "media/asharIcon.png"></a>
        <div>
            <a href = "homepage.html#about">About Me</a>
            <a href = "experience.html" >Experience</a> 
            <a href = "education.html">Education</a>  
            <a href = "projects.html">Projects</a>  
            <a href = "skills.html">Skills</a>   
            <a href = "redirectlogin.php">Blog</a>   
        </div>
    </nav>

    
    <section class="login">
        <div class="loginsection">
            <legend>
                <h3>Sign Up</h3>
            </legend>
            <form method="POST" action="createlogin.php">
                <div>
                    <label for="fname">First Name:</label>
                    <input class= blacktext type="text" name="fname" id="fname" required title="Please enter your first name">
                </div>
                <div>
                    <label for="lname">Last Name:</label>
                    <input class= blacktext type="text" name="lname" id="lname" required title="Please enter your last name">
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input class= blacktext type="email" name="email" id="email" required title="Please enter a valid email address">
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input class= blacktext type="password" name="password" id="password" required title="Please enter a password">
                </div>
                <div >
                    <input type="submit" value="Create" name="Create" class="buttonui">
                    <input type="reset" value="Clear" name="Create" class="buttonui">
                </div>
                <div>
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </section>

    <?php
        // Database connection
        $servername = "127.0.0.1";
        $username  = "root";
        $password = "";
        $dbname = "417project";

        $conn = new mysqli($servername,$username,$password,$dbname);
        if($conn->connect_error){
            die("Connection failed: " . $conn->$connect_error);
        }
    ?>

    <?php
        // FORM SUBMISSION
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $email = $_POST["email"];
            $pass = $_POST["password"];

            $checkEmailSql = "SELECT * FROM USERS WHERE email = '$email'";
            $result = $conn->query($checkEmailSql);

            // Check if the email already exists in the database
            if($result->num_rows > 0){
                echo "<article class='response'>";    
                echo "<p> An account already exists with this email address. </p>";
                echo "<br> <a class='button' href = login.php> Sign in? </a>";
                echo "</article>";      
            }
            else{
                // SAVE TO DATABSE
                session_start();
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $_SESSION['email'] = $email;

                $sql = "INSERT INTO USERS(firstName, lastName, email, password) 
                VALUES ('$fname','$lname','$email','$pass')";

                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully.";
                    header("Location: addEntry.php"); 
                    exit(); 
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        $conn->close();
    ?>

    <footer>
        <section class = "footerlinks"> 
            <a href = "tel=02089819867"> Call </a> 
            <a href = mailto://ec24424@qmul.ac.uk> Email </a> 
            <a href = #top> Go to top</a>
        </section>
        <p><i> ©2025 Ashar Adeel </i></p>
        <p class="barcodetext"> written by ashar </p>
    </footer>
    
</body>
</html>