<?php

namespace Drupal\job_queue\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Queue\QueueFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Controlador para pruebas con colas en Drupal.
 */
class JobQueueController extends ControllerBase {

  /**
   * Fábrica de colas de Drupal.
   *
   * @var \Drupal\Core\Queue\QueueFactory
   */
  protected QueueFactory $queueFactory;

  /**
   * Usuario actual.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected AccountInterface $currentUser;

  /**
   * Constructor del controlador.
   */
  public function __construct(QueueFactory $queue_factory, AccountInterface $current_user) {
    $this->queueFactory = $queue_factory;
    $this->currentUser = $current_user;
  }

  /**
   * Método estático para la creación con inyección de dependencias.
   */
  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('queue'),
      $container->get('current_user')
    );
  }

  /**
   * Agrega 50 trabajos a la cola.
   */
  public function enqueueMultiple(): array {
    $uid = $this->currentUser->id();
    $username = $this->currentUser->getDisplayName();
    $queue = $this->queueFactory->get('job_queue_example');

    for ($i = 1; $i <= 50; $i++) {
      $queue->createItem([
        'uid' => $uid,
        'username' => $username,
        'time' => time(),
        'index' => $i,
        'message' => "Trabajo #{$i} generado automáticamente",
      ]);
    }

    return [
      '#markup' => $this->t('Se agregaron 50 trabajos a la cola para el usuario @user.', [
        '@user' => $username,
      ]),
    ];
  }

  /**
   * Muestra la cantidad de trabajos pendientes en la cola.
   */
  public function showQueueCount(): array {
    $queue = $this->queueFactory->get('job_queue_example');
    $count = $queue->numberOfItems();

    return [
      '#markup' => $this->t('Trabajos pendientes en la cola: @count', ['@count' => $count]),
    ];
  }

}
