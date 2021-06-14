<?php

namespace NovaPoshta\Tracking\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;


class Tracking implements TrackingInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $config;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->config = $scopeConfig;
    }

    public function track($documentNumber, $phone = '')
    {
        $array = $this->getTrackingTemplate($documentNumber, $phone);

        $ch = curl_init(self::TRACK_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        $jsonContent = json_encode($array);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $jsonContent);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);

// Или предать массив строкой:
// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array, '', '&'));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

    private function getTrackingTemplate($documentNumber, $phone): array
    {
        $apiKey = $this->config->getValue(self::NP_API_KEY);

        return [
            "apiKey" => $apiKey,
            "modelName" => "TrackingDocument",
            "calledMethod" => "getStatusDocuments",
            "methodProperties" => [
                "Documents" => [
                    [
                        "DocumentNumber" => $documentNumber,
                        "Phone" => $phone
                    ]
                ]
            ]
        ];
    }
}
