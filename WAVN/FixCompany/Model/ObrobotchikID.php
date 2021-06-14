<?php


namespace WAVN\FixCompany\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;


class ObrobotchikID
{
    /**
     * @var ScopeConfigInterface
     */
    private $config;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->config = $scopeConfig;
    }

    public function getIdFromConfig(){
       return $adminId = $this->config->getValue('carriers/fixcompany/adminid');
    }
}
