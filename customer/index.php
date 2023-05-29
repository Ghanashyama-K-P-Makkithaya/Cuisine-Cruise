<?php

session_start();

include("../connections.php");
include("../helpers.php");

$userdata = check_login(($con));

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/icons/online-delivery.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./stylesheet/index.css">
    <title>OFDMS</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <?php
            include('header.php');
            ?>
        </nav>
    </header>


    <main class="main-content">
        <h1 class="text-center text-white">Restaurants</h1>       
        <div class="container-fluid">
            <div class="intro-section">
                <div class="row row-cols-1 row-cols-md-3 g-4">

                    <?php
                    $query_res = "SELECT * FROM restaurant";
                    $res_details = mysqli_query($con, $query_res);
                    while ($entry = mysqli_fetch_array($res_details)) {
                        echo '<div class="col-auto ">
                        <div class="card h-100">
                            <img src="' . $entry['RImg'] . '" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">' . $entry['RName'] . '</h5>
                                <h5 class="card-title">' . $entry['RType'] . '</h5>
                                <p class="card-text">' . $entry['Address'] . '.</p><a href="./food.php?q=' . $entry['RId'] . '" class="stretched-link""></a>
                            </div>
                        </div>
                    </div>';
                    }
                    ?>


                </div>
            </div>
        </div>
    </main>


</body>

</html>