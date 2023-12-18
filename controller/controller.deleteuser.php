<?php

include_once("../services/services.database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["user_id_form"];

    if (empty($userId)) {
        echo "User ID is missing.";
        exit();
    }

    $db = new Database();
    $conn = $db->getCon();

    $sql = "DELETE FROM users WHERE user_id=?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Check for successful preparation of the statement
    if ($stmt) {
        // Bind parameter
        $stmt->bind_param("s", $userId);

        // Execute the statement
        if ($stmt->execute()) {
            echo "User deleted successfully.";
        } else {
            echo "Error executing deletion query: " . $stmt->error;
        }
    } else {
        echo "Error preparing deletion statement: " . $conn->error;
    }
}
?>