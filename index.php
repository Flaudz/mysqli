<?php
    include_once 'db.php';
    if (isset($_POST['callFunc1'])) {
        // $stmt = $con->prepare('INSERT INTO lobbys (name) VALUES ($_POST["lobbyName"]);');
        // $stmt->execute();
        // $stmt->close();
        $query = "INSERT INTO lobbys (name) VALUES (?)";
        $stmt = mysqli_prepare($con ,$query);
        mysqli_stmt_bind_param($stmt, "s", $val1);
        $val1 = $_POST['lobbyName'];
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