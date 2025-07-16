<?php

namespace Drupal\job_queue\Controller;

use Drupal\Core\Controller\ControllerBase;

class JobQueueController extends ControllerBase {

  public function enqueueJob() {
    $queue = \Drupal::queue('job_queue_example');
    $queue->createItem([
      'time' => time(),
      'message' => '¡Trabajo desde job_queue!',
    ]);

    return [
      '#markup' => $this->t('Trabajo agregado a la cola desde job_queue.'),
    ];
  }
}
