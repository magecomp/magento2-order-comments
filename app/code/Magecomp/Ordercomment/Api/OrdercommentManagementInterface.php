<?php
namespace Magecomp\Ordercomment\Api;

/**
 * @api
 */
interface OrdercommentManagementInterface
{
    /**
     * @param int $cartId
     * @param \Magecomp\Ordercomment\Api\Data\OrdercommentInterface $orderComment
     * @return string
     */
    public function saveOrdercomment(
        $cartId,
        \Magecomp\Ordercomment\Api\Data\OrdercommentInterface $orderComment
    );
}
