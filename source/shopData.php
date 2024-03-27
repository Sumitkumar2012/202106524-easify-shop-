<?php
// Include config file
require_once "config.php";

if(isset($_POST)){
    $data = file_get_contents("php://input");
    $record = json_decode($data,true);

    $userName = $record["userName"];
    $productId = $record["productId"];
    $productName = $record["productName"];
    $quantity = $record["quantity"];
    $unitPrice = $record["unitPrice"];
    $totalPrice = $record["totalPrice"];

   
    // Prepare an insert statement
    $sql = "INSERT INTO customerData(UserName, ProductId, ProductName, Quantity, UnitPrice, TotalPrice) VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sisiss", $param_name, $param_productId, $param_productName, $param_quantity, $param_unitPrice, $param_totalPrice);

        // Set parameters
        $param_name = $userName;
        $param_productId = $productId;
        $param_productName = $productName;
        $param_quantity = $quantity;
        $param_unitPrice = $unitPrice;
        $param_totalPrice = $totalPrice;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records created successfully. Redirect to landing page
            echo $userName;
            echo $productId;
            echo $productName;
            echo $quantity;
            echo $unitPrice;
            echo $totalPrice;
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

?>

