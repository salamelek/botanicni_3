let isNavShown = false;
let isImgBig = false;

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

function toggleImgSize(img_div=null) {
    let big_img_frame = document.getElementById("img-gallery-big");
    let big_img = document.getElementById("big-img");

    if (isImgBig) {
        big_img_frame.style = "transform: scale(0);";
        isImgBig = false;
    } else if (img_div !== null) {
        big_img.src = img_div.children[0].src;
        big_img_frame.style = "transform: scale(100%);";
        isImgBig = true;
    }
}
