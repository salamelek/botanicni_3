<p>Izbriši slike:</p>
<div class="delete-images-gallery">
    <div class="delete-images-inner">
        <?php
        $plantInfo = get_plant_assoc($_GET["plant"]);
        $dirName = "./images/plants/" . $plantInfo["imeLat"] . "/";
        $fileCount = count(glob($dirName . "*"));

        if ($fileCount != 0) {
            $dir = new DirectoryIterator($dirName);
            foreach ($dir as $fileInfo) {
                if (!$fileInfo->isDot() && !$fileInfo->isDir()) {
                    $fileName = $fileInfo->getFilename();

                    echo ' 
                                <div class="delete-img-frame">
                                    <img src="' . $dirName . $fileName . '" alt="lepa slikca" onclick="deleteImage(this) ">
                                </div>
                            ';
                }
            }
        }
        ?>
    </div>
    <div class="confirm-delete-prompt" id="confirm-delete-popup">
        <p>Ali želiš izbrisati izbrano sliko?</p>
        <div class="options-container">
            <button type="button" onclick="closePopup()" id="delete-image-confirmed">DA</button>
            <button type="button" onclick="closePopup()">NE</button>
        </div>
    </div>
</div>

<br>
<hr>