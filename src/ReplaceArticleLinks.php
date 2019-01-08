<?php

namespace Drupal\sf1subtheme;

use Drupal\Core\Url;

/**
 * Replace article links if a body has a link at the top.
 */
class ReplaceArticleLinks {

  /**
   * The node entity.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $node;

  /**
   * Replace Node article links.
   *
   * @param array $variables
   *   Node variables.
   */
  public function replaceNodeLink(array &$variables) {
    $this->node = $variables['node'];

    // Only apply to Articles that are not the full display.
    if ($variables['view_mode'] !== 'full' && $this->isArticle()) {
      $url = $this->getUrl();

      if ($url) {
        $variables['url'] = $url;
      }
    }
  }

  /**
   * Replace links on a Primary Image.
   *
   * @param array $variables
   *   Field variables.
   */
  public function replaceImageFieldLink(array &$variables) {
    // Only look to nodes with the field_sf_primary_image named field.
    if ($variables['entity_type'] == 'node' && $variables['field_name'] == 'field_sf_primary_image') {
      $this->node = $variables["element"]["#object"];

      if ($this->isArticle()) {
        $url = $this->getUrl();

        if ($url) {
          $variables["items"][0]["content"]["#url"] = Url::fromUri($url);
        }
      }
    }
  }

  /**
   * Return the url placed at the top of a node body.
   *
   * @return bool|string
   *   The Url of the node body field.
   */
  protected function getUrl() {
    $markup = $this->node->body->value;

    preg_match('/^(\D{1,15})?<a href="([^"]*)"/', $markup, $matches);

    if (!empty($matches[2])) {
      return $matches[2];
    }
    else {
      return FALSE;
    }
  }

  /**
   * Is the node type an Article.
   *
   * @return bool
   *   Return TRUE if the node type is an article.
   */
  protected function isArticle() {
    return $this->node->getType() == 'sf_article' ? TRUE : FALSE;
  }
}