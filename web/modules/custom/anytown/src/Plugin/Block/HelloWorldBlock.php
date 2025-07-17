<?php

declare(strict_types=1);

namespace Drupal\anytown\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Block\Attribute\Block;

/**
 * Block plugin para mostrar un mensaje de prueba.
 * 
 */

#[Block(
    id: "anytown_hello_world",
    admin_label: new TranslatableMarkup("Hello World"),
    category: new TranslatableMarkup("Custom"),
)]

class HelloWorldBlock extends BlockBase
{

    public function build()
    {
        $build['content'] = [
            '#markup' => '<div id="anytown-clock"></div>',
            '#attached' => [
                'library' => [
                    'anytown/live_clock',
                ],
            ],
        ];
        return $build;
    }
}
