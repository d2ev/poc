<?php

declare(strict_types=1);

namespace Drupal\diff\Plugin\diff\Field;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\comment\Plugin\Field\FieldType\CommentItemInterface;
use Drupal\diff\FieldDiffBuilderBase;

/**
 * Plugin to diff comment fields.
 *
 * @FieldDiffBuilder(
 *   id = "comment_field_diff_builder",
 *   label = @Translation("Comment Field Diff"),
 *   field_types = {
 *     "comment"
 *   },
 * )
 */
class CommentFieldBuilder extends FieldDiffBuilderBase {

  /**
   * {@inheritdoc}
   */
  public function build(FieldItemListInterface $field_items): array {
    $result = [];

    // Every item from $field_items is of type FieldItemInterface.
    foreach ($field_items as $field_key => $field_item) {
      if (!$field_item->isEmpty()) {
        $values = $field_item->getValue();
        // Compare the key of the comment status.
        if ($this->configuration['compare_key']) {
          if (isset($values['status'])) {
            $result[$field_key][] = $values['status'];
          }
        }
        // A more human friendly representation.
        if ($this->configuration['compare_string']) {
          if (isset($values['status'])) {
            switch ($values['status']) {
              case CommentItemInterface::OPEN:
                $result[$field_key][] = $this->t('Comments for this entity are open.');
                break;

              case CommentItemInterface::CLOSED:
                $result[$field_key][] = $this->t('Comments for this entity are closed.');
                break;

              case CommentItemInterface::HIDDEN:
                $result[$field_key][] = $this->t('Comments for this entity are hidden.');
                break;
            }
          }
        }
      }
    }

    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state): array {
    $form['compare_key'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Compare comment status key'),
      '#default_value' => $this->configuration['compare_key'],
    ];
    $form['compare_string'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Compare comment status string'),
      '#default_value' => $this->configuration['compare_string'],
    ];

    return parent::buildConfigurationForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state): void {
    $this->configuration['compare_key'] = $form_state->getValue('compare_key');
    $this->configuration['compare_string'] = $form_state->getValue('compare_string');

    parent::submitConfigurationForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration(): array {
    $default_configuration = [
      'compare_key' => 0,
      'compare_string' => 1,
    ];
    $default_configuration += parent::defaultConfiguration();

    return $default_configuration;
  }

}
