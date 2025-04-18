<?php
session_start();

if (
   isset($_POST['uname']) &&
   isset($_POST['pass'])
) {

   include "./dbconn.php";

   $uname = $_POST['uname'];
   $pass = $_POST['pass'];

   $data = "uname=" . $uname;

   if (empty($uname)) {
      $em = "Username is required";
      header("Location: ../../login.php?error=$em&$data");
      exit;
   } else if (empty($pass)) {
      $em = "Password is required";
      header("Location: ../../login.php?error=$em&$data");
      exit;
   } else {

      $sql = "SELECT * FROM Users WHERE Username = ?";
      $stmt = $db->prepare($sql);
      $stmt->execute([$uname]);

      if ($stmt->rowCount() == 1) {
         $user = $stmt->fetch();

         $username =  $user['Username'];
         $password =  $user['Password'];
         $fname =  $user['Firstname'];
         $lname =  $user['Lastname'];
         $id =  $user['Id'];
         $status = $user['Status'];

         if ($status == 'Y') {
            if ($username === $uname) {
               if (password_verify($pass, $password)) {
                  $_SESSION['id'] = $id;
                  $_SESSION['fname'] = $fname;
                  $_SESSION['lname'] = $lname;
                  $_SESSION['login_success'] = true;
                  $_SESSION['role_id'] = $user['Role_id'];
                  
                  header("Location: ../../index.php");
                  exit;
               } else {
                  $em = "Incorrect username or password";
                  header("Location: ../../login.php?error=$em&$data");
                  exit;
               }
            } else {
               $em = "Incorrect username or password";
               header("Location: ../../login.php?error=$em&$data");
               exit;
            }
         } else {
            $em = "Your account is not active";
            header("Location: ../../login.php?error=$em&$data");
            exit;
         }
      } else {
         $em = "Incorrect username or password";
         header("Location: ../../login.php?error=$em&$data");
         exit;
      }
   }
} else {
   header("Location: ../../login.php?error=error");
   exit;
}
