<!DOCTYPE html>
<?php
include 'dbconn.php';

$queryMembers = "SELECT * from group_member_tw WHERE Group_name = 'Group A'";
$resultMembers = mysqli_query($link, $queryMembers) or die(mysqli_error($link));

$queryMembers2 = "SELECT * from group_member_tw WHERE Group_name = 'Group A'";
$resultMembers2 = mysqli_query($link, $queryMembers2) or die(mysqli_error($link));
$queryMembers3 = "SELECT * from group_member_tw WHERE Group_name = 'Group A'";
$resultMembers3 = mysqli_query($link, $queryMembers3) or die(mysqli_error($link));

function members() {
    include 'dbconn.php';
    $queryMembers3 = "SELECT * from group_member_tw WHERE Group_name = 'Group A'";
    $resultMembers3 = mysqli_query($link, $queryMembers3) or die(mysqli_error($link));
    $message = "";
    while ($rowMembers3 = mysqli_fetch_array($resultMembers3)) {
        $message = "<option value= " + $rowMembers3["Member_ID"] + ";>" + $rowMembers3["Members"] + "</option>";

        echo $message;
    }
}

$queryId = "SELECT DISTINCT Exp_ID FROM expense_table_tw;";
$resultId = mysqli_query($link, $queryId)or die(mysqli_error($link));

$lastIDquery = "SELECT * FROM expense_table_tw ORDER BY Exp_ID desc limit 1";
$resultLastIDquery = mysqli_query($link, $lastIDquery);

$member = array();
while ($row = mysqli_fetch_assoc($resultMembers2)) {
    $member[] = $row;
}
mysqli_close($link);

$arrayMembers = json_encode($member);
?>   
<html>
    <head>
        <meta charset="UTF-8">
        <title>Expenses Details</title>       
        <link href="css/expenseDetail.css" rel="stylesheet" type="text/css"/>
        <link rel='stylesheet' href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!--        <link rel="stylesheet" href="//code.jquery.com/resources/demos/style.css">-->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <meta content="width=device-width, height=device-height ,initial-scale=1, maximum-scale=1, user-scalable=no, user-scalable=0" name="viewport" />
        <script>
            $(document).ready(function () {
                $("#curr").hide();
                var memberArray = <?php echo $arrayMembers; ?>;
                var selectMembers = "<option hidden disabled selected value='0'>Group member</option>";
                for (var i = 0; i < memberArray.length; i++) {
                    $("#curr" + memberArray[i].Member_ID).hide();
                    selectMembers += "<option value='" + memberArray[i].Member_ID + "'>" + memberArray[i].Members + "</option>";
                }

                $("select#m1").html(selectMembers);
                $("select#m2").html(selectMembers);
                $("select#m3").html(selectMembers);

                for (var x = 1; x < memberArray.length; x++) {
                    $("#" + memberArray[x].Member_ID).hide();
                    $("#member" + memberArray[x].Member_ID).hide();
                }
                $("#type").hide();
                $("select#currency").change(function () {
                    var currency = this.value;
                    $("#curr").show();
                    if (currency == "JPY") {
                        $("input#exchange_rate").val("0.0125");
                        var rate = 0.0125;
                        var sAmount = $("input#totalAmt").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#sgdeqv").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr').attr('src', 'img/JYP.png');
                    } else if (currency == "KRW") {
                        $("input#exchange_rate").val("0.0011");
                        var rate = 0.0011;
                        var sAmount = $("input#totalAmt").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#sgdeqv").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr').attr('src', 'img/KRW.png');
                    } else if (currency == "TWD") {
                        $("input#exchange_rate").val("0.0011");
                        var rate = 0.0011;
                        var sAmount = $("input#totalAmt").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#sgdeqv").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr').attr('src', 'img/KRW.png');
                    } else if (currency == "SGD") {
                        $("input#exchange_rate").val("1.00");
                        var rate = 1.00;
                        var sAmount = $("input#totalAmt").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#sgdeqv").val(calculatedExchange);
                        }
                        $('#curr').attr('src', 'img/SGD.png');
                    } else {
                        $("input#exchange_rate").val("Exchange Rate");
                        $("input#sgdeqv").val("");
                        $('#curr').attr('src', '');
                    }

                });

                $("select#currency1").change(function () {
                    var currency2 = this.value;
                    $("#curr1").show();
                    if (currency2 == "JPY") {
                        var rate = 0.0125;
                        var sAmount = $("input#youpay1").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay1").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr1').attr('src', 'img/JYP.png');
                    } else if (currency2 == "KRW") {
                        var rate = 0.0011;
                        var sAmount = $("input#youpay1").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay1").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr1').attr('src', 'img/KRW.png');
                    } else if (currency2 == "TWD") {
                        var rate = 0.0011;
                        var sAmount = $("input#youpay1").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay1").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr1').attr('src', 'img/KRW.png');
                    } else if (currency2 == "SGD") {
                        var rate = 1.00;
                        var sAmount = $("input#youpay1").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay1").val(calculatedExchange);
                        }
                        $('#curr1').attr('src', 'img/SGD.png');
                    } else {
                        $("input#pay1").val("");
                        $('#curr1').attr('src', '');
                    }
                });

                $("select#currency2").change(function () {
                    var currency2 = this.value;
                    $("#curr2").show();
                    if (currency2 == "JPY") {
                        var rate = 0.0125;
                        var sAmount = $("input#youpay2").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay2").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr2').attr('src', 'img/JYP.png');
                    } else if (currency2 == "KRW") {
                        var rate = 0.0011;
                        var sAmount = $("input#youpay2").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay2").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr2').attr('src', 'img/KRW.png');
                    } else if (currency2 == "TWD") {
                        var rate = 0.0011;
                        var sAmount = $("input#youpay2").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay2").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr2').attr('src', 'img/KRW.png');
                    } else if (currency2 == "SGD") {
                        var rate = 1.00;
                        var sAmount = $("input#youpay2").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay2").val(calculatedExchange);
                        }
                        $('#curr2').attr('src', 'img/SGD.png');
                    } else {
                        $("input#pay2").val("");
                        $('#curr2').attr('src', '');
                    }
                });
                $("select#currency3").change(function () {
                    var currency2 = this.value;
                    $("#curr3").show();
                    if (currency2 == "JPY") {
                        var rate = 0.0125;
                        var sAmount = $("input#youpay3").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay3").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr3').attr('src', 'img/JYP.png');
                    } else if (currency2 == "KRW") {
                        var rate = 0.0011;
                        var sAmount = $("input#youpay3").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay3").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr3').attr('src', 'img/KRW.png');
                    } else if (currency2 == "TWD") {
                        var rate = 0.0011;
                        var sAmount = $("input#youpay3").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay3").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr3').attr('src', 'img/KRW.png');
                    } else if (currency2 == "SGD") {
                        var rate = 1.00;
                        var sAmount = $("input#youpay3").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay3").val(calculatedExchange);
                        }
                        $('#curr3').attr('src', 'img/SGD.png');
                    } else {
                        $("input#pay3").val("");
                        $('#curr3').attr('src', '');
                    }
                });
                $("select#currency4").change(function () {
                    var currency2 = this.value;
                    $("#curr4").show();
                    if (currency2 == "JPY") {
                        var rate = 0.0125;
                        var sAmount = $("input#youpay4").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay4").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr4').attr('src', 'img/JYP.png');
                    } else if (currency2 == "KRW") {
                        var rate = 0.0011;
                        var sAmount = $("input#youpay4").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay4").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr4').attr('src', 'img/KRW.png');
                    } else if (currency2 == "TWD") {
                        var rate = 0.0011;
                        var sAmount = $("input#youpay4").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay4").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr4').attr('src', 'img/KRW.png');
                    } else if (currency2 == "SGD") {
                        var rate = 1.00;
                        var sAmount = $("input#youpay4").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay4").val(calculatedExchange);
                        }
                        $('#curr4').attr('src', 'img/SGD.png');
                    } else {
                        $("input#pay4").val("");
                        $('#curr4').attr('src', '');
                    }
                });
                $("select#currency5").change(function () {
                    var currency2 = this.value;
                    $("#curr5").show();
                    if (currency2 == "JPY") {
                        var rate = 0.0125;
                        var sAmount = $("input#youpay5").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay5").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr5').attr('src', 'img/JYP.png');
                    } else if (currency2 == "KRW") {
                        var rate = 0.0011;
                        var sAmount = $("input#youpay5").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay5").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr5').attr('src', 'img/KRW.png');
                    } else if (currency2 == "TWD") {
                        var rate = 0.0011;
                        var sAmount = $("input#youpay5").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay5").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr5').attr('src', 'img/KRW.png');
                    } else if (currency2 == "SGD") {
                        var rate = 1.00;
                        var sAmount = $("input#youpay5").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay5").val(calculatedExchange);
                        }
                        $('#curr5').attr('src', 'img/SGD.png');
                    } else {
                        $("input#pay5").val("");
                        $('#curr5').attr('src', '');
                    }
                });
                $("select#currency6").change(function () {
                    var currency2 = this.value;
                    $("#curr6").show();
                    if (currency2 == "JPY") {
                        var rate = 0.0125;
                        var sAmount = $("input#youpay6").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay6").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr6').attr('src', 'img/JYP.png');
                    } else if (currency2 == "KRW") {
                        var rate = 0.0011;
                        var sAmount = $("input#youpay6").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay6").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr6').attr('src', 'img/KRW.png');
                    } else if (currency2 == "TWD") {
                        var rate = 0.0011;
                        var sAmount = $("input#youpay6").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay6").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr6').attr('src', 'img/KRW.png');
                    } else if (currency2 == "SGD") {
                        var rate = 1.00;
                        var sAmount = $("input#youpay6").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay6").val(calculatedExchange);
                        }
                        $('#curr6').attr('src', 'img/SGD.png');
                    } else {
                        $("input#pay6").val("");
                        $('#curr6').attr('src', '');
                    }
                });
                $("select#currency7").change(function () {
                    var currency2 = this.value;
                    $("#curr7").show();
                    if (currency2 == "JPY") {
                        var rate = 0.0125;
                        var sAmount = $("input#youpay7").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay7").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr7').attr('src', 'img/JYP.png');
                    } else if (currency2 == "KRW") {
                        var rate = 0.0011;
                        var sAmount = $("input#youpay7").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay7").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr7').attr('src', 'img/KRW.png');
                    } else if (currency2 == "TWD") {
                        var rate = 0.0011;
                        var sAmount = $("input#youpay7").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay7").val(calculatedExchange.toFixed(2));
                        }
                        $('#curr7').attr('src', 'img/KRW.png');
                    } else if (currency2 == "SGD") {
                        var rate = 1.00;
                        var sAmount = $("input#youpay7").val();
                        if (sAmount != "") {
                            var amt = parseFloat(sAmount);
                            var calculatedExchange = amt * rate;
                            $("input#pay7").val(calculatedExchange);
                        }
                        $('#curr7').attr('src', 'img/SGD.png');
                    } else {
                        $("input#pay7").val("");
                        $('#curr7').attr('src', '');
                    }
                });
                $("select#types").change(function () {
                    var types = this.value;
                    $("#type").show();
                    checkTypeImg(types);
                });


                function checkCurrencyImg(curr, memberId) {
                    $("#curr" + memberId).show();
                    if (curr == "JPY") {
                        $('#curr').attr('src', 'img/JYP.png');
                        $('#curr' + memberId).attr('src', 'img/JYP.png');
                    } else if (curr == "KRW") {
                        $('#curr').attr('src', 'img/KRW.png');
                        $('#curr' + memberId).attr('src', 'img/KRW.png');
                    } else if (curr == "TWD") {
                        $('#curr').attr('src', 'img/KRW.png');
                        $('#curr' + memberId).attr('src', 'img/KRW.png');
                    } else if (curr == "SGD") {
                        $('#curr').attr('src', 'img/SGD.png');
                        $('#curr' + memberId).attr('src', 'img/SGD.png');
                    }
                }

                function checkTypeImg(type) {
                    $('#type').show();
                    if (type == "1") {
                        $('#type').attr('src', 'img/food.png');
                    } else if (type == "2") {
                        $('#type').attr('src', 'img/transport.png');
                    } else if (type == "3") {
                        $('#type').attr('src', 'img/shopping.png');
                    } else if (type == "4") {
                        $('#type').attr('src', 'img/entertainment.png');
                    } else if (type == "5") {
                        $('#type').attr('src', 'img/accomodation.png');
                    } else if (type == "6") {
                        $('#type').attr('src', 'img/misc.png');
                    }
                }

                $("select#exp_id").change(function () {
                    var id = this.value;
                    $.ajax({
                        type: "GET",
                        url: "getTWExpensesById.php",
                        data: "exp_id=" + id,
                        cache: false,
                        dataType: "JSON",
                        success: function (response) {
                            if (response != null) {
                                for (var i = 0; i < response.length; i++) {
                                    $("#curr").show();
                                    $("#member" + (i + 1)).show();
                                    $("hr#" + (i + 1)).show();
                                    $("select#currency option[value='" + response[0].Currency + "']").prop('selected', true);
                                    $("select#types option[value='" + response[0].Type + "']").prop('selected', true);
                                    $("select#currency" + (i + 1) + " option[value='" + response[0].Currency + "']").prop('selected', true);
                                    $("select#m" + (i + 1) + " option[value='" + response[i].Member_ID + "']").prop('selected', true);
                                    $("textarea#exp_desc").val(response[0].Description);
                                    $("input#date").val(response[0].Date);
                                    $("input#totalAmt").val(response[0].Amt);
                                    $("input#exchange_rate").val(response[0].Exchange_rate);
                                    $("input#sgdeqv").val(response[0].SGD);
                                    $("input#portion" + (i + 1)).val(response[i].Member_portion);
                                    $("input#youpay" + (i + 1)).val(response[i].Member_paid);
                                    $("input#pay" + (i + 1)).val(response[i].Member_paid_SGD);
                                    checkCurrencyImg(response[i].Currency, response[i].Member_ID);
                                    checkTypeImg(response[i].Type);
                                }

                            } else {
                                $("#curr").hide();
                                $('#type').hide();
                                $("#curr").attr('src', '');
                                $('#type').attr('src', '');
                                $("select#currency option[value='0']").prop('selected', true);
                                $("select#types option[value='0']").prop('selected', true);
                                $("textarea#exp_desc").val("");
                                $("input#date").val("");
                                $("input#totalAmt").val("");
                                $("input#exchange_rate").val("");
                                $("input#sgdeqv").val("");
                                var memberArray = <?php echo $arrayMembers; ?>;
                                for (var i = 0; i < memberArray.length; i++) {
                                    $("#curr" + memberArray[i].Member_ID).hide();
                                    $("#member" + memberArray[i].Member_ID).hide();
                                    $("#curr" + memberArray[i].Member_ID).attr('src', '');
                                    $("select#currency" + memberArray[i].Member_ID + " option[value='0']").prop('selected', true);
                                    $("select#m" + memberArray[i].Member_ID + " option[value='0']").prop('selected', true);
                                    $("input#portion" + memberArray[i].Member_ID).val("");
                                    $("input#pay" + memberArray[i].Member_ID).val("");
                                    $("input#youpay" + memberArray[i].Member_ID).val("");
                                }
                            }
                        }
                    });
                });

                $("input#totalAmt").on('input', function () {
                    var pay = this.value;
                    var currency = $("select#currency").val();
                    if (currency != null) {
                        if (currency == "JPY") {
                            var total = pay * 0.0125;
                            $("input#sgdeqv").val(total.toFixed(2));
                        } else if (currency == "KRW") {
                            var total = pay * 0.0011;
                            $("input#sgdeqv").val(total.toFixed(2));
                        } else if (currency == "TWD") {
                            var total = pay * 0.0011;
                            $("input#sgdeqv").val(total.toFixed(2));
                        } else if (currency == "SGD") {
                            var total = pay * 1.00;
                            $("input#sgdeqv").val(total);
                        }
                    }
                });

                $("input#youpay1").on('input', function () {
                    var pay1 = this.value;
                    var currency1 = $("select#currency1").val();
                    if (currency1 != null) {
                        if (currency1 == "JPY") {
                            var total = pay1 * 0.0125;
                            $("input#pay1").val(total.toFixed(2));
                        } else if (currency1 == "KRW") {
                            var total = pay1 * 0.0011;
                            $("input#pay1").val(total.toFixed(2));
                        } else if (currency1 == "TWD") {
                            var total = pay1 * 0.0011;
                            $("input#pay1").val(total.toFixed(2));
                        } else if (currency1 == "SGD") {
                            var total = pay1 * 1.00;
                            $("input#pay1").val(total);
                        }
                    }
                });

                $("input#youpay2").on('input', function () {
                    var pay2 = this.value;
                    var currency2 = $("select#currency2").val();
                    if (currency2 != null) {
                        if (currency2 == "JPY") {
                            var total = pay2 * 0.0125;
                            $("input#pay2").val(total.toFixed(2));
                        } else if (currency2 == "KRW") {
                            var total = pay2 * 0.0011;
                            $("input#pay2").val(total.toFixed(2));
                        } else if (currency2 == "TWD") {
                            var total = pay2 * 0.0011;
                            $("input#pay2").val(total.toFixed(2));
                        } else if (currency2 == "SGD") {
                            var total = pay2 * 1.00;
                            $("input#pay2").val(total);
                        }
                    }
                });

                $("input#youpay3").on('input', function () {
                    var pay3 = this.value;
                    var currency3 = $("select#currency3").val();
                    if (currency3 != null) {
                        if (currency3 == "JPY") {
                            var total = pay3 * 0.0125;
                            $("input#pay3").val(total.toFixed(2));
                        } else if (currency3 == "KRW") {
                            var total = pay3 * 0.0011;
                            $("input#pay3").val(total.toFixed(2));
                        } else if (currency3 == "TWD") {
                            var total = pay3 * 0.0011;
                            $("input#pay3").val(total.toFixed(2));
                        } else if (currency3 == "SGD") {
                            var total = pay3 * 1.00;
                            $("input#pay3").val(total);
                        }
                    }
                });

                $("input#youpay4").on('input', function () {
                    var pay4 = this.value;
                    var currency4 = $("select#currency4").val();
                    if (currency4 != null) {
                        if (currency4 == "JPY") {
                            var total = pay4 * 0.0125;
                            $("input#pay4").val(total.toFixed(2));
                        } else if (currency4 == "KRW") {
                            var total = pay4 * 0.0011;
                            $("input#pay4").val(total.toFixed(2));
                        } else if (currency4 == "TWD") {
                            var total = pay4 * 0.0011;
                            $("input#pay4").val(total.toFixed(2));
                        } else if (currency4 == "SGD") {
                            var total = pay4 * 1.00;
                            $("input#pay4").val(total);
                        }
                    }
                });

                $("input#youpay5").on('input', function () {
                    var pay2 = this.value;
                    var currency2 = $("select#currency5").val();
                    if (currency2 != null) {
                        if (currency2 == "JPY") {
                            var total = pay2 * 0.0125;
                            $("input#pay5").val(total.toFixed(2));
                        } else if (currency2 == "KRW") {
                            var total = pay2 * 0.0011;
                            $("input#pay5").val(total.toFixed(2));
                        } else if (currency2 == "TWD") {
                            var total = pay2 * 0.0011;
                            $("input#pay5").val(total.toFixed(2));
                        } else if (currency2 == "SGD") {
                            var total = pay2 * 1.00;
                            $("input#pay5").val(total);
                        }
                    }
                });

                $("input#youpay6").on('input', function () {
                    var pay3 = this.value;
                    var currency3 = $("select#currency6").val();
                    if (currency3 != null) {
                        if (currency3 == "JPY") {
                            var total = pay3 * 0.0125;
                            $("input#pay6").val(total.toFixed(2));
                        } else if (currency3 == "KRW") {
                            var total = pay3 * 0.0011;
                            $("input#pay6").val(total.toFixed(2));
                        } else if (currency3 == "TWD") {
                            var total = pay3 * 0.0011;
                            $("input#pay6").val(total.toFixed(2));
                        } else if (currency3 == "SGD") {
                            var total = pay3 * 1.00;
                            $("input#pay6").val(total);
                        }
                    }
                });

                $("input#youpay7").on('input', function () {
                    var pay4 = this.value;
                    var currency4 = $("select#currency7").val();
                    if (currency4 != null) {
                        if (currency4 == "JPY") {
                            var total = pay4 * 0.0125;
                            $("input#pay7").val(total.toFixed(2));
                        } else if (currency4 == "KRW") {
                            var total = pay4 * 0.0011;
                            $("input#pay7").val(total.toFixed(2));
                        } else if (currency4 == "TWD") {
                            var total = pay4 * 0.0011;
                            $("input#pay7").val(total.toFixed(2));
                        } else if (currency4 == "SGD") {
                            var total = pay4 * 1.00;
                            $("input#pay7").val(total);
                        }
                    }
                });
                window.addEventListener("orientationchange", function (event) {
                    if (window.matchMedia("(orientation: portrait)").matches) {
                        if ($("#curr").attr('src') != '') {
                            $("#curr").hide();
                        }
                        if ($("#type").attr('src') != '') {
                            $("#type").hide();
                        }

                        var memberArray = <?php echo $arrayMembers; ?>;
                        for (var i = 0; i < memberArray.length; i++) {
                            if ($("#curr" + memberArray[i].Member_ID).attr('src') != '') {
                                $("#curr" + memberArray[i].Member_ID).hide();
                                $("#member" + memberArray[i].Member_ID).hide();
                                $("#" + memberArray[i].Member_ID).hide();
                            }
                        }
//                        if ($("#curr1").attr('src') != '') {
//                            $("#curr1").hide();
//                        }
//
//                        if ($("#curr2").attr('src') != '') {
//                            $("#curr2").hide();
//                            $("#member2").hide();
//                            $("#2").hide();
//                        }
//
//                        if ($("#curr3").attr('src') != '') {
//                            $("#curr3").hide();
//                            $("#member3").hide();
//                            $("#3").hide();
//                        }
//
//                        if ($("#curr4").attr('src') != '') {
//                            $("#curr4").hide();
//                            $("#member4").hide();
//                            $("#4").hide();
//                        }
//
//                        if ($("select#m2 option").attr('value') != '0') {
//                            $('#member2').hide();
//                        }
                    }
                    if (window.matchMedia("(orientation: landscape").matches) {
                        if ($("#curr").attr('src') != '') {
                            $("#curr").show();
                        }
                        if ($("#type").attr('src') != '') {
                            $("#type").show();
                        }
                        var memberArray = <?php echo $arrayMembers; ?>;
                        for (var i = 0; i < memberArray.length; i++) {
                            if ($("#curr" + memberArray[i].Member_ID).attr('src') != '') {
                                $("#curr" + memberArray[i].Member_ID).show();
                                $("#member" + memberArray[i].Member_ID).show();
                                $("#" + memberArray[i].Member_ID).show();
                            }
                        }
//                        if ($("#curr1").attr('src') != '') {
//                            $("#curr1").show();
//                        }
//                        if ($("#curr2").attr('src') != '') {
//                            $("#curr2").show();
//                            $("#member2").show();
//                            $("#2").show();
//                        }
//                        if ($("#curr3").attr('src') != '') {
//                            $("#curr3").show();
//                            $("#member3").show();
//                            $("#3").show();
//                        }
//                        if ($("#curr4").attr('src') != '') {
//                            $("#curr4").show();
//                            $("#member4").show();
//                            $("#4").show();
//                        }
                    }
                });

                $("input#date").datepicker({
                    dateFormat: 'yy-mm-dd'
                });


            });
        </script>
    </head>
    <body style="background-color: lightblue;">
        <p>This will only work in portrait mode!</p>
        <label id="exp_id" style="color: blue;">Expenses ID:      
            <select id="exp_id">
                <option hidden disabled selected value="0">ID</option>
                <?php if (mysqli_fetch_row($resultId) != NULL) { ?>
                    <?php while ($rowID = mysqli_fetch_array($resultId)) { ?>
                        <option value="<?php echo $rowID["Exp_ID"]; ?>"><?php echo $rowID["Exp_ID"]; ?></option>
                    <?php } ?>
                    <?php while ($rowLastID = mysqli_fetch_array($resultLastIDquery)) { ?>
                        <option value="<?php echo $rowLastID["Exp_ID"] + 1; ?>"><?php echo $rowLastID["Exp_ID"] + 1; ?></option>
                    <?php } ?>
                <?php } else { ?>
                    <option value="1">1</option>
                <?php } ?>
            </select>
        </label> 
        <br/>
        <textarea placeholder="Expense Description" name="exp_desc" id='exp_desc'cols="30" rows="5"></textarea>
        <div id="types">
            <select id="types">
                <option hidden selected value="0">Types of expenses</option>
                <option value="1">Food</option>
                <option value="2">Transport</option>
                <option value="3">Shopping</option>
                <option value="4">Entertainment</option>
                <option value="5">Accommodation</option>
                <option value="6">Misc</option>
            </select>
            <img id="type" src="">
        </div>
        <div id="dates">
            <input type="text" id='date' name="date" placeholder="Date" />       
            <label id="date">Date: </label>
        </div>
        <div id="totalAmts">
            <input type="text" id='totalAmt' name="totalAmt" placeholder="Total Amount" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1');"/>
            <label id="tAmt" style="float: right">Total: </label>
        </div>
        <div id="currency">
            <select id="currency">
                <option hidden disabled selected value="0">Currency</option>
                <option value="KRW">KRW</option>
                <option value="SGD">SGD</option>
            </select>
            <img id="curr" src="">
        </div>
        <div id="exchange_rate">
            <input type="text" id="exchange_rate" name="exchange_rate" placeholder="Exchange Rate" readonly/>               
            <label id="xChange">EXR: </label>
        </div>            
        <div id="sgdeqv">
            <input type="text" id='sgdeqv' name="SGD_eqv" readonly/>
            <label id="sgdeqv" style="color: darkblue; font-family: Arial; float: right;">SGD Eqv. S$</label>
        </div>      

        <?php while ($rowMembers = mysqli_fetch_array($resultMembers)) { ?>
            <div id="member<?php echo $rowMembers["Member_ID"]; ?>">
                <hr id="<?php echo $rowMembers["Member_ID"]; ?>" style="border: 1px solid black; margin-top: 10px; width: 100%;"/>    
                <div id="m<?php echo $rowMembers["Member_ID"]; ?>">
                    <select id="m<?php echo $rowMembers["Member_ID"]; ?>">
                        <!--<option  hidden disabled selected value="0">Group member</option>-->
                        <?php // while ($rowMembers3 = mysqli_fetch_array($resultMembers3)) {  ?>
                            <!--<option value="<?php echo $rowMembers3["Member_ID"]; ?>"><?php echo $rowMembers3["Members"]; ?></option>-->
                        <?php // }  ?>
                    </select>
                    <label id="m<?php echo $rowMembers["Member_ID"]; ?>">Member <?php echo $rowMembers['Member_ID']; ?>: </label>
                </div>
                <div id="portion<?php echo $rowMembers["Member_ID"]; ?>">
                    <input type="text" placeholder="Your Portion" id="portion<?php echo $rowMembers["Member_ID"]; ?>" name="portion"/>            
                    <label id="portion<?php echo $rowMembers["Member_ID"]; ?>">Portion: </label>
                </div>
                <div id="youpay<?php echo $rowMembers["Member_ID"]; ?>">
                    <input type="text" name="youpay<?php echo $rowMembers["Member_ID"]; ?>" id="youpay<?php echo $rowMembers["Member_ID"]; ?>" placeholder="You pay" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1');" />            
                    <label id="youpay<?php echo $rowMembers["Member_ID"]; ?>">You pay: </label>
                </div>  
                <div id="currency<?php echo $rowMembers["Member_ID"]; ?>">
                    <select id="currency<?php echo $rowMembers["Member_ID"]; ?>">
                        <option hidden disabled selected value="0">Currency</option>
                        <option value="KRW">KRW</option>
                        <option value="SGD">SGD</option>
                    </select>
                    <img id="curr<?php echo $rowMembers["Member_ID"]; ?>" src="">
                </div>        
                <div id="pay">
                    <input type="text" name="pay<?php echo $rowMembers["Member_ID"]; ?>" id="pay<?php echo $rowMembers["Member_ID"]; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g,'').replace(/(\..*)\./g,'$1');" readonly/>
                    <label id="pay" style="color: darkblue; font-family: Arial; float: right">SGD Eqv. S$</label>
                </div>
            </div>
        <?php } ?>
        <div id="buttons">
            <input type="button"  id="insert" class="done" value="DONE" style="background-color: lightgreen; font-weight: bold;"/>
            <input type="button"  id="addMember" value="+ Member" style="background-color: lightgreen; font-weight: bold"/>
            <input type="button"  id="back" class="back" value="BACK" style="background-color: lightgreen; font-weight: bold;"/>
        </div>
        <script>
            var count = 1;
            $("#back").click(function () {
                window.location = "EM_Taiwan.php";
            });

            $("#addMember").click(function () {
                var descr = $("textarea#exp_desc").val();
                var id = $("select#exp_id").val();
                var date = $('input#date').val();
                var type = $('select#types').val();
                var portion1 = $('input#portion1').val();
                var mem1 = $('select#m1').val();
                var mem2 = $('select#m2').val();
                var mem3 = $('select#m3').val();
                var pay1 = $('input#youpay1').val();

                if (descr == "" || id == "0" || date == "" || type == "0" || portion1 == "" || mem1 == "0" || pay1 == "") {
                    alert("Select ID, types or member. Enter Description, date , portion1 or pay");
                } else {
                    count++;
                    $("div#member" + count).show();
                    $("#" + count).show();
                    $("select#m2 option[value='" + mem1 + "']").remove();
                    $("select#m3 option[value='" + mem1 + "']").remove();
                    $("select#m3 option[value='" + mem2 + "']").remove();
                }
            });

            $("#insert").click(function () {
                var expID = $("select#exp_id").val();
                var desc = $("textarea#exp_desc").val();
                var type = $('select#types').val();
                var currency = $('select#currency').val();
                var date = $('input#date').val();
                var amt = $('input#totalAmt').val();
                var exchange_r8 = $('input#exchange_rate').val();
                var sgdeqv = $('input#sgdeqv').val();
                var m1 = $('select#m1').val();
                var m2 = $('select#m2').val();
                var m3 = $('select#m3').val();
                var portion1 = $('input#portion1').val();
                var portion2 = $('input#portion2').val();
                var portion3 = $('input#portion3').val();
                var youPay1 = $('input#youpay1').val();
                var youPay2 = $('input#youpay2').val();
                var youPay3 = $('input#youpay3').val();
                var pay1 = $('input#pay1').val();
                var pay2 = $('input#pay2').val();
                var pay3 = $('input#pay3').val();

                if (expID != null) {
                    if (portion1 != "" && portion2 != "" && portion3 != "" ) {
                        var fP1 = parseFloat(portion1);
                        var fP2 = parseFloat(portion2);
                        var fP3 = parseFloat(portion3);
                        var fYouPay1 = parseFloat(youPay1);
                        var fYouPay2 = parseFloat(youPay2);
                        var fYouPay3 = parseFloat(youPay3);
                        var fAmt = parseFloat(amt);
                        var totalP = fP1 + fP2 + fP3;
                        if (fAmt == totalP) {
                            var owe1 = fP1 - fYouPay1;
                            var owe2 = fP2 - fYouPay2;
                            var owe3 = fP3 - fYouPay3;

                            insertExpenses(expID, desc, date, type, amt, currency, exchange_r8, sgdeqv, m1, portion1, youPay1, owe1, pay1, m2, portion2, youPay2, owe2, pay2, m3, portion3, youPay3, owe3, pay3);
                        } else {
                            alert("Portion is not equals to the total amount!");
                        }
                    } else if (portion1 != "" && portion2 != "") {
                        var fP1 = parseFloat(portion1);
                        var fP2 = parseFloat(portion2);
                        var fYouPay1 = parseFloat(youPay1);
                        var fYouPay2 = parseFloat(youPay2);
                        var fAmt = parseFloat(amt);
                        var totalP = fP1 + fP2;
                        if (fAmt == totalP) {
                            var owe1 = fP1 - fYouPay1;
                            var owe2 = fP2 - fYouPay2;
           
                            insertExpenses(expID, desc, date, type, amt, currency, exchange_r8, sgdeqv, m1, portion1, youPay1, owe1, pay1, m2, portion2, youPay2, owe2, pay2);
                        } else {
                            alert("Portion is not equals to the total amount!");
                        }
                    } else if (portion1 != "") {
                        var fP1 = parseFloat(portion1);
                        var fYouPay1 = parseFloat(youPay1);
                        var fAmt = parseFloat(amt);
                        var totalP = fP1;
                        if (fAmt == totalP) {
                            var owe1 = fP1 - fYouPay1;
                            insertExpenses(expID, desc, date, type, amt, currency, exchange_r8, sgdeqv, m1, portion1, youPay1, owe1, pay1);
                        } else {
                            alert("Portion is not equals to the total amount!");
                        }
                    } else {
                        alert("Portion is not set!");
                    }

                } else {
                    alert("Please Select Expenses ID!");
                }
            });

            function insertExpenses(expID, desc, date, type, amt, currency, exchange_r8, sgdeqv, m1, portion1, pay1, owe1, paySGD1, m2, portion2, pay2, owe2, paySGD2, m3, portion3, pay3, owe3, paySGD3) {

                $.ajax({
                    type: "POST",
                    url: "insertTWExpenses.php",
                    data: "exp_id=" + expID + "&description=" + desc + "&date=" + date + "&type=" + type + "&amt=" + amt + "&currency=" + currency + "&exchange_rate=" + exchange_r8 + "&sgd=" + sgdeqv + "&memberId=" + m1 + "&memberPort=" + portion1 + "&memberPaid=" + pay1 + "&memberOwes=" + owe1 + "&memberPaidSGD=" + paySGD1 + "&remark=" + "",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status == "1") {
                            window.location = "EM_Taiwan.php";
                        }
                    }
                });

                if (m2 != null) {
                    $.ajax({
                        type: "POST",
                        url: "insertTWExpenses.php",
                        data: "exp_id=" + expID + "&description=" + desc + "&date=" + date + "&type=" + type + "&amt=" + amt + "&currency=" + currency + "&exchange_rate=" + exchange_r8 + "&sgd=" + sgdeqv + "&memberId=" + m2 + "&memberPort=" + portion2 + "&memberPaid=" + pay2 + "&memberOwes=" + owe2 + "&memberPaidSGD=" + paySGD2 + "&remark=" + "",
                        cache: false,
                        dataType: "JSON",
                        success: function (response) {
                            if (response.status == "1") {
                                window.location = "EM_Taiwan.php";
                            }
                        }
                    });
                }

                if (m3 != null) {
                    $.ajax({
                        type: "POST",
                        url: "insertTWExpenses.php",
                        data: "exp_id=" + expID + "&description=" + desc + "&date=" + date + "&type=" + type + "&amt=" + amt + "&currency=" + currency + "&exchange_rate=" + exchange_r8 + "&sgd=" + sgdeqv + "&memberId=" + m3 + "&memberPort=" + portion3 + "&memberPaid=" + pay3 + "&memberOwes=" + owe3 + "&memberPaidSGD=" + paySGD3 + "&remark=" + "",
                        cache: false,
                        dataType: "JSON",
                        success: function (response) {
                            if (response.status == "1") {
                                window.location = "EM_Taiwan.php";
                            }
                        }
                    });
                }
            }
        </script>
    </body>
</html>
