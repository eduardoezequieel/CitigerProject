//Constante para la direccion de la API
const API_USUARIO = '../../app/api/dashboard/usuarios.php?action=';

//Evento que se ejecuta al cargar el DOM 
document.addEventListener('DOMContentLoaded', function () {
    // Se declara e inicializa un objeto para obtener la fecha y hora actual.
    let today = new Date();
    // Se declara e inicializa una variable para guardar el día en formato de 2 dígitos.
    let day = ('0' + today.getDate()).slice(-2);
    // Se declara e inicializa una variable para guardar el mes en formato de 2 dígitos.
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    // Se declara e inicializa una variable para guardar el año con la mayoría de edad.
    let year = today.getFullYear() - 18;
    // Se declara e inicializa una variable para establecer el formato de la fecha.
    let date = `${year}-${month}-${day}`;
    // Se asigna la fecha como valor máximo en el campo del formulario.
    document.getElementById('txtNacimiento').setAttribute('max', date);

    //Se verifica si hay usuarios existentes
    fetch(API_USUARIO + 'readAll')
    .then(request => {
        //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
        if (request.ok) {
            request.json().then(response => {
                //Se verifica si la respuesta fue satisfactoria, de ser asi se redirecciona al login
                if (response.status) {
                    sweetAlert(3, response.message, 'index.php');
                }
            })
        } else {
            console.log(response.status + ' ' + response.exception);
        }
    }).catch(error => console.log(error));
})

//Evento submit del formulario para registrar al primer usuario
document.getElementById('primeruso-form').addEventListener('submit', function (event) {
    //Evento para evitar que recargue la página
    event.preventDefault();
    //Fetch para registrar al primer usuario del sistema
    fetch(API_USUARIO + 'register', {
        method: 'post',
        body: new FormData(document.getElementById('primeruso-form'))
    }).then(request => {
        //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
        if (request.ok) {
            request.json().then(response => {
                //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                if (response.status) {
                    sweetAlert(1, response.message, 'index.php');
                } else {
                    sweetAlert(2, response.exception, null);
                }
            })
        } else {
            console.log(response.status + ' ' + response.exception);
        }
    }).catch(error => console.log(error));
})

//Metodo para usar un boton diferente de examinar
botonExaminar('btnAgregarFoto', 'archivo_usuario');

//Metodo para crear una previsualizacion del archivo a cargar en la base de datos
previewPicture('archivo_usuario','divFoto');

function botonExaminar(idBoton, idInputExaminar){
    document.getElementById(idBoton).addEventListener('click', function(event){
        //Se evita recargar la pagina
        event.preventDefault();
    
        //Se hace click al input invisible
        document.getElementById(idInputExaminar).click();
    });
}

function previewPicture(idInputExaminar, idDivFoto){
    document.getElementById(idInputExaminar).onchange=function(e){

        //variable creada para obtener la URL del archivo a cargar
        let reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
    
        //Se ejecuta al obtener una URL
        reader.onload=function(){
            //Parte de la pagina web en donde se incrustara la imagen
            let preview=document.getElementById(idDivFoto);
    
            //Se crea el elemento IMG que contendra la preview
            image = document.createElement('img');
    
            //Se le asigna la ruta al elemento creado
            image.src = reader.result;
    
            //Se aplican las respectivas clases para que la preview aparezca estilizada
            image.className = 'fit-images rounded-circle';
    
            //Se quita lo que este dentro del div (en caso de que exista otra imagen)
            preview.innerHTML = ' ';
    
            //Se agrega el elemento recien creado
            preview.append(image);
        }
    }
}