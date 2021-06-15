//Constante para la direccion de la API
const API_EMPLEADO = '../../app/api/dashboard/empleados.php?action=';

document.getElementById('btnInsertDialog').addEventListener('click',function(){
    document.getElementById('btnAgregar').className="btn btnAgregarFormulario mr-2";
    document.getElementById('btnActualizar').className="d-none";
    document.getElementById('btnSuspender').className="d-none";
    document.getElementById('btnActivar').className="d-none";
});

document.getElementById('btnAgregar'),addEventListener('click',function(){
    document.getElementById('administrarEmpleado-form').addEventListener('submit',function(event){
        event.preventDefault();

        //Evento para evitar que recargue la página
        event.preventDefault();
        //Fetch para registrar al primer usuario del sistema
        fetch(API_EMPLEADO + 'createRow', {
            method: 'post',
            body: new FormData(document.getElementById('administrarEmpleado-form'))
        }).then(request => {
            //Se la verifica si la petición fue correcta de lo contrario muestra un mensaje de error en consola
            if (request.ok) {
                request.json().then(response => {
                    //Se verifica si la respuesta fue satisfactoria, de lo contrario se muestra la excepción
                    if (response.status) {
                        sweetAlert(1, response.message, null);
                    } else {
                        sweetAlert(2, response.exception, null);
                    }
                })
            } else {
                console.log(response.status + ' ' + response.exception);
            }
        }).catch(error => console.log(error));
    })
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
            image.className = 'fit-images rounded-circle fotoPrimerUso';
    
            //Se quita lo que este dentro del div (en caso de que exista otra imagen)
            preview.innerHTML = ' ';
    
            //Se agrega el elemento recien creado
            preview.append(image);
        }
    }
}