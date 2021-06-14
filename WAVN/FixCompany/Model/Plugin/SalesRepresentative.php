<?php


namespace WAVN\FixCompany\Model\Plugin;


use Magento\Company\Api\CompanyRepositoryInterface;
use Magento\Company\Api\Data\CompanyInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class SalesRepresentative
{

//    /**
//     * @var \WAVN\FixCompany\Model\ObrobotchikID
//     */
//    private $obrobotchikID;
//
//    public function __construct(\WAVN\FixCompany\Model\ObrobotchikID $obrobotchikID)
//    {
//        $this->obrobotchikID = $obrobotchikID;
//    }

    /**
     * @var ScopeConfigInterface
     */
    private $config;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->config = $scopeConfig;
    }

    public function beforeSave(
        CompanyRepositoryInterface $companyRepository,
        CompanyInterface $company
    )
    {
//        $company->setSalesRepresentativeId($this->obrobotchikID->getIdFromConfig());

        $ids = $company->getSalesRepresentativeId();


        $id = $this->config->getValue('carriers/fixcompany/adminid');
        $company->setSalesRepresentativeId($id);
        $t = 0; //return [$1, $2]
        return [$company];
    }
}
