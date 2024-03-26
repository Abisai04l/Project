<?php
// Verificamos si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de entradas
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Sanitización de datos
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $phone = filter_var($phone, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $message = filter_var($message, FILTER_SANITIZE_STRING);

    // Verificación de datos
    if (empty($name) || empty($email) || empty($message)) {
        // Manejar el caso cuando los campos requeridos no están completos
        echo "Por favor, complete todos los campos obligatorios.";
        exit;
    }

    // Verificar el formato del correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Manejar el caso cuando el correo electrónico no es válido
        echo "El correo electrónico proporcionado no es válido.";
        exit;
    }

    // Configuración del correo
    $to = "cwalker.04lnit1v.root@pm.me";
    $subject = "Formulario de contacto";
    $body = "Nombre: $name\n";
    $body .= "Teléfono: $phone\n";
    $body .= "Email: $email\n\n";
    $body .= "Mensaje:\n$message";

    // Envío del correo electrónico
    $headers = "From: $email\r\n";
    if (mail($to, $subject, $body, $headers)) {
        // Manejar el caso cuando el correo se envió correctamente
        echo "¡Formulario enviado correctamente!";
        // Redirigir al usuario a otra página después de 3 segundos
        header("refresh:3;url=contacto.html");
        exit;
    } else {
        // Manejar el caso cuando ocurrió un error al enviar el correo
        echo "Ocurrió un error al enviar el formulario. Por favor, inténtalo de nuevo más tarde.";
    }
} else {
    // Manejar el caso cuando no se recibe una solicitud POST
    echo "Acceso no autorizado.";
}
?>
