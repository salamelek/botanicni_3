let isNavShown = false;

function toggleNav() {
    let dropdown_btn = document.getElementById("nav-dropdown-btn");
    let nav = document.getElementById("nav");

    if (isNavShown) {
        dropdown_btn.style = "transform: rotate(0deg);";
        nav.style = "transform: translateY(-100%);";

        isNavShown = false;
    } else {
        dropdown_btn.style = "transform: rotate(180deg);";
        nav.style = "transform: translateY(0);";

        isNavShown = true;
    }
}