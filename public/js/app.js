"use strict";

// // Activar/desactivar los botones del sidebar
// const allNavLinks = document.querySelectorAll(".nav-link");
// const allNavItems = document.querySelectorAll(".nav-item");
// const sidebar = document.querySelector(".navbar-nav");

// // Event listener del sidebar
// sidebar.addEventListener("click", function (event) {
//     const currentNavLink = event.target;

//     if (!currentNavLink.classList.contains("nav-item")) return;
//     console.log("funciona");
// });

// console.log('Funciona el Script');


// FUNCIONALIDAD DE BUSQUEDA (CHAPA Y CONDUCTOR) ###################################
const searchForm = document.getElementById('searchForm');
const searchConductor = document.getElementById('conductor');
const searchChapa = document.getElementById('chapa');


searchForm.addEventListener('submit', function (event) {
    event.preventDefault();
    // const chapaDOM = event.target.firstElementChild;
    // const chapa = chapaDOM.value.toUpperCase();
    // const conductor = chapaDOM.nextElementSibling.value;
    const chapa = searchChapa.value;
    const conductor = searchConductor.value;

    if (conductor.length === 0 && chapa.length === 0) return;

    // Enviar dato como QueryString
    let url = window.location.href.split('?')[0];
    // console.log(url);
    if (chapa.length > 0) url += `?chapa=${chapa}`;
    if (conductor.length > 0) url += (chapa.length > 0) ? `&conductor=${conductor}` : `?conductor=${conductor}`;
    // console.log(url);
    window.location.href = url;
});


// FUNCIONALIDAD DE BORRAR CONTENIDO DE LOS CAMPOS DE BÚSQUEDA
const btnClearFields = document.getElementById('btnClearFields');

btnClearFields.addEventListener('click', function () {
    searchConductor.value = '';
    searchChapa.value = '';
    const url = window.location.href.split('?')[0];
    window.location.href = url;
});

// FUNCIONALIDAD PARA BORRAR VEHICULOS (ADMIN)
const btnsFormDeleteVehicle = document.querySelectorAll('.btnFormDeleteVehicle'); // btns dentro de cada 'hidden delete form'
let deleteModalContent = document.getElementById('deleteModalContent');
const btnBorrarVehiculo = document.getElementById('btnBorrarVehiculo');
let currentForm; // guarda el delete form del btn al que se hizo click

btnsFormDeleteVehicle.forEach(function (btnFormDeleteVehicle) {
    btnFormDeleteVehicle.addEventListener('click', function (event) {
        event.preventDefault();

        currentForm = event.target.closest('.deleteForm');

        const vehiculoImei = event.target.closest('.btnFormDeleteVehicle').dataset.vehiculoImei;
        deleteModalContent.textContent = `¿Está seguro de que desea borrar el vehículo con el Imei ${vehiculoImei}?`;
    });
})

btnBorrarVehiculo.addEventListener('click', function () {
    currentForm.submit();
    // console.log(currentForm);
});