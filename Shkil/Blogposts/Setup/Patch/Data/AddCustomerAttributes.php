<?php

namespace Shkil\Blogposts\Setup\Patch\Data;

use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddCustomerAttributes implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    private EavSetupFactory $eavSetupFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        /** @var  $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(
            Customer::ENTITY,
            'blogposts',
            [
                'type' => 'int',
                'label' => 'Blogposts',
                'input' => 'text',
                'source' => '',
                'frontend' => '',
                'required' => true,
                'backend' => '',
                'sort_order' => '30',
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'default' => '0',
                'visible' => true,
                'user_defined' => true,
                'searchable' => true,
                'filterable' => true,
                'comparable' => true,
                'visible_on_front' => true,
                'unique' => false,
                'apply_to' => '',
                'group' => 'General',
                'used_in_product_listing' => true,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'option' => ''
            ]
        );
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }
}
