<main>
    <form action="./actions/login_action.php" method="post">
        <label for="login-usr">uporabniško ime: </label>
        <input id="login-usr" name="login-username" type="text" required>
        <br>
        <label for="login-psw">Geslo:</label>
        <input id="login-psw" name="login-password" type="password" required>
        <br>
        <input type="submit" value="Log in">
    </form>
    <div>
        <p>
            <?php
            if (isset($_SESSION["action-result-msg"])) {
                echo $_SESSION["action-result-msg"];
                unset($_SESSION["action-result-msg"]);
            }
            ?>
        </p>
    </div>
</main>