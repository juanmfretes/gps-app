const { host, port } = require('./config');
const coordenadas = require('./coordenadas');
const axios = require('axios');
const fs = require('fs');

const syncLocalizacion = async (i) => {

    coordenadas[i].imei = '2749572958';
    coordenadas[i].fechaHora = new Date(Date.now()).toLocaleString('sv', { timeZone: "America/Asuncion" });
    await axios.post(`http://${host}:${port}/insertarLocalizacion`, coordenadas[i])
        .then(function (response) {
            // handle success
            if (response.data.ok) {
                console.log(`OK - (${coordenadas[i].lat}, ${coordenadas[i].lng}) ${coordenadas[i].fechaHora}`);
                fs.writeFileSync("ultimaCoordenada.txt", (i < (coordenadas.length - 1) ? i + 1 : 0).toString());
            } else
                console.log(`ERROR - (${coordenadas[i].lat}, ${coordenadas[i].lng}) ${coordenadas[i].fechaHora}`);
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
}


const start = async () => {
    let i = fs.readFileSync('./ultimaCoordenada.txt',
        { encoding: 'utf8', flag: 'r' });
    await syncLocalizacion(i ? parseInt(i) : 0);
    setTimeout(async () => {
        start();
    }, 10000);
}

start();