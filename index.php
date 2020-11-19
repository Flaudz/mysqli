<?php
    include_once 'db.php';
    if (isset($_POST['callFunc1'])) {
        $query = "SELECT name FROM lobbys WHERE name=? LIMIT 1";

        $stmt = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $query))
        {
            print "Failed to prepare statement\n";
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $_POST['lobbyName']);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
                {
                    
                }
        }
        mysqli_stmt_close($stmt);
        $query = "INSERT INTO lobbys (name, numberofplayers, leader, player1) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con ,$query);
        mysqli_stmt_bind_param($stmt, "siss", $lobbyName, $numberofplayers, $leadersname, $player1);
        $lobbyName = $_POST['lobbyName'];
        $numberofplayers = 1;
        $leadersname = $_COOKIE['userName'];
        $player1 = $_COOKIE['userName'];
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
    
    </ul>
    <form action="index.php" class="makeLobbyDiv">
		<input class="lobbyInput" type="text" name="lobbyName" placeholder="Make looby">
		<input type="submit">
	</form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    function setCookie(cname, cvalue, exdays) {
        let d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        let expires = `expires=${d.toUTCString()}`;
        document.cookie = `${cname}=${cvalue};${expires};path=/`;
    }
    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
            c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    function checkCookie() {
        var username = getCookie("userName");
        if (username == "") {
            getName();
        }
    }
    const getName = () =>{
        let nameInput = prompt("Please enter your name:", "");
        setCookie('userName', nameInput, 1);
    }
    checkCookie();
    $(".makeLobbyDiv").submit(function(e) {
        e.preventDefault();
            const lobby = document.querySelector(".lobbyInput").value;
            $.ajax({
                url: 'index.php',
                type: 'post',
                data: {
                    "callFunc1": 1,
                    "lobbyName": lobby
                },
                success: function(response) {
                    console.log(response);
                }
            });

        })
    </script>
</body>
</html>