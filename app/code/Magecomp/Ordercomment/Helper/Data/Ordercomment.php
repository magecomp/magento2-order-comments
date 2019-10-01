<?php

namespace Magecomp\Ordercomment\Helper\Data;

use Magecomp\Ordercomment\Api\Data\OrdercommentInterface;
use Magento\Framework\Api\AbstractSimpleObject;

class Ordercomment extends AbstractSimpleObject implements OrdercommentInterface
{
    const COMMENT_FIELD_NAME = 'magecomp_order_comment';

    public function getComment()
    {
        return $this->_get(static::COMMENT_FIELD_NAME);
    }

    public function setComment( $comment )
    {
        return $this->setData(static::COMMENT_FIELD_NAME, $comment);
    }
}
