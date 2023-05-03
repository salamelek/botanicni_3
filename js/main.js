// DELETE IMAGES

let imgToDelete = "";

function deleteImage(img) {
    imgToDelete = img.src.slice(img.src.indexOf("/images"));
    let popup = document.getElementById("confirm-delete-popup");

    // confirm popup
    popup.style = "display: flex";

    // focus on "DA"
    document.getElementById("delete-image-confirmed").focus();
}

function confirmDeleteImage() {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            // TODO when fixed, remove the path from the output
            console.log(this.responseText);
        }
    };

    xhttp.open("POST", "./actions/deleteImg.php?file=" + imgToDelete, true);
    xhttp.send();

    // reload somehow images

    // close popup
    closePopup();
}

function closePopup() {
    let popup = document.getElementById("confirm-delete-popup");
    popup.style = "display: none";
}


// LIST FILTERS



function changeOrder(button) {
    let order1 = "A-Z";
    let order2 = "Z-A";

    if (button.innerHTML === order1) {
        button.innerHTML = order2;
    } else {
        button.innerHTML = order1;
    }
}

function changePosition(button) {
    let place1 = "Samo v šoli";
    let place2 = "Tudi izven šole";

    if (button.innerHTML === place1) {
        button.innerHTML = place2;
    } else {
        button.innerHTML = place1;
    }
}

function changeLanguage(button) {
    let lang1 = "Latinščina";
    let lang2 = "Slovenščina";
    let lang3 = "Italijanščina";

    if (button.innerHTML === lang1) {
        button.innerHTML = lang2;
    } else if (button.innerHTML === lang2) {
        button.innerHTML = lang3;
    } else {
        button.innerHTML = lang1;
    }
}

function updateList() {
    let linkHolder = document.getElementById("link-holder");

    let orderBtn = document.getElementById("orderBtn");
    let positionBtn = document.getElementById("positionBtn");
    let langBtn = document.getElementById("langBtn");

    // create filters string (must be easy to unpack)
    let filters = "";

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            // instead of console.log, set the inner html of the list
            linkHolder.innerHTML = this.responseText;
        }
    };

    xhttp.open("POST", "./actions/get_list.php?filters=" + filters, true);
    xhttp.send();
}