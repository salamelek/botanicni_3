<main>
    <div class="main-wrapper">
        <form action="./actions/search_plant_action.php" method="post">
            <label for="search-plant-input">Vnesi ime rastline: </label>
            <br>
            <input type="text" id="search-plant-input" name="search-plant-input" placeholder="Ime rastline" required>
            <label>
                <input type="text" hidden name="prevFileName" value="<?php echo basename(debug_backtrace()[0]['file']); ?>">
            </label>
            <input type="submit" value="Išči">
        </form>
    </div>
</main>
