# 🛠️ HelpDesk - Sistema de Mesa de Ayuda

Proyecto desarrollado en **Laravel 10** que permite la gestión de tickets de soporte técnico para clientes, agentes y administradores.

---

## 🚀 Características principales

- Registro y autenticación de usuarios con Laravel Breeze
- Roles de usuario: Administrador, Agente, Cliente
- Creación y gestión de tickets de soporte
- Asignación de tickets a agentes
- Prioridades, categorías y estados personalizados
- Mensajes dentro de tickets con historial de conversación
- Archivos adjuntos en tickets y respuestas
- Registro de logs de acciones
- Sección de preguntas frecuentes (FAQs)

---

## 📦 Requisitos

- PHP >= 8.1
- Composer
- Node.js y NPM
- MySQL o cualquier base de datos compatible
- Laravel 10

---

## ⚙️ Instalación

```bash
# Clona el repositorio
git clone https://github.com/Sanca2001/HelpDesk_Sistema.git
cd HelpDesk_Sistema

# Instala dependencias backend
composer install

# Copia archivo de entorno
cp .env.example .env

# Genera clave de aplicación
php artisan key:generate

# Configura tu base de datos en el archivo .env
DB_DATABASE=helpdesk
DB_USERNAME=root
DB_PASSWORD=secret

# Ejecuta las migraciones
php artisan migrate

# Instala Breeze y sus assets
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev

