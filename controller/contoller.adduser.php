<?php

include_once("../services/services.database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "<script>" . "console.log(" . $_POST . ");" . "</script>";

    $firstName = $_POST["f_name_form"];
    $lastName = $_POST["l_name_form"];
    $birthday = $_POST["birthday_form"];
    $gender = $_POST["gender_form"];
    $address = $_POST["address_form"];
    $email = $_POST["email_form"];
    $phone = $_POST["phone_form"];

    if (empty($firstName) || empty($lastName) || empty($gender) || empty($address) || empty($email) || empty($phone)) {
        echo "Please fill all the fields";
        exit();
    }

    $db = new Database();
    $conn = $db->getCon();

    $sql = "INSERT INTO users (f_name, l_name, b_day, gender, address, email, contact_no) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Check for successful preparation of the statement
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("sssssss", $firstName, $lastName, $birthday, $gender, $address, $email, $phone);

        // Execute the statement
        if ($stmt->execute()) {
            echo "User added successfully.";
        } else {
            echo "Error executing insertion query: " . $stmt->error;
        }
    } else {
        echo "Error preparing insertion statement: " . $conn->error;
    }
}
?>