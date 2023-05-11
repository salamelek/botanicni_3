<main>
    <div class="main-wrapper">
        <form action="./actions/search_plant_action.php" method="post">
            <label for="search-plant-input">Vnesi ime rastline: </label>
            <br>
            <input type="text" id="search-plant-input" name="search-plant-input" placeholder="Ime rastline" required autocomplete="off" list="plants-list">
            <datalist id="plants-list"></datalist>
            <label>
                <input type="text" hidden name="prevFileName" value="<?php echo basename(debug_backtrace()[0]['file']); ?>">
            </label>
            <input type="submit" value="Išči">
        </form>
    </div>
</main>
<script>
    let searchBar = document.getElementById("search-plant-input");
    let plantsDataList = document.getElementById("plants-list");

    let plantsList = <?php echo json_encode(get_n_plants(1000, 0)) ?>;
    // TODO get a list of all names, Ita and slo and other slo included

    function addValues() {
        // Filter list of words based on user input
        let filteredWords = plantsList.filter(function(word) {
            return word.toLowerCase().startsWith(searchBar.value.toLowerCase());
        });

        plantsDataList.innerHTML = '';
        filteredWords.forEach(function(word) {
            let option = document.createElement('option');
            option.value = word;
            plantsDataList.appendChild(option);
        });
    }

    searchBar.addEventListener('input', function() {
        if (searchBar.value.length >= 1) {
            addValues();
        }
    });
</script>