<?php
/**
 * OrderId Options
 *
 * @category    Kirchbergerknorr
 * @package     Kirchbergerknorr_IntelliAd
 * @author      Aleksey Razbakov <ar@kirchbergerknorr.de>
 * @copyright   Copyright (c) 2014 kirchbergerknorr GmbH (http://www.kirchbergerknorr.de)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Kirchbergerknorr_IntelliAd_Model_System_Config_Source_Orderid
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'entity_id', 'label' => Mage::helper('kk_intelliad')->__('ID')),
            array('value' => 'increment_id', 'label' => Mage::helper('kk_intelliad')->__('Increment ID')),
        );
    }
}