# WodCross 🏋️‍♂️ 
### Gestión Integral de Entrenamientos y Reservas para Box de CrossFit

**WodCross** es una aplicación web diseñada para digitalizar la operativa diaria de un box de CrossFit. Este proyecto permite a los atletas gestionar su progreso deportivo y sus reservas de clases, mientras ofrece al administrador una herramienta de control centralizada para organizar el calendario y las competiciones.

---

## Funcionalidades de la Aplicación

El sistema utiliza un control de acceso por roles para asegurar que cada usuario vea solo lo que necesita para entrenar o gestionar el centro.

**Acceso y Perfiles**
* Sistema de login seguro para Clientes y Administradores.
* Panel personal donde cada atleta puede ver su actividad y sus datos.

**Gestión de Reservas de Clases**
* Calendario actualizado con las sesiones de entrenamiento del día.
* Reserva de plaza inmediata con actualización de cupos en tiempo real.
* Opción de cancelar reservas para liberar espacio a otros compañeros.

**Sección de Competiciones**
* Listado de eventos, competiciones internas y jornadas especiales del box.
* Consulta de detalles, fechas y horarios para fomentar la participación de la comunidad.

**Registro de Marcas Personales (PRs)**
* Diario de levantamientos para ejercicios de fuerza (Sentadilla, Peso Muerto, Arrancada, etc.).
* Historial de marcas para que el atleta pueda medir su evolución y mejora de rendimiento.

---

## Tecnologías Utilizadas

* **Backend:** PHP para la gestión de la lógica y conexión con el servidor.
* **Base de Datos:** MySQL para el almacenamiento de toda la información del box.
* **Frontend:** HTML5 y CSS3 con diseño adaptado a dispositivos móviles.
* **Entorno de desarrollo:** XAMPP (Servidor Apache).

---

## Cómo poner en marcha el proyecto

1.  **Descarga:** Clona o descarga este repositorio en tu carpeta `htdocs` de XAMPP.
2.  **Base de Datos:** * Entra en `phpMyAdmin` y crea una base de datos llamada `wodcross`.
    * Importa el archivo `wodcross.sql` que encontrarás en la carpeta raíz de este proyecto.
3.  **Ejecución:** Abre tu navegador y escribe la dirección `http://localhost/wodcross`.

---

## Cuentas de Acceso para Pruebas (Tribunal)

Para facilitar la revisión del TFG sin necesidad de crear nuevas cuentas, se pueden utilizar las siguientes credenciales:

| Perfil de Usuario | Nombre de Usuario / Email | Contraseña |
| :--- | :--- | :--- |
| **Administrador** | admin@wodcross.com | admin123 |
| **Cliente / Atleta** | atleta@wodcross.com | atleta123 |

---

## Nota sobre el Proyecto
Este software ha sido desarrollado como **Trabajo de Fin de Grado (TFG)** en 2026, buscando ofrecer una herramienta real, útil y sencilla para la comunidad del CrossFit.
