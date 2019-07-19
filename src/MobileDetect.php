<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */

namespace skeeks\yii2\mobiledetect;

use yii\base\Component;

require_once(\Yii::getAlias('@vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php'));

/**
 * @method (bool)isMobile()
 * @method (bool)isTablet()
 *
 * @property  (bool) isMobile
 * @property  (bool) isTablet
 * @property  (bool) isDesktop
 *
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class MobileDetect extends Component
{
    /**
     * @var \Mobile_Detect
     */
    protected $_mobileDetect;

    public function init()
    {
        parent::init();
        $this->_mobileDetect = new \Mobile_Detect();
    }

    /**
     * @var self
     */
    static protected $_instance = null;

    /**
     * @return self
     */
    static public function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->_mobileDetect, $name], $arguments);
    }

    /**
     * @deprecated
     * @return bool
     */
    public function isDescktop()
    {
        return $this->isDesktop();
    }

    /**
     * @return bool
     */
    public function isDesktop()
    {
        if ($this->isMobile() || $this->isTablet()) {
            return false;
        }

        return true;
    }

    /**
     * @return boolean
     */
    public function getIsMobile()
    {
        return $this->isMobile();
    }

    /**
     * @return boolean
     */
    public function getIsTablet()
    {
        return $this->isTablet();
    }

    /**
     * @return boolean
     */
    public function getIsDesktop()
    {
        return $this->isDesktop();
    }
}