/// <reference path="./node_modules/@types/jquery/index.d.ts"

function Listar(){
    let url = "http://localhost:10000/productos_fotos";
    $.ajax({
        type:"get",
        url: url,
        dataType: "JSON",
    })
    .done((objJSON:any)=>{
        //MUESTRO EL RESULTADO DE LA PETICION
        console.log(objJSON);

        let cadena = "";

        objJSON.forEach((elemento:any) => {
            console.log(elemento);
            if(elemento !== "")
            {
                let obj = JSON.parse(elemento);
                cadena += obj.codigo + " - " + obj.marca + " - " + obj.precio + " - " + obj.path + "<br>";
            }
        });

        $("#divListado").html(cadena);

    })
    .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    }); 
}

function Agregar(){
    let url = "http://localhost:10000/productos_fotos";
    let codigo = $("#codigo").val();
    let marca = $("#marca").val();
    let precio = $("#precio").val();
    let foto:any = $("#foto")[0];

    let form:FormData = new FormData();
    form.append("foto", foto.files[0])

    form.append("obj", JSON.stringify({"codigo":codigo, "marca":marca, "precio":precio}));

    $.ajax({
        type:"post",
        url: url,
        dataType: "text",
        cache: false,
        contentType: false,
        processData: false,
        data: form
    })

    .done(rta=>{
        alert(rta);
    })

    .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    }); 
}
function Modificar() {
    let url = "http://localhost:10000/productos_fotos";
    let codigo = $("#codigo_m").val();
    let marca = $("#marca_m").val();
    let precio = $("#precio_m").val();
    let foto:any = $("#foto_m")[0];  

    // Crea un objeto FormData para enviar los datos
    let form:FormData = new FormData();
    form.append("foto", foto.files[0])
    form.append("obj", JSON.stringify({"codigo":codigo, "marca":marca, "precio":precio}));

    $.ajax({
        type: "put",
        url: url,
        dataType: "text",
        cache: false,
        contentType: false,
        processData: false,
        data: form
    })
    .done(rta => {
        alert(rta);
    })
    .fail((jqXHR, textStatus, errorThrown) => {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function Borrar() {
    const url = "http://localhost:10000/productos_fotos"; // URL base sin barra diagonal al final
//Archivo
    // Obtiene el objeto de producto a eliminar del servidor y lo convierte a JSON
    const obj = {
        codigo: $("#codigo_b").val() // Obtén el código del producto desde el elemento HTML #codigo_b
    };

    // Realiza una solicitud DELETE al servidor y envía el objeto de producto a eliminar en el cuerpo de la solicitud
    $.ajax({
        type: "delete",
        url: url, // Utiliza la URL base
        dataType: "text", // Cambia el tipo de datos esperado si el servidor devuelve JSON
        data: JSON.stringify(obj), // Envía el objeto como JSON en el cuerpo de la solicitud
        contentType: "application/json", // Indica que se está enviando JSON en el cuerpo de la solicitud
    })
    .done(rta => {
        alert(rta); // Suponiendo que el servidor devuelve un mensaje en el campo "message"
    })
    .fail((jqXHR, textStatus, errorThrown) => {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function ArmarTablaObjetos(){
    let url = "http://localhost:10000/productos_fotos";
    $.ajax({
        type:"get",
        url: url,
        dataType: "JSON",
    })
    .done((objJSON:any)=>{
        // MUESTRO EL RESULTADO DE LA PETICION
        console.log(objJSON);
        //alert(objJSON);

        // Crea una tabla HTML
        let tabla = $("<table>");

        // Agrega encabezados a la tabla
        tabla.append("<thead><tr><th>Código</th><th>Marca</th><th>Precio</th><th>Foto</th></tr></thead>");

        // Crea el cuerpo de la tabla
        let tbody = $("<tbody>");


        objJSON.forEach((elemento:any) => {
            if(elemento !== ""){
            // Crea una fila en la tabla
            let obj = JSON.parse(elemento);
            let fila = $("<tr>");
            // Agrega las celdas de datos a la fila
            fila.append(`<td>${obj.codigo}</td>`);
            fila.append(`<td>${obj.marca}</td>`);
            fila.append(`<td>${obj.precio}</td>`);
            fila.append(`<td><img src="${obj.path}" alt="Foto del producto"></td>`);

            // Agrega la fila al cuerpo de la tabla
            tbody.append(fila);
            }
        });

        // Agrega el cuerpo de la tabla a la tabla
        tabla.append(tbody);

        // Obtén el elemento con el id "divListado_tabla_json"
        let divListadoTablaJson = document.getElementById("divListado_tabla_json");

        // Verifica si el elemento existe antes de asignarle el contenido HTML
        if (divListadoTablaJson) {
            divListadoTablaJson.innerHTML = tabla[0].outerHTML; // Aquí se asigna el contenido HTML correctamente
        } else {
            console.error("Elemento 'divListado_tabla_json' no encontrado.");
        }
    })
    .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    }); 
}
