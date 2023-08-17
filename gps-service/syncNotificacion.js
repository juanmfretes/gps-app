const { host, port } = require('./config');
const axios = require('axios');

const notificaciones = [
    {
        imei: '2749572958',
        lat: -25.236651,
        lng: -57.518330,
        codigo: 'speed',
        fechaHora: '2022-12-25 23:59:59',
    }, {
        imei: '2749572958',
        lat: -25.336126,
        lng: -57.522227,
        codigo: 'sos',
        fechaHora: '2023-01-02 03:04:05',
    }, {
        imei: '2749572958',
        lat: -25.293705,
        lng: -57.529195,
        codigo: 'brake',
        fechaHora: '2023-03-04 05:06:07',
    }
];


for (const notificacion of notificaciones) {
    axios.post(`http://${host}:${port}/insertarNotificacion`, notificacion)
        .then(function (response) {
            // handle success
            if (response.data.ok)
                console.log(`OK - ${notificacion.codigo} ${notificacion.fechaHora}`);
            else
                console.log(`ERROR - ${notificacion.codigo} ${notificacion.fechaHora}`);
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
}