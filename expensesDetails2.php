<!DOCTYPE html>
<?php
session_start();
include 'dbconn.php';
$value = $_SESSION["group"];
$queryMembers = "SELECT * from group_member WHERE Group_name = '$value'";
$resultMembers = mysqli_query($link, $queryMembers) or die(mysqli_error($link));
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h3>Expenses ID 
            <?php
            echo $_SESSION['exp_id'];
            ?>
        </h3>
        <select>
            <option value="">Group member</option>
            <?php while ($rowMembers = mysqli_fetch_array($resultMembers)) { ?>
                <option value="<?php echo $rowMembers["Members"]; ?>"><?php echo $rowMembers["Members"]; ?></option>
            <?php } ?>
        </select>
        <br/><br/>
        <input type="text" placeholder="Your Portion" name="portion"/>
        <br/><br/>
        SGD Eqv. <input type="text" name="pay" placeholder="You pay"/>
        <br/><br/>
        <input type="button" onclick="window.location = 'expensesDetails.php'" class="bck" value="<"/>
        <input type="button" onclick="window.location = 'expensesDetails2.php'" class="front" value=">"/> 
        <input type="button" onclick="window.location = 'expenseManagement.php'" class="done" value="DONE"/>
    </body>
</html>
