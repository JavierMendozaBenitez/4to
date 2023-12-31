"use strict";
function SubirFoto() {
    let pagina = "./BACKEND/subirImagen.php";
    if ($("#archivo").val() === "") {
        return;
    }
    $("#fotoTmp").attr("src", "");
    $("#lblFoto").html("");
    AdministrarGif(true);
    let archivo = $("#archivo");
    let formData = new FormData();
    formData.append("archivo", archivo[0].files[0]);
    formData.append("caso", "1");
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        async: true
    })
        .done(function (objJson) {
        AdministrarGif(false);
        if (!objJson.Exito) {
            console.clear();
            console.log(objJson.Mensaje);
            return;
        }
        $("#fotoTmp").attr("src", objJson.PathTemporal);
        $("#hdnFotoSubir").val(objJson.PathTemporal);
        $("#lblFoto").html("Nombre de la imagen: " + objJson.NombreFoto);
    })
        .fail(function (jqXHR, textStatus, errorThrown) {
        AdministrarGif(false);
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}
function AdministrarGif(mostrar) {
    let gif = "css/gif-load.gif";
    let div = $("#divGif");
    let img = $("#imgGif");
    if (mostrar) {
        div.css("display", "block");
        div.css("top", "50%");
        div.css("left", "45%");
        img.attr("src", gif);
    }
    else {
        div.css("display", "block");
        img.attr("src", "");
    }
}
//# sourceMappingURL=main.js.map