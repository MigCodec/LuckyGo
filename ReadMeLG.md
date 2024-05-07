
## Convenciones de Nomenclatura
##Estándares de programación en el proyecto
En este proyecto, seguimos las siguientes convenciones de nomenclatura para mantener un código limpio y consistente:

- **Camel Case (Uppercamelcase)para Clases**:Todas las clases se nombran utilizando la convención CamelCase. Esto significa que cada palabra en el nombre de la clase comienza con mayúscula, incluyendo la primera palabra.

 Ejemplo: `AuthController.php`

- **Snake Case para Variables y Funciones**: Todas las variables y funciones se nombran utilizando la convención snake_case. Esto implica que las palabras están en minúsculas y separadas por guiones bajos.

 Ejemplo: `valid_date`, `is_logged_in()`

- **Nombres Mnemotécnicos**: Se prefieren los nombres mnemotécnicos descriptivos para las variables y funciones. Esto significa que los nombres deben ser lo suficientemente descriptivos como para recordar su propósito o función sin necesidad de referirse a la documentación.

**Estilo de Comentarios**: Todos los comentarios deben seguir el siguiente estilo para mantener la coherencia y facilitar la comprensión del código:

/**
 * Descripción del método o función.
 *
 * Esta es una descripción más detallada que explica el propósito y el comportamiento
 * de la función o método. Puedes incluir detalles sobre los parámetros,
 * el valor de retorno y cualquier otra información relevante.
 *
 * @access public
 * @param Tipo $parametro Descripción del parámetro.
 * @return Tipo Descripción del valor de retorno.
 */
public function nombre_metodo($parametro) {
    // Cuerpo de la función
}
Este es un ejemplo en PHP para ilustrar cómo deberían verse los comentarios en el código.


-Además un punto importante a considerar es que el código está implementado en inglés por lo que en el futuro seguir con esta nomenclatura también debe ser en inglés.

Estas convenciones nos ayudan a mantener un estilo de codificación uniforme en todo el proyecto, lo que facilitará la legibilidad y el mantenimiento del código.


Instalación
1.-clonar el repositorio en tu máquina local
2.-instalar dependencias utilizando Composer
3.-configurar variables necesarias para la base de datos
4.-migrar para crear las tablas necesarias en la base de datos

Uso
Inicio de sesión
El sistema de autenticación proporciona las siguientes funcionalidades:
Inicio de sesión 
El usuario puede iniciar sesión a través de su correo electrónico y contraseña.

parámetros:
email: correo electrónico del usuario (string)
contraseña: contraseña del usuario(string)

Registro de usuario
El sistema permite registrar un nuevo usuario proporcionando nombre, correo electrónico, edad.
 nombre: nombre del usuario(string)
correo electrónico: correo electrónico del usuario(string)
edad: edad del usuario(integer)

Controladores y Vistas
Los controladores y vistas relacionados con la autenticación se encuentran en el directorio app/Http/Controllers/AuthController y resources/views/auth, respectivamente.
