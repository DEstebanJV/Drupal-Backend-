<?php

namespace Drupal\job_queue\Controller;

use Drupal\Core\Controller\ControllerBase;

class JobQueueController extends ControllerBase {

  public function enqueueJob() {
    $uid = \Drupal::currentUser()->id();
    $username = \Drupal::currentUser()->id();
    $queue = \Drupal::queue('job_queue_example');
    $queue->createItem([
      'uid' => $uid,
      'username' => $username,
      'time' => time(),
      'message' => '¡Trabajo generado por el usuario actual 3',
    ]);

    return [
      '#markup' => $this->t('Trabajo encolado por el usuario @user.', ['@user' => $username]),
    ];
  }
}
