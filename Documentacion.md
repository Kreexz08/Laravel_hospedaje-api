# Documentación de la API de Hospedaje

## Autenticación
### 1. Registro de usuario 
Método: POST
Ruta: /register
Descripción: Registra un nuevo usuario en el sistema.
Body (Ejemplo):
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "secret123"
}


Respuesta exitosa (201):

{
  "access_token": "TOKEN",
  "token_type": "Bearer"
  }

### 2. inicio de sesión 
Método: POST
Ruta: /login
Descripción: Autentica un usuario y genera un token de acceso.
Body (Ejemplo): 

{
  "email": "john@example.com",
  "password": "secret123"
  }
  
Respuesta exitosa (200):

{
  "access_token": "TOKEN",
  "token_type": "Bearer"
}

Respuesta error (401):

{
"message": "Invalid login details"
}

## Gestion de habitaciones 
### 1. Listar habitaciones
Metodo: GET
Ruta: /rooms
Descripción: Devuelve una lista de todas las habitaciones disponibles.
Encabezados requeridos:
Authorization: Bearer {TOKEN}
Respuesta exitosa (200):

[
  {
    "id": 1,
    "name": "Room 1",
    "status": "available"
    },
]

### 2. Crear una nueva habitación
Método: POST
Ruta: /rooms
Descripción: Crea una nueva habitación.
Encabezados requeridos:
Authorization: Bearer {TOKEN}
Body (Ejemplo):

{
  "number": "101",
  "status": "available"
}

Respuesta exitosa (201):
{
  "id": 1,
  "number": "101",
  "status": "available"
}

### 3. Ver detalles de una habitación
Método: GET
Ruta: /rooms/{room}
Descripción: Muestra los detalles de una habitación específica.
Encabezados requeridos:
Authorization: Bearer {TOKEN}
Respuesta exitosa (200):

{
  "id": 1,
  "number": 101,
  "status": "available"
}

### 4. Actualizar datos de una habitación 
Método: PUT
Ruta: /rooms/{room}
Descripción: Actualiza la información de una habitación.
Encabezados requeridos:
Authorization: Bearer {TOKEN}
Body (Ejemplo):

{
  "number": 102,
  "status": "occupied"
  }

Respuesta exitosa (200):
{
  "id": 1,
  "number": 102,
  "status": "occupied" 
}

### 5. Eliminar una habitación
Método: DELETE
Ruta: /rooms/{room}
Descripción: Elimina una habitación específica.
Encabezados requeridos:
Authorization: Bearer {TOKEN}

### 6. Obtener el historial de estados de una habitación
Método: GET
Ruta: /rooms/{room}/statuses
Descripción: Devuelve el historial de cambios de estado de una habitación.
Encabezados requeridos:
Authorization: Bearer {TOKEN}
Respuesta exitosa (200):

[
  {
    "status": "occupied",
    "status_changed_at": "2024-09-01T12:00:00Z"
  },
  {
    "status": "available",
    "status_changed_at": "2024-09-02T08:00:00Z"
  },
]

## Gestion de reservas
### 1. Reservar una habitación
Método: POST
Ruta: /rooms/{room}/reserve
Descripción: Marca una habitación como ocupada.
Encabezados requeridos:
Authorization: Bearer {TOKEN}
Respuesta exitosa (200):

{
  "message": "Room reserved successfully."
}

Respuesta de error (400):

{
  "message": "Room is already occupied."
}

### 2. Liberar una habitación
Método: POST
Ruta: /rooms/{room}/release
Descripción: Marca una habitación como disponible.
Encabezados requeridos:
Authorization: Bearer {TOKEN}
Respuesta exitosa (200):
{
  "message": "Room released successfully."
}

Respuesta de error (400):
{
  "message": "Room is already available."
}




