<?php
require_once("../assets/connection.php");

if (isset($_POST["action"])) {
    if ($_POST["action"] == "add") {
        $matricID = mysqli_real_escape_string($conn, $_POST["matricID"]);
        $staffID = mysqli_real_escape_string($conn, $_POST["staffID"]);
        $tool = mysqli_real_escape_string($conn, $_POST["tool"]);
        $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
        $date = date("Y-m-d");
        $time = date("H:m:s");

        $iloan = mysqli_query($conn, "INSERT INTO loans (lnMatricID, lnStaffID, lnTool, lnQuantity, lnStartDate, lnStartTime) VALUES ('{$matricID}', '{$staffID}', '{$tool}', '{$quantity}', '{$date}', '{$time}') ");

        if ($iloan) {
            $getToolLeft = mysqli_query($conn, "SELECT tlLeft FROM tools WHERE tlID = '{$tool}'");
            $fetchToolLeft = mysqli_fetch_assoc($getToolLeft);
            $tlLeft = $fetchToolLeft['tlLeft'];
            $left = $tlLeft - $quantity;
            $utool = mysqli_query($conn, "UPDATE tools SET tlLeft = '$left' WHERE tlID = '$tool'");
        } else {
            echo mysqli_error($conn);
        }
    }
}
