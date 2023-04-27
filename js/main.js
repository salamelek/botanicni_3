function deleteImage(img) {
    let imgPath = "../.." + img.src.slice(img.src.indexOf("/images"));
    let popup = document.getElementById("confirm-delete-popup");
    let confirmButton = document.getElementById("delete-image-confirmed");

    // confirm popup
    popup.style = "display: flex";

    // add listener to confirm button
    confirmButton.addEventListener("click", function() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log(this.responseText);
            }
        };

        xhttp.open("POST", "./actions/deleteImg.php?file=" + imgPath, true);
        xhttp.send();

        console.log(imgPath)

        // location.reload();
    });
}

function closePopup() {
    let popup = document.getElementById("confirm-delete-popup");
    popup.style = "display: none";
}