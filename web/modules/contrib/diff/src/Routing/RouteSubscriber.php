<?php

declare(strict_types=1);

namespace Drupal\diff\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  public function alterRoutes(RouteCollection $collection) {
    // Replace the content from node.revision_overview route with content
    // generated by revisionOverview method from NodeRevisionController class.
    $route = $collection->get('entity.node.version_history');
    if ($route) {
      $route->addDefaults(
        [
          '_controller' => '\Drupal\diff\Controller\NodeRevisionController::revisionOverview',
        ],
      );
    }
  }

}
