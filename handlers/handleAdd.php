<?php 

require_once "../db/connection.php";
session_start();

$target_dir = "../assets/images/postImage/";

$message = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = $_POST['title'];
    $body = $_POST['body'];
    
    // Check if an image was selected
    if (empty($_FILES['image']['tmp_name'])) {
        $message = '<div style="color:red;">Please select an image to upload.</div>';
    } else {
        $file_tmp_name = $_FILES["image"]["tmp_name"];
        $file_name = $_FILES["image"]["name"];
        $file_size = $_FILES["image"]["size"];

        // Validate file size (5MB)
        if ($file_size > 5000000) {
            $message = '<div style="color:red;">Sorry, your file is too large. The maximum size is 5MB.</div>';
        } else {
            // Validate that the file is a real image
            $image_info = getimagesize($file_tmp_name);
            if ($image_info === false) {
                $message = '<div style="color:red;">File is not a valid image.</div>';
            } else {
                // Validate file extension
                $imageType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                $allowedTypes = ['jpg', 'png', 'jpeg'];

                if (!in_array($imageType, $allowedTypes)) {
                    $message = '<div style="color:red;">Sorry, only JPG, JPEG, and PNG files are allowed.</div>';
                } else {
                    // Create the target directory if it doesn't exist
                    if (!is_dir($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }
                    
                    // Generate a unique file name for security
                    $new_filename = uniqid('img_', true) . '.' . $imageType;
                    $finalName = $target_dir . $new_filename;

                    // Move the file to the final destination
                    if (move_uploaded_file($file_tmp_name, $finalName)) {
                        
                        // --- IMPORTANT: Use a Prepared Statement to prevent SQL Injection ---
                        $stmt = $mysqli->prepare("INSERT INTO posts (title, body, image, user_id) VALUES (?, ?, ?, ?)");
                        if(isset($_SESSION['user_id'])){
                            $user_id = $_SESSION['user_id']; 
                            $stmt->bind_param("sssi", $title, $body, $new_filename, $user_id);
                            
                            if ($stmt->execute()) {
                                header("Location: ../index.php");
                                exit();
                            } else {
                                $message = '<div style="color:red;">Database insertion failed: ' . $stmt->error . '</div>';
                            }
                            $stmt->close();
                        } else {
                            echo "Sorry , you'r not Login to Add post ! <br> back to login here <a href='../Login.php'>Login</a>"; 
                        }   
                    } else {
                        $message = '<div style="color:red;">Sorry, there was an error uploading your file.</div>';
                    }
                }
            }
        }
    }
}

// Display the message after processing the form
echo $message;

// Close the database connection
if (isset($conn)) {
    mysqli_close($conn);
}
?>