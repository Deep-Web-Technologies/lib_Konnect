<?php
namespace Kompli\Konnect\Model;

use Kompli\Konnect\Helper\Enum\QEDProductSendType;
use Kompli\Konnect\Helper\Enum\YotiDocumentType;
use PHPUnit\Framework\TestCase;

class AbstractTest extends TestCase
{
    public function testGetters()
    {
        $arrInput = [
            KonnectAbstract::FIELD_SEND_TYPE => QEDProductSendType::TYPE_EMAIL,
            KonnectAbstract::FIELD_MERGE_FIELDS => [],
            KonnectAbstract::FIELD_INTERVIEW_TEMP_ID => 1,
            KonnectAbstract::FIELD_EMAIL => 'testEmail',
            KonnectAbstract::FIELD_PHONE_NUMBER => 'testPhone',
            KonnectAbstract::FIELD_TARGET_NAME => 'testName',
            KonnectAbstract::FIELD_FILE_PATHS => ['path'],
            KonnectAbstract::FIELD_DOC_TYPE => YotiDocumentType::TYPE_PASSPORT,
            KonnectAbstract::FIELD_COUNTRY => 'gbr'
        ];
        $model = new Officer($arrInput);

        $arrGetters = [
            KonnectAbstract::FIELD_SEND_TYPE => $model->getSendType()->getId(),
            KonnectAbstract::FIELD_MERGE_FIELDS => $model->getMergeFields(),
            KonnectAbstract::FIELD_INTERVIEW_TEMP_ID => $model->getInterviewTemplateId(),
            KonnectAbstract::FIELD_EMAIL => $model->getEmail(),
            KonnectAbstract::FIELD_PHONE_NUMBER => $model->getPhone(),
            KonnectAbstract::FIELD_TARGET_NAME => $model->getTargetName(),
            KonnectAbstract::FIELD_FILE_PATHS => $model->getFilePaths(),
            KonnectAbstract::FIELD_DOC_TYPE => $model->getDocumentType()->getId(),
            KonnectAbstract::FIELD_COUNTRY => $model->getCountry(),
        ];

        $this->assertEquals($arrInput, $arrGetters);
    }

    public function testHasAutoRunFields_Email()
    {
        $arrData = [
            KonnectAbstract::FIELD_SEND_TYPE => QEDProductSendType::TYPE_EMAIL,
            KonnectAbstract::FIELD_EMAIL => 'example@test.com'
        ];

        $model = new Officer($arrData);

        $this->assertTrue($model->hasAutoRunFields());
    }

    public function testHasAutoRunFields_Phone()
    {
        $arrData = [
            KonnectAbstract::FIELD_SEND_TYPE => QEDProductSendType::TYPE_SMS,
            KonnectAbstract::FIELD_PHONE_NUMBER => '0123456'
        ];

        $model = new Officer($arrData);

        $this->assertTrue($model->hasAutoRunFields());
    }

    public function testHasAutoRunFields_Null()
    {
        $arrData = [];

        $model = new Officer($arrData);

        $this->assertFalse($model->hasAutoRunFields());
    }

    public function testIsMissingAllAutoRunFields()
    {
        $arrData = [];

        $model = new Officer($arrData);

        $this->assertTrue($model->isMissingAllAutoRunFields());
    }

    public function testOutputEntityData()
    {
        $arrData = [
            KonnectAbstract::FIELD_PHONE_NUMBER => 'testPhone',
            KonnectAbstract::FIELD_EMAIL => 'testEmail',
            KonnectAbstract::FIELD_MERGE_FIELDS => ['Merge Field'],
            KonnectAbstract::FIELD_INTERVIEW_TEMP_ID => 1,
            KonnectAbstract::FIELD_SEND_TYPE => QEDProductSendType::TYPE_EMAIL,
            KonnectAbstract::FIELD_INCLUDE_IN_PRODUCT => true,
        ];

        $model = new Officer($arrData);

        $this->assertEquals($arrData, $model->outputEntityData());
    }
}
