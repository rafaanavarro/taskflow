# 📋 Taskflow - Tablero Kanban

Taskflow es una aplicación web de gestión de tareas estilo Kanban (similar a Trello), diseñada para ser rápida, reactiva y visualmente atractiva. Permite a los usuarios organizar su trabajo en columnas, mover tarjetas mediante arrastrar y soltar (Drag & Drop) y cuenta con un diseño totalmente adaptable al modo oscuro.

## ✨ Características Principales

* **Sistema de Usuarios:** Registro, inicio de sesión y gestión de perfil completos (basado en Laravel Breeze).
* **Tablero Interactivo:** Creación automática de un tablero por defecto ("Pendiente", "En progreso", "Hecho") para nuevos usuarios.
* **Drag & Drop Fluido:** Arrastra y suelta tareas entre diferentes columnas o reordénalas dentro de la misma columna. Todo se guarda automáticamente en la base de datos sin recargar la página.
* **Gestión de Tareas:** Crea nuevas tareas con título y descripción, y elimínalas con un solo clic.
* **Modo Oscuro Integrado (Dark Mode):** Interfaz de usuario elegante y moderna construida con Tailwind CSS, 100% compatible con el modo oscuro del sistema operativo.
* **Soporte Multilingüe:** Preparado para traducciones (Español configurado).

## 🛠️ Tecnologías Utilizadas (Tech Stack)

Este proyecto está construido con el potente ecosistema TALL stack (y un pequeño extra para la magia del movimiento):

* **[Laravel 11](https://laravel.com/):** Framework backend de PHP.
* **[Livewire 3](https://livewire.laravel.com/):** Componentes dinámicos de servidor sin escribir JS complejo.
* **[Alpine.js](https://alpinejs.dev/):** Framework de JavaScript ligero para el comportamiento frontend (modales, menús, integración de eventos).
* **[Tailwind CSS](https://tailwindcss.com/):** Framework CSS "utility-first" para un diseño rápido y a medida.
* **[SortableJS](https://sortablejs.github.io/Sortable/):** Librería de JavaScript utilizada para la lógica de arrastrar y soltar (Drag & Drop).

## 🚀 Requisitos Previos

Antes de instalar, asegúrate de tener en tu sistema:
* PHP 8.2 o superior
* Composer
* Node.js y npm
* Base de datos compatible (MySQL, SQLite, PostgreSQL, etc.)

## ⚙️ Instalación y Configuración

Sigue estos pasos para levantar el proyecto en tu entorno local:

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/rafaanavarro/taskflow.git
   cd taskflow
