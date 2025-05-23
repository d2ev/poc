<?php

declare(strict_types=1);

namespace Drupal\Tests\diff\Functional;

use Drupal\Tests\field_ui\Traits\FieldUiTestTrait;

/**
 * Tests the Diff module entity plugins.
 *
 * @group diff
 */
class DiffPluginEntityTest extends DiffPluginTestBase {

  use FieldUiTestTrait;
  use CoreVersionUiTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'file',
    'image',
    'field_ui',
  ];

  /**
   * The file system service.
   *
   * @var \Drupal\Core\File\FileSystemInterface
   */
  protected $fileSystem;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $this->fileSystem = \Drupal::service('file_system');

    // FieldUiTestTrait checks the breadcrumb when adding a field, so we need
    // to show the breadcrumb block.
    $this->drupalPlaceBlock('system_breadcrumb_block');
  }

  /**
   * Tests the EntityReference plugin.
   *
   * @see \Drupal\diff\Plugin\diff\Field\EntityReferenceFieldBuilder
   */
  public function testEntityReferencePlugin(): void {
    // Add an entity reference field to the article content type.
    $bundle_path = 'admin/structure/types/manage/article';
    $field_name = 'reference';
    $storage_edit = $field_edit = [];
    $storage_edit['settings[target_type]'] = 'node';
    $field_edit['settings[handler_settings][target_bundles][article]'] = TRUE;
    $this->fieldUIAddNewField($bundle_path, $field_name, 'Reference', 'entity_reference', $storage_edit, $field_edit);

    // Create three article nodes.
    $node1 = $this->drupalCreateNode([
      'type' => 'article',
      'title' => 'Article A',
    ]);
    $node2 = $this->drupalCreateNode([
      'type' => 'article',
      'title' => 'Article B',
    ]);
    $node3 = $this->drupalCreateNode([
      'type' => 'article',
      'title' => 'Article C',
    ]);

    // Reference article B in article A.
    $edit = [
      'field_reference[0][target_id]' => 'Article B (' . $node2->id() . ')',
      'revision' => TRUE,
    ];
    $this->drupalPostNodeForm('node/' . $node1->id() . '/edit', $edit, 'Save');

    // Update article A so it points to article C instead of B.
    $edit = [
      'field_reference[0][target_id]' => 'Article C (' . $node3->id() . ')',
      'revision' => TRUE,
    ];
    $this->drupalPostNodeForm('node/' . $node1->id() . '/edit', $edit, 'Save');

    // Check differences between revisions.
    $this->clickLink(\t('Revisions'));
    $this->submitForm([], 'Compare selected revisions');
    $this->assertSession()->pageTextContains('Reference');
    $this->assertSession()->pageTextContains('Article B');
    $this->assertSession()->pageTextContains('Article C');
  }

}
