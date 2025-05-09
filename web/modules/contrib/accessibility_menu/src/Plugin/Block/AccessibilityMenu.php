<?php

namespace Drupal\accessibility_menu\Plugin\Block;

use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Extension\ExtensionPathResolver;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Render\Markup;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a block to display 'Accessibility menu'.
 *
 * @Block(
 *   id = "accessibility_menu",
 *   admin_label = @Translation("Accessibility menu"),
 * )
 */
class AccessibilityMenu extends BlockBase implements ContainerFactoryPluginInterface {

  protected ExtensionPathResolver $extensionPathResolver;

  protected ConfigFactoryInterface $configFactory;

  protected \Drupal\accessibility_menu\AccessibilityMenu $accessibilityMenu;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): static {
    $instance = new static($configuration, $plugin_id, $plugin_definition);
    $instance->extensionPathResolver = $container->get('extension.path.resolver');
    $instance->configFactory = $container->get('config.factory');
    $instance->accessibilityMenu = $container->get('accessibility_menu');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $path = $this->extensionPathResolver->getPath('module', 'accessibility_menu');
    $config = $this->configFactory->get('accessibility_menu.settings');

    $attached = [
      'library' => [
        'accessibility_menu/css',
      ],
    ];
    if ($config->get('inline')) {
      $content = file_get_contents($path . '/misc/accessibility_menu.js');
      $attached['html_head'] = [
        [
          [
            '#tag'   => 'script',
            '#value' => Markup::create($content),
          ],
          'accessibility_js',
        ],
      ];
    }
    else {
      $attached['library'][] = 'accessibility_menu/js';
    }

    return [
      '#theme'    => 'accessibility_menu',
      '#info'     => [
        'items' => $this->accessibilityMenu->getSettings(),
      ],
      '#attached' => $attached,
    ];
  }

}
