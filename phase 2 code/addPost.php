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
    $title = $_POST['posttitle']; 
    $content = $_POST['postcontent']; 

    session_start();
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        $userQuery = "SELECT ID FROM users WHERE email = '$email'";
        $userResult = $conn->query($userQuery);

        if ($userResult->num_rows > 0) {
            $userRow = $userResult->fetch_assoc();
            $userId = $userRow['ID'];

            $sql = "INSERT INTO posts (userId, title, content, timestamp) VALUES ('$userId', '$title', '$content', NOW())";
            if ($conn->query($sql) === TRUE) {
                header("Location: viewPost.php"); 
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "No active session. Please log in.";
    }

    $conn->close();
?>