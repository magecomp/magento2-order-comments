<?php

namespace Magecomp\Ordercomment\Plugin\Model\Order;

use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Model\OrderFactory;

class LoadOrdercomment
{
    private $orderFactory;

    private $orderExtensionFactory;

    public function __construct(
        OrderFactory $orderFactory,
        OrderExtensionFactory $extensionFactory
    )
    {
        $this->orderFactory = $orderFactory;
        $this->orderExtensionFactory = $extensionFactory;
    }

    public function afterGet(
        OrderRepositoryInterface $subject,
        OrderInterface $resultOrder
    )
    {
        $this->setOrdercomment($resultOrder);
        return $resultOrder;
    }

    public function setOrdercomment( OrderInterface $order )
    {
        if ($order instanceof \Magento\Sales\Model\Order) {
            $value = $order->getMagecompOrdercomment();
        } else {
            $temp = $this->getOrderFactory()->create();
            $temp->load($order->getId());
            $value = $temp->getMagecompOrdercomment();
        }

        $extensionAttributes = $order->getExtensionAttributes();
        $orderExtension = $extensionAttributes ? $extensionAttributes : $this->getOrderExtensionFactory()->create();
        $orderExtension->setMagecompOrdercomment($value);
        $order->setExtensionAttributes($orderExtension);
    }

    public function getOrderFactory()
    {
        return $this->orderFactory;
    }

    public function getOrderExtensionFactory()
    {
        return $this->orderExtensionFactory;
    }

    public function afterGetList(
        OrderRepositoryInterface $subject,
        \Magento\Sales\Api\Data\OrderSearchResultInterface $orderSearchResult
    )
    {
        foreach ($orderSearchResult->getItems() as $order) {
            $this->setOrdercomment($order);
        }
        return $orderSearchResult;
    }
}
