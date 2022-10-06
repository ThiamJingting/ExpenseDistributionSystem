<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Expense Management</title>
        <!-- Required meta tags -->   
        <link rel='stylesheet' href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no" >
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script>
            function reloadTable() {

                var message = "";
                $.ajax({
                    type: "GET",
                    url: "getKRExpensesRow.php",
                    cache: false,
                    dataType: "JSON",
                    success: function (x) {
                        var count = x.length;
                        $.ajax({
                            type: "POST",
                            url: "getKRExpensesItemById.php",
                            cache: false,
                            dataType: "JSON",
                            success: function (response) {
                                if (response.length != 0) {
                                    for (var i = 0; i < count; i++) {
                                        message += "<tr style='background-color: white;'><td>";
                                        message += "Expenses ID:" + x[i].Exp_ID;
                                        if (x[i].Type == "1") {
                                            message += "<img src='img/food.png' alt='food' width='70px' height='70px' align='right' style='margin: 10px;'>";
                                        } else if (x[i].Type == "2") {
                                            message += "<img src='img/transport.png' alt='transport' width='70px' height='70px' align='right' style='margin: 10px;'>";
                                        } else if (x[i].Type == "3") {
                                            message += "<img src='img/shopping.png' alt='shopping' width='70px' height='70px' align='right' style='margin: 10px;'>";
                                        } else if (x[i].Type == "4") {
                                            message += "<img src='img/entertainment.png' alt='entertainment' width='70px' height='70px' align='right' style='margin: 10px;'>";
                                        } else if (x[i].Type == "5") {
                                            message += "<img src='img/accomodation.png' alt='accomodation' width='70px' height='70px' align='right' style='margin: 10px;'>";
                                        } else if (x[i].Type == "6") {
                                            message += "<img src='img/misc.png' alt='misc' width='70px' height='70px' align='right' style='margin: 10px;'>";
                                        }
                                        message += "<br/>Description: " + x[i].Description +
                                                "<br/>Date: " + x[i].Date +
                                                "<br/>Total Amount:" + x[i].Currency +
                                                " " + x[i].Amt;
                                        for (var z = 0; z < response.length; z++) {

                                            if (response[z].Exp_ID == (i + 1)) {
                                                message += "<table style='border-collapse: collapse; width: 100% '>";
                                                if (parseFloat(response[z].Member_owes) > 0) {
                                                    message += "<tr><th style='width: 50%;'>" + response[z].Members + "'s Portion </th><th style='width: 50%;'>" + response[z].Currency + " " + response[z].Member_portion + "</th></tr>" + "<tr><td style='width: 50%;'>Paid </td><td style='width: 50%;'>" + response[z].Currency + response[z].Member_paid + "</td></tr>" + "<tr><td style='width: 50%;'>Owed </td><td style='width: 50%;'><label style='color: red;'>" + response[z].Currency + response[z].Member_owes + "</label></td></tr>";
                                                } else {
                                                    message += "<tr><th style='width: 50%;'>" + response[z].Members + "'s Portion </th><th style='width: 50%;'>" + response[z].Currency + " " + response[z].Member_portion + "</th></tr><tr><td style='width: 50%;'>Paid </td><td style='width: 50%;'>" + response[z].Currency + response[z].Member_paid + "</td></tr><tr><td style='width: 50%;'>Owed </td><td style='width: 50%;'>" + response[z].Currency + response[z].Member_owes + " </td></tr>";
                                                }
                                            }
                                        }

                                        message += "</table>"
                                        message += "</td></tr>";
                                        $("#table tbody").html(message);
                                    }

                                } else {
                                    message += "<tr style='background-color: white;'><td>";
                                    message += "Theres no records of expenses! Please add expenses</td></tr>";
                                    $("#table tbody").html(message);
                                }
                            },
                            error: function (obj, textStatus, errorThrown) {
                                console.log("Error " + textStatus + ": " + errorThrown);
                            }
                        });

                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });
            }
            $(document).ready(function () {

                $("body").hide();
                $("input#logout").click(function () {
                    localStorage.setItem("authenticated", false);
                    window.location = "EM_Login.php";
                });
                var auth = localStorage.getItem("authenticated");
                if (auth == "false") {
                    alert("Please Login!");
                    window.location = "EM_Login.php";
                } else {
                    $("body").show();
                }

                reloadTable();
            });
        </script>
    </head>
    <body style="background-image: url('img/background_kr.jpg'); background-repeat: no-repeat;
          background-attachment: fixed;
          background-size: cover;">

        <input type="button" id="logout" style="border-radius: 8px; float: right; font-family: Arial;" value="Log Out"/>
        <h1 style="color: darkblue; font-family: Arial;">Expense Management</h1>
        <form name="form" action="expensesKRDetails.php" method="GET">
            <h2 style="color: blue; font-weight: bolder; font-size: 40px; font-family: Arial;">Korea Trip 2020</h2> 
            <input type="image" src="img/add_expense_button.png" alt="Submit" style="width: 300px; ">
        </form>
        <div class="table-wrapper-scoll-y my-custom-scrollbar">
            <table class="table" id="table">
                <tbody>
                </tbody>
            </table>
        </div>

        <div align="center" id="view">
            <label>View Total Expenses and Payment</label>
            <br/>
            <!--<input type="text" id="byDate" value="By Date" style="background-color: whitesmoke; width: 20%"/>-->
            <input type="button" id="totalExp" value="Total"/>
        </div>
        <script>
            $(document).ready(function () {

//                $("input#byDate").datepicker({
//                    dateFormat: 'yy-mm-dd',
//                    onSelect: function (dateText) {
//                        window.location = "expensesByDate.php?date=" + dateText;
//                    }
//                });

                $("input#totalExp").click(function () {
                    window.location = "totalKRExpenses.php";
                });
            });
        </script>
    </body>
</html>
