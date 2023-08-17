// VARIABLES ---------------------------------------------------------------------
const vehiculo_icon_path = 'M42.3 110.94c2.22 24.11 2.48 51.07 1.93 79.75-13.76.05-24.14 1.44-32.95 6.69-4.96 2.96-8.38 6.28-10.42 12.15-1.37 4.3-.36 7.41 2.31 8.48 4.52 1.83 22.63-.27 28.42-1.54 2.47-.54 4.53-1.28 5.44-2.33.55-.63 1-1.4 1.35-2.31 1.49-3.93.23-8.44 3.22-12.08.73-.88 1.55-1.37 2.47-1.61-1.46 62.21-6.21 131.9-2.88 197.88 0 43.41 1 71.27 43.48 97.95 41.46 26.04 117.93 25.22 155.25-8.41 32.44-29.23 30.38-50.72 30.38-89.54 5.44-70.36 1.21-134.54-.79-197.69.69.28 1.32.73 1.89 1.42 2.99 3.64 1.73 8.15 3.22 12.08.35.91.8 1.68 1.35 2.31.91 1.05 2.97 1.79 5.44 2.33 5.79 1.27 23.9 3.37 28.42 1.54 2.67-1.07 3.68-4.18 2.31-8.48-2.04-5.87-5.46-9.19-10.42-12.15-8.7-5.18-18.93-6.6-32.44-6.69-.75-25.99-1.02-51.83-.01-77.89C275.52-48.32 29.74-25.45 42.3 110.94zm69.63-90.88C83.52 30.68 62.75 48.67 54.36 77.59c21.05-15.81 47.13-39.73 57.57-57.53zm89.14-4.18c28.41 10.62 49.19 28.61 57.57 57.53-21.05-15.81-47.13-39.73-57.57-57.53zM71.29 388.22l8.44-24.14c53.79 8.36 109.74 7.72 154.36-.15l7.61 22.8c-60.18 28.95-107.37 32.1-170.41 1.49zm185.26-34.13c5.86-34.1 4.8-86.58-1.99-120.61-12.64 47.63-9.76 74.51 1.99 120.61zM70.18 238.83l-10.34-47.2c45.37-57.48 148.38-53.51 193.32 0l-12.93 47.2c-57.58-14.37-114.19-13.21-170.05 0zM56.45 354.09c-5.86-34.1-4.8-86.58 1.99-120.61 12.63 47.63 9.76 74.51-1.99 120.61z';

let map, getLocation, newLocation, coords, lastFechaHora, vehiclePath;
let allVehicles = [];
let lastLocations = new Map();
let newLocations = new Map();
let allMarkers = {};
let allMarkersColor = {};
// let allLastFechaHora = []
let vehiclesCoords = new Map(); // guardará las coordenadas de cada vehículo
let vehiclesPaths = {};  // guardará el recorrido de cada vehículo (polyline)
let vehiclesArrowPaths = {}; // polyline superpuesto al anterior para mostrar flechas en la dirección de movimiento

let infoWindow;
let infoWindowData = {
    is_open: false,
    vehicle: '',
};

// FUNCTIONS ---------------------------------------------------------------------------
// Obtener un color aleatorio (hexadecimal)
const randomColor = () => {
    return "#" + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0').toUpperCase();
}

// Obtener ubicación (para el mapa inicial)
const getInitialLocation = () => {
    // lat:-25.3261237, lng:-57.5550702, zoom: 11
    return { lat: -25.3261237, lng: -57.5550702 };
};

// Crear Marcador
const createMarker = (coords, vehicle) => {
    return new google.maps.Marker({
        position: coords,
        map,
        title: `Imei: ${vehicle}`,
    });
};

// Obtener el contenido para cada InfoWindows
const getData = (vehicle) => {
    let text = `<div id="infoWindow"><h4>Imei: ${vehicle.imei}</h4>`;
    text += `<p>Conductor: ${vehicle.conductor}</p>`;
    text += `<p>Vehiculo: ${vehicle.vehiculo}</p>`;
    text += `<p>Chapa: ${vehicle.chapa}</p>`;
    text += `<p>Velocidad: ${vehicle.speed}</p>`;
    text += `<p>FechaHora: ${vehicle.fechaHora}</p></div>`;
    return text;
}

// Cerrar todos los InfoWindows 'abiertos' del mapa
const closeInfoWindow = function () {
    infoWindowData.vehicle = '';
    infoWindowData.is_open = false;
};

// Abrir un InfoWindow específico
const openInfoWindow = (infoWindow, vehicle) => {
    infoWindow.setContent(getData(lastLocations.get(vehicle)));

    infoWindow.open({
        anchor: allMarkers[vehicle],
        map,
    });

    infoWindowData.vehicle = vehicle;
    infoWindowData.is_open = true;
};

// Filtrar vehículos que el usuario puede ver
const filterVehicles = function (vehiclesLocation) {
    return vehiclesLocation.filter(vehicle => vehicle.empresa_id === user.empresa_id);
};


// -------------------------------------------------------------------------------------
async function initMap() {
    // Obtener la primera localizacion de cada vehículo
    getLocation = await fetch(`http://127.0.0.1:8000/location/lastLocations`);
    newLocation = await getLocation.json(); // [{}, {}, ...]

    // Filtrar vehículos (si no es admin)
    if (user.empresa_id) {
        newLocation = filterVehicles(newLocation);
    }

    /*
    EJEMPLO DE OBJETO
    {
        "imei": "7483650274",
        "lat": "-25.3216767",
        "lng": "-57.5621272",
        "conductor": "Javier Lopez",
        "vehiculo": "BMW X6",
        "empresa_id": 2,
        "speed": "38.11",
        "fechaHora": "2023-06-24 00:37:39"
    },
    */

    // Obtener los datos iniciales
    newLocation.forEach(vehicle => {
        allVehicles.push(vehicle.imei); // array de imeis de todos los vehículos
        lastLocations.set(vehicle.imei, vehicle); // guarda los últimos datos de cada vehículo

        vehiclesCoords.set(vehicle.imei, []); // guarda los recorridos de cada vehículo
        vehiclesCoords.get(vehicle.imei).push({ lat: +lastLocations.get(vehicle.imei).lat, lng: +lastLocations.get(vehicle.imei).lng }); // guarda el punto inicial del recorrido
        allMarkers[vehicle.imei] = {}; // guarda el Marcador de cada vehículo
        vehiclesPaths[vehicle.imei] = {};
        vehiclesArrowPaths[vehicle.imei] = {};
        allMarkersColor[vehicle.imei] = randomColor(); // guarda el color del Marcador de cada vehículo
    });

    // TODO: HACER QUE EL MAPA SELECCIONE UN ZOOM AUTOMÁTICO PARA QUE SE PUEDAN VER TODOS LOS MARKERS A LA VEZ

    // Si no hay localizaciones en la DB => sólo carga una coordenada inicial para el mapa
    const initialMapCoords = newLocation.length === 0 ? getInitialLocation() : { lat: +lastLocations.get(allVehicles[0]).lat, lng: +lastLocations.get(allVehicles[0]).lng };

    // Crear el Mapa
    const { Map } = await google.maps.importLibrary("maps");
    map = new Map(document.getElementById("map"), {
        center: initialMapCoords,
        zoom: 11,
    });

    // Flecha para mostrar la dirección del recorrido
    const lineSymbol = {
        path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
        strokeOpacity: 1,
        scale: 4,
    };

    // Crear INFOWINDOW
    infoWindow = new google.maps.InfoWindow({
        content: '',
        ariaLabel: `InfoWindows`,
    });

    // Event Listener para cerrar InfoWindows
    infoWindow.addListener('closeclick', () => {
        closeInfoWindow();
    });

    // Colocar el 1er Marcador de cada vehículo
    allVehicles.forEach(vehicle => {
        // Crear Marcadores
        coords = { lat: parseFloat(lastLocations.get(vehicle).lat), lng: parseFloat(lastLocations.get(vehicle).lng) };
        allMarkers[vehicle] = createMarker(coords, vehicle);

        // Event Listeners para abrir InfoWindows
        allMarkers[vehicle].addListener("click", () => {
            openInfoWindow(infoWindow, vehicle);
        });
    });

    // Verificar nueva localización cada 5 seg
    setInterval(async function () {
        getLocation = await fetch('http://127.0.0.1:8000/location/lastLocations');
        newLocation = await getLocation.json();

        newLocation.forEach(vehicle => {
            newLocations.set(vehicle.imei, vehicle); // guarda los nuevos datos de cada vehículo
        });

        allVehicles.forEach(vehicle => {
            // OBS: 'vehicle' es el IMEI (string)

            // VERIFICAR QUE NO SEA LA MISMA LOCALIZACION (repetido)
            const newLoc = newLocations.get(vehicle);
            const lastLoc = lastLocations.get(vehicle);

            if (newLoc.fechaHora <= lastLoc.fechaHora) {
                return;
            };

            // GUARDAR NUEVA COORDENADA y fechaHora
            lastFechaHora = location.fechaHora;

            // Guardar la nueva coordenada en el recorrido (trayecto y flechas)
            vehiclesCoords.get(vehicle).push({ lat: +newLoc.lat, lng: +newLoc.lng });

            // Guardar nueva coordenada y nuevo 'fechaHora'
            lastLocations.get(vehicle).lat = newLoc.lat;
            lastLocations.get(vehicle).lng = newLoc.lng;
            lastLocations.get(vehicle).speed = newLoc.speed;
            lastLocations.get(vehicle).fechaHora = newLoc.fechaHora;

            // Actualizar recorrido del vehículo actual
            vehiclesPaths[vehicle] = new google.maps.Polyline({
                path: vehiclesCoords.get(vehicle),
                geodesic: true,
                strokeColor: allMarkersColor[vehicle],
                strokeOpacity: 1.0,
                strokeWeight: 4,
            });

            // Actualizar el recorrido de flechas del vehículo actual
            vehiclesArrowPaths[vehicle] = new google.maps.Polyline({
                path: vehiclesCoords.get(vehicle),
                strokeOpacity: 0,
                strokeColor: allMarkersColor[vehicle],
                icons: [
                    {
                        icon: lineSymbol,
                        offset: "0",
                        repeat: "80px",
                    },
                ],
            });

            // BORRAR EL MARCADOR y RECORRIDO ANTERIOR
            allMarkers[vehicle].setMap(null);
            vehiclesPaths[vehicle].setMap(null);
            vehiclesArrowPaths[vehicle].setMap(null);

            // AGREGAR EL NUEVO MARCADOR, INFOWINDOW y RECORRIDO

            // Actualizar Marcador
            coords = new google.maps.LatLng(+newLoc.lat, +newLoc.lng);
            allMarkers[vehicle] = createMarker(coords, vehicle);

            // Event listener para abrir InfoWindows
            allMarkers[vehicle].addListener("click", () => {
                openInfoWindow(infoWindow, vehicle);
            });

            // Actualizar Recorrido y recorrido de flechas
            vehiclesPaths[vehicle].setMap(map);
            vehiclesArrowPaths[vehicle].setMap(map);

            // Verificar si el infowindow está abierto
            if (infoWindowData.vehicle === vehicle && infoWindowData.is_open) openInfoWindow(infoWindow, vehicle)
        });
    }, 10000);
}

initMap();