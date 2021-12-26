<?php

namespace Drupal\dorpa_interface\Controller;

use Drupal;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

class PagesController extends ControllerBase
{
  public function homepage(): array
  {
    $output = [];
    $output[]['#cache']['max-age'] = 0;

    $storage = Drupal::entityTypeManager()->getStorage('node');
    $opponent_query = $storage->getQuery()
      ->range(0, 1)
      ->condition('type', 'article')
      ->condition('field_tags.target_id', 1)
      ->sort('created')
      ->execute();
    $human_rights_query = $storage->getQuery()
      ->range(0, 1)
      ->condition('type', 'article')
      ->condition('field_tags.target_id', 4)
      ->sort('created')
      ->execute();
    $opponent_id = reset($opponent_query); // Returns false if empty
    $human_rights_id = reset($human_rights_query); // Returns false if empty
    $output[] = [
      '#theme' => 'homepage',
      '#opponent' => $opponent_id !== false ? Node::load($opponent_id) : [],
      '#human_rights' => $human_rights_id !== false ? Node::load($human_rights_id) : [],
    ];

    return $output;
  }
}
