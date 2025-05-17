<?php

namespace Drupal\accessibility_menu\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * AccessibilityMenu settings form.
 */

class AccessibilityMenuSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'accessibility_menu.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'accessibility_menu_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $default = $this->config('accessibility_menu.settings')->get();
    $values = array_replace_recursive($default, $form_state->getValue('fields') ?? []);

    $form['fields'] = [
      '#type' => 'container',
      '#tree' => TRUE,
    ];
    $form['fields']['enabled'] = [
      '#type'          => 'checkbox',
      '#title'         => $this->t('Enable'),
      '#default_value' => $values['enabled'] ?? FALSE,
    ];
    $form['fields']['inline'] = [
      '#type'          => 'checkbox',
      '#title'         => $this->t('Inline js'),
      '#default_value' => $values['inline'] ?? TRUE,
    ];
    $form['fields']['plugins'] = [
      '#type'          => 'checkboxes',
      '#title'         => $this->t('Plugins'),
      '#default_value' => $values['plugins'] ?? [],
      '#options'       => [
        'contrast'       => $this->t('Contrast settings'),
        'font_size'      => $this->t('Font size'),
        'letter_spacing' => $this->t('Letter spacing'),
        'line_height'    => $this->t('Line height'),
        'images'         => $this->t('Images'),
        'font_style'     => $this->t('Font'),
        'cursor'         => $this->t('Big cursor'),
        'reading_line'   => $this->t('Reading line'),
      ],
    ];
    $form['actions'] = [
      '#type'  => 'actions',
      'submit' => [
        '#type'        => 'submit',
        '#value'       => $this->t('Save'),
        '#button_type' => 'primary,',
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $values = $form_state->getValue('fields');
    $config = $this->config('accessibility_menu.settings');
    foreach ($values as $key => $value) {
      $config->set($key, $value);
    }
    $config->save();
  }

}
