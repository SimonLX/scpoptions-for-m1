<?php

/**
 * Class Silex_ScpOptions_Model_Catalog_Product_Type_Simple
 *
 * Overridden to add custom options on simple products if there are set in configurable products
 */
class Silex_ScpOptions_Model_Catalog_Product_Type_Simple
    extends OrganicInternet_SimpleConfigurableProducts_Catalog_Model_Product_Type_Simple
{
    /**
     * @inheritDoc
     */
    protected function _prepareOptions(Varien_Object $buyRequest, $product, $processMode)
    {
        if ($buyRequest->getCpid()) {
            /** @var Mage_Catalog_Model_Product $parentProduct */
            $parentProduct = Mage::getModel('catalog/product')->load($buyRequest->getCpid());

            if ($parentProduct->getId()) {
                /** @var Mage_Catalog_Model_Product_Option $option */
                foreach ($parentProduct->getOptions() as $option) {
                    $product->addOption($option);
                }
            }
        }

        return parent::_prepareOptions($buyRequest, $product, $processMode);
    }
}
