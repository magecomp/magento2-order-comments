<?php
namespace Magecomp\Ordercomment\Api\Data;

interface OrdercommentInterface
{
    /**
     * @return string|null
     */
    public function getComment();

    /**
     * @param string $comment
     * @return null
     */
    public function setComment($comment);
}
