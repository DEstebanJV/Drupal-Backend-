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
    \Drupal::logger('job_queue')->notice(
      'Procesando trabajo para el usuario @uid (@username) a las @time. Mensaje: @message',
      [
        '@uid' => $data['uid'],
        '@username' => $data['username'],
        '@time' => date('H:i:s', $data['time']),
        '@message' => $data['message'],
      ]
    );
  }
}

