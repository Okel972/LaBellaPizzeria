<?php

if(isset($success_msg)){
   foreach($success_msg as $success_msg){
      echo '<script>swal("'.$success_msg.'", "" ,"success");</script>';
   }
}

if(isset($warning_msg)){
   foreach($warning_msg as $warning_msg){
      echo '<script>swal("'.$warning_msg.'", "" ,"warning");</script>';
   }
}

if(isset($info_msg)){
   foreach($info_msg as $success_msg){
      echo '<script>swal("'.$info_msg.'", "" ,"info");</script>';
   }
}

if(isset($error_msg)){
   foreach($error_msg as $error_msg){
      echo '<script>swal("'.$error_msg.'", "" ,"error");</script>';
   }
}














if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
        $error_msg[] = "Fill in all fields";
    } 
    elseif ($_GET["error"] == "wronglogin") {
        $error_msg[] = "Incorrect login information";
    } 
    elseif ($_GET["error"] == "wrongpassword") {
        $error_msg[] = "Incorrect password";
    }
    else if ($_GET["error"] == "invalidUid") {
        $error_msg[] = "Choose a proper username";
    }
    else if ($_GET["error"] == "invalidEmail") {
        $error_msg[] = "Choose a proper email";
    }
    else if ($_GET["error"] == "passwordsdontmatch") {
        $error_msg[] = "Passwords don't match";
    }
    else if ($_GET["error"] == "stmtfailed") {
        $error_msg[] = "Something went wrong, please try again";
    }
    else if ($_GET["error"] == "usernametaken") {
        $error_msg[] = "Username already taken";
    }
    else if ($_GET["error"] == "none") {
        $success_msg[] = "You have signed up";
    }
    else if ($_GET["error"] == "disconnected") {
        $success_msg[] = "You are disconnected";
    }
    else if ($_GET["error"] == "connected") {
        $success_msg[] = "You are connected";
    }
}

if (!empty($error_msg)) {
    foreach ($error_msg as $error) {
        echo '<script>swal("' . $error . '", "", "error");</script>';
    }
}

if (!empty($success_msg)) {
    foreach ($success_msg as $success) {
        echo '<script>swal("' . $success . '", "" ,"success");</script>';
    }
}