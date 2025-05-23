<?php

declare(strict_types=1);

namespace Drupal\diff;

use Drupal\Component\Plugin\ConfigurableInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Plugin\PluginFormInterface;

/**
 * Provides referenced entities to recurse in diff.
 */
interface FieldReferenceInterface extends PluginFormInterface, ConfigurableInterface {

  /**
   * Builds an array of entities.
   *
   * This method is responsible for transforming a FieldItemListInterface object
   * into an array of entities. The resulted array of entities is then used when
   * parsing the entity to get a clean array of fields that will be compared.
   *
   * @param \Drupal\Core\Field\FieldItemListInterface $field_items
   *   Represents an entity field.
   *
   * @return \Drupal\Core\Entity\EntityInterface[]
   *   An array of entities to be compared. If an empty array is returned it
   *   means that a field is either empty or no properties need to be compared
   *   for that field.
   */
  public function getEntitiesToDiff(FieldItemListInterface $field_items): array;

}
