<!DOCTYPE html>
<html>
<head>
    <title>Nueva solicitud de servicio</title>
</head>
<body>
    <h2>Has recibido una nueva solicitud de servicio</h2>
    <p><strong>Servicio:</strong> {{ $data['service'] }}</p>
    <p><strong>Nombre:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Empresa:</strong> {{ $data['company'] }}</p>
    <p><strong>Teléfono:</strong> {{ $data['phone'] }}</p>
    <p><strong>Comentario:</strong></p>
    <p>{{ $data['comments'] }}</p>
</body>
</html>