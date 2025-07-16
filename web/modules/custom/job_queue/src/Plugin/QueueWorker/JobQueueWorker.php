<?php

namespace Drupal\job_queue\Plugin\QueueWorker;

use Drupal\Core\Queue\QueueWorkerBase;

/**
 * @QueueWorker(
 *   id = "job_queue_example",
 *   title = @Translation("Job Queue Example Worker"),
 *   cron = {"time" = 15}
 * )
 */
class JobQueueWorker extends QueueWorkerBase {

  public function processItem($data) {
    \Drupal::logger('job_queue')->notice('Procesando trabajo: @message a las @time', [
      '@message' => $data['message'],
      '@time' => date('H:i:s', $data['time']),
    ]);
  }
}
