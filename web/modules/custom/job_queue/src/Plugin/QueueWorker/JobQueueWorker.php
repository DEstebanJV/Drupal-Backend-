<?php

namespace Drupal\job_queue\Plugin\QueueWorker;

use Drupal\Core\Queue\QueueWorkerBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * @QueueWorker(
 *   id = "job_queue_example",
 *   title = @Translation("Job Queue Example Worker"),
 *   cron = {"time" = 1}
 * )
 */
class JobQueueWorker extends QueueWorkerBase implements ContainerFactoryPluginInterface {

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
   * Constructor.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, LoggerChannelFactoryInterface $logger_factory, Connection $database) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->logger = $logger_factory->get('job_queue');
    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('logger.factory'),
      $container->get('database')
    );
  }

  /**
   * Procesa cada ítem encolado.
   */
  public function processItem($data) {
    $this->logger->notice('Procesando trabajo #@index del usuario @username (uid: @uid). Mensaje: @msg', [
      '@index' => $data['index'],
      '@username' => $data['username'],
      '@uid' => $data['uid'],
      '@msg' => $data['message'],
    ]);

    $remaining = $this->getRemainingItemsCount();
    $this->logger->notice('Quedan @count trabajos pendientes en la cola.', [
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
