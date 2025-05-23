<?php

declare(strict_types=1);

namespace Drupal\Tests\diff\Functional;

use Drupal\Core\Url;
use Drupal\Tests\views\Functional\ViewTestBase;
use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;

/**
 * Tests the diff views integration.
 *
 * Loads optional config of views.
 *
 * @group diff
 */
class DiffViewsTest extends ViewTestBase {

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['node', 'diff', 'user', 'views', 'diff_test'];

  /**
   * Tests the behavior of a view that uses the diff_from and diff_to fields.
   */
  public function testDiffView(): void {
    // Make sure HTML Diff is disabled.
    $this->config('diff.settings')
      ->set('general_settings.layout_plugins.visual_inline.enabled', FALSE)
      ->save();

    $node_type = NodeType::create([
      'type' => 'article',
      'label' => 'Article',
    ]);
    $node_type->save();
    $node = Node::create([
      'type' => 'article',
      'title' => 'Test article: giraffe',
    ]);
    $node->save();
    $revision1 = $node->getRevisionId();

    $node->setNewRevision(TRUE);
    $node->setTitle('Test article: llama');
    $node->save();
    $revision2 = $node->getRevisionId();

    $this->drupalGet("node/{$node->id()}/diff-views");
    $this->assertSession()->statusCodeEquals(403);

    $user = $this->createUser(['view all revisions']);
    $this->drupalLogin($user);

    $this->drupalGet("node/{$node->id()}/diff-views");
    $this->assertSession()->statusCodeEquals(200);

    $from_first = $this->cssSelect('#edit-diff-from--3')[0]->getAttribute('value');
    $to_second = $this->cssSelect('#edit-diff-to--2')[0]->getAttribute('value');

    $edit = [
      'diff_from' => $from_first,
      'diff_to' => $to_second,
    ];
    $this->submitForm($edit, 'Compare');
    $expected_url = Url::fromRoute(
      'diff.revisions_diff',
      // Route parameters.
      [
        'node' => $node->id(),
        'left_revision' => $revision1,
        'right_revision' => $revision2,
        'filter' => 'split_fields',
      ],
      // Additional route options.
      [
        'query' => [
          'destination' => Url::fromUri("internal:/node/{$node->id()}/diff-views")->toString(),
        ],
      ],
    );
    $this->assertSession()->addressEquals($expected_url->setAbsolute()->toString());
    $this->assertSession()->responseContains('<td class="diff-context diff-deletedline">Test article: <span class="diffchange">giraffe</span></td>');
    $this->assertSession()->responseContains('<td class="diff-context diff-addedline">Test article: <span class="diffchange">llama</span></td>');
  }

}
