<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                <h3>Login</h3>
            </legend>
            <form method="POST" action="login.php">
                <div>
                    <label for="email">Email:</label>
                    <input class= blacktext type="email" name="email" id="email" required title="Please enter a valid email address">
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input class= blacktext type="password" name="password" id="password" required title="Please enter a password">
                </div>
                <div >
                    <input type="submit" value="Login" class="buttonui">
                    <input type="reset" value="Clear" class="buttonui">
                </div>
                <div>
                    <p>Don't have an account? <a href="createlogin.php">Sign Up</a></p>
                </div>
            </form>
        </div>
    </section>

    <?php
        // DATABASE CONNECTION
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
        // LOGIN FUNCTIONALITY
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST["email"];
            $pass = $_POST["password"];

            $sql = "SELECT firstName, lastName, email FROM USERS WHERE email = '$email' AND password = '$pass'";
            $result = $conn->query($sql); 

            // Save to session if login is successful, else return message
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                session_start();
                $_SESSION['fname'] = $row['firstName'];
                $_SESSION['lname'] = $row['lastName'];
                $_SESSION['email'] = $row['email'];

                echo "Sign in successful.";
                header("Location: addEntry.php");
                exit();
            } else {
                echo "<article class='response'>";
                echo "<p>Invalid email or password. Please try again.</p>";
                echo "<br> <p> Dont have an account? </p> <a href= createlogin.php> Create an account </a>";
                echo "</article>";
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