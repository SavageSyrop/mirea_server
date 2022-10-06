<html lang="ru">
<head>
    <title>Hello page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<h1>Coffee shop</h1>
<h2>Add order</h2>
<form method="post">
    <div>
      <input class='input' placeholder='Client name' type='text' name="client_name">
    </div>
    <div>
      <input class='input' placeholder='Coffee type' type='text' name="coffee_type">
    </div>
    <div>
      <input class='input' placeholder='Cost' type='text' name="cost" required>
    </div>
    <input class='submit' type='submit' value='Add'>
</form>
<h2>Delete order</h2>
<form method="post">
    <div>
      <input class='input' placeholder='ID' type='text' name="id" required>
    </div>
    <input class='submit' type='submit' value='Delete'>
</form>
<table>
    <tr>
        <th>Id</th>
        <th>Client name</th>
        <th>Coffee type</th>
        <th>Cost</th>
    </tr>
    <?php
    function display(){
        $mysqli = new mysqli("mysql", "user", "vicecity0", "appDB");
        $result = $mysqli->query("SELECT * FROM orders");
        foreach ($result as $row) {
            echo <<<A
            <tr><td>{$row['id']}</td>
            <td>{$row['client_name']}</td>
            <td>{$row['coffee_type']}</td>
            <td>{$row['cost']}</td></tr>
            A;
        }
    }
    display();
    function add(string $client_name, string $coffee_type, int $cost) {
        $mysqli = new mysqli("mysql", "user", "vicecity0", "appDB");
        $sql = "INSERT INTO orders (client_name, coffee_type, cost) 
        VALUES ('$client_name', '$coffee_type', $cost);";
        $mysqli->query($sql);
        echo("<meta http-equiv='refresh' content='1'>"); 
    }
    function delete(string $id){
        $mysqli = new mysqli("mysql", "user", "vicecity0", "appDB");
        $sql = "DELETE FROM orders WHERE id=$id";
        $mysqli->query($sql);
        echo("<meta http-equiv='refresh' content='1'>"); 
    }
    if(isset($_POST["client_name"]) && isset($_POST["cost"])){
        add(
            $_POST["client_name"],
            $_POST["coffee_type"],
            intval($_POST["cost"])
        );
    }
    if(isset($_POST["id"])){
        delete(intval($_POST["id"]));
    }
    ?>
</table>
</body>
</html>