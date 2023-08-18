# instalacion
- instalar node.js
- ejecutar npm install (desde la raiz del proyecto)
- en el archivo config.js definir el host y el puerto del backend que recibirá los datos


# INSERTAR NOTIFICACIONES DE EJEMPLO
    EJECUCION
        node syncNotificacion
    REQUEST
        POST -> http://<host>:<port>/insertarNotificacion
        BODY
        {
            imei        // string 10
            lat         // float, hasta 8 dígitos de precisión
            lng         // float, hasta 8 dígitos de precisión
            codigo      // 'speed', 'sos' o 'brake'
            fechaHora   // fecha hora en formato iso
        }
    RESPONSES
        Para indicar inserción correcta, responder con: {ok: 'ok'}

# SIMULAR RECORRIDO DE VEHÍCULO EN TIEMPO REAL
    EJECUCION
        node syncLocalizacion
    REQUEST
        POST -> http://<host>:<port>/insertarLocalizacion
        BODY
        {
            imei        // string 10
            lat         // float, hasta 8 dígitos de precisión
            lng         // float, hasta 8 dígitos de precisión
            speed       // float, hasta 2 digitos de precision
            fechaHora   // fecha hora en formato iso
        }

    RESPONSES
        Para indicar inserción correcta y pasar a la siguiente coordenada, responder con: {ok: 'ok'}
        
    OBSERVACIONES
    - El imei por defecto es '2749572958'
    - Se envia una coordenada cada 5 segundos aprox.
    - Si NO se recibe un objeto con el campo ok como respuesta, enviará de vuelta la misma coordenada 
    hasta que se inserte correctamente. 
    - El campo fecha de una coordenada siempre se actualiza (no importa si falla), esto para simular 
    que se envian datos en tiempo real.

# OBSERVACIONES GENERALES
- El archivo coordenadas.js contiene un array de coordenadas que representa un circuito, una vez que 
se llega al final del array, se vuelve a empezar.
- El archivo ultimaCoordenada.txt contiene el índice de la tabla de coordenadas que contiene la última
coordenada enviada. (Borrar contenido del archivo para comenzar desde la primera cooordenada).