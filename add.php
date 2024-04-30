<?php
global $conn;
include('Connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Full_Name = mysqli_real_escape_string($conn, $_POST['Full_Name']);
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Phone_Number = mysqli_real_escape_string($conn, $_POST['Phone_Number']);
    $Product_Name = mysqli_real_escape_string($conn, $_POST['Product_Name']);
    $Specs = mysqli_real_escape_string($conn, $_POST['Specs']);
    $Price = mysqli_real_escape_string($conn, $_POST['Price']);

    $sql = "INSERT INTO Product_sales (Full_Name, Email, Phone_Number, Product_Name, Specs, Price) VALUES ('$Full_Name', '$Email', '$Phone_Number', '$Product_Name', '$Specs', '$Price')";
//    $sql1 = "INSERT INTO Seller (Full_Name, Email, Phone_Number) SELECT ('$Full_Name', '$Email', '$Phone_Number') FROM Product_sales ";
//    $sql2 = "INSERT INTO Product ( Product_Name, Specs, Price) SELECT ('$Product_Name', '$Specs', '$Price') FROM Product_sales ";
    mysqli_query($conn, $sql);

    $sql1 = "INSERT INTO Product (Product_Name, Specs, Price) VALUES ('$Product_Name', '$Specs', '$Price')";

// Execute the first query
    mysqli_query($conn, $sql1);

// Second SQL statement to insert into Seller
    $sql2 = "INSERT INTO Seller (Full_Name, Email, Phone_Number) SELECT Full_Name, Email, Phone_Number FROM Product_sales";

// Execute the second query
    if (mysqli_query($conn, $sql2)) {
//        echo "Record added successfully";
        header('location: index.php');

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

//}

//        $sql = "INSERT INTO pizzas (email, title, ingredients) VALUES ('$email', '$title', '$ingredients')";

//if (isset($_POST['submit'])) {

//    $sql = "INSERT INTO Product_sales (Full_Name, Email, Phone_Number, Product_Name, Specs, Price) VALUES ('$Full_Name', '$Email', '$Phone_Number', '$Product_Name', '$Specs', '$Price')";
//    print_r($sql)
//    if (mysqli_query($conn, $sql)) {
//
//    }else {
//        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//    }
//};

?>


<!doctype html>
<html lang="en">
<head>
    <title>Add Product</title>
</head>
<body>
<?php include "templates/header.php" ?>
<section class="container blue-text text-darken-4">
    <h4 class="center">Add Product</h4>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="white">
        <label for="">Full Name</label>
        <input type="text" name="Full_Name" value="<?php echo htmlspecialchars($Full_Name) ?>">
        <div class="red-text"></div>
        <label for="">Your Email</label>
        <input type="text" name="Email" value="<?php echo htmlspecialchars($Email) ?>">
        <div class="red-text"></div>
        <label for="">Phone Number</label>
        <input type="text" name="Phone_Number" value="<?php echo htmlspecialchars($Phone_Number) ?>">
        <div class="red-text"></div>
        <label for="">Product Title</label>
        <input type="text" name="Product_Name" value="<?php echo htmlspecialchars($Product_Name) ?>">
        <div class="red-text"></div>
        <label for="">Specs</label>
        <input type="text" name="Specs" value="<?php echo htmlspecialchars($Specs) ?>">
        <div class="red-text"></div>
        <label for="">Price</label>
        <input type="text" name="Price" value="<?php echo htmlspecialchars($Price) ?>">
        <div class="red-text"></div>

        <div class="center">
            <input type="submit" name="submit" value="Add" class="btn brand z-depth-0">
        </div>
    </form>
</section>
<?php include "templates/footer.php" ?>

</body>
</html>
