<!-- bundle -->
<script src="<?php echo SERVERURL; ?>views/assets/js/vendor.min.js"></script>
<script src="<?php echo SERVERURL; ?>views/assets/js/app.min.js"></script>

<!-- third party js -->
<script src="<?php echo SERVERURL; ?>views/assets/js/vendor/apexcharts.min.js"></script>
<script src="<?php echo SERVERURL; ?>views/assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo SERVERURL; ?>views/assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
<!-- third party js ends -->

<!-- demo app -->
<script src="<?php echo SERVERURL; ?>views/assets/js/pages/demo.dashboard.js"></script>
<!-- end demo js-->

<!-- alertas js -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo SERVERURL; ?>views/assets/js/alerta.js"></script>
<script src="<?php echo SERVERURL; ?>views/assets/js/main.js"></script>
<!-- fin alertas js -->
<script>
    const select = document.getElementById("yearSelect");
    const yearActual = new Date().getFullYear();
    const añosAtras = 10; // Años a mostrar antes del actual

    // Generar rango de años (ej. del actual-10 al actual+1)
    for (let i = yearActual - añosAtras; i <= yearActual + 1; i++) {
        let option = document.createElement("option");
        option.value = i;
        option.text = i;

        // Seleccionar el año actual por defecto
        if (i === yearActual) {
            option.selected = true;
        }

        select.add(option);
    }
</script>