<!DOCTYPE html>
<?php
include 'dbconn.php';
$queryMember = "SELECT Member_ID, Members from group_member_tw WHERE Group_name = 'Group A'";
$resultMembers = mysqli_query($link, $queryMember) or die(mysqli_error($link));

$queryMember1 = "SELECT Member_ID, Members from group_member_tw WHERE Group_name = 'Group A'";
$resultMember1 = mysqli_query($link, $queryMember1) or die(mysqli_error($link));

$queryMember2 = "SELECT Member_ID, Members from group_member_tw WHERE Group_name = 'Group A'";
$resultMembers2 = mysqli_query($link, $queryMember2) or die(mysqli_error($link));

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
        <title>Total Expenses</title>
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
            $(document).ready(function () {
                $('br').remove();
                //Total JPY
                $.ajax({
                    type: "POST",
                    url: "getTWTotalExpenses.php",
                    data: "currency=TWD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].totalAmt != null) {
                            $("caption#tableTWD").text("Total Expenses till date: " + response[0].Currency + " " + response[0].totalAmt);
                        } else {
                            $("h3#totalTWD").text("Total Expenses till date: TWD 0.00");
                            $("table#tableTWD").hide();
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });

                //Total SGD
                $.ajax({
                    type: "POST",
                    url: "getTWTotalExpenses.php",
                    data: "currency=SGD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].totalAmt != null) {
                            $("caption#tableSGD").text("Total Expenses till date: " + response[0].Currency + " " + response[0].totalAmt);
                        } else {
                            $("h3#totalSGD").text("Total Expenses till date: SGD 0.00");
                            $("table#tableSGD").hide();
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });

                //Member 1 TWD
                $.ajax({
                    type: "POST",
                    url: "getTotalTWExpensesByMember.php",
                    data: "memberID=1&currency=TWD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].mPaid != null || response[0].mOwes != null) {
                            $("td#p1").text(response[0].Currency + " " + response[0].mPaid);
                            if (response[0].mOwes > 0) {
                                $("td#o1").text(response[0].Currency + " " + response[0].mOwes);
                                $("td#o1").css({"color": "red", "font-family": "Arial"});
                            } else {
                                $("td#o1").text(response[0].Currency + " " + response[0].mOwes);
                            }
                        } else {
                            $("td#p1").text("TWD 0.00");
                            $("td#o1").text("TWD 0.00");
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });

                //Member 2 TWD
                $.ajax({
                    type: "POST",
                    url: "getTotalTWExpensesByMember.php",
                    data: "memberID=2&currency=TWD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].mPaid != null || response[0].mOwes != null) {
                            $("td#p2").text(response[0].Currency + " " + response[0].mPaid);
                            if (response[0].mOwes > 0) {
                                $("td#o2").text(response[0].Currency + " " + response[0].mOwes);
                                $("td#o2").css({"color": "red", "font-family": "Arial"});
                            } else {
                                $("td#o2").text(response[0].Currency + " " + response[0].mOwes);
                            }
                        } else {
                            $("td#p2").text("TWD 0.00");
                            $("td#o2").text("TWD 0.00");
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });

                //Member 3 TWD
                $.ajax({
                    type: "POST",
                    url: "getTotalTWExpensesByMember.php",
                    data: "memberID=3&currency=TWD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].mPaid != null || response[0].mOwes != null) {
                            $("td#p3").text(response[0].Currency + " " + response[0].mPaid);
                            if (response[0].mOwes > 0) {
                                $("td#o3").text(response[0].Currency + " " + response[0].mOwes);
                                $("td#o3").css({"color": "red", "font-family": "Arial"});
                            } else {
                                $("td#o3").text(response[0].Currency + " " + response[0].mOwes);
                            }
                        } else {
                            $("td#p3").text("TWD 0.00");
                            $("td#o3").text("TWD 0.00");
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });

                //Member 4 TWD
                $.ajax({
                    type: "POST",
                    url: "getTotalTWExpensesByMember.php",
                    data: "memberID=4&currency=TWD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].mPaid != null || response[0].mOwes != null) {
                            $("td#p4").text(response[0].Currency + " " + response[0].mPaid);
                            if (response[0].mOwes > 0) {
                                $("td#o4").text(response[0].Currency + " " + response[0].mOwes);
                                $("td#o4").css({"color": "red", "font-family": "Arial"});
                            } else {
                                $("td#o4").text(response[0].Currency + " " + response[0].mOwes);
                            }
                        } else {
                            $("td#p4").text("TWD 0.00");
                            $("td#o4").text("TWD 0.00");
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });

                //Member 5 TWD
                $.ajax({
                    type: "POST",
                    url: "getTotalTWExpensesByMember.php",
                    data: "memberID=5&currency=TWD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].mPaid != null || response[0].mOwes != null) {
                            $("td#p5").text(response[0].Currency + " " + response[0].mPaid);
                            if (response[0].mOwes > 0) {
                                $("td#o5").text(response[0].Currency + " " + response[0].mOwes);
                                $("td#o5").css({"color": "red", "font-family": "Arial"});
                            } else {
                                $("td#o5").text(response[0].Currency + " " + response[0].mOwes);
                            }
                        } else {
                            $("td#p5").text("TWD 0.00");
                            $("td#o5").text("TWD 0.00");
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });

                //Member 6 TWD
                $.ajax({
                    type: "POST",
                    url: "getTotalTWExpensesByMember.php",
                    data: "memberID=6&currency=TWD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].mPaid != null || response[0].mOwes != null) {
                            $("td#p6").text(response[0].Currency + " " + response[0].mPaid);
                            if (response[0].mOwes > 0) {
                                $("td#o6").text(response[0].Currency + " " + response[0].mOwes);
                                $("td#o6").css({"color": "red", "font-family": "Arial"});
                            } else {
                                $("td#o6").text(response[0].Currency + " " + response[0].mOwes);
                            }
                        } else {
                            $("td#p6").text("TWD 0.00");
                            $("td#o6").text("TWD 0.00");
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });

                //Member 7 TWD
                $.ajax({
                    type: "POST",
                    url: "getTotalTWExpensesByMember.php",
                    data: "memberID=7&currency=TWD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].mPaid != null || response[0].mOwes != null) {
                            $("td#p7").text(response[0].Currency + " " + response[0].mPaid);
                            if (response[0].mOwes > 0) {
                                $("td#o7").text(response[0].Currency + " " + response[0].mOwes);
                                $("td#o7").css({"color": "red", "font-family": "Arial"});
                            } else {
                                $("td#o7").text(response[0].Currency + " " + response[0].mOwes);
                            }
                        } else {
                            $("td#p7").text("TWD 0.00");
                            $("td#o7").text("TWD 0.00");
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });
                //Member 1 SGD
                $.ajax({
                    type: "POST",
                    url: "getTotalTWExpensesByMember.php",
                    data: "memberID=1&currency=SGD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].mPaid != null || response[0].mOwes != null) {
                            $("td#pa1").text(response[0].Currency + " " + response[0].mPaid);
                            if (response[0].mOwes > 0) {
                                $("td#ow1").text(response[0].Currency + " " + response[0].mOwes);
                                $("td#ow1").css({"color": "red", "font-family": "Arial"});
                            } else {
                                $("td#ow1").text(response[0].Currency + " " + response[0].mOwes);
                            }
                        } else {
                            $("td#pa1").text("SGD 0.00");
                            $("td#ow1").text("SGD 0.00");
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });

                //Member 2 SGD
                $.ajax({
                    type: "POST",
                    url: "getTotalTWExpensesByMember.php",
                    data: "memberID=2&currency=SGD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].mPaid != null || response[0].mOwes != null) {
                            $("td#pa2").text(response[0].Currency + " " + response[0].mPaid);
                            if (response[0].mOwes > 0) {
                                $("td#ow2").text(response[0].Currency + " " + response[0].mOwes);
                                $("td#ow2").css({"color": "red", "font-family": "Arial"});
                            } else {
                                $("td#ow2").text(response[0].Currency + " " + response[0].mOwes);
                            }
                        } else {
                            $("td#pa2").text("SGD 0.00");
                            $("td#ow2").text("SGD 0.00");
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });

                //Member 3 SGD
                $.ajax({
                    type: "POST",
                    url: "getTotalTWExpensesByMember.php",
                    data: "memberID=3&currency=SGD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].mPaid != null || response[0].mOwes != null) {
                            $("td#pa3").text(response[0].Currency + " " + response[0].mPaid);
                            if (response[0].mOwes > 0) {
                                $("td#ow3").text(response[0].Currency + " " + response[0].mOwes);
                                $("td#ow3").css({"color": "red", "font-family": "Arial"});
                            } else {
                                $("td#ow3").text(response[0].Currency + " " + response[0].mOwes);
                            }
                        } else {
                            $("td#pa3").text("SGD 0.00");
                            $("td#ow3").text("SGD 0.00");
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });

                //Member 4 SGD
                $.ajax({
                    type: "POST",
                    url: "getTotalTWExpensesByMember.php",
                    data: "memberID=4&currency=SGD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].mPaid != null || response[0].mOwes != null) {
                            $("td#pa4").text(response[0].Currency + " " + response[0].mPaid);
                            if (response[0].mOwes > 0) {
                                $("td#ow4").text(response[0].Currency + " " + response[0].mOwes);
                                $("td#ow4").css({"color": "red", "font-family": "Arial"});
                            } else {
                                $("td#ow4").text(response[0].Currency + " " + response[0].mOwes);
                            }
                        } else {
                            $("td#pa4").text("SGD 0.00");
                            $("td#ow4").text("SGD 0.00");
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });

                //Member 5 SGD
                $.ajax({
                    type: "POST",
                    url: "getTotalTWExpensesByMember.php",
                    data: "memberID=5&currency=SGD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].mPaid != null || response[0].mOwes != null) {
                            $("td#pa5").text(response[0].Currency + " " + response[0].mPaid);
                            if (response[0].mOwes > 0) {
                                $("td#ow5").text(response[0].Currency + " " + response[0].mOwes);
                                $("td#ow5").css({"color": "red", "font-family": "Arial"});
                            } else {
                                $("td#ow5").text(response[0].Currency + " " + response[0].mOwes);
                            }
                        } else {
                            $("td#pa5").text("SGD 0.00");
                            $("td#ow5").text("SGD 0.00");
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });

                //Member 6 SGD
                $.ajax({
                    type: "POST",
                    url: "getTotalTWExpensesByMember.php",
                    data: "memberID=6&currency=SGD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].mPaid != null || response[0].mOwes != null) {
                            $("td#pa6").text(response[0].Currency + " " + response[0].mPaid);
                            if (response[0].mOwes > 0) {
                                $("td#ow6").text(response[0].Currency + " " + response[0].mOwes);
                                $("td#ow6").css({"color": "red", "font-family": "Arial"});
                            } else {
                                $("td#ow6").text(response[0].Currency + " " + response[0].mOwes);
                            }
                        } else {
                            $("td#pa6").text("SGD 0.00");
                            $("td#ow6").text("SGD 0.00");
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });

                //Member 7 SGD
                $.ajax({
                    type: "POST",
                    url: "getTotalTWExpensesByMember.php",
                    data: "memberID=7&currency=SGD",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response[0].Currency != null || response[0].mPaid != null || response[0].mOwes != null) {
                            $("td#pa7").text(response[0].Currency + " " + response[0].mPaid);
                            if (response[0].mOwes > 0) {
                                $("td#ow7").text(response[0].Currency + " " + response[0].mOwes);
                                $("td#ow7").css({"color": "red", "font-family": "Arial"});
                            } else {
                                $("td#ow7").text(response[0].Currency + " " + response[0].mOwes);
                            }
                        } else {
                            $("td#pa7").text("SGD 0.00");
                            $("td#ow7").text("SGD 0.00");
                        }
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });
            });
        </script>
    </head>
    <body>
        <div id="tableTWD" style="border: 1px solid black; background-color: lightgrey;">
            <h3 id="totalTWD" align="center" style="font-family: Arial;"></h3>
            <table id="tableTWD">
                <caption id="tableTWD" style="font-family: Arial;">Total Expense till date: </caption>
                <?php while ($rowMembers = mysqli_fetch_array($resultMembers)) { ?>
                    <tr>
                        <th style="font-family: Arial;"><?php echo $rowMembers["Members"]; ?> Paid</th>
                        <td id="p<?php echo $rowMembers["Member_ID"]; ?>" style="color: black; font-family: Arial;">0.00</td>
                    </tr>
                    <tr>
                        <td style="font-family: Arial;">Owes</td>
                        <td id="o<?php echo $rowMembers["Member_ID"]; ?>" style="font-family: Arial;">0.00</td><br/>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div id="tableSGD" style="margin-top:10px; border: 1px solid black; background-color: lightgrey;">
            <h3 id="totalSGD" align="center" style="font-family: Arial;"></h3>
            <table id="tableSGD">
                <caption id="tableSGD" style="font-family: Arial;">Total Expense till date: </caption>
                <?php while ($rowMembers = mysqli_fetch_array($resultMembers2)) { ?>
                    <tr>
                        <th style="font-family: Arial;"><?php echo $rowMembers["Members"]; ?> Paid</th>
                        <td id="pa<?php echo $rowMembers["Member_ID"]; ?>" style="color: black; font-family: Arial;">0.00</td>
                    </tr>
                    <tr>
                        <td style="font-family: Arial;">Owes</td>
                        <td id="ow<?php echo $rowMembers["Member_ID"]; ?>" style="font-family: Arial;">0.00</td><br/>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <input type="button" id="done" value="Done" style="margin-top: 15px; font-family: Arial;" onclick="window.location = 'EM_Taiwan.php'"/>
    </body>
</html>
