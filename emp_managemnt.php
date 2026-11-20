
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "empydb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {

    $id = $_POST['eid'];
    $name = $_POST['ename'];
    $dep = $_POST['dept'];
    $salary = $_POST['sal'];

    $stmt = mysqli_prepare($conn, "INSERT INTO emp(eid, ename, dept, sal) VALUES (?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, "issd", $id, $name, $dep, $salary);

    if (mysqli_stmt_execute($stmt)) {
        echo "SUBMITTED SUCCESSFULLY!!";
    }
    else {
        echo "ERROR: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
?>

<html>
<head>
    <title>Employee</title>
</head>
<body>

<form method="POST" action="">

    Enter ID:
    <input type="text" name="eid" required>
    <br><br>

    Enter Name:
    <input type="text" name="ename" required>
    <br><br>

    Enter Dept:
    <input type="text" name="dept" required>
    <br><br>

    Enter Salary:
    <input type="text" name="sal" required>
    <br><br>

    <input type="submit" name="submit" value="Submit">

</form>

<?php

echo "<br><h2 align=center>EMPLOYEE DETAILS</h2>";

$sql = "SELECT * FROM emp";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {

    echo "<table border=2 align=center>";

    echo "<tr>
    <th>Employee ID</th>
    <th>Employee Name</th>
    <th>Department</th>
    <th>Salary</th>
    </tr>";

    while ($row = mysqli_fetch_assoc($res)) {

        echo "<tr><td>" . htmlspecialchars($row['eid']) . "</td>";
        echo "<td>" . htmlspecialchars($row['ename']) . "</td>";
        echo "<td>" . htmlspecialchars($row['dept']) . "</td>";
        echo "<td>" . htmlspecialchars($row['sal']) . "</td></tr>";
    }

    echo "</table>";
}
else {
    echo "0 results";
}

mysqli_close($conn);

?>

</body>
</html>


