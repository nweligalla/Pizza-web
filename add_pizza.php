<?php

$errors = array(
    "email" => "",
    "title" => "",
    "ingredients" => ""
);

$email = $title = $ingredients = "";


if (isset($_POST["submit"])) {

    //email check
    if (empty($_POST["email"])) {
        $errors["email"] = "An email is required" . "<br />";
    } else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Email must be valid email address";
        }
    }

    //title check
    if (empty($_POST["title"])) {
        $errors["title"] = "A title is required " . "<br />";
    } else {
        $title = $_POST["title"];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors["title"] = "Title must be letters and spaces only";
        }
    }

    //ingredent check
    if (empty($_POST["ingredients"])) {
        $errors["ingredients"] = "An Ingredients are required " . "<br />";
    } else {
        $ingredients = $_POST["ingredients"];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors["ingredients"] = "Ingredients must be a comma separated list";
        }
    }

    //redirect page after succesfull form validation
    if (!array_filter($errors)) {
        //adding data to database
        header("Location: index.php");
    }

}//endf of POST check
?>


<!DOCTYPE html>
<html>
<?php include("templates/header.php"); ?>

<section class="container grey-text">
    <h4 class="center">Add Pizza</h4>

    <form class="white" action="add_pizza.php" method="POST">
        <label>Email</label>
        <input type="text" name="email" value=<?php echo htmlspecialchars($email); ?>>
        <div class="red-text"><?php echo $errors["email"]; ?></div>

        <label>Pizza Title</label>
        <input type="text" name="title" value=<?php echo htmlspecialchars($title); ?>>
        <div class="red-text"><?php echo $errors["title"]; ?></div>

        <label>Ingredients (comma seperated)</label>
        <input type="text" name="ingredients" value=<?php echo htmlspecialchars($ingredients); ?>>
        <div class="red-text"><?php echo $errors["ingredients"]; ?></div>


        <div class="center">
            <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include("templates/footer.php"); ?>
</html>

