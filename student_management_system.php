<?php
$conn = new mysqli("localhost", "root", "", "stud_info", 3307);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$rn = "";
$nm = "";
$ct = "";
$percent = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $roll = $_POST['roll_no'] ?? "";
    $name = $_POST['name'] ?? "";
    $city = $_POST['city_name'] ?? "";
    $per  = $_POST['percentage'] ?? "";

    // INSERT
    if (isset($_POST['insert'])) {
        $sql = "INSERT INTO student VALUES ('$roll','$name','$city','$per')";
        if ($conn->query($sql))
            echo "<script>alert('Record Inserted Successfully');</script>";
        else
            echo "<script>alert('Duplicate Roll No!');</script>";
    }

    // UPDATE (Prefill + Update)
    if (isset($_POST['update'])) {

        // If other fields empty → Fetch record first
        if ($name == "" && $city == "" && $per == "") {

            $result = $conn->query("SELECT * FROM student WHERE roll_no='$roll'");

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                $rn      = $row['roll_no'];
                $nm      = $row['name'];
                $ct      = $row['city_name'];
                $percent = $row['percentage'];

            } else {
                echo "<script>alert('Record Not Found');</script>";
            }

        } else {
            // Perform Update
            $sql = "UPDATE student 
                    SET name='$name', city_name='$city', percentage='$per' 
                    WHERE roll_no='$roll'";

            if ($conn->query($sql))
                echo "<script>alert('Record Updated Successfully');</script>";
        }
    }

    // DELETE
    if (isset($_POST['delete'])) {
        $sql = "DELETE FROM student WHERE roll_no='$roll'";
        if ($conn->query($sql))
            echo "<script>alert('Record Deleted Successfully');</script>";
    }

    // VIEW (Only Table)
    if (isset($_POST['view'])) {

        $result = $conn->query("SELECT * FROM student");

        echo "<table>";
        echo "<tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>City</th>
                <th>Percentage</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['roll_no']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['city_name']}</td>
                    <td>{$row['percentage']}</td>
                  </tr>";
        }

        echo "</table>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Management System</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(120deg, #667eea, #764ba2);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* HEADER */
.header {
    width: 100%;
    padding: 25px 0;
    text-align: center;
    color: white;
}

.header h1 {
    font-size: 32px;
    font-weight: 600;
}

.header p {
    font-size: 14px;
    opacity: 0.9;
}

/* CARD CONTAINER */
.container {
    width: 420px;
    background: white;
    margin-top: 20px;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    animation: fadeIn 0.6s ease-in-out;
}

@keyframes fadeIn {
    from {opacity:0; transform: translateY(20px);}
    to {opacity:1; transform: translateY(0);}
}

/* FORM */
form {
    display: flex;
    flex-direction: column;
}

input {
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 8px;
    border: 1px solid #ddd;
    font-size: 14px;
    transition: 0.3s;
}

input:focus {
    border-color: #667eea;
    box-shadow: 0 0 6px rgba(102,126,234,0.5);
    outline: none;
}

/* BUTTON GROUP */
.btn-group {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.btn-group button {
    padding: 10px;
    border: none;
    border-radius: 8px;
    color: white;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s;
}

.insert { background: #28a745; }
.update { background: #ffc107; color: black; }
.delete { background: #dc3545; }
.view   { background: #007bff; }
.clear  { background: #6c757d; }

.btn-group button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.2);
}

/* TABLE */
table {
    width: 80%;
    margin: 40px auto;
    border-collapse: collapse;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}

th {
    background: #667eea;
    color: white;
    padding: 14px;
    font-weight: 500;
}

td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

tr:hover {
    background: #f4f6ff;
}

@media(max-width:500px){
    .container {
        width: 90%;
    }
    table {
        width: 95%;
    }
}
</style>
</head>

<body>

<h2>Student Management System</h2>

<div class="container">

<form method="post">

<input type="number" name="roll_no" placeholder="Enter Roll No"
       value="<?php echo $rn; ?>">

<input type="text" name="name" placeholder="Enter Name"
       value="<?php echo $nm; ?>">

<input type="text" name="city_name" placeholder="Enter City"
       value="<?php echo $ct; ?>">

<input type="number" step="0.01" name="percentage"
       placeholder="Enter Percentage"
       value="<?php echo $percent; ?>">

<div class="btn-group">
    <button type="submit" name="insert" class="insert">Insert</button>
    <button type="submit" name="update" class="update">Update</button>
    <button type="submit" name="delete" class="delete">Delete</button>
    <button type="submit" name="view" class="view">View</button>
    <button type="reset" class="clear">Clear</button>
</div>

</form>

</div>

</body>
</html>

<?php $conn->close(); ?>
