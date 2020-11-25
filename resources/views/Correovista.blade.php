<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
</head>
<body>
    <center>
        <h2>Hola Bienvenido {{$elcorreo['nombre']}} es un gran placer conocerte</h2>
        <h2>Tu te haz registrado con este correo {{$elcorreo['email']}}</h2>
    </center>

    <p>¡¡¡Gracias por elegir la pagina!!!</p>
    <p>para poder continuar con el proceso porfavor has click aqui</p>
    <h2><a href="http://127.0.0.1:8000/api/login">Registra</a></h2>

    <h3>en caso de no funcionar porfavor copia y pega este link</h3>
    <h2><a href="http://127.0.0.1:8000/api/login"></a></h2>
</body>
</html>