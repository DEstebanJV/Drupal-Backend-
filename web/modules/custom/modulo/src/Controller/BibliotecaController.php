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

    // Crear la salida para mostrar los libros
    $output = '<h2>Lista de Libros</h2><ul>';
    foreach ($libros as $libro) {
      $output .= '<li>' . $libro['titulo'] . ' - ' . $libro['autor'] . ' (' . $libro['año'] . ')</li>';
    }
    $output .= '</ul>';

    return [
      '#markup' => $output,
    ];
  }
}
