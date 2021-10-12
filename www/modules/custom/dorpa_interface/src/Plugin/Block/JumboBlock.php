<?php

namespace Drupal\dorpa_interface\Plugin\Block;

use Drupal;
use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;

/**
 * Class JumboBlock
 * @package Drupal\dorpa_interface\Plugin\Block
 * @Block(
 *     id = "jumbo_block",
 *     admin_label = @Translation("Jumbo block"),
 *     category = @Translation("Custom Dorpa Blocks")
 * )
 */
class JumboBlock extends BlockBase
{

  /**
   * @throws Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function build(): array
  {
    $output = [];
    $output[]['#cache']['max-age'] = 0;

    $storage = Drupal::entityTypeManager()->getStorage('node');
    $latest_article_query = $storage->getQuery()
      ->range(0, 1)
      ->condition('type', 'article')
      ->sort('created')
      ->execute();
    $article_id = reset($latest_article_query);
    if ($article_id !== false) {
      $output[] = [
        '#theme' => 'dorpa_jumbo',
        '#article' => Node::load($article_id)
      ];
    }
    return $output;
  }
}
