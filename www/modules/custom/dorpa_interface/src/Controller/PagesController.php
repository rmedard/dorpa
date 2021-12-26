<?php

namespace Drupal\dorpa_interface\Controller;

use Drupal;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

class PagesController extends ControllerBase
{
  public function homepage(): array
  {
//    kint(array_keys(\Drupal::service('plugin.manager.block')->getDefinitions()));
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
    $opponent = [];
    $humanRights = [];
    if ($opponent_id !== false) {
      $opponent = Node::load($opponent_id);
    }
    if ($human_rights_id !== false) {
      $humanRights = Node::load($human_rights_id);
    }
    $output[] = [
      '#theme' => 'homepage',
      '#opponent' => $opponent,
      '#human_rights' => $humanRights,
    ];

    return $output;
  }
}
