let isNavShown = false;
let isImgBig = false;

function toggleNav() {
    let dropdown_btn = document.getElementById("dropdown-btn");
    let nav = document.getElementById("dropdown-nav");
    let nav_bck = document.getElementById("nav-bck")

    if (isNavShown) {
        dropdown_btn.style = "transform: rotate(90deg);";
        nav.style = "transform: translateX(100%);";
        nav_bck.style = "transform: translateX(-100%);";

        isNavShown = false;
    } else {
        dropdown_btn.style = "transform: rotate(-90deg);";
        nav.style = "transform: translateX(0%);";
        nav_bck.style = "transform: translateX(0%);";

        isNavShown = true;
    }
}

function toggleImgSize(img_div=null) {
    let big_img_frame = document.getElementById("img-gallery-big");
    let big_img = document.getElementById("big-img");

    if (isImgBig) {
        big_img_frame.style = "transform: scale(0);";
        isImgBig = false;
    } else if (img_div !== null) {
        big_img.src = img_div.children[0].src;
        big_img_frame.style = "transform: scale(1);";
        isImgBig = true;
    }
}

function loadNav() {
    // moves the nav, so it doesn't get broken ;-;
    let nav = document.getElementById("dropdown-nav");
    nav.style = "transform: translateX(100%);";
}