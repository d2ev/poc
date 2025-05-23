<?php

declare(strict_types=1);

namespace Drupal\Tests\diff\Functional;

use Drupal\Tests\field_ui\Traits\FieldUiTestTrait;
use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Tests the Diff module entity plugins.
 *
 * @group diff
 */
class DiffPluginFileTest extends DiffPluginTestBase {

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
   * Tests the File plugin.
   *
   * @see \Drupal\diff\Plugin\diff\Field\FileFieldBuilder
   */
  public function testFilePlugin(): void {
    // Add file field to the article content type.
    $file_field_name = 'field_file';
    $field_storage = FieldStorageConfig::create([
      'field_name' => $file_field_name,
      'entity_type' => 'node',
      'type' => 'file',
    ]);
    $field_storage->save();
    FieldConfig::create([
      'entity_type' => 'node',
      'field_storage' => $field_storage,
      'bundle' => 'article',
      'label' => 'File',
    ])->save();

    // Make the field visible in the form and default display.
    $this->viewDisplay->load('node.article.default')
      ->setComponent('test_field')
      ->setComponent($file_field_name)
      ->save();
    $this->formDisplay->load('node.article.default')
      ->setComponent('test_field', ['type' => 'entity_reference_autocomplete'])
      ->setComponent($file_field_name, ['type' => 'file_generic'])
      ->save();

    // Create an article.
    $node = $this->drupalCreateNode([
      'type' => 'article',
      'title' => 'Test article',
    ]);
    $revision1 = $node->getRevisionId();

    // Upload a file to the article.
    $test_files = $this->drupalGetTestFiles('text');
    $edit['files[field_file_0]'] = $this->fileSystem->realpath($test_files['0']->uri);
    $this->drupalGet('node/' . $node->id() . '/edit');
    $this->submitForm($edit, 'Upload');
    $edit['revision'] = TRUE;
    $this->drupalPostNodeForm('node/' . $node->id() . '/edit', $edit, 'Save');
    $node = $this->drupalGetNodeByTitle('Test article', TRUE);

    // Replace the file by a different one.
    $this->drupalGet('node/' . $node->id() . '/edit');
    $this->submitForm([], 'Remove');
    $this->submitForm(['revision' => FALSE], 'Save');
    $edit['files[field_file_0]'] = $this->fileSystem->realpath($test_files['1']->uri);
    $this->drupalGet($node->toUrl('edit-form'));
    $this->submitForm($edit, 'Upload');
    $edit['revision'] = TRUE;
    $this->drupalPostNodeForm('node/' . $node->id() . '/edit', $edit, 'Save');
    $node = $this->drupalGetNodeByTitle('Test article', TRUE);
    $revision3 = $node->getRevisionId();

    // Check differences between revisions.
    $this->clickLink('Revisions');
    $edit = [
      'radios_left' => $revision1,
      'radios_right' => $revision3,
    ];
    $this->submitForm($edit, 'Compare selected revisions');
    $this->assertSession()->pageTextContains('File');
    $this->assertSession()->pageTextContains('File: text-1_0.txt');
    $this->assertSession()->pageTextContains('File ID: 4');

    // Use the unified fields layout.
    $this->clickLink('Unified fields');
    $this->assertSession()->statusCodeEquals(200);
    $this->assertSession()->pageTextContains('File');
    $this->assertSession()->pageTextContains('File: text-1_0.txt');
    $this->assertSession()->pageTextContains('File ID: 4');
  }

  /**
   * Tests the Image plugin.
   *
   * @see \Drupal\diff\Plugin\diff\Field\ImageFieldBuilder
   */
  public function testImagePlugin(): void {
    // Add image field to the article content type.
    $image_field_name = 'field_image';
    FieldStorageConfig::create([
      'field_name' => $image_field_name,
      'entity_type' => 'node',
      'type' => 'image',
      'settings' => [],
      'cardinality' => 1,
    ])->save();

    $field_config = FieldConfig::create([
      'field_name' => $image_field_name,
      'label' => 'Image',
      'entity_type' => 'node',
      'bundle' => 'article',
      'required' => FALSE,
      'settings' => ['alt_field' => 1],
    ]);
    $field_config->save();

    $this->formDisplay->load('node.article.default')
      ->setComponent($image_field_name, [
        'type' => 'image_image',
        'settings' => [],
      ])
      ->save();

    $this->viewDisplay->load('node.article.default')
      ->setComponent($image_field_name, [
        'type' => 'image',
        'settings' => [],
      ])
      ->save();

    // Create an article.
    $node = $this->drupalCreateNode([
      'type' => 'article',
      'title' => 'Test article',
    ]);
    $revision1 = $node->getRevisionId();

    // Upload an image to the article.
    $test_files = $this->drupalGetTestFiles('image');
    $edit = ['files[field_image_0]' => $this->fileSystem->realpath($test_files['1']->uri)];
    $this->drupalPostNodeForm('node/' . $node->id() . '/edit', $edit, 'Save');
    $edit = [
      'field_image[0][alt]' => 'Image alt',
      'revision' => TRUE,
    ];
    $this->submitForm($edit, 'Save');
    $node = $this->drupalGetNodeByTitle('Test article', TRUE);

    // Replace the image by a different one.
    $this->drupalGet('node/' . $node->id() . '/edit');
    $this->submitForm([], 'Remove');
    $this->submitForm(['revision' => FALSE], 'Save');
    $edit = ['files[field_image_0]' => $this->fileSystem->realpath($test_files['1']->uri)];
    $this->drupalPostNodeForm('node/' . $node->id() . '/edit', $edit, 'Save');
    $edit = [
      'field_image[0][alt]' => 'Image alt updated',
      'revision' => TRUE,
    ];
    $this->submitForm($edit, 'Save');
    $node = $this->drupalGetNodeByTitle('Test article', TRUE);
    $revision3 = $node->getRevisionId();

    // Check differences between revisions.
    $this->clickLink('Revisions');
    $edit = [
      'radios_left' => $revision1,
      'radios_right' => $revision3,
    ];
    $this->submitForm($edit, 'Compare selected revisions');
    $this->assertSession()->pageTextContains('Image');
    $this->assertSession()->pageTextContains('Image: image-test-transparent-indexed_0.gif');
    // Image title must be absent since it is not set in previous revisions.
    $this->assertSession()->pageTextNotContains('Title');

    // Enable Title field in instance settings.
    $this->drupalGet('admin/structure/types/manage/article/fields/node.article.field_image');
    $this->submitForm([
      'settings[title_field]' => 1,
    ], 'Save settings');

    // Add image title and alt text.
    $edit = [
      'field_image[0][alt]' => 'Image alt updated new',
      'revision' => TRUE,
      'field_image[0][title]' => 'Image title updated',
    ];
    $this->drupalPostNodeForm('node/' . $node->id() . '/edit', $edit, 'Save');
    $this->drupalGet('node/' . $node->id() . '/revisions');
    $this->submitForm([], 'Compare selected revisions');

    // Image title and alternative text must be shown.
    $assert_session = $this->assertSession();
    $assert_session->elementContains('css', 'tr:nth-child(3) td:nth-child(3)', 'Alt: Image alt updated');
    $assert_session->elementTextContains('css', 'tr:nth-child(3) td:nth-child(6)', 'Alt: Image alt updated new');
    $this->assertEquals('', $assert_session->elementExists('css', 'tr:nth-child(4) td:nth-child(3)')->getText());
    $assert_session->elementTextContains('css', 'tr:nth-child(4) td:nth-child(6)', 'Title: Image title updated');

    // Show File ID.
    $this->drupalGet('admin/config/content/diff/fields');
    $this->submitForm([], 'node__field_image_settings_edit');
    $edit = [
      'fields[node__field_image][settings_edit_form][settings][show_id]' => TRUE,
    ];
    $this->submitForm($edit, 'node__field_image_plugin_settings_update');
    $this->submitForm([], 'Save');
    $this->drupalGet('node/' . $node->id() . '/revisions');
    $this->submitForm([], 'Compare selected revisions');
    // Alt and title must be hidden.
    $this->assertSession()->pageTextContains('File ID: 2');

    // Disable alt image fields.
    $this->drupalGet('admin/config/content/diff/fields');
    $this->submitForm([], 'node__field_image_settings_edit');
    $edit = [
      'fields[node__field_image][settings_edit_form][settings][compare_alt_field]' => FALSE,
    ];
    $this->submitForm($edit, 'node__field_image_plugin_settings_update');
    $this->submitForm([], 'Save');
    $this->drupalGet('node/' . $node->id() . '/revisions');
    $this->submitForm([], 'Compare selected revisions');
    // Alt and title must be hidden.
    $this->assertSession()->pageTextNotContains('Alt: Image alt updated');
    $this->assertSession()->pageTextNotContains('Alt: Image alt updated new');
    $this->assertSession()->pageTextContains('Title: Image title updated');

    // Disable title image fields, reenable alt.
    $this->drupalGet('admin/config/content/diff/fields');
    $this->submitForm([], 'node__field_image_settings_edit');
    $edit = [
      'fields[node__field_image][settings_edit_form][settings][compare_alt_field]' => TRUE,
      'fields[node__field_image][settings_edit_form][settings][compare_title_field]' => FALSE,
    ];
    $this->submitForm($edit, 'node__field_image_plugin_settings_update');
    $this->submitForm([], 'Save');
    $this->drupalGet('node/' . $node->id() . '/revisions');
    $this->submitForm([], 'Compare selected revisions');
    $this->assertSession()->pageTextContains('Alt: Image alt updated');
    $this->assertSession()->pageTextContains('Alt: Image alt updated new');
    $this->assertSession()->pageTextNotContains('Title: Image title updated');
    // Assert the thumbnail is displayed.
    $img1_url = \Drupal::service('file_url_generator')->generateAbsoluteString(\Drupal::token()->replace("public://styles/thumbnail/public/[date:custom:Y]-[date:custom:m]/" . $test_files['1']->name));
    $image_url = \Drupal::service('file_url_generator')->transformRelative($img1_url);
    $this->assertSession()->responseContains($image_url);

    // Disable thumbnail image field.
    $this->drupalGet('admin/config/content/diff/fields');
    $this->submitForm([], 'node__field_image_settings_edit');
    $edit = [
      'fields[node__field_image][settings_edit_form][settings][show_thumbnail]' => FALSE,
    ];
    $this->submitForm($edit, 'node__field_image_plugin_settings_update');
    $this->submitForm([], 'Save');
    $this->drupalGet('node/' . $node->id() . '/revisions');
    $this->submitForm([], 'Compare selected revisions');

    // Assert the thumbnail is not displayed.
    $img1_url = \Drupal::service('file_url_generator')->generateAbsoluteString(\Drupal::token()->replace("public://styles/thumbnail/public/[date:custom:Y]-[date:custom:m]/" . $test_files['1']->name));
    $image_url = \Drupal::service('file_url_generator')->transformRelative($img1_url);
    $this->assertSession()->responseNotContains($image_url);
  }

}
