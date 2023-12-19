<?php

/**
 * Class Silex_ScpOptions_ModelObserver
 *
 * Observer class adding parent product options to quote items
 */
class Silex_ScpOptions_Model_Observer
{
    /**
     * Add parent product options to quote items
     *
     * @see Mage_Sales_Model_Quote_Item::setProduct
     *
     * @param Varien_Event_Observer $observer
     *
     * @return void
     */
    public function addParentProductOptionsToQuoteItem($observer)
    {
        /** @var Mage_Catalog_Model_Product $product */
        $product = $observer->getEvent()->getProduct();
        /** @var Mage_Sales_Model_Quote_Item $item */
        $item = $observer->getEvent()->getQuoteItem();

        /** @var Varien_Object $infoBuyRequest */
        $infoBuyRequest = $item->getBuyRequest();

        if ($infoBuyRequest->getCpid()) {
            /** @var Mage_Catalog_Model_Product $parentProduct */
            $parentProduct = Mage::getModel('catalog/product')->load($infoBuyRequest->getCpid());

            foreach ($parentProduct->getOptions() as $option) {
                $product->addOption($option);
            }
        }
    }
}