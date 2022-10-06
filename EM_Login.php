<!DOCTYPE html>
<?php
session_start();
include 'dbconn.php';

$queryTrip = "SELECT * from Password_table";
$resultTrip = mysqli_query($link, $queryTrip) or die(mysqli_error($link));
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="css/login.css" rel="stylesheet" type="text/css"/>
        <link rel='stylesheet' href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no" >
        <script>
            $(document).ready(function () {
                $("select#trips").change(function () {
                    $("input#password").removeAttr("disabled");
                });


                $("input#submit").click(function () {
                    var password = $("input#password").val();
                    var trip = $("select#trips").val();
                    $.ajax({
                        type: "POST",
                        url: "doLogin.php",
                        data: "trip=" + trip + "&password=" + password,
                        cache: false,
                        dataType: "JSON",
                        success: function (response) {
                            if (response.authenticated === true) {
                                localStorage.setItem("authenticated", response.authenticated);
                                $.ajax({
                                    type: "GET",
                                    url: "getTrips.php",
                                    cache: false,
                                    dataType: "JSON",
                                    success: function (x) {
                                        if (response.Trip == x[0].Trip){
                                            window.location = "EM.php"
                                        } else if (response.Trip == x[1].Trip) {
                                            window.location = "EM_Taiwan.php";
                                        } else if (response.Trip == x[2].Trip){
                                            window.location = "KR/EM_Korea.php";
                                        }
                                        for (var i = 3; i < x.length; i++ ){
                                            if (response.Trip == x[i].Trip){
                                                window.location = "ComingSoon.php";
                                            }
                                        }
                                    },
                                    error: function (obj, textStatus, errorThrown) {
                                        console.log("Error " + textStatus + ": " + errorThrown);
                                    }
                                });
//                                if (response.Trip == "1") {
//                                    window.location = "EM.php";
//                                } else if (response.Trip === "2") {
//                                    window.location = "ComingSoon.php";
//                                } else if (response.Trip === "3") {
//                                    window.location = "ComingSoon.php";
//                                } else if (response.Trip === "4") {
//                                    window.location = "ComingSoon.php";
//                                } else {
//                                    alert("Error no such trips!");
//                                }

                            } else {
                                localStorage.setItem("authenticated", response.authenticated);
                                var password = $("input#password").val("");
                                alert("You have entered the wrong password!");
                            }
                        },
                        error: function (obj, textStatus, errorThrown) {
                            console.log("Error " + textStatus + ": " + errorThrown);
                        }
                    });
                });
            });

        </script>
    </head>
    <body>
        <h1 align="center" style="font-family: Arial;">Expenses Management</h1>
        <div align="center" id="trip" >
            <select id="trips" style="border-radius: 8px;">
                <option  hidden disabled selected value="0" style="font-family: Arial;">Select Trip</option>
                <?php while ($rowTrips = mysqli_fetch_array($resultTrip)) { ?>
                <option value="<?php echo $rowTrips["Trip"]; ?>" style="font-family: Arial;"><?php echo $rowTrips["Trip"]; ?></option>
                <?php } ?>
            </select>    
        </div>
        <br/>
        <div align="center" id="password">
            <input type="password" id="password" name="password" disabled/>
        </div>
        <div align="center" id="submit" style="margin-top: 10px;">
            <input type="button" id="submit" value="Login" style="font-family: Arial;" />
        </div>
    </body>
</html>
