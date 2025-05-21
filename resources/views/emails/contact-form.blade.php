<!DOCTYPE html>
<html>
<head>
    <title>Nuevo mensaje de contacto</title>
</head>
<body>
    <h2>Has recibido un nuevo mensaje de contacto</h2>
    
    <p><strong>Nombre:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Empresa:</strong> {{ $data['company'] }}</p>
    <p><strong>Teléfono:</strong> {{ $data['phone'] }}</p>
    <p><strong>Comentario:</strong></p>
    <p>{{ $data['comments'] }}</p>
</body>
</html>