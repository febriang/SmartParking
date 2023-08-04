<?php
require 'cek_login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>IoT</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="https://img1.wsimg.com/isteam/ip/e9c1bdab-ef67-4abe-9ce0-82a400c73871/iot%20based-0001.jpg">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- font awesome -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-color: "white";
            font-family: 'Poppins', sans-serif;
        }

        .card {
            width: 350px;
            background-color: #31068a;
        }

        .card:hover {
            box-shadow: rgba(226, 226, 230, 0.2) 0px 7px 29px 0px;
        }

        .nav-link {
            color: white;
            font-weight: bold;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #dfc5f7;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Function to update parking status
            function updateParkingStatus() {
                $.ajax({
                    url: "get_parking_status.php", // File PHP untuk mengambil data dari database
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        // Memperbarui status parkir pada halaman
                        $("#parking1-status").text(response.parking1);
                        $("#parking2-status").text(response.parking2);
                        $("#parking3-status").text(response.parking3);

                        if (response.parking1 === "Terisi") {
                            $("#parking1-status").css("color", "red");
                        } else {
                            $("#parking1-status").css("color", "#00DFA2");
                        }
                        if (response.parking2 === "Terisi") {
                            $("#parking2-status").css("color", "red");
                        } else {
                            $("#parking2-status").css("color", "#00DFA2");
                        }
                        if (response.parking3 === "Terisi") {
                            $("#parking3-status").css("color", "red");
                        } else {
                            $("#parking3-status").css("color", "#00DFA2");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
            // Memanggil fungsi updateParkingStatus setiap 2 detik
            setInterval(updateParkingStatus, 1000);
        });
    </script>


</head>

<body>
    <div class="container vh-100">
        <div class="row justify-content-center h-100">
            <div class="card my-auto">
                <div class="card-header text-center text-white">
                    <img src="https://img1.wsimg.com/isteam/ip/e9c1bdab-ef67-4abe-9ce0-82a400c73871/iot%20based-0001.jpg" style="width: 300px; height: 200px; padding: 10px;">
                    <h4>Smart Parking</h4>
                    <hr class="text-white">
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col">
                            <h5 style="color: white;">Parking 1</h5>
                            <div class="d-flex align-items-center">
                                <p style="color: white; margin-right: 10px;">Status:</p>
                                <p id="parking1-status" style="color: white; font-weight: bold;">Loading</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5 style="color: white;">Parking 2</h5>
                            <div class="d-flex align-items-center">
                                <p style="color: white; margin-right: 10px;">Status:</p>
                                <p id="parking2-status" style="color: white; font-weight: bold;;">Loading</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5 style="color: white;">Parking 3</h5>
                            <div class="d-flex align-items-center">
                                <p style="color: white; margin-right: 10px;">Status:</p>
                                <p id="parking3-status" style="color: white; font-weight: bold;">Loading</p>
                            </div>
                        </div>
                    </div>
                    <hr class="text-white">
                    <center>
                        <a class="nav-link" href="logout.php">
                            Logout
                        </a>
                    </center>
                </div>
            </div>
        </div>
    </div>
</body>

</html>