// =============================================================
// VARIABLES
// =============================================================
let map, allNotifications;

let allMarkers = new Map(); // guardara todas los marcadores / notificaciones

const notificationColor = {
    sos: 'red',
    speed: 'blue',
    brake: 'green'
}

const url1 = "http://maps.google.com/mapfiles/ms/icons/";
const url2 = "-dot.png";

let infoWindow;
let openInfoWindowId = -1;

// =============================================================
// FUNCIONES
// =============================================================
// Obtener url para dar color al marcador según el "código"
const getColoredUrl = function (codigo) {
    return url1 + notificationColor[codigo] + url2;
};

// Crear Marcador
const createMarker = (coords, notification) => {
    return new google.maps.Marker({
        position: coords,
        map,
        icon: {
            url: getColoredUrl(notification['codigo']),
        },
        title: `Codigo: ${notification['codigo']}`,
    });
};

// Obtener el contenido para cada InfoWindows
const getData = (notification) => {
    // const formatedDateTime = notification.fechaHora.replace(' ', 'T');
    let text = `<div id="infoWindow"><h4>Codigo: ${notification.codigo}</h4>`;
    text += `<p>Conductor: ${notification.conductor}</p>`;
    text += `<p>Vehiculo: ${notification.vehiculo}</p>`;
    text += `<p>FechaHora: ${notification.fechaHora}</p></div>`;
    return text;
}

// Actualiza el Estado de openInfoWindowId (ver si realmente hace falta)
const updateInfoWindowState = function () {
    openInfoWindowId = -1;
};

// Abrir un InfoWindow específico
const openInfoWindow = (notificationId) => {
    let currentNotification;
    allNotifications.forEach(notification => {
        if (notification['id'] === notificationId) currentNotification = notification;
    });

    infoWindow.setContent(getData(currentNotification));

    infoWindow.open({
        anchor: allMarkers.get(notificationId),
        map,
    });

    // Guardar el Id de la notificación actual
    openInfoWindowId = notificationId;
};

// Obtener ubicación (para el mapa inicial)
const getInitialLocation = () => {
    // lat:-25.3261237, lng:-57.5550702, zoom: 11
    return { lat: -25.3261237, lng: -57.5550702 };
};

// Handler function para el <select> (obtiene las notificaciones de la DB y crea los marcadores)
const vehicleSelectHandler = async function (event) {
    const vehicleId = event.target.value;

    // Borrar todos los marcadores del mapa (si los hay)
    if (allMarkers.size !== 0) {
        allMarkers.forEach(marker => marker.setMap(null));
    }

    if (!vehicleId) return;

    // Obtener datos del API
    const data = await fetch(`http://127.0.0.1:8000/notification/${vehicleId}`);
    allNotifications = await data.json(); // [{}, {}, ...]

    if (allNotifications.length === 0) {
        alert('El vehículo actual no posee ninguna notificación');

    } else {
        // Crear un marcador por cada notificacion obtenida
        allNotifications.forEach(notification => {
            const coords = { lat: parseFloat(notification['lat']), lng: parseFloat(notification['lng']) };
            allMarkers.set(notification['id'], createMarker(coords, notification));
        });

        // Event Listeners para abrir InfoWindows
        allMarkers.forEach((marker, notificationId) => {
            marker.addListener("click", () => {
                openInfoWindow(notificationId);
            });
        });
    }
}

// =============================================================
// EVENT LISTENERS
// =============================================================
// Handler del <select> (para elegir un vehículo)
let vehicleSelect;
const setSelectListener = function () {
    vehicleSelect.addEventListener('change', vehicleSelectHandler);
};


// =============================================================
// INIT()
// =============================================================

async function initMap() {
    // Obtener coordenadas iniciales
    const initialMapCoords = getInitialLocation();

    // Crear el Mapa
    const { Map } = await google.maps.importLibrary("maps");
    map = new Map(document.getElementById("map"), {
        center: initialMapCoords,
        zoom: 11,
    });

    // Acá se crea el INFOWINDOW
    infoWindow = new google.maps.InfoWindow({
        content: '',
        ariaLabel: `InfoWindows`,
    });

    // Event Listener al cerrar InfoWindow
    infoWindow.addListener('closeclick', () => {
        updateInfoWindowState();
    });

    // DOM para el Event Listener (<select>)
    vehicleSelect = document.getElementById('vehicleSelect');
    setSelectListener();
}

initMap();