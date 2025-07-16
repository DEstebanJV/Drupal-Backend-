<?php

namespace Drupal\job_queue\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Queue\QueueFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

class JobQueueController extends ControllerBase {

  /**
   * La fábrica de colas.
   *
   * @var \Drupal\Core\Queue\QueueFactory
   */
  protected QueueFactory $queueFactory;

  /**
   * Constructor del controlador.
   */
  public function __construct(QueueFactory $queue_factory) {
    $this->queueFactory = $queue_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('queue')
    );
  }

  /**
   * Agrega un trabajo a la cola.
   */
  public function enqueueJob(): array {
    $uid = $this->currentUser()->id();
    $username = $this->currentUser()->getDisplayName();

    $queue = $this->queueFactory->get('job_queue_example');
    $queue->createItem([
      'uid' => $uid,
      'username' => $username,
      'time' => time(),
      'message' => 'Trabajo generado por el usuario actual segunda prueba',
    ]);

    return [
      '#markup' => $this->t('Trabajo para el usuario @user.', ['@user' => $username]),
    ];
  }
}
