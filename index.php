
<?php

include "db.php";

$message = "";

if (isset($_POST['submit'])) {

    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate all fields
    if ($firstname == "" || $lastname == "" || $email == "" || $password == "") {

        $message = "Please fill in all fields.";

    } else {

        // INSERT query
        $sql = "INSERT INTO students (firstname, lastname, email, password)
                VALUES ('$firstname', '$lastname', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            $message = "Student record inserted successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Registration</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 30px;
        }

        .container {
            width: 85%;
            max-width: 1000px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #cccccc;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        h2 {
            margin-top: 35px;
        }

        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }

        button {
            margin-top: 20px;
            padding: 10px 25px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        th, td {
            border: 1px solid #cccccc;
            padding: 10px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Student Registration Form</h1>

    <?php if ($message != ""): ?>

        <div class="message">
            <?php echo $message; ?>
        </div>

    <?php endif; ?>


    <!-- Registration Form -->

    <form method="POST" action="">

        <label>First Name</label>

        <input
            type="text"
            name="firstname"
            placeholder="Enter first name"
        >


        <label>Last Name</label>

        <input
            type="text"
            name="lastname"
            placeholder="Enter last name"
        >


        <label>Email</label>

        <input
            type="email"
            name="email"
            placeholder="Enter email"
        >


        <label>Password</label>

        <input
            type="password"
            name="password"
            placeholder="Enter password"
        >


        <button type="submit" name="submit">
            Submit
        </button>

    </form>


    <!-- Student Records -->

    <h2>Student Records</h2>

    <table>

        <tr>

            <th>ID</th>

            <th>First Name</th>

            <th>Last Name</th>

            <th>Email</th>

            <th>Password</th>

        </tr>


        <?php

        // SELECT query
        $sql = "SELECT * FROM students";

        $result = $conn->query($sql);


        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                echo "<tr>";

                echo "<td>" . $row['id'] . "</td>";

                echo "<td>" . $row['firstname'] . "</td>";

                echo "<td>" . $row['lastname'] . "</td>";

                echo "<td>" . $row['email'] . "</td>";

                echo "<td>" . $row['password'] . "</td>";

                echo "</tr>";
            }

        } else {

            echo "<tr>";

            echo "<td colspan='5'>No student records found.</td>";

            echo "</tr>";
        }

        ?>

    </table>

</div>

</body>

</html>

