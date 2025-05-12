// getData para el edit-categoria
// obtener el valor de edit-categoria
let editCategoria = document.getElementById("edit-categoria");
let deleteCategoria = document.getElementById("delete-categoria");
// editar categoria: accedes a estas opciones, una vez que se muestre el modal
editCategoria.addEventListener("shown.bs.modal", (event) => {

    // creo que se usa para evitar que el modal se elimine cuando se acciona fuera de este.
    let button = event.relatedTarget;
    // agarra el valor del atributo data-bs-id del evento boton
    let id = button.getAttribute("data-bs-id");

    // del contenido del class "modal-body" recogemos el "#id"  y el resto de datos correspondientes pasados al "nuevo_modal"
    let inputId = editCategoria.querySelector(".modal-body #id");
    let inputCategoria = editCategoria.querySelector(".modal-body #Categoria");
    

    //archivo para la peticion
    let url = "../crud/seleccionarCategoria.php";
    let formData = new FormData();
    //guarda en variable 'id' al dato que esta el nombre id dentro de este archivo
    // metodo del objeto FormData, usado para generar un nuevo clave-valor para enviar al archivo el valor con metodo POST.
    formData.append("id", id);

    fetch(url, {
        method: "POST",
        body: formData,
    })
    // se dos tipos de respuesta, la 1era es que el resultado , devuelve los datos json (JavaScript Object Notation) en lenguaje JS.
    .then((response) => response.json())
        // este 2do resultado devuelve una funcion para usar los datos anteriores.
    .then((data) => {
        //nombre puesto por este script=data.nombre del campo de la tabla x
        // reemplazar el valor del inputId por el valor de la prop id_categoria en el objeto data
        inputId.value = data.id_categoria;
        inputCategoria.value = data.nombre_categoria;
    })
    .catch((err) => console.log(err));
});

// eliminar categoria
deleteCategoria.addEventListener("shown.bs.modal", (event) => {
    let button = event.relatedTarget;
    // agarra el id, luego se selecciona por el data-bs-id solamente el elegido
    let id = button.getAttribute("data-bs-id");
    deleteCategoria.querySelector(".modal-footer #id").value = id;
});

// ----------------------------------------------------------------------------------------

