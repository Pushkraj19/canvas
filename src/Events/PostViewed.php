<?php

declare(strict_types=1);

namespace Canvas\Events;

use Canvas\Models\Post;

final class PostViewed
{
    /**
     * The post instance.
     *
     * @var Post
     */
    public $post;

    /**
     * Create a new event instance.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}
