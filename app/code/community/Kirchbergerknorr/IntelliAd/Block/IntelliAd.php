<?php
/**
 * IntelliAd Block
 *
 * @category    Kirchbergerknorr
 * @package     Kirchbergerknorr_IntelliAd
 * @author      Aleksey Razbakov <ar@kirchbergerknorr.de>
 * @copyright   Copyright (c) 2014 kirchbergerknorr GmbH (http://www.kirchbergerknorr.de)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Kirchbergerknorr_IntelliAd_Block_IntelliAd extends Mage_Core_Block_Template
{
    protected $quote;

    public function getCustomerId()
    {
        return Mage::getStoreConfig('kk_intelliad/general/customer_id');
    }

    public function isPriceTrackingActive()
    {
        return Mage::getStoreConfig('kk_intelliad/general/price_tracking');
    }

    public function isActive()
    {
        if(Mage::getStoreConfigFlag('kk_intelliad/general/enable')
            && Mage::getStoreConfig('kk_intelliad/general/add_to') == $this->getParentBlock()->getNameInLayout()){
                return true;
        }
        return false;
    }

    public function isSuccess()
    {
        $successPath = '/checkout/onepage/success';
        if(Mage::getStoreConfigFlag('kk_intelliad/general/enable')
            && strpos($this->getRequest()->getPathInfo(), $successPath) !== false){
                return true;
        }
        return false;
    }

    public function isCheckout()
    {
        $checkoutPath = '/checkout/onepage';
        if(strpos($this->getRequest()->getPathInfo(), $checkoutPath) !== false){
            return true;
        }
        return false;
    }

    public function isCart()
    {
        $checkoutPath = '/checkout/cart';
        if(strpos($this->getRequest()->getPathInfo(), $checkoutPath) !== false){
            return true;
        }
        return false;
    }

    public function getQuote()
    {
        if (!$this->quote) {
            $this->quote = Mage::getModel('checkout/cart')->getQuote();
        }

        return $this->quote;
    }

    public function getOrderId()
    {
        return $this->getQuote()->getId();
    }

    public function getPrice()
    {
        return $this->getQuote()->getGrandTotal();
    }

    public function getCurrency()
    {
        return Mage::app()->getStore()->getCurrentCurrencyCode();
    }

    public function getLastPrice()
    {
        $sOrderId = Mage::getSingleton('checkout/session')->getLastOrderId();
        $oOrder = Mage::getModel('sales/order')->load($sOrderId);
        return $oOrder->getGrandTotal();
    }

    public function getLastOrderId()
    {
        $orderId = Mage::getSingleton('checkout/session')->getLastOrderId();
        $order = Mage::getModel('sales/order')->load($orderId);
        return $order->getQuoteId();
    }

    public function getSteps()
    {
        $conf = Mage::getStoreConfig('kk_intelliad/general/aliases');
        $conf = str_replace("\n", "", $conf);
        $result = array();
        if ($conf) {
            $options = explode(",", $conf);
            foreach ($options as $option) {
                list($name, $value) = explode(":", trim($option));
                $result[$name] = $value;
            }
        }
        return Mage::helper('core')->jsonEncode($result);
    }
}