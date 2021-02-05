<?php

include("config/db_connect.php");

//check GET request id parameter
if (isset($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    //make sql
    $sql = "SELECT * FROM pizzas WHERE id = $id";

    //get query results
    $result = mysqli_query($conn, $sql);

    //fetch result data into array
    $pizza = mysqli_fetch_assoc($result);

    //free up result memory and close the conncention
    mysqli_free_result($result);
    mysqli_close($conn);


}

//detect delete post request

if (isset($_POST["delete"])) {
    $delId = mysqli_real_escape_string($conn, $_POST["delId"]);

    //sql
    $delsql = "DELETE FROM pizzas WHERE id = '$delId'";

    if (mysqli_query($conn, $delsql)) {
        header("Location: index.php");
    } else {
        echo "query error" . mysqli_error($conn);
    }
}

?>

<!doctype html>
<html>

<body>
<?php include("templates/header.php") ?>


<?php if ($pizza) : ?>
    <div class="container white center box hoverable">
        <h4><?php echo htmlspecialchars($pizza["title"]) ?></h4>
        <p>created by : <?php echo htmlspecialchars($pizza["email"]) ?></p>
        <p><?php echo date($pizza["created_at"]) ?></p>
        <h5>Ingredients</h5>
        <ul>
            <?php foreach (explode(",", $pizza["ingredients"]) as $ing): ?>
                <li><?php echo $ing ?></li>
            <?php endforeach; ?>
        </ul>
        <form action="details.php" method="POST">
            <input type="hidden" name="delId" value="<?php echo $pizza['id'] ?>">
            <input type="submit" name="delete" value="delete" class="btn brand z-depth-0">
        </form>
    </div>
<?php else: ?>
    <h5 class="center">No such pizza found</h5>
<?php endif; ?>


<?php include("templates/footer.php") ?>
</body>
</html>
