<?php
if (isset($_POST["search-plant-input"])) {
    $plantName = $_POST["search-plant-input"];
    header("Location: plant.php?plant=" . $plantName);
}
?>

<main>
    <form action="" method="post">
        <label for="search-plant-input">Vnesi ime rastline: </label>
        <br>
        <input type="text" id="search-plant-input" name="search-plant-input" placeholder="Testus plantis" required>
        <input type="submit" value="Išči">
    </form>
</main>
