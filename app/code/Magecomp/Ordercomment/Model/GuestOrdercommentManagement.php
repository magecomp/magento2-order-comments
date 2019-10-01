<?php

namespace Magecomp\Ordercomment\Model;

use Magento\Quote\Model\QuoteIdMaskFactory;

class GuestOrdercommentManagement implements \Magecomp\Ordercomment\Api\GuestOrdercommentManagementInterface
{
    protected $quoteIdMaskFactory;
    protected $orderCommentManagement;

    public function __construct(
        QuoteIdMaskFactory $quoteIdMaskFactory,
        \Magecomp\Ordercomment\Api\OrdercommentManagementInterface $orderCommentManagement
    )
    {
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->orderCommentManagement = $orderCommentManagement;
    }

    public function saveOrdercomment(
        $cartId,
        \Magecomp\Ordercomment\Api\Data\OrdercommentInterface $orderComment
    )
    {
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        return $this->orderCommentManagement->saveOrdercomment($quoteIdMask->getQuoteId(), $orderComment);
    }
}
