<?php

namespace Magecomp\Ordercomment\Model;

use Magecomp\Ordercomment\Helper\Data\Ordercomment;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\ValidatorException;

class OrdercommentManagement implements \Magecomp\Ordercomment\Api\OrdercommentManagementInterface
{
    protected $quoteRepository;

    protected $scopeConfig;

    public function __construct(
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->quoteRepository = $quoteRepository;
        $this->scopeConfig = $scopeConfig;
    }

    public function saveOrdercomment(
        $cartId,
        \Magecomp\Ordercomment\Api\Data\OrdercommentInterface $orderComment
    )
    {
        $quote = $this->quoteRepository->getActive($cartId);
        if (!$quote->getItemsCount()) {
            throw new NoSuchEntityException(__('Cart %1 doesn\'t contain products', $cartId));
        }
        $comment = $orderComment->getComment();

        $this->validateComment($comment);

        try {
            $quote->setData(Ordercomment::COMMENT_FIELD_NAME, strip_tags($comment));
            $this->quoteRepository->save($quote);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('The order comment could not be saved'));
        }

        return $comment;
    }

    protected function validateComment( $comment )
    {
        $maxLength = $this->scopeConfig->getValue(OrdercommentConfigProvider::CONFIG_MAX_LENGTH);
        if ($maxLength && (mb_strlen($comment) > $maxLength)) {
            throw new ValidatorException(__('Comment is too long'));
        }
    }
}
