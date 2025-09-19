<?php 

require_once "../db/connection.php";

$target_dir = "../assets/images/postImage/"; 
$id = $_GET['id'];
$message = '';

if($_SERVER['REQUEST_METHOD'] == "POST"){

    // Update title if provided
    if (isset($_POST['title'])){
        $newTitle = $_POST['title'];
        $stmt = $mysqli->prepare("UPDATE posts SET title = ? WHERE id = ?");
        $stmt->bind_param("si", $newTitle, $id);
        $stmt->execute();
        if($stmt->error){
            $message = '<div style="color:red;">Database update failed: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    }

    // Update body if provided
    if (isset($_POST['body'])){
        $newBody = $_POST['body'];
        $stmt = $mysqli->prepare("UPDATE posts SET body = ? WHERE id = ?");
        $stmt->bind_param("si", $newBody, $id);
        $stmt->execute();
        if($stmt->error){
            $message = '<div style="color:red;">Database update failed: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    }

    // Handle image update
    $updateImage = false;
    $finalImageName = null;

    // Check if a new image was uploaded
    if(!empty($_FILES['image']['tmp_name'])){
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
                    $finalPath = $target_dir . $new_filename;

                    // Move the file to the final destination
                    if (move_uploaded_file($file_tmp_name, $finalPath)) {
                        $updateImage = true;
                        $finalImageName = $new_filename;

                        // Get old image to delete it later
                        $query = $mysqli->prepare("SELECT image FROM posts WHERE id = ?");
                        $query->bind_param("i", $id);
                        $query->execute();
                        $result = $query->get_result();
                        if($row = $result->fetch_assoc()) {
                            $oldFileName = $row['image'];
                            // Delete old image file if it exists and is different
                            if($oldFileName && $oldFileName != $new_filename && file_exists($target_dir . $oldFileName)) {
                                unlink($target_dir . $oldFileName);
                            }
                        }
                        $query->close();
                    } else {
                        $message = '<div style="color:red;">Sorry, there was an error uploading your file.</div>';
                    }
                }
            }
        }
    }

    // Update database with new image name if upload was successful
    if($updateImage && $finalImageName) {
        $stmt = $mysqli->prepare("UPDATE posts SET image = ? WHERE id = ?");
        $stmt->bind_param("si", $finalImageName, $id);
        $stmt->execute();
        if($stmt->error){
            $message = '<div style="color:red;">Database update failed: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    }

    // Redirect only if no errors occurred
    if(empty($message)) {
        header("Location: ../index.php");
        exit();
    }

} else {
    header("Location: ../viewPost.php?id=" . urlencode($id));
    exit();
}

// If we reach here, there were errors - you might want to display them
echo $message;
?>