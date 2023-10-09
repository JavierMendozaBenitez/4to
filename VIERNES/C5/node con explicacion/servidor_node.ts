//gestiona ida y vuelta con servidor node
const express = require("express");

const app = express();

//establecer puertos
app.set("puerto", 8008);

//adonde va a escuchar y despues que va a hacer, es el callback
app.listen(app.get("puerto"), ()=>{
    console.log("servidor corriendo sobre puerto ", app.get("puerto"));
});


//es para el tipo de dato file string, archivos de texto
const fs = require("fs");

//habilita manipular objetos json. Es una funcion q está a nivel de aplicacion, es como encode y decode
app.use(express.json());

//directorio donde va estar el archivo, esta es la referencia. Es para el crud de producto
const path_archivo = "./archivos/productos.txt";



//establecer ruta para nuestro servidor expres, es el lugar 
//donde voy a indicar con que nombre se va a acceder a tal 
//dirección de mi servidor y sobre todo con que metodo, get o post.
//Comenzamos con la default, get. Accedemos al raiz con /
app.get('/',(request:any, response:any)=>{
    response.send('GET - servidor NodeJS');
});

//hacemos un crud. GET hacemos listados. Para agregar usamos POST. Modificar PUT. Eliminar DELETE
app.post('/',(request:any, response:any)=>{
    response.send('POST - servidor NodeJS');
});

app.put('/',(request:any, response:any)=>{
    response.send('PUT - servidor NodeJS');
});

app.delete('/',(request:any, response:any)=>{
    response.send('DELETE - servidor NodeJS');
});


//nuevo

//listar. Contenido es el contenido del archivo leido
app.get('/productos',(request:any, response:any)=>{
    fs.readFile(path_archivo, "UTF-8", (error:any, contenido:any)=>{
        if(error){
            throw("No se pudo leer");
        }
        let array = contenido.split(",\r\n");

        response.send(JSON.stringify(array));
    });
});

//hacemos un crud. GET hacemos listados. Para agregar usamos POST. Modificar PUT. Eliminar DELETE
//response es el segundo parametro de la funcion callback de la ruta post
//Agregar
app.post('/productos',(request:any, response:any)=>{
    let dato = request.body;//cuerpo de la peticion, le digo q envio un json q despues se va a serializar
    let contenido = JSON.stringify(dato);//lo transformo en lineas, en cadena, lo serializo

    //vas agregando contenido, lo escribis
    fs.appendFile(path_archivo, contenido + ",\r\n", (err:any)=>{
        if(err)//si hay alguna falla aparecera en err
        {
            throw("Error al escribir en el archivo.");
        }

        console.log("Archivo agregado correctamente.");
        response.send("Archivo agregado correctamente.");

    });
});

// //modificar
// //leer de un archivo, hacer una busqueda y escribir en el archivo con los datos cambiados
// app.put('/productos',(request:any, response:any)=>{
//     //recuperamos el objeto json que queremos modificar
//     let obj = request.body;
//     let productosString = "";

//     //buscamos el archivo
//     fs.readFile(path_archivo, "UTF-8", (err:any, contenido:any)=>{
//         if(err){
//             throw("Error al leer archivo");
//         }

//         //en array hay un array de cadenas con objeto json incluidos
//         let array = contenido.split(",\r\n");        
        
//         //recorremos el array para buscar objeto por objeto a ver si uno coincide, si lo hace, modifico
//         array.forEach((item:any)=>{
//             if(item != "" && item != undefined)
//             {
//                 let itemObj = JSON.parse(item);//parseamos el objeto de cadena a objeto

//                 if(itemObj.codigo == obj.codigo)//si son iguales el elemento que busco se encontro en algun lugar
//                 {
//                     itemObj.marca = obj.Marca;
//                     itemObj.precio = obj.precio;
//                 }
//                 //reconstruyo mi archivo con el objeto modificado
//                 productosString += JSON.stringify(itemObj) + ",\r\n";//Esto te arma un producto por reglon
//             }       
//         });    
//     });
//         //Pisamos el archivo con lo nuevo modificado
//         fs.writeFile(path_archivo, productosString,(err:any)=>{
//             if(err){
//                 throw("No se pudo escribir el archivo");
//             }
//             console.log("Archivo escrito");
//             response.send("Archivo escrito");
//         });
    
// });
//modificar
app.put('/productos', (request:any, response:any)=>{   
    let obj = request.body;

    fs.readFile(path_archivo, "UTF-8", (err:any, contenido:any) => {
        if (err) {
            throw ("Error al leer el archivo.");
        }

        let array = contenido.split(",\r\n");
        let productosString = "";

        array.forEach((item:any) => {
            if (item != "" && item != undefined) {
                let itemObj = JSON.parse(item);

                if (itemObj.codigo == obj.codigo) {
                    itemObj.marca = obj.marca;
                    itemObj.precio = obj.precio;
                }

                productosString += JSON.stringify(itemObj) + ",\r\n";
            }
        });

        fs.writeFile(path_archivo, productosString, (err:any) => {
            if (err) {
                throw ("Error al escribir el archivo.");
            }

            console.log("Archivo modificado exitosamente.");
            response.send("Archivo modificado exitosamente.");
        });
    });
});

app.delete('/productos',(request:any, response:any)=>{
    let obj = request.body;

    fs.readFile(path_archivo, "UTF-8", (err:any, contenido:any) => {
        if (err) {
            throw ("Error al leer el archivo.");
        }

        let array = contenido.split(",\r\n");
        let productosString = "";

        array.forEach((item:any) => {
            if (item != "" && item != undefined) {
                let itemObj = JSON.parse(item);

                if (itemObj.codigo != obj.codigo) {
                    productosString += JSON.stringify(itemObj) + ",\r\n";
                }                
            }
        });

        fs.writeFile(path_archivo, productosString, (err:any) => {
            if (err) {
                throw ("Error al escribir el archivo.");
            }

            console.log("Archivo eliminado exitosamente.");
            response.send("Archivo eliminado exitosamente.");
        });
    });
});

