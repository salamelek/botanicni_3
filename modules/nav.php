<nav id="nav" class="shadow">
    <div class="inner-nav">
        <div class="nav-links-space">
            <a href="./" class="nice-link">Domov</a>
            <a href="./list.php" class="nice-link">Seznam</a>
            <a href="./plant.php" class="nice-link">Rastlina</a>
            <a href="./admins_only.php" class="nice-link">Urejaj</a>
        </div>
    </div>
</nav>

<script>
    // Manage navBar
    let prevScrollPos = scrollY;
    window.onscroll = function() {
        let currentScrollPos = scrollY;
        if (prevScrollPos > currentScrollPos) {
            document.getElementById("nav").style.transform = "translateY(0)";
        } else {
            document.getElementById("nav").style.transform = "translateY(-100%)";
        }
        prevScrollPos = currentScrollPos;
    }
</script>