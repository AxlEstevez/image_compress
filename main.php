<?php
if(!empty($_FILES['images'])){
    $targetDir = "temporalUploadFiles/";
    $allowsTypes = array('jpg','png','jpeg','gif');

    $images_arr = array();

    foreach($_FILES['images']['name'] as $key=>$val){
        $image_name = $_FILES['images']['name'][$key];
        $tmp_name = $_FILES['images']['tmp_name'][$key];
        $size = $_FILES['images']['size'][$key];
        $type = $_FILES['images']['type'][$key];
        $error = $_FILES['images']['error'][$key];

        $fileName = basename($_FILES['images']['name'][$key]);
        $targetFilePath = $targetDir . $fileName;

        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if(in_array($fileType, $allowsTypes)){
            // mostrar imagenes
            $img_info = getimagesize($_FILES['images']['tmp_name'][$key]);
            $images_arr[] = "data".$img_info["mime"].";base64,".base64_encode(file_get_contents($_FILES['images']['tmp_name'][$key]));
        }
    }

    // Generar vista de galeria de imagenes.
    if(!empty($images_arr)){ ?>
        <ul>
        <?php foreach($images_arr as $image_src){ ?>
            <li><img src="<?php echo $image_src; ?>" alt=""></li>
        <?php } ?>
        </ul>
    <?php }

}
?>