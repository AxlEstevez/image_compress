$(document).ready(function () {
    // Subir archivo vía ajax
    $("#uploadForm").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "http://localhost/image_compress//main.php",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $('#uploadStatus').html("<img src='./static/img/uploading.gif'/>");
            },
            error: function () {
                $('#uploadStatus').html('<span style="color:#EA4335;">Images upload failed, please try again.<span>');
            },
            success: function (data) {
                $('#uploadForm')[0].reset();
                $('#uploadStatus').html('<span style="color:#28A74B;">Images uploaded successfully.<span>');
                $('.gallery').html(data);
            }
        });
    });

    // validar el tipo de archivo
    $("#fileInput").change(function () {
        var fileLength = this.files.length;
        var match = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
        for (let i = 0; i < fileLength; i++) {
            var file = this.files[i];
            var imagefile = file.type;
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]) || (imagefile == match[4]))) {
                alert("Por favor selecciona un tipo de archivo valido");
                $("#fileInput").val('');
                return false;
            }
        }
    });
});