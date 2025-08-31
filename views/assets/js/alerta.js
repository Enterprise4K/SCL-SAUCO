// seleccionamos todos los formularios con la clase ajax
const formulario_ajax = document.querySelectorAll(".FormularioAjax");

function enviar_formulario_ajax(e) {
    e.preventDefault();

    let data = new FormData(this);
    let method = this.getAttribute("method");
    let action = this.getAttribute("action");
    let tipo  = this.getAttribute("data-form");

    let encabezados = new Headers();
    
    let config = {
        method: method,
        header: encabezados,
        mode: 'cors',
        cache: 'no-cache',
        body: data
    }

    let texto_alerta;

    if (tipo === "save") {
        texto_alerta="Los datos quedaran guardados en el sistema";
    }else if (tipo === "delete") {
        texto_alerta="Los datos seran eliminados completamente del sistema";
    }else if (tipo === "update") {
        texto_alerta="Los datos seran actualizados";
    }else if (tipo === "search") {
        texto_alerta="se eliminara el termino de búsqueda y tendras que escribir uno nuevo";
    }else if (tipo === "load") {
        texto_alerta="dDesea remover los datos seleccionado para ordenes de compra o servicio";
    }else {
        texto_alerta= "Quieres realizar la operacion solicitada"
    }

    Swal.fire({
        title: 'Estas Seguro?',
        text: texto_alerta,
        icon: 'question',
        showCancelButton:true,
        confirmButtonColor:'#3085d6',
        cancelButtonColor:'#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText:'Cancelar' 
    }).then((result) => {
        if (result.value) {
        fetch(action,config)
        .then(respuesta => respuesta.json())
        .then(respuesta => {
                return alertas_ajax(respuesta);
        });
        }
    });
}

formulario_ajax.forEach(formularios => {

    formularios.addEventListener("submit", enviar_formulario_ajax);
});

function alertas_ajax(alerta) {
    if (alerta.Alerta === "simple") {
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Icono,
            confirmButtonText: 'Aceptar'
        });
    } else if (alerta.Alerta === "recargar") {
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Icono,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        });
    } else if(alerta.Alerta === "limpiar")
    {
        Swal.fire({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Icono,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.value) {
                document.querySelector(".FormularioAjax").reset();
            }
        });
    }else if (alerta.Alerta === "redireccionar") 
    {
        window.location.href=alerta.URL;
    }
}