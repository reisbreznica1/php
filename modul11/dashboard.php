
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table</title>

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse:collapse;
        }
        td,th{
            padding: 10px, 20px;
        }


    </style>
</head>
<body>
    <?php
    include_once('config.php');
    $sql = "SELECT * FROM user";
    $getUsers = $conn->prepare($sql);
    $getUsers->execute();
    $users = $getUsers->fetchALL();
    ?>

    <h2>Data Table</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

</body>
</html>