<?php

namespace AudioDharma\Base;

class MetaboxMissingControllerException extends \Exception {}
class MetaboxInvalidControllerException extends \InvalidArgumentException {}
class InvalidPostTypeException extends \InvalidArgumentException {}

class BaseMetabox implements MetaboxInterface {

    protected
      $id = 'metabox-id',
      $title = 'Metabox',
      $post_type = 'post',
      $context = 'advanced',
      $priority = 'default',
      $callback_args = array()
    ;

    private
        $wp,
        $handler;

    /**
     * @param WpApiWrapper $wp
     * @param MetaboxHandler $handler
     */
    public function __construct(WpApiWrapper $wp, MetaboxHandler $handler)
    {
        $this->handler = $handler;
        $this->wp = $wp;
        $this->wp->add_action('save_post', array($this, 'save'));
    }

    public function add()
    {
        $this->wp->add_meta_box(
          $this->id,
          $this->title,
          array($this, 'dispatch'),
          $this->post_type,
          $this->context,
          $this->priority,
          $this->callback_args
        );
    }

    public function manuallyAddAction()
    {
        $this->wp->add_action('add_meta_boxes', array($this, 'add'));
    }

    public function dispatch($post, $meta_box)
    {
        $dispatch_args = array($post, $meta_box);
        if (count($this->callback_args) > 0) {
            $dispatch_args[] = $this->callback_args;
        }

        $this->handler->handle($dispatch_args);
    }

    /**
     * @param $post_type
     * @throws InvalidPostTypeException
     */
    public function setPostType($post_type)
    {
        if (!$post_type || !is_string($post_type)) {
            Throw new InvalidPostTypeException('Post type ' . var_dump($post_type) . ' given for Metabox '. get_class($this) . ' is invalid, must be a string.');
        }
        $this->post_type = $post_type;
    }

    public function save($post_id)
    {
        return $this->handler->save($post_id, $_POST);
    }
}