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
    Search as ModelSearch
};


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
        string $strKonnectId
    ) : ?array
    {
        $response = $this->_client->get("/v2/corporate/$strKonnectId/check");

        $arrContent = json_decode($response->getBody()->getContents(), true);

        return $arrContent;
    }

    public function getOfficer(int $intOfficerId) : ?array
    {
        try {
            $response = $this->_client->get("/v2/officer/$intOfficerId/check");
        } catch (RequestException $e) {
            if ($e->getResponse()->getStatusCode() === 404) {
                throw new Error404("Officer not found. ID: $intOfficerId");
            } else {
                throw $e;
            }
        }

        $arrContent = json_decode($response->getBody()->getContents(), true);

        return $arrContent;
     }

    public function searchOfficer(
        ?string $strName,
        ?string $strAddress = '',
        ?string $strCompanyName = '',
        ?string $strCRN = ''
    ) : ModelSearch
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

        return new ModelSearch($arrContent);
    }

    public function searchCorporate(
        ?string $strName,
        ?CorporateStatus $enumStatus = null,
        ?string $strJurisdiction = 'gb',
        ?string $strCRN = '',
        ?string $strAddress = ''
    ) : ModelSearch
    {
        $strUrl = "/search/corporate";

        $arrPostParams = [
            self::POST_COMPANY_NAME => $strName,
            self::POST_JURISDICTION => $strJurisdiction,
            self::POST_COMPANY_NUMBER => $strCRN,
            self::POST_COMPANY_ADDRESS => $strAddress
        ];

        if (!is_null($enumStatus)) {
            $arrPostParams[self::POST_COMPANY_STATUS] = [$enumStatus->getId()];
        }

        $response = $this->_client->post(
            $strUrl,
            ['json' => $arrPostParams]
        );

        $arrContent = json_decode($response->getBody()->getContents(), true);

        return new ModelSearch($arrContent);
    }
}