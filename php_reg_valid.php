
<?php
$name = $email = $mobile = $gender = "";
$errors = array();
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Name validation
    $name = trim($_POST["name"]);
    if (empty($name)) {
        $errors[] = "Name is required";
    }

    // Email validation
    $email = trim($_POST["email"]);
    if (empty($email)) {
        $errors[] = "Email is required";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Mobile validation
    $mobile = trim($_POST["mobile"]);
    if (!preg_match("/^[0-9]{10}$/", $mobile)) {
        $errors[] = "Enter a valid 10-digit mobile number";
    }

    // Password validation
    $password = $_POST["password"];
    if (strlen($password) < 8) {
        $errors[] = "Password must contain at least 8 characters";
    }

    // Confirm password
    $confirm = $_POST["confirm"];
    if ($password != $confirm) {
        $errors[] = "Passwords do not match";
    }

    // Gender validation
    $gender = $_POST["gender"] ?? "";
    if (empty($gender)) {
        $errors[] = "Please select your gender";
    }

    // Display success message
    if (empty($errors)) {
        $success = "Registration Successful!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>

<h2>Student Registration Form</h2>

<?php
foreach ($errors as $error) {
    echo "<p style='color:red;'>$error</p>";
}

if ($success != "") {
    echo "<p style='color:green;'>$success</p>";
}
?>

<form method="POST" action="">

    Name:
    <input type="text" name="name"
    value="<?php echo htmlspecialchars($name); ?>">
    <br><br>

    Email:
    <input type="text" name="email"
    value="<?php echo htmlspecialchars($email); ?>">
    <br><br>

    Mobile:
    <input type="text" name="mobile"
    value="<?php echo htmlspecialchars($mobile); ?>">
    <br><br>

    Password:
    <input type="password" name="password">
    <br><br>

    Confirm Password:
    <input type="password" name="confirm">
    <br><br>

    Gender:
    <input type="radio" name="gender" value="Male"> Male
    <input type="radio" name="gender" value="Female"> Female
    <br><br>

    <input type="submit" value="Register">
    <input type="reset" value="Clear">

</form>

</body>
</html>
