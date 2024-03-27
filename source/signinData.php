<?php
// Include config file
require_once "config.php";

if(isset($_POST)){
    $data = file_get_contents("php://input");
    $record = json_decode($data,true);

    $userName = $record["userName"];
    $passKey = $record["passKey"];

   
    // Prepare an insert statement
    $sql = "INSERT INTO signinData(UserName, PassKey) VALUES (?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_userName, $param_passKey);

        // Set parameters
        $param_userName = $userName;
        $param_passKey = $passKey;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records created successfully.
            echo $userName;
            echo $passKey;
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

?>

