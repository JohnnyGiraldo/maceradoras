# Sistema de Registro de Equipos ALKAMEDICA

Este es un proyecto desarrollado con Laravel 10 y Vue 3 utilizando Inertia.js como stack de tecnología principal. El sistema permite a la empresa ALKAMEDICA gestionar el registro de equipos.

## Características

- **CRUD Doble**: Gestión de equipos y categorías.
- **Interfaz Rápida**: Utiliza Inertia.js para una experiencia de usuario fluida y sin recargas de página.
- **Estilos Atractivos**: Diseñado con Tailwind CSS para una interfaz de usuario moderna y atractiva.
- **Gráficos Interactivos**: Utiliza Chart.js para representar datos de forma visual.
- **Tablas Avanzadas**: Implementa DataTables para la visualización y gestión de datos tabulares.

## Requisitos del Sistema

Asegúrate de tener instalados los siguientes requisitos en tu entorno de desarrollo:

- PHP >= 8.0
- Composer
- Node.js >= 16
- NPM o Yarn
- Base de datos (por ejemplo, MySQL)

## Configuración

1. Clona este repositorio en tu máquina local:

   ```bash
   git clone https://github.com/tuusuario/alkamedica-equipos.git

   Navega hasta el directorio del proyecto:

bash
Copy code
cd alkamedica-equipos
Instala las dependencias de PHP:

bash
Copy code
composer install
Copia el archivo .env.example y crea tu propio archivo .env:

bash
Copy code
cp .env.example .env
Luego, configura la conexión a tu base de datos en el archivo .env.

Genera una clave de aplicación:

bash
Copy code
php artisan key:generate
Instala las dependencias de Node.js:

bash
Copy code
npm install
Compila los assets de JavaScript y CSS:

bash
Copy code
npm run dev
Ejecuta las migraciones para crear las tablas en la base de datos:

bash
Copy code
php artisan migrate
Inicia el servidor de desarrollo de Laravel:

bash
Copy code
php artisan serve
El proyecto estará disponible en http://localhost:8000.

Uso
Visita la aplicación en tu navegador y comienza a gestionar los equipos de ALKAMEDICA.

Contribuciones
¡Contribuciones son bienvenidas! Si deseas contribuir al proyecto, por favor sigue estos pasos:

Haz un fork del repositorio.
Crea una rama con tu nueva funcionalidad: git checkout -b nueva-funcionalidad
Realiza tus cambios y commitea: git commit -m 'Añade nueva funcionalidad'
Sube tus cambios a tu fork: git push origin nueva-funcionalidad
Crea un pull request en el repositorio original.
Licencia
Este proyecto está bajo la licencia MIT.

Copy code

Asegúrate de personalizar la información en el archivo README.md con los detalles específicos de tu proyecto y de proporcionar la información necesaria para que otros desarrolladores puedan configurar y utilizar la aplicación.



