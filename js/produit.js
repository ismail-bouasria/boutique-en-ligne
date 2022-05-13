'use strict';

// Evenement pour charger le scripte sur toute la page 
document.addEventListener('DOMContentLoaded', function loaded() {

    window.onload = function () {
        var input = document.getElementById('quantite'),
            plus = document.getElementById('plus'),
            moins = document.getElementById('moins');
        var colisage = parseInt(document.getElementById('quantite').getAttribute('colisage'));
        var mini = parseInt(document.getElementById('quantite').getAttribute('min'));
        var max = parseInt(document.getElementById('quantite').getAttribute('max'));

        plus.onclick = function (e) {
            if ( input.value < max){
                    e.preventDefault();
                    input.value++;
            }else{
                e.preventDefault();

            }
        }
            moins.onclick = function (e) {
                e.preventDefault();
                if (input.value > 1) input.value--;
            }
       

    };

   


})