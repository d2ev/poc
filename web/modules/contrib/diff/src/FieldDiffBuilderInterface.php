<?php

declare(strict_types=1);

namespace Drupal\diff;

use Drupal\Component\Plugin\ConfigurableInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Plugin\PluginFormInterface;

/**
 * Builds a diff from field item list.
 */
interface FieldDiffBuilderInterface extends PluginFormInterface, ConfigurableInterface {

  /**
   * Builds an array of strings.
   *
   * This method is responsible for transforming a FieldItemListInterface object
   * into an array of strings. The resulted array of strings is then compared by
   * the Diff component with another such array of strings and the result
   * represents the difference between two entity fields.
   *
   * Example of FieldItemListInterface built into an array of strings:
   * @code
   * [
   *   0 => "This is an example string",
   *   1 => "Field values or properties",
   * ]
   * @endcode
   *
   * @see \Drupal\diff\Plugin\diff\Field\TextFieldBuilder
   *
   * @param \Drupal\Core\Field\FieldItemListInterface $field_items
   *   Represents an entity field.
   *
   * @return mixed
   *   An array of strings to be compared. If an empty array is returned it
   *   means that a field is either empty or no properties need to be compared
   *   for that field.
   */
  public function build(FieldItemListInterface $field_items): mixed;

  /**
   * Returns if the plugin can be used for the provided field.
   *
   * @param \Drupal\Core\Field\FieldStorageDefinitionInterface $field_definition
   *   The field definition that should be checked.
   *
   * @return bool
   *   TRUE if the plugin can be used, FALSE otherwise.
   */
  public static function isApplicable(FieldStorageDefinitionInterface $field_definition): bool;

}
