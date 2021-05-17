<?php
namespace Kompli\Konnect\Model;


use Kompli\Konnect\Helper\Enum\{
    OfficerType as EnumType,
    ResignedReason as EnumResignedReason
};
use Kompli\Konnect\Iterator\SearchOfficers as Itt;
use PHPUnit\Framework\TestCase;

class SearchOfficerTest extends TestCase
{
    public function testGetFields()
    {
        $this->assertEquals(SearchOfficer::FIELDS, SearchOfficer::getFields());
    }

    /**
     * @dataProvider getterProvider
     */
    public function testGetter(
        SearchOfficer $model,
        string $strFunctionName,
        $expectedOutput
    )
    {
        $this->assertEquals($expectedOutput, $model->$strFunctionName());
    }

    public function getterProvider()
    {
        $strType = "officer_cluster_root";
        $strId = "ocr/33851080";
        $strWeight = "30.00";
        $strName = "TIM LANGLEY";
        $strCorporate = "MGAMI LIMITED";
        $strCompanyNumber = "06530487";
        $strAddress = "85 KENWORTHY LANE, MANCHESTER, LANCS, M22 4FA, UNITED KINGDOM";
        $strEndDate = "2010-10-19";
        $strIsActive = "Resigned";
        $strPreviousNames = [];
        $strResignedReason = "Dissolved";
        $intClusterId = 33851080;
        $intOfficerId = 183861435;
        $strOfficerType = "Person";
        $strRestOfCluster = [];

        $model = new SearchOfficer(
            [
                SearchOfficer::FIELD_TYPE => $strType,
                SearchOfficer::FIELD_ID => $strId,
                SearchOfficer::FIELD_WEIGHT => $strWeight,
                SearchOfficer::FIELD_NAME => $strName,
                SearchOfficer::FIELD_CORPORATE => $strCorporate,
                SearchOfficer::FIELD_COMPANY_NUMBER => $strCompanyNumber,
                SearchOfficer::FIELD_ADDRESS => $strAddress,
                SearchOfficer::FIELD_END_DATE => $strEndDate,
                SearchOfficer::FIELD_IS_ACTIVE => $strIsActive,
                SearchOfficer::FIELD_PREVIOUS_NAMES => $strPreviousNames,
                SearchOfficer::FIELD_RESIGNED_REASON => $strResignedReason,
                SearchOfficer::FIELD_CLUSTER_ID => $intClusterId,
                SearchOfficer::FIELD_OFFICER_ID => $intOfficerId,
                SearchOfficer::FIELD_OFFICER_TYPE => $strOfficerType,
                SearchOfficer::FIELD_REST_OF_CLUSTER => $strRestOfCluster,
            ]
        );
        return [
            [$model, 'getType', $strType],
            [$model, 'getId', $strId],
            [$model, 'getWeight', $strWeight],
            [$model, 'getName', $strName],
            [$model, 'getCorporate', $strCorporate],
            [$model, 'getCompanyNumber', $strCompanyNumber],
            [$model, 'getAddress', $strAddress],
            [$model, 'getEndDate', $strEndDate],
            [$model, 'getIsActive', $strIsActive],
            [$model, 'getPreviousNames', $strPreviousNames],
            [$model, 'getResignedReason', new EnumResignedReason(EnumResignedReason::REASON_DISSOLVED)],
            [$model, 'getClusterId', $intClusterId],
            [$model, 'getOfficerId', $intOfficerId],
            [$model, 'getOfficerType', new EnumType($strOfficerType)],
            [$model, 'getRestOfCluster', new Itt($strRestOfCluster)],
        ];
    }

    public function testOutput()
    {
        $strType = "officer_cluster_root";
        $strId = "ocr/33851080";
        $strWeight = "30.00";
        $strName = "TIM LANGLEY";
        $strCorporate = "MGAMI LIMITED";
        $strCompanyNumber = "06530487";
        $strAddress = "85 KENWORTHY LANE, MANCHESTER, LANCS, M22 4FA, UNITED KINGDOM";
        $strEndDate = "2010-10-19";
        $strIsActive = "Resigned";
        $strPreviousNames = [];
        $strResignedReason = "Dissolved";
        $intClusterId = 33851080;
        $intOfficerId = 183861435;
        $strOfficerType = "Person";
        $strRestOfCluster = [];

        $arrInput = [
            SearchOfficer::FIELD_TYPE => $strType,
            SearchOfficer::FIELD_ID => $strId,
            SearchOfficer::FIELD_WEIGHT => $strWeight,
            SearchOfficer::FIELD_NAME => $strName,
            SearchOfficer::FIELD_CORPORATE => $strCorporate,
            SearchOfficer::FIELD_COMPANY_NUMBER => $strCompanyNumber,
            SearchOfficer::FIELD_ADDRESS => $strAddress,
            SearchOfficer::FIELD_END_DATE => $strEndDate,
            SearchOfficer::FIELD_IS_ACTIVE => $strIsActive,
            SearchOfficer::FIELD_PREVIOUS_NAMES => $strPreviousNames,
            SearchOfficer::FIELD_RESIGNED_REASON => $strResignedReason,
            SearchOfficer::FIELD_CLUSTER_ID => $intClusterId,
            SearchOfficer::FIELD_OFFICER_ID => $intOfficerId,
            SearchOfficer::FIELD_OFFICER_TYPE => $strOfficerType,
            SearchOfficer::FIELD_REST_OF_CLUSTER => $strRestOfCluster,
        ];

        $model = new SearchOfficer($arrInput);

        $this->assertEquals($arrInput, $model->output());
    }

    public function testOutputInCluster()
    {
        $strType = "officer_cluster_root";
        $strId = "ocr/33851080";
        $strWeight = "30.00";
        $strName = "TIM LANGLEY";
        $strCorporate = "MGAMI LIMITED";
        $strCompanyNumber = "06530487";
        $strAddress = "85 KENWORTHY LANE, MANCHESTER, LANCS, M22 4FA, UNITED KINGDOM";
        $strEndDate = "2010-10-19";
        $strIsActive = "Resigned";
        $strPreviousNames = [];
        $strResignedReason = "Dissolved";
        $intClusterId = 33851080;
        $intOfficerId = 183861435;
        $strOfficerType = "Person";
        $strRestOfCluster = [];

        $arrInput = [
            SearchOfficer::FIELD_TYPE => $strType,
            SearchOfficer::FIELD_ID => $strId,
            SearchOfficer::FIELD_WEIGHT => $strWeight,
            SearchOfficer::FIELD_NAME => $strName,
            SearchOfficer::FIELD_CORPORATE => $strCorporate,
            SearchOfficer::FIELD_COMPANY_NUMBER => $strCompanyNumber,
            SearchOfficer::FIELD_ADDRESS => $strAddress,
            SearchOfficer::FIELD_END_DATE => $strEndDate,
            SearchOfficer::FIELD_IS_ACTIVE => $strIsActive,
            SearchOfficer::FIELD_PREVIOUS_NAMES => $strPreviousNames,
            SearchOfficer::FIELD_RESIGNED_REASON => $strResignedReason,
            SearchOfficer::FIELD_CLUSTER_ID => $intClusterId,
            SearchOfficer::FIELD_OFFICER_ID => $intOfficerId,
            SearchOfficer::FIELD_OFFICER_TYPE => $strOfficerType,
            SearchOfficer::FIELD_REST_OF_CLUSTER => $strRestOfCluster,
        ];

        $arrExpectedOutput = [
            SearchOfficer::FIELD_NAME => $strName,
            SearchOfficer::FIELD_CORPORATE => $strCorporate,
            SearchOfficer::FIELD_COMPANY_NUMBER => $strCompanyNumber,
            SearchOfficer::FIELD_ADDRESS => $strAddress,
            SearchOfficer::FIELD_END_DATE => $strEndDate,
            SearchOfficer::FIELD_IS_ACTIVE => $strIsActive,
            SearchOfficer::FIELD_PREVIOUS_NAMES => $strPreviousNames,
            SearchOfficer::FIELD_RESIGNED_REASON => $strResignedReason,
            SearchOfficer::FIELD_CLUSTER_ID => $intClusterId,
            SearchOfficer::FIELD_OFFICER_ID => $intOfficerId,
            SearchOfficer::FIELD_OFFICER_TYPE => $strOfficerType,
        ];

        $model = new SearchOfficer($arrInput);

        $this->assertEquals($arrExpectedOutput, $model->outputInCluster());
    }
}