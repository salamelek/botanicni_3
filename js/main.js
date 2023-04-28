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