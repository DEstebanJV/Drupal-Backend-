# 🕒 Anytown - Módulo de práctica Drupal con reloj en vivo

**Anytown** es un módulo de **práctica para Drupal 10/11** que te enseña a:

✅ Crear bloques personalizados.  
✅ Adjuntar JS de forma limpia con `libraries.yml`.  
✅ Usar `Drupal.behaviors` y `once` para actualizar elementos en vivo.  
✅ Actualizar la **hora local del usuario en tiempo real sin recargar la página.**

---

## 📦 Contenido del módulo

```
anytown/
├── anytown.info.yml
├── anytown.libraries.yml
├── js/
│   └── live_clock.js
└── src/
    └── Plugin/
        └── Block/
            └── HelloWorldBlock.php
```

**Incluye:**

- **`HelloWorldBlock.php`:** bloque que imprime un contenedor para mostrar la hora.
- **`live_clock.js`:** actualiza la hora cada segundo con `setInterval`.
- **`anytown.libraries.yml`:** define la librería JS para el bloque.

---

## 🚀 Instalación

1️⃣ Copia `anytown` en:
```
/modules/custom/anytown
```

2️⃣ Activa el módulo:
```bash
drush en anytown -y
```
o desde:
> Extend > Anytown > Enable

3️⃣ Limpia cachés:
```bash
drush cr
```

---

## 🧩 Uso

1️⃣ Ve a:
> Structure > Block layout

2️⃣ Añade el bloque:
> **Hello World (Anytown)**

en la región que desees.

3️⃣ Guarda y recarga el sitio.

✅ Ahora verás **la hora local de tu navegador actualizándose en vivo cada segundo** sin recargar la página.

---

## ⚙️ Cómo funciona

✅ **Bloque (`HelloWorldBlock.php`):**
- Renderiza:
  ```html
  <div id="anytown-clock"></div>
  ```
- Adjunta la librería `live_clock`.

✅ **JS (`live_clock.js`):**
- Usa `Drupal.behaviors` y `once` para asegurar ejecución limpia.
- Crea un `setInterval` que actualiza el contenido del `div` cada segundo con:
  ```javascript
  const now = new Date();
  const formattedTime = now.toLocaleString();
  ```

✅ **`anytown.libraries.yml`:**
Carga `live_clock.js` de forma desacoplada, permitiendo que se administre por Drupal y se limpie con `drush cr`.

---

## ✏️ Personalización

✅ **Formato de hora:**
- Puedes ajustar:
  ```javascript
  now.toLocaleString();
  ```
  para personalizar fecha/hora según zona y formato.

✅ **Estilos:**
- Puedes añadir CSS en `anytown.libraries.yml` para personalizar visualmente el reloj.

---

## 🎯 Objetivos de aprendizaje

✅ Práctica real de:
- Bloques personalizados en Drupal.
- Librerías JS en módulos personalizados.
- `Drupal.behaviors` + `once` para compatibilidad con AJAX.
- Actualizaciones en vivo en el frontend Drupal.

✅ Mejora tus habilidades en el flujo de trabajo moderno de Drupal.

---

## 🤝 Contribuciones

Este módulo es de **uso libre para prácticas personales, talleres o para integrarse en proyectos de pruebas en Drupal**.

Si deseas extender funcionalidades (reloj con zonas horarias, formatos dinámicos, estilos animados), es ideal como punto de partida.

---

¡Disfruta aprendiendo Drupal de forma limpia y estructurada!
