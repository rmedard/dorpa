<?php

namespace Drupal\dorpa_interface\Plugin\Block;

use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Class JumboBlock
 * @package Drupal\dorpa_interface\Plugin\Block
 * @Block(
 *     id = "social_buttons_block",
 *     admin_label = @Translation("Social Buttons block"),
 *     category = @Translation("Custom Dorpa Blocks")
 * )
 */
class SocialButtons extends BlockBase
{

  public function build(): array
  {
    return ['#theme' => 'social_buttons'];
  }
}
