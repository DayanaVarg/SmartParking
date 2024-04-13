const errorAlert = document.getElementById('errorAlert');
const successAlert = document.getElementById('successAlert');
const spaceBtn1 = document.querySelector('.spaceBtn1');
const spaceBtn2 = document.querySelector('.spaceBtn2');

function ajustarMargenes() {
    if (errorAlert || successAlert ) {
        spaceBtn1.style.marginTop = '9%'; 
        spaceBtn2.style.marginTop = '18%'; 
    } else {
        spaceBtn1.style.marginTop = '6%';
        spaceBtn2.style.marginTop = '12%'; 
    }
}