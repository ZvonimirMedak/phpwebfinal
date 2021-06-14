<?php
if(!empty($_POST["login"])) {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
    if($email == "admin@admin.com" && $_POST['password'] == "admin123") {
        setcookie ("username",$_POST["username"],time()+ 86400);
        echo "Cookies Set Successfuly";
    }else {
        $loginErr = "Invalid credentials"
    }
	
} else {
	setcookie("username","");
	echo "Cookies Not Set";
}

?>
