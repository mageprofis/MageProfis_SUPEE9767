<?php

class MageProfis_SUPEE9767_Model_Observer {
    
    public function coreBlockAbstractToHtmlBefore($observer)
    {
        $block = $observer->getBlock();
        if ($block instanceof Mage_Core_Block_Template && $this->getOnlyTemplatesFiles())
        {
            $templateFile = $block->getTemplateFile();
            $suffix = pathinfo($templateFile, PATHINFO_EXTENSION);
            if (!in_array($suffix, array('phtml', 'html', 'tpl')))
            {
                $msg = 'Not valid script path:' . $templateFile;
                Mage::log($msg, Zend_Log::CRIT, null, null, true);
                Mage::log($msg, Zend_Log::CRIT, null, 'supee9767.log', true);
                $block->setTemplate('supee9767/error.phtml');
            }
        }
    }

    protected function getOnlyTemplatesFiles()
    {
        return Mage::getStoreConfigFlag('dev/template/allow_only_template_files');
    }
}
