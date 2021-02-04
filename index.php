<?php
//connecting to database
$conn = mysqli_connect("localhost", "nayana", "test1234", "webpizza");


//checking conncetion
if (!$conn) {
    echo "Connection error" . mysqli_connect_error();
}

//write query to all pizza
$sql = "SELECT title,ingredients,id FROM pizzas ORDER BY created_at";

//make querry to get results
$result = mysqli_query($conn, $sql);

//fetch resulting rows as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free results from memory beacuse we do not want that anymore
mysqli_free_result($result);

//close the database conncetion
mysqli_close($conn);

//print_r(explode(",",$pizzas[0]["ingredients"]));


?>


<!DOCTYPE html>
<html>
<?php include("templates/header.php") ?>

<h4 class="center grey-text">Pizzas</h4>
<div class="container">
    <div class="row">
        <?php
        foreach ($pizzas as $pizza): ?>
            <div class="col s6 m3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($pizza["title"]); ?></h6>
                        <ul class="grey-text text-darken-2">
                            <?php foreach (explode(",", $pizza["ingredients"]) as $ing) : ?>
                                <li><?php echo htmlspecialchars($ing) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-action right-align">
                        <a href="#" class="brand-text">more info</a>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php include("templates/footer.php") ?>
</html>