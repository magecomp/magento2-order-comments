<?php
namespace Magecomp\Ordercomment\Setup;

use Magecomp\Ordercomment\Helper\Data\Ordercomment;
use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class Uninstall implements UninstallInterface
{
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $setup->getConnection()->dropColumn(
            $setup->getTable('quote'),
            Ordercomment::COMMENT_FIELD_NAME
        );

        $setup->getConnection()->dropColumn(
            $setup->getTable('sales_order'),
            Ordercomment::COMMENT_FIELD_NAME
        );

        $setup->getConnection()->dropColumn(
            $setup->getTable('sales_order_grid'),
            Ordercomment::COMMENT_FIELD_NAME
        );

        $setup->endSetup();
    }
}
