<?php
    // Start the session and check if the user is logged in 
    date_default_timezone_set("UTC");
    session_start();
    if(isset($_SESSION['fname'])){
        $fname = $_SESSION['fname'];
        $lname = $_SESSION['lname'];
        $email = $_SESSION['email'];
    }
    else{
        header("Location: login.php"); 
        exit(); 
    }
?>

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

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ashars_ - Post to Blog</title>
    <link rel="stylesheet" href="css files/reset.css" type="text/css">
    <link rel="stylesheet" href="css files/general.css" type="text/css">
    <link rel="stylesheet" href="css files/blog.css" type="text/css">

    <script src="javascript/general.js" defer></script>
    <script src="javascript/previewPost.js" defer></script>
    <script src="javascript/blogvalidator.js" defer></script>
    <script src="javascript/saveUser.js" defer></script>
    <script src="javascript/resetUser.js" defer></script>
</head>
<body>
    <div id="overlay" style="display: none;"></div>

    <div id="confirmBox" style="display: none;">
        <p>Are you sure?</p>
        <button id="confirmY">Yes</button>
        <button id="confirmN">No</button>
    </div>

    <div id="prevoverlay" style="display: none;"></div>

    <div id ="previewBox" style="display: none;">
        <h3>Preview</h3>
        <div id="previewContent"></div>
        <button id="postFromPreview">Confirm Post</button> 
        <button id="closePreview">Edit</button>
    </div>

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


    <section class="lefttoright">
        <p class="nametag">Hello, <?php echo htmlspecialchars($fname); ?></p>
        <div class="blogredirect">
            <a class="blogredirectbutton" href = "viewPost.php"><img src = "media/read.gif"></a>
            <a class="blogredirectbutton" href = "addEntry.php"><img src = "media/compose.gif"></a>
            <a class="blogredirectbutton" id ="LogoutButton" href = "logout.php"><img src = "media/logout.gif"></a>
        </div>
    </section>

   
    <section class="addpostsection">
        <h3 class="poststitle">Compose a Post</h3>
        <form method="POST" action="addPost.php" class="addpostform" id ="blogpost">
            <h4>Title</h4>
            <input type="text"  placeholder="Title" id="posttitle" name="posttitle" required class="blacktext">
            <h4>Content</h4>
            <textarea id="postcontent" name="postcontent" placeholder="Enter your text here..." required class="blacktext"></textarea>
            <div>
                <button type="submit" id ="postButton">Post</button>
                <button type="reset">Clear</button>
                <button type="button" id="preview">Preview</button>            
            </div>
        </form>
    </section>

    
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

