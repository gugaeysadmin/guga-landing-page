

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

---

# Proyecto Laravel + Vue

## 🧱 Stack Tecnológico

| Herramienta  | Versión |
| ------------ | ------- |
| PHP          | 8.3.11  |
| Laravel      | 11.34.2 |
| Node.js      | 22.16.0 |
| Vite         | 5.0     |
| Vue.js       | 3.5.13  |
| Tailwind CSS | ^3.4.17 |
| TW Elements  | ^2.0.0  |
| Flowbite     | ^2.5.2  |

---

## ⚙️ Instalación y Ejecución en Desarrollo

### 1. Instalar dependencias de Node

```bash
# Con npm
npm install

# O con yarn
yarn
```

### 2. Instalar dependencias de Laravel

```bash
composer install
```

### 3. (Opcional) Generar clave de la aplicación

```bash
php artisan key:generate
```

### 4. Ejecutar en entorno de desarrollo

> Requiere **dos terminales** abiertas

```bash
# Terminal 1 - Backend (Laravel)
php artisan serve
```

```bash
# Terminal 2 - Frontend (Vite)
npm run dev

# O
yarn dev
```

### 5. En caso de error al cargar archivos grandes

Editar `php.ini` y agregar o reemplazar los siguientes valores:

```ini
upload_max_filesize = 100M
post_max_size = 100M
memory_limit = 256M
```

---

## 🚀 Instalación en Producción

### 1. Compilar assets del frontend

```bash
npm run build

# O

yarn build
```

### 2. Compilar y optimizar Laravel

```bash
composer install --optimize-autoloader

php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan optimize
php artisan optimize:clear

php artisan route:clear
```

### 3. Copiar archivos a producción

Sube los archivos a la ruta:

```
/home3/gugaequi/public_html_page
```

> ⚠️ **Importante:** No eliminar ni reemplazar los siguientes elementos:

* Carpeta `storage` dentro del hosting
* Archivo `.htaccess`
* Archivos `.zip`
* Carpeta `.well-known`

### 4. Generar enlaces simbólicos

Accede en el navegador a:

```
http://{{ dominio de la página }}/link.php
```

Esto generará los enlaces simbólicos necesarios para el `storage` y las APIs.

---

