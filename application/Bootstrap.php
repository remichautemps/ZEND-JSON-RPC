<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	private function _getView ()
    {
        $_view = $this->getResource('view');
        if ($_view instanceof Zend_View) {
            return $_view;
        }
        $this->bootstrap('view');
        return $this->getResource('view');
    }    
}



