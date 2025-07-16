<?php

namespace Drupal\modulo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BibliotecaController extends ControllerBase {

  /**
   * Muestra los libros desde la configuración.
   */
  public function mostrarLibros() {
    // Recuperar la configuración de biblioteca
    $config = $this->config('modulo.biblioteca');
    $libros = $config->get('libros');

    return [
      '#theme' => 'biblioteca',
      '#libros' => $libros,
    ];
  }
}
