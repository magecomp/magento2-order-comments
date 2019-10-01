<?php

namespace Magecomp\Ordercomment\Observer;

use Magecomp\Ordercomment\Helper\Data\Ordercomment;

class AddOrdercommentToOrder implements \Magento\Framework\Event\ObserverInterface
{
    public function execute( \Magento\Framework\Event\Observer $observer )
    {
        $order = $observer->getEvent()->getOrder();

        $quote = $observer->getEvent()->getQuote();

        $order->setData(Ordercomment::COMMENT_FIELD_NAME, $quote->getData(Ordercomment::COMMENT_FIELD_NAME));
    }
}
