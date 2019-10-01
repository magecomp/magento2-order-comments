<?php

namespace Magecomp\Ordercomment\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class OrdercommentConfigProvider implements ConfigProviderInterface
{
    const CONFIG_MAX_LENGTH = 'ordcomments/ordercomments/max_length';
    const CONFIG_FIELD_DEFAULT_SHOW = 'ordcomments/ordercomments/defualt_show';
    const CONFIG_FIELD_CHECKOUT_TITLE = 'ordcomments/ordercomments/checkouttitle';
    const IS_ORDER_COMMENT_ENABLE = 'ordcomments/general/enable';


    private $scopeConfig;

    public function __construct( ScopeConfigInterface $scopeConfig )
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getConfig()
    {
        return [
            'max_length' => (int)$this->scopeConfig->getValue(self::CONFIG_MAX_LENGTH),
            'comment_initial_defualt_show' => (int)$this->scopeConfig->getValue(self::CONFIG_FIELD_DEFAULT_SHOW),
            'checkout_title' => $this->scopeConfig->getValue(self::CONFIG_FIELD_CHECKOUT_TITLE),
            'is_ordercomment_enable' => (int) $this->scopeConfig->getValue(self::IS_ORDER_COMMENT_ENABLE)
        ];
    }

}
