<?php

namespace Drupal\job_queue\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Queue\QueueFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Session\AccountInterface;

class JobQueueController extends ControllerBase {

  /**
   * La fábrica de colas.
   *
   * @var \Drupal\Core\Queue\QueueFactory
   */
  protected QueueFactory $queueFactory;

  /**
   * El usuario actual.
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
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('queue'),
      $container->get('current_user')
    );
  }

  /**
   * Agrega un trabajo a la cola.
   */
  public function enqueueJob(): array {
    $uid = $this->currentUser->id();
    $username = $this->currentUser->getDisplayName();

    $queue = $this->queueFactory->get('job_queue_example');
    $queue->createItem([
      'uid' => $uid,
      'username' => $username,
      'time' => time(),
      'message' => 'Trabajo generado por el usuario actual',
    ]);

    return [
      '#markup' => $this->t('Trabajo encolado para el usuario @user.', ['@user' => $username]),
    ];
  }
}
