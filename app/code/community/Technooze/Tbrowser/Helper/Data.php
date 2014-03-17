<?php
/**
 *
 * @category Technooze
 * @package  Technooze_Tbrowser
 * @module   Tbrowser
 * @author   Damodar Bashyal (enjoygame @ hotmail.com)
 */
class Technooze_Tbrowser_Helper_Data extends Mage_Core_Helper_Abstract
{
    private $_device;
    private $_browser;
    private $_engine;
    private $_os;

    /**
     * @param object $browser
     */
    public function setBrowser($browser)
    {
        $this->_browser = $browser;
    }

    /**
     * @return object
     */
    public function getBrowser()
    {
        return $this->_browser;
    }

    /**
     * @param object $device
     */
    public function setDevice($device)
    {
        $this->_device = $device;
    }

    /**
     * @return object
     */
    public function getDevice()
    {
        return $this->_device;
    }

    /**
     * @param object $engine
     */
    public function setEngine($engine)
    {
        $this->_engine = $engine;
    }

    /**
     * @return object
     */
    public function getEngine()
    {
        return $this->_engine;
    }

    /**
     * @param object $os
     */
    public function setOs($os)
    {
        $this->_os = $os;
    }

    /**
     * @return object
     */
    public function getOs()
    {
        return $this->_os;
    }

    public function isType($type = 'tablet'){
        $device = $this->getDevice();

        return isset($device->type) && $device->type == strtolower($type);
    }

    public function getBrowserDataArray(){
        return get_object_vars($this);
    }

    public function detect($headers=array()){
        $device = $this->getDevice();
        if(empty($device)){
            include_once BP . '/lib/WhichBrowser/whichbrowser.php';

            if(empty($headers)){
                $headers['User-Agent'] = $_SERVER['HTTP_USER_AGENT'];
                $headers['headers']['User-Agent'] = $headers['User-Agent'];
            }
            $detected = new WhichBrowser($headers);

            $this->setBrowser($detected->browser);
            $this->setDevice($detected->device);
            $this->setEngine($detected->engine);
            $this->setOs($detected->os);
        }
        return $this;
    }
}