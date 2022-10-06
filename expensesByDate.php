<!DOCTYPE html>
<?php
$date = $_GET['date'];

include 'dbconn.php';

$queryMembers = "SELECT Member_ID, Members from group_member WHERE Group_name = 'Group A'";
$resultMembers = mysqli_query($link, $queryMembers) or die(mysqli_error($link));

$queryMember1 = "SELECT Member_ID, Members from group_member WHERE Group_name = 'Group A' ORDER BY Member_ID ASC";
$resultMember1 = mysqli_query($link, $queryMember1) or die(mysqli_error($link));

$member = array();
while ($row = mysqli_fetch_assoc($resultMember1)) {
    $member[] = $row;
}
mysqli_close($link);

$arrayMembers = json_encode($member);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Expenses By Date</title>
        <link rel='stylesheet' href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no" >
        <style>
            label,input{
                font-size: 20px;
            }
            table,th,td{
                border: 1px solid black;
                border-collapse: collapse;
                font-size: 20px;
            }

            table{
                width: 100%;
            }

            /* ----------- iPad 1, 2, Mini and Air ----------- */

            /* Portrait */
            @media only screen 
            and (min-device-width: 768px) 
            and (max-device-width: 1024px) 
            and (orientation: portrait) 
            and (-webkit-min-device-pixel-ratio: 1) {
                label,input{
                    font-size: 40px;
                }
                table,th,td{
                    border: 1px solid black;
                    border-collapse: collapse;
                }
            }

            /* ----------- iPad 3, 4 and Pro 9.7" ----------- */

            /* Portrait */
            @media only screen 
            and (min-device-width: 768px) 
            and (max-device-width: 1024px) 
            and (orientation: portrait) 
            and (-webkit-min-device-pixel-ratio: 2) {
                label,input{
                    font-size: 40px;
                }
                table,th,td{
                    border: 1px solid black;
                    border-collapse: collapse;
                }

            }
        </style>
        <script>
            function load() {
                $.ajax({
                    type: "GET",
                    url: "getTotalExpensesByDate.php",
                    data: "date=" + '<?php echo $date ?>',
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response.length != 0) {
                            var total = 0;
                            for (var i = 0; i < response.length; i++) {
                                var amount = parseFloat(response[i].Amt);
                                total += amount;
                            }
                            var currency = response[0].Currency;
                            $("label#totalAmt").text(currency + total.toFixed(2));
                        } else {
                            $("label#totalAmt").text("0.00");
                            $("table").hide();
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });
                var memberArray = <?php echo $arrayMembers; ?>;
                var array = [];
                var pArray = [];
                for (var x = 0; x < memberArray.length; x++) {
                    $.ajax({
                        type: "POST",
                        url: "getPortionByDate.php",
                        data: "date=" + '<?php echo $date ?>' + "&memberID=" + (x+1),
                        cache: false,
                        dataType: "JSON",
                        success: function (response) {
                            if (response.length != 0) {
                                var pAmt = 0;
                                var totalAmt = 0;
                                for (var i = 0; i < response.length; i++) {
                                    var amount = parseFloat(response[i].Member_paid);
                                    var portionAmt = parseFloat(response[i].Member_owes);
                                    pAmt += portionAmt;
                                    totalAmt += amount;
                                }
                                pArray.push(pAmt.toFixed(2));
                                array.push(totalAmt.toFixed(2));

                                var memberArray1 = <?php echo $arrayMembers; ?>;
                                var currency = response[0].Currency;
                                var message = "";
                                for (var z = 0; z < memberArray1.length; z++) {
                                    message += "<tr><th>" + memberArray1[z].Members + " Paid</th>";
                                    if (array[z] != null) {
                                        message += "<td>" + currency + " " + array[((memberArray1[z].Member_ID)-1)] + "</td></tr>";
                                    } else {
                                        message += "<td>" + currency + " 0.00" + "</label></td></tr>";
                                    }
                                    message += "<td>Owes</td>"
                                    if (pArray[z] != null) {
                                        if (pArray[z] > 0) {
                                            message += "<td><label style='color: red;'>" + currency + " " + pArray[((memberArray1[z].Member_ID)-1)] + "</label></td></tr>";                                            
                                        } else {
                                            message += "<td>" + currency + " 0.00</td></tr>";
                                        }
                                    } else {
                                        message += "<td>" + currency + " 0.00" + "</td></tr>";
                                    }
                                }
                                $("table").html(message);
                            }
                        },
                        error: function (obj, textStatus, errorThrown) {
                            console.log("Error " + textStatus + ": " + errorThrown);
                        }
                    });
                }
            }
            $(document).ready(function () {
                load();
            });
        </script>
    </head>
    <body>
        <div align="center" style="background-color: lightgrey;">
            <br/>
            <label>Date: </label>
            <label id="date"><?php echo $date; ?></label>
            <br/>
            <label>Total Expense: </label><label id="totalAmt">0.00</label>
            <table>
            </table>
            <br/>
        </div>
        <input type="button" id="done" value="Done" style="margin-top: 15px;" onclick="window.location = 'EM.php'"/>

    </body>
</html>
