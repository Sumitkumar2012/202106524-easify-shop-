<?php
// Include config file
require_once "config.php";

if(isset($_POST)){
    $data = file_get_contents("php://input");
    $record = json_decode($data,true);

    $userName = $record["userName"];
    $userInterface = $record["userInterface"];
    $suggestion = $record["suggestion"];

   
    // Prepare an insert statement
    $sql = "INSERT INTO feedbackData(UserName, UserInterface, Suggestion) VALUES (?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sss", $param_userName, $param_userInterface, $param_suggestion);

        // Set parameters
        $param_userName = $userName;
        $param_userInterface = $userInterface;
        $param_suggestion = $suggestion;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records created successfully.
            echo $userName;
            echo $userInterface;
            echo $suggestion;
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

?>

