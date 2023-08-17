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
// Buscar en Vehículos
const searchConductor = document.getElementById('conductor');
const searchChapa = document.getElementById('chapa');
// Buscar en Empresas
const searchRazonSocial = document.getElementById('razon_social');
const searchRuc = document.getElementById('ruc');

function getCleanUrl() {
    return window.location.href.split('?')[0];
}

function getResource() {
    return getCleanUrl().split('/').pop();
}

if (searchForm) {
    searchForm.addEventListener('submit', function (event) {
        event.preventDefault();
        // const chapaDOM = event.target.firstElementChild;
        // const chapa = chapaDOM.value.toUpperCase();
        // const conductor = chapaDOM.nextElementSibling.value;
        const chapa = searchChapa?.value ?? '';
        const conductor = searchConductor?.value ?? '';
        const razonSocial = searchRazonSocial?.value ?? '';
        const ruc = searchRuc?.value ?? '';

        console.log(razonSocial.length);
        console.log(ruc.length);
        console.log(chapa.length);
        console.log(conductor.length);

        // Identificar resource (vehiculos o empresas)
        let url = getCleanUrl();
        const resource = getResource();
        console.log(resource);

        if (resource === 'vehiculos') { }
        if (resource === 'empresas') { }

        if (resource === 'vehiculos' && conductor.length === 0 && chapa.length === 0) return;
        if (resource === 'empresas' && razonSocial.length === 0 && ruc.length === 0) return;

        console.log('pasó los guard clauses');

        // Enviar dato como QueryString
        // Modificar URL Vehículos
        if (chapa || conductor) {
            if (chapa.length > 0) url += `?chapa=${chapa}`;
            if (conductor.length > 0) url += (chapa.length > 0) ? `&conductor=${conductor}` : `?conductor=${conductor}`;
        }

        // Modificar URL Empresas
        if (razonSocial || ruc) {
            if (razonSocial.length > 0) url += `?razon_social=${razonSocial}`;
            if (ruc.length > 0) url += (razonSocial.length > 0) ? `&ruc=${ruc}` : `?ruc=${ruc}`;
        }

        // console.log(url);
        window.location.href = url;
    });
}


// FUNCIONALIDAD DE BORRAR CONTENIDO DE LOS CAMPOS DE BÚSQUEDA
const btnClearFields = document.getElementById('btnClearFields');

if (btnClearFields) {
    btnClearFields.addEventListener('click', function () {
        if (searchConductor) searchConductor.value = '';
        if (searchChapa) searchChapa.value = '';
        if (searchRazonSocial) searchRazonSocial.value = '';
        if (searchRuc) searchRuc.value = '';
        const url = window.location.href.split('?')[0];
        window.location.href = url;
    });
}

// BORRAR VEHICULOS/EMPRESAS
let deleteModalContent = document.getElementById('deleteModalContent');
let currentForm; // guarda el delete form del btn al que se hizo click

// FUNCIONALIDAD PARA BORRAR VEHICULOS (ADMIN)

// En /vehiculos (index)
const btnsFormDeleteVehicle = document.querySelectorAll('.btnFormDeleteVehicle'); // btns dentro de cada 'hidden delete form'
const btnModalBorrarVehiculo = document.getElementById('btnModalBorrarVehiculo');

if (btnsFormDeleteVehicle.length > 0) {
    btnsFormDeleteVehicle.forEach(function (btnFormDeleteVehicle) {
        btnFormDeleteVehicle.addEventListener('click', function (event) {
            event.preventDefault();

            currentForm = event.target.closest('.deleteForm');

            const vehiculoImei = event.target.closest('.btnFormDeleteVehicle').dataset.vehiculoImei;
            deleteModalContent.textContent = `¿Está seguro de que desea borrar el vehículo con el Imei ${vehiculoImei}?`;
        });
    })
}


// En /vehiculos/# (show)
const btnDeleteVehicleShow = document.getElementById('btnDeleteVehicleShow');

if (btnDeleteVehicleShow) {
    btnDeleteVehicleShow.addEventListener('click', function (event) {
        event.preventDefault();
        currentForm = event.target.closest('.deleteForm');
    });
}

// Borrar Vehiculo en el Modal
if (btnModalBorrarVehiculo) {
    btnModalBorrarVehiculo.addEventListener('click', function () {
        currentForm.submit();
    });
}

// FUNCIONALIDAD PARA BORRAR EMPRESAS (ADMIN)

// En /empresas (index)
const btnsFormDeleteEmpresa = document.querySelectorAll('.btnFormDeleteEmpresa'); // btns dentro de cada 'hidden delete form'
const btnModalBorrarEmpresa = document.getElementById('btnModalBorrarEmpresa');

if (btnsFormDeleteEmpresa.length > 0) {
    btnsFormDeleteEmpresa.forEach(function (btnFormDeleteEmpresa) {
        btnFormDeleteEmpresa.addEventListener('click', function (event) {
            event.preventDefault();

            currentForm = event.target.closest('.deleteForm');
            console.log(currentForm);

            const razonSocial = event.target.closest('.btnFormDeleteEmpresa').dataset.razonSocial;
            deleteModalContent.textContent = `¿Está seguro de que desea borrar la empresa ${razonSocial}?`;
        });
    })
}

// En /empresas/# (show)
const btnDeleteEmpresaShow = document.getElementById('btnDeleteEmpresaShow');

if (btnDeleteEmpresaShow) {
    btnDeleteEmpresaShow.addEventListener('click', function (event) {
        event.preventDefault();
        currentForm = event.target.closest('.deleteForm');
    });
}

// Borrar Empresa en el Modal
if (btnModalBorrarEmpresa) {
    btnModalBorrarEmpresa.addEventListener('click', function () {
        currentForm.submit();
    });
}