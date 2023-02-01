<?php
include("include/auth_session.php");
require('include/db.php');
$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";
$errorMesssage = "";
$succsessMessage = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: Show the data of the client
    if (!isset($_GET['id'])) {
        header("location: home.php");
        exit;
    }
    $id = $_GET["id"];
    // Read the row of the selected client from database table
    $sql = "SELECT * FROM clients WHERE id=$id";
    // Execute SQL query
    $result = $conn->query($sql);
    // Read the data of the client from database
    $row = $result->fetch_assoc();
    if (!$row) {
        header("location: home.php");
        exit;
    }
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
} else {
    // POST method: Update the data of the client
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    do {
        if (empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMesssage = "All the fields are required";
            break;
        }
        // Update 
        $sql = " UPDATE clients " . " SET name = '$name', email = '$email', phone = '$phone', address = '$address' " .
            "WHERE id = $id";
        $result = $conn->query($sql);
        if (!$result) {
            $errorMesssage = " Invalid query: " . $conn->error;
            break;
        }
        $succsessMessage = "Client updated successfully";
        header("location: home.php");
    } while (false);
}
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Create</title>
</head>
<body>
    <div class="container my-5"></div>
    <div class="row mb-3">
        <h2>New Client</h2>
    </div>
    <?php
    if (!empty($errorMesssage)) {
        echo "
        <div class='row mb-3'> 
            <div class='offset-sm-3 col-sm-6'>
<div class='alert alert-warning alert-dismissible fade show' role='alert'>
<strong>$errorMesssage</strong>
<button type='button' class='btn-close' 'data-bs-dismiss='alert' aria-label='close' ></button>
</div> 
</div>
</div>
";
    }

    ?>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="row mb-3">
            <label class="col-sm-1 offset-md-1">Name</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-1 col-form-label offset-md-1">Email</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="email" value="<?php echo $email ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-1 offset-md-1">Phone</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="phone" value="<?php echo $phone ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-1 offset-md-1">Address</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="address" value="<?php echo $address ?>">
            </div>
        </div>
        <?php
        if (!empty($succsessMessage)) {
            echo "
            <div class='row mb-3'> 
            <div class='offset-sm-3 col-sm-6'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$succsessMessage</strong>
                    <button type='button' class='btn-close' data-bs-dissmiss='alert' aria-label='close'></button>
                </div>
            </div>
        </div>
            ";
        }
        ?>
        <div class="row mp-3">
            <div class="offset-sm-2 col-sm-1 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-1 d-grid">
                <a class="btn btn-outline-primary" href="home.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
</body>
</html>