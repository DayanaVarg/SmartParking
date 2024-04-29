<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registerForm');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        Swal.fire({
            title: 'Seleccione una opción',
            icon:'info',
            iconColor: '#544A0D',
            html: `
                <div class="btn-group">
                    <button class="btn-option" onclick="handleOption('Código QR')">Código QR</button>
                    <button class="btn-option" onclick="handleOption('Código de Barras')">Código de Barras</button>
                </div>
            `,
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            showConfirmButton: false
        });
    });
});

function handleOption(option) {
    let actionUrl;

    if (option === 'Código QR') {
        actionUrl = '<?= base_url('vehicle/registerEntQr') ?>'; 
    } else {
        actionUrl = '<?= base_url('vehicle/registerEntBar') ?>'; 
    }

    const form = document.getElementById('registerForm');
    form.action = actionUrl;
    form.submit();
}

</script>