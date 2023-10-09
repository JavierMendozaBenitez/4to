"use strict";
function enviarSolicitud(accion, datos, callback) {
    const xhr = new XMLHttpRequest();
    const url = `./BACKEND/nexo_poo.php?accion=${accion}`;
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                callback(xhr.responseText);
            }
            else {
                console.error('Error en la solicitud:', xhr.status, xhr.statusText);
            }
        }
    };
    xhr.send(JSON.stringify(datos));
}
function agregarAlumno() {
    const legajoInput = document.getElementById("legajo");
    const nombreInput = document.getElementById("nombre");
    const apellidoInput = document.getElementById("apellido");
    const fotoInput = document.getElementById("foto");
    const legajo = parseInt(legajoInput.value);
    const nombre = nombreInput.value;
    const apellido = apellidoInput.value;
    // Comprobar si se ha seleccionado un archivo de imagen
    if (fotoInput.files && fotoInput.files.length > 0) {
        const foto = fotoInput.files[0];
        const datos = new FormData();
        datos.append('accion', 'agregar');
        datos.append('legajo', legajo.toString());
        datos.append('nombre', nombre);
        datos.append('apellido', apellido);
        datos.append('foto', foto);
        enviarSolicitud('agregar', datos, function (respuesta) {
            const resultado = JSON.parse(respuesta);
            if (resultado.status === 'success') {
                // El alumno se agregó correctamente, puedes mostrar un mensaje de éxito
                console.log('Alumno agregado:', resultado.message);
            }
            else {
                // Error al agregar el alumno, muestra un mensaje de error
                console.error('Error al agregar alumno:', resultado.message);
            }
        });
    }
    else {
        // No se seleccionó un archivo de imagen, puedes mostrar un mensaje de error o realizar otra acción apropiada
        console.error('Debes seleccionar una imagen de perfil.');
    }
}
// function agregarAlumno() {
//     const legajoInput = (<HTMLInputElement>document.getElementById("legajo"))as HTMLInputElement;
//     const nombreInput = (<HTMLInputElement>document.getElementById("nombre"))as HTMLInputElement;
//     const apellidoInput = (<HTMLInputElement>document.getElementById("apellido"))as HTMLInputElement;
//     const foto = ""; // Obtener el valor del campo de la foto si es necesario
//     const legajo = parseInt(legajoInput.value);
//     const nombre = nombreInput.value;
//     const apellido = apellidoInput.value;
//     const datos = {
//         accion: 'agregar',
//         legajo,
//         nombre,
//         apellido,
//         foto
//     };
//     enviarSolicitud('agregar', datos, function (respuesta) {
//         const resultado = JSON.parse(respuesta);
//         if (resultado.status === 'success') {
//             // El alumno se agregó correctamente, puedes mostrar un mensaje de éxito
//             console.log('Alumno agregado:', resultado.message);
//         } else {
//             // Error al agregar el alumno, muestra un mensaje de error
//             console.error('Error al agregar alumno:', resultado.message);
//         }
//     });
// }
function listarAlumnosObjetos() {
    const datos = {
        //accion: 'listarObjetos'
        accion: 'listar_objetos'
    };
    //enviarSolicitud('listarObjetos', datos, function (respuesta) {
    enviarSolicitud('listar_objetos', datos, function (respuesta) {
        // Manejar la respuesta del servidor, por ejemplo, mostrar la lista de alumnos en formato de objetos en la interfaz de usuario
        console.log(respuesta);
    });
}
// function listarAlumnosTabla() {
//     const datos = {
//         //accion: 'listarConFotos'
//         accion: 'listar_tabla'
//     };
//     //enviarSolicitud('listarConFotos', datos, function (respuesta) {
//     enviarSolicitud('listar_tabla', datos, function (respuesta) {
//         // Manejar la respuesta del servidor, por ejemplo, mostrar la lista de alumnos con fotos en la interfaz de usuario
//         console.log(respuesta);
//     });
// }
function listarAlumnosTabla() {
    const datos = {
        accion: 'listar_tabla'
    };
    enviarSolicitud('listar_tabla', datos, function (respuesta) {
        // Manejar la respuesta del servidor, por ejemplo, mostrar la tabla en el contenedor
        const tablaContainer = document.getElementById('tablaContainer');
        if (tablaContainer) {
            tablaContainer.innerHTML = respuesta;
            // Puedes realizar cualquier otra acción que necesites aquí
        }
        else {
            console.error("El elemento con ID 'tablaContainer' no se encontró en el DOM.");
        }
    });
}
function listarAlumnos() {
    const datos = {
        accion: 'listar'
    };
    enviarSolicitud('listar', datos, function (respuesta) {
        // Manejar la respuesta del servidor, por ejemplo, mostrar la lista de alumnos en la interfaz de usuario
        console.log(respuesta);
    });
}
function verificarAlumno(legajo) {
    const datos = {
        accion: 'verificar',
        legajo
    };
    enviarSolicitud('verificar', datos, function (respuesta) {
        // Manejar la respuesta del servidor, por ejemplo, mostrar información del alumno en la interfaz de usuario
        console.log(respuesta);
    });
}
function modificarAlumno(legajo, nombre, apellido) {
    const datos = {
        accion: 'modificar',
        legajo,
        nombre,
        apellido
    };
    enviarSolicitud('modificar', datos, function (respuesta) {
        // Manejar la respuesta del servidor, por ejemplo, mostrar un mensaje de éxito o error en la interfaz de usuario
        console.log(respuesta);
    });
}
function borrarAlumno(legajo) {
    const datos = {
        accion: 'borrar',
        legajo
    };
    enviarSolicitud('borrar', datos, function (respuesta) {
        // Manejar la respuesta del servidor, por ejemplo, mostrar un mensaje de éxito o error en la interfaz de usuario
        console.log(respuesta);
    });
}
// Llama a estas funciones cuando sea necesario desde eventos de la interfaz de usuario
//# sourceMappingURL=funciones.js.map