<?php
    // Set Session
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
    <title>ashars_ - Blog Posts</title>
    <link rel="stylesheet" href="css files/reset.css" type="text/css">
    <link rel="stylesheet" href="css files/general.css" type="text/css">
    <link rel="stylesheet" href="css files/blog.css" type="text/css">

    <script src="javascript/general.js" defer></script>
    <script src="javascript/dropdownStyle.js" defer></script>
    <script src="javascript/resetUser.js" defer></script>


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


    <section class="lefttoright">
        <p class="nametag">Hello, <?php echo htmlspecialchars($fname); ?></p>
        <div class="blogredirect">
            <div class="blogredirectbutton">
                <!-- Dropdown button and menu -->
                <button id="sortDropdown">
                    <img src="media/dropdown.png" alt="Dropdown">
                </button>
                <div id="dropdownMenu" class="dropdown-menu">
                    <p class="dropdown-item"> Sort By:</p>
                    <a href="viewPost.php" class="dropdown-item">Default</a>  
                    <?php
                        $timestampQuery = "SELECT timestamp FROM posts ORDER BY timestamp DESC";
                        $timestampResult = $conn->query($timestampQuery);

                        $months = []; 
                        if ($timestampResult->num_rows > 0) {
                            while ($row = $timestampResult->fetch_assoc()) {
                                $monthYear = date("F Y", strtotime($row['timestamp']));
                                $yearMonth = date("Y-m", strtotime($row['timestamp'])); 


                                if (!in_array($yearMonth, $months)) {
                                    $months[$yearMonth] = $monthYear;
                                }
                            }
                            foreach ($months as $yearMonth => $displayMonth) {
                                echo "<a href='viewPost.php?month=$yearMonth' class='dropdown-item'>$displayMonth</a>";
                            }
                        } else {
                            echo "<p class='dropdown-item'>No posts available</p>";
                        }
                    ?>
                </div>
                <!-- End of dropdown button and menu -->
            </div>
            <a class="blogredirectbutton" href = "viewPost.php"><img src = "media/read.gif"></a>
            <a class="blogredirectbutton" href = "addEntry.php"><img src = "media/compose.gif"></a>
            <a class="blogredirectbutton" id="LogoutButton" href = "logout.php"><img src = "media/logout.gif"></a>
        </div>
    </section>
   

    <section class="posthistory">
        <h3 class="poststitle">Posts</h3>
        <?php
            // CREATE SQL QUERY
            $monthFilter = isset($_GET['month']) ? $_GET['month'] : null;

            $sql = "SELECT posts.*, users.firstName AS fname, users.lastName AS lname 
                    FROM posts 
                    JOIN users ON posts.userId = users.ID";

            $result = $conn->query($sql);

            // MODIFY POSTS BASED ON MONTH FILTER
            $posts = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($monthFilter) {
                        $postMonth = date("Y-m", strtotime($row['timestamp']));
                        if ($postMonth !== $monthFilter) {
                            continue; 
                        }
                    }
                    $posts[] = $row; 
                }
            }

            // SORT POSTS IN DESC ORDER 
            function bubbleSortPosts(&$posts) {
                $n = count($posts);
                for ($i = 0; $i < $n - 1; $i++) {
                    for ($j = 0; $j < $n - $i - 1; $j++) {
                        if (strtotime($posts[$j]['timestamp']) < strtotime($posts[$j + 1]['timestamp'])) {
                            $temp = $posts[$j];
                            $posts[$j] = $posts[$j + 1];
                            $posts[$j + 1] = $temp;
                        }
                    }
                }
            }

            bubbleSortPosts($posts);

            // Display the posts
            if (!empty($posts)) {
                foreach ($posts as $row) {
                    echo "<div class='post'>";
                        echo "<div class='posttitle'>";
                            echo "<div class='styleposttitle'>";
                                echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
                                $formattedDate = date("d F Y, H:i:s T", strtotime($row['timestamp']));
                                echo "<p class='postdate'>" . htmlspecialchars($formattedDate) . "</p>";
                            echo "</div>";
                            echo "<h5> By: " . htmlspecialchars($row['fname']) . " " . htmlspecialchars($row['lname']) . "</h5>";
                        echo "</div>";
                        echo "<div class='postcontent'>";
                            echo "<p class='postcontenttext'>" . htmlspecialchars($row['content']) . "</p>";
                        echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p class='nopostalert'>No posts available.</p>";
            }
        ?>
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

