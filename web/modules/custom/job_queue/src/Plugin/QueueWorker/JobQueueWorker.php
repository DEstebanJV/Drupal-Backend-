<?php

namespace Drupal\job_queue\Plugin\QueueWorker;

use Drupal\Core\Queue\QueueWorkerBase;
use Drupal\Core\Queue\QueueInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @QueueWorker(
 *   id = "job_queue_example",
 *   title = @Translation("Job Queue Example Worker"),
 *   cron = {"time" = 30}
 * )
 */
class JobQueueWorker extends QueueWorkerBase {

  /**
   * Logger de Drupal.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected $logger;

  /**
   * Conexión a la base de datos.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = new static($configuration, $plugin_id, $plugin_definition);
    $instance->logger = $container->get('logger.factory')->get('job_queue');
    $instance->database = $container->get('database');
    return $instance;
  }

  /**
   * Procesa cada ítem encolado.
   */
  public function processItem($data) {
    // Log individual por ítem.
    $this->logger->notice('Procesando trabajo #@index del usuario @username (uid: @uid). Mensaje: @msg', [
      '@index' => $data['index'],
      '@username' => $data['username'],
      '@uid' => $data['uid'],
      '@msg' => $data['message'],
    ]);

    // Al final del proceso, verificamos si quedan trabajos.
    $remaining = $this->getRemainingItemsCount();
    $this->logger->info('Quedan @count trabajos pendientes en la cola.', [
      '@count' => $remaining,
    ]);
  }

  /**
   * Devuelve cuántos ítems quedan pendientes en la cola.
   */
  protected function getRemainingItemsCount(): int {
    $query = $this->database->select('queue', 'q')
      ->condition('name', 'job_queue_example')
      ->countQuery();

    return (int) $query->execute()->fetchField();
  }
}
