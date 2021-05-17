<?php

namespace Kompli\Konnect;

use Kompli\Konnect\Helper\Enum\CorporateStatus;
use Kompli\Konnect\Exception\{
    Error404,
    Error400
};
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client as GuzzleClient;
use Kompli\Konnect\Model\{
    Corporate as ModelCorporate,
    Officer as ModelOfficer,
};
use Kompli\Konnect\Iterator\SearchOfficers as IttSearchOfficers;


class Client
{
    private $_client;

    const PARAM_VALID_FROM = 'FlagsValidFrom';

    const POST_JURISDICTION   = 'Jurisdiction';
    const POST_COMPANY_NUMBER = 'CompanyNumber';
    const POST_COMPANY_STATUS = 'CompanyStatuses';
    const POST_COMPANY_NAME   = 'CorporateName';
    const POST_COMPANY_ADDRESS = 'Address';

    const POST_OFFICER_NAME           = 'OfficerName';
    const POST_OFFICER_ADDRESS        = 'Address';
    const POST_OFFICER_CRN            = 'CompanyNumber';

    const POST_PERSON_NAME = 'PersonName';

    const QUERY_LIMIT = 'Limit';

    public function __construct(GuzzleClient $client)
    {
        $this->_client = $client;
    }

    public function getCorporate(
        string $strCRN,
        ?int $intResignation = null,
        array $arrRequiredFields = []
    ) : ModelCorporate
    {
        $strUrl = "/corporate/gb,$strCRN";

        if (!is_null($intResignation)) {
            $strUrl = $strUrl . "?ResignedDateWithin=" . $intResignation;
        }

        if (!empty($arrRequiredFields)) {
            $strFields = implode(',', $arrRequiredFields);
            $strUrl = $strUrl . "?RequiredFields=" . $strFields;
        }

        try {
            $response = $this->_client->get($strUrl);
        } catch (RequestException $e) {
            if ($e->getResponse()->getStatusCode() === 404) {
                throw new Error404("Corporate not found. CRN: $strCRN");
            } else {
                throw $e;
            }
        }

        $arrContent = json_decode($response->getBody()->getContents(), true);

        $modelCorporate = KonnectFactory::createKonnectEntity($arrContent);

        return $modelCorporate;
    }

    public function getOfficer(int $intOfficerId) : ?ModelOfficer
    {
        try {
            $response = $this->_client->get("/officer/$intOfficerId");
        } catch (RequestException $e) {
            if ($e->getResponse()->getStatusCode() === 404) {
                throw new Error404("Officer not found. ID: $intOfficerId");
            } else {
                throw $e;
            }
        }

        $arrContent = json_decode($response->getBody()->getContents(), true);

        $modelOfficer = KonnectFactory::createOfficer($arrContent);

        return $modelOfficer;
     }
  
    public function searchOfficer(
        string $strName,
        string $strAddress = '',
        string $strCompanyName = '',
        string $strCRN = ''
    ) : IttSearchOfficers
    {
        $strUrl = "/search/officer";

        $response = $this->_client->post(
            $strUrl,
            [
                'form_params' =>[
                    'OfficerName' => $strName,
                    'Address' => $strAddress,
                    'CorporateName' => $strCompanyName,
                    'CompanyNumber' => $strCRN,
                ],
            ]
        );

        $arrContent = json_decode($response->getBody()->getContents(), true);

        return new IttSearchOfficers($arrContent);
    }
}