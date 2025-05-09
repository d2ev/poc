<?php

namespace Drupal\accessibility_menu;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * AccessibilityMenu service class.
 */
class AccessibilityMenu {

  use StringTranslationTrait;

  public function __construct(
    protected ConfigFactoryInterface $configFactory,
  ) {}

  /**
   * Returns list of options.
   */
  public function getSettings() {
    // @todo move to enum or plugins.
    $config = $this->configFactory->get('accessibility_menu.settings');
    $plugins = $config->get('plugins');
    $settings = [
      'contrast'       => [
        'title'   => $this->t('Contrast settings'),
        'access'  => $plugins['contrast'] ?? FALSE,
        'options' => [
          0 => [
            'title' => $this->t('High contrast'),
          ],
          1 => [
            'title' => $this->t('Inversion'),
          ],
          2 => [
            'title' => $this->t('White'),
          ],
          3 => [
            'title' => $this->t('Comfort'),
          ],
        ],
      ],
      'font_size'      => [
        'title'   => $this->t('Font size'),
        'access'  => $plugins['font_size'] ?? FALSE,
        'options' => [
          0 => [
            'title' => $this->t('Font size'),
          ],
          1 => [
            'title' => $this->t('Font size'),
          ],
          2 => [
            'title' => $this->t('Font size'),
          ],
          3 => [
            'title' => $this->t('Font size'),
          ],
        ],
      ],
      'letter_spacing' => [
        'title'   => $this->t('Letter spacing'),
        'access'  => $plugins['letter_spacing'] ?? FALSE,
        'options' => [
          0 => [
            'title' => $this->t('Increased interval'),
          ],
          1 => [
            'title' => $this->t('Moderate interval'),
          ],
          2 => [
            'title' => $this->t('Wide interval'),
          ],
        ],
      ],
      'line_height'    => [
        'title'   => $this->t('Line height'),
        'access'  => $plugins['line_height'] ?? FALSE,
        'options' => [
          0 => [
            'title' => $this->t('Line height (@value)', [
              '@value' => '1.5x',
            ]),
          ],
          1 => [
            'title' => $this->t('Line height (@value)', [
              '@value' => '1.75x',
            ]),
          ],
          2 => [
            'title' => $this->t('Line height (@value)', [
              '@value' => '2x',
            ]),
          ],
        ],
      ],
      'images'         => [
        'title'   => $this->t('Images'),
        'access'  => $plugins['images'] ?? FALSE,
        'options' => [
          0 => [
            'title' => $this->t('Grayscale'),
          ],
          1 => [
            'title' => $this->t('Disabled'),
          ],
        ],
      ],
      'font_style'     => [
        'title'   => $this->t('Font'),
        'access'  => $plugins['font_style'] ?? FALSE,
        'options' => [
          0 => [
            'title' => $this->t('Serif'),
          ],
          1 => [
            'title' => $this->t('Sans serif'),
          ],
        ],
      ],
      'cursor'         => [
        'title'   => $this->t('Big cursor'),
        'access'  => $plugins['cursor'] ?? FALSE,
        'options' => [
          0 => [
            'title' => $this->t('Big cursor'),
          ],
        ],
      ],
      'reading_line'   => [
        'title'   => $this->t('Reading line'),
        'access'  => $plugins['reading_line'] ?? FALSE,
        'options' => [
          0 => [
            'title' => $this->t('Reading line'),
          ],
        ],
      ],
    ];
    return $settings;
  }

}
