<?php

namespace NovaPoshta\Tracking\Model;

interface TrackingInterface
{
    const TRACK_URL = 'http://api.novaposhta.ua/v2.0/json';

    const NP_API_KEY = 'carriers/novap/api_key';

    /**
     * Send request to track documentNumber to NovaPoshta API and receive response.
     *
     * @param $documentNumber
     * @param string $phone
     * @return mixed
     */
    public function track($documentNumber, $phone = '');

}
