const typeSelect = document.getElementById('type');
const motoImage = document.getElementById('motoImage');
const carImage = document.getElementById('carImage');

typeSelect.addEventListener('change', function() {
    if (this.value === 'Moto') {
        motoImage.style.display = 'inline';
        carImage.style.display = 'none';
    } else if (this.value === 'Carro') {
        motoImage.style.display = 'none';
        carImage.style.display = 'inline';
    } else {
        motoImage.style.display = 'none';
        carImage.style.display = 'none';
    }
});


