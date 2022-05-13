'use strict';

// Evenement pour charger le scripte sur toute la page 
document.addEventListener('DOMContentLoaded', function loaded() {


    var input = document.querySelector('.quantite'),
        plus = document.querySelector('.plus1'),
        moins = document.querySelector('.moins1');
   var max = document.querySelector('.quantite.max');
   var total = document.querySelector('.prix.h3.b');

    console.log(input);
    console.log(plus);
    console.log(max);


    moins.forEach(element => {
        element.onclick = function (e) {
            input.forEach(element3 => {
                console.log(element3);

                if (element3.value > 1) {
                    e.preventDefault();
                    element3.value--;
                } 
            })
        }
    });

    //         moins.onclick = function (e) {
    //             e.preventDefault();
    //             if (input.value > 1) input.value--;
    //         }


    // plus.onclick = function (e) {
    //     if ( input.value < max){
    //             e.preventDefault();
    //             input.value++;
    //     }else{
    //         e.preventDefault();

    //     }
    // }
    //     moins.onclick = function (e) {
    //         e.preventDefault();
    //         if (input.value > 1) input.value--;
    //     }







})