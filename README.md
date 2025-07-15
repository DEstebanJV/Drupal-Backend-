# Docksal powered Drupal 10 With Composer Installation

This is a sample Drupal 10 with Composer installation pre-configured for use with Docksal.

Features:

- Drupal 10 Composer Project
- `fin init` [example](.docksal/commands/init)
- Using the [default](.docksal/docksal.env#L9) Docksal LAMP stack with [image version pinning](.docksal/docksal.env#L13-L15)
- PHP and MySQL settings overrides [examples](.docksal/etc)

## Rutas Backend Drupal

- Modulos 

Los módulos interactúan con el software Drupal mediante cuatro patrones principales: plugins , servicios , eventos y ganchos . Como desarrollador, estos son los patrones que necesitarás aprender a implementar y aplicar para crear módulos personalizados.

Plugins : Son como las piezas individuales que se utilizan para ensamblar una máquina. Ofrecen nuevas funciones que permiten al administrador de Drupal elegir una opción entre varias. Por ejemplo, elegir bloques o tipos de campos específicos al crear un sitio web lo hace único.
Servicios : Piense en los servicios como herramientas especializadas que se pueden intercambiar. Se encargan de tareas específicas, como enviar correos electrónicos o integrarse con bases de datos. Puede que tenga un cajón lleno de herramientas y que funcionen igual, pero usted elige la adecuada según el trabajo.
Eventos : son como disparadores que reaccionan a ciertas acciones o condiciones dentro de Drupal, como la validación de entidades o el enrutamiento dinámico.
Ganchos : los ganchos son como puntos de conexión personalizables en Drupal donde puedes "enganchar" tu propio código para alterar el comportamiento o ampliar la funcionalidad.
