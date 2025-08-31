<script>
    let btn_salir = document.querySelector(".btn_salir");

    btn_salir.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¡Deseas cerrar sesión!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, cerrar sesión",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.value) {
                //url para cerrar sesión
                let url = '<?php echo SERVERURL; ?>ajax/loginAjax.php';
                let token = '<?php echo $ic->encryption($_SESSION['token_scl']); ?>';
                let usuario = '<?php echo $ic->encryption($_SESSION['usuario_scl']); ?>';

                let datos = new FormData();
                datos.append('token', token);
                datos.append('usuario', usuario);

                fetch(url, {
                        method: 'POST',
                        body: datos
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        return alertas_ajax(respuesta);
                    });
            }
        });
    });
</script>