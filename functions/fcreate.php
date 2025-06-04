<?php
if (isset($_POST['btnCreate'])) {
    $admName  = mysqli_real_escape_string($conn, $_POST['admName']);
    $admEmail  = mysqli_real_escape_string($conn, $_POST['admEmail']);
    $admPhone  = mysqli_real_escape_string($conn, $_POST['admPhone']);
    $admPwd  = mysqli_real_escape_string($conn, $_POST['admPwd']);
    $confirmPwd  = mysqli_real_escape_string($conn, $_POST['confirmPwd']);

    if ($admPwd != $confirmPwd) {
        echo "<script>alert('Password Mismatch')</script>";
    }

    $hashed = password_hash($admPwd, PASSWORD_BCRYPT);

    $iadm = mysqli_query($conn, "INSERT INTO admins (admName, admPwd, admEmail, admPhone, admDepartment) VALUES ('$admName', '$hashed', '$admEmail', '$admPhone', 'Creator')");

    if ($iadm) {
        //echo "<script>alert('Administrator Added')</script>";
    } else {
        // echo mysqli_error($conn); //this is used to check error
        echo "<script>alert('Add Administrator Failed. Please Try Again')</script>";
    }
}
