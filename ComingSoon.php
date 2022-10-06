<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Coming Soon</title>        
        <link rel='stylesheet' href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no" >
    </head>
    <body>
        <div align="center">
            <h1 style="font-size: 30px;">Coming Soon</h1>
            <input type="button" id="logout" style="font-size: 30px;" value="Back to Login Page"/>
            <script>
                $(document).ready(function () {
                    $("#logout").click(function () {
                        localStorage.setItem("authenticated", false);
                        window.location = "EM_Login.php";
                    });
                });
            </script>
        </div>
    </body>
</html>
