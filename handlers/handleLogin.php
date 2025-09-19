<?php 
require_once "../db/connection.php";
session_start();

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (!empty($email) && !empty($password)) {
        
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                $hashedPassword = $user['password'];
                $user_id = $user['id'];
                $user_name = $user['name'];
                
                $verify = password_verify($password, $hashedPassword);
                
                if ($verify) {
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_name'] = $user_name;
                    $_SESSION['successLogin'] = "Welcome " . $user_name;
                    header("Location: ../index.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Wrong Password";
                    header("Location: ../Login.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Wrong Email!";
                header("Location: ../Login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Database error occurred";
            header("Location: ../Login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Please fill in all fields";
        header("Location: ../Login.php");
        exit();
    }
} else {
    header("Location: ../Login.php");
    exit();
}
?>