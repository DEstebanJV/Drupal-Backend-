# Job Queue - Módulo de ejemplo para uso de colas en Drupal

Este módulo demuestra cómo utilizar el sistema de colas (`Queue API`) de Drupal para encolar y procesar trabajos de manera asincrónica mediante el plugin `CronQueueWorker`.

---

## ✨ ¿Qué hace este módulo?

- Encola un trabajo cuando un usuario accede a la ruta `/job-queue/enqueue`.
- El trabajo contiene:
  - El ID del usuario actual (`uid`)
  - El nombre del usuario
  - Un mensaje
  - La hora en que se encoló
- El trabajo se procesa cuando se ejecuta `cron` (manual o automáticamente).
- Una vez procesado, el trabajo se elimina automáticamente de la cola.

---

## 🧩 Componentes principales

- `JobQueueController`: Controlador que agrega trabajos a la cola (`createItem()`).
- `JobQueueWorker`: Plugin `QueueWorker` que define la lógica para procesar los ítems.
- Ruta: `/job-queue/enqueue`

---

## ⚙️ ¿Cómo funciona la cola?

### 1. **Agregar un trabajo a la cola**

Cuando se accede a `/job-queue/enqueue`, se ejecuta:

```php
$queue->createItem([
  'uid' => $uid,
  'username' => $username,
  'time' => time(),
  'message' => 'Trabajo generado por el usuario actual',
]);
