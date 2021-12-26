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
      ->sort('created', 'DESC')
      ->execute();
    $refugees_query = $storage->getQuery()
      ->range(0, 1)
      ->condition('type', 'article')
      ->condition('field_tags.target_id', 2)
      ->sort('created', 'DESC')
      ->execute();
    $activists_query = $storage->getQuery()
      ->range(0, 1)
      ->condition('type', 'article')
      ->condition('field_tags.target_id', 3)
      ->sort('created', 'DESC')
      ->execute();
    $human_rights_query = $storage->getQuery()
      ->range(0, 1)
      ->condition('type', 'article')
      ->condition('field_tags.target_id', 4)
      ->sort('created', 'DESC')
      ->execute();
    $opponent_id = reset($opponent_query); // Returns false if empty
    $refugee_id = reset($refugees_query); // Returns false if empty
    $activist_id = reset($activists_query); // Returns false if empty
    $human_rights_id = reset($human_rights_query); // Returns false if empty
    $output[] = [
      '#theme' => 'homepage',
      '#opponent' => $opponent_id !== false ? Node::load($opponent_id) : [],
      '#refugee' => $refugee_id !== false ? Node::load($refugee_id) : [],
      '#activist' => $activist_id !== false ? Node::load($activist_id) : [],
      '#human_rights' => $human_rights_id !== false ? Node::load($human_rights_id) : [],
    ];

    return $output;
  }
}
