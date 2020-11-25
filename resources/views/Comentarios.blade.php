<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Se ha registrado un nuevo producto</h2>
    <center>
        <h2>El usuario: {{$elcorreo['usuario']}} </h2>
        <h2>Comentario: {{$elcorreo['titulo']}}</h2>
        <h2>Descripcion: {{$elcorreo['contenido']}}</h2>
    </center>
    <br>
    <h3>El producto fue agregado exitosamente :)</h3>
</body>
</html>