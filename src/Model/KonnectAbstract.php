<?php

namespace Kompli\Konnect\Model;

use Kompli\Konnect\Model\ModelAbstract;
use Kompli\Konnect\Helper\Enum\{
    QEDProductSendType as SendType
};
use Kompli\Konnect\Helper\Enum\YotiDocumentType as DocumentType;

abstract class KonnectAbstract extends ModelAbstract
{
    const FIELD_SEND_TYPE          = 'SendType';
    const FIELD_MERGE_FIELDS       = 'MergeFields';
    const FIELD_INTERVIEW_TEMP_ID  = 'InterviewTemplateId';
    const FIELD_EMAIL              = 'Email';
    const FIELD_FILE_PATHS         = 'FilePaths';
    const FIELD_PHONE_NUMBER       = 'PhoneNumber';
    const FIELD_TARGET_NAME        = 'TargetName';
    const FIELD_CASE_ENTITY        = 'CaseEntity';
    const FIELD_INCLUDE_IN_PRODUCT = 'IncludeInProduct';
    const FIELD_DOC_TYPE           = 'DocumentType';
    const FIELD_COUNTRY            = 'Country';
    const FIELD_KONNECT_ID         = 'KonnectId';
    const FIELD_RETIEVED_AT        = 'RetrievedAt';
    const FIELD_REQUESTOR          = 'Requestor';
    const FIELD_BANK_DETAILS       = 'BankDetails';

    const BANK_DETAIL_ACCOUNT_NAME   = 'AccountName';
    const BANK_DETAIL_ACCOUNT_NUMBER = 'AccountNumber';
    const BANK_DETAIL_SORTCODE       = 'Sortcode';
    const BANK_DETAIL_ACCOUNT_TYPE   = 'AccountType';

    public function getKonnectId() : ?string
    {
        return $this->_getField(self::FIELD_KONNECT_ID, null);
    }

    public function getRequestor() : ?string
    {
        return $this->_getField(self::FIELD_REQUESTOR, null);
    }

    public function getRetrievedAt() : ?string
    {
        return $this->_getField(self::FIELD_RETIEVED_AT, null);
    }

    public function getSendType() : ?SendType
    {
        $intSendType = $this->_getField(self::FIELD_SEND_TYPE, null);
        if (empty($intSendType)) {
            return null;
        }
        return new SendType($intSendType);
    }

    public function getMergeFields() : ?array
    {
        return $this->_getField(self::FIELD_MERGE_FIELDS, null);
    }

    public function getInterviewTemplateId() : ?int
    {
        return $this->_getField(self::FIELD_INTERVIEW_TEMP_ID, null);
    }

    public function getEmail() : ?string
    {
        return $this->_getField(self::FIELD_EMAIL, null);
    }

    public function getFilePaths() : ?array
    {
        return $this->_getField(self::FIELD_FILE_PATHS, null);
    }

    public function getDocumentType() : ?DocumentType
    {
        $strType = $this->_getField(self::FIELD_DOC_TYPE, null);

        if (is_null($strType)) {
            return null;
        }

        return new DocumentType($strType);
    }

    public function getCountry() : ?string
    {
        return $this->_getField(self::FIELD_COUNTRY, null);
    }

    public function getPhone() : ?string
    {
        return $this->_getField(self::FIELD_PHONE_NUMBER, null);
    }

    public function getTargetName() : ?string
    {
        return $this->_getField(self::FIELD_TARGET_NAME, null);
    }

    public function getBankDetails() : array
    {
        return $this->_getField(self::FIELD_BANK_DETAILS, []);
    }
    public function getBankDetailAccountName() : ?string
    {
        return $this->getBankDetails()[self::BANK_DETAIL_ACCOUNT_NAME] ?? null;
    }
    public function getBankDetailAccountNumber() : ?string
    {
        return $this->getBankDetails()
            [self::BANK_DETAIL_ACCOUNT_NUMBER] ?? null;
    }
    public function getBankDetailSortcode() : ?string
    {
        return $this->getBankDetails()[self::BANK_DETAIL_SORTCODE] ?? null;
    }
    public function getBankDetailAccountType() : ?string
    {
        return $this->getBankDetails()[self::BANK_DETAIL_ACCOUNT_TYPE] ?? null;
    }

    public function setIncludeInProduct(bool $bIncludeInProduct) : self
    {
        return $this->_setField(
            self::FIELD_INCLUDE_IN_PRODUCT,
            $bIncludeInProduct
        );
    }

    public function isCaseEntity() : bool
    {
        return $this->_getField(self::FIELD_CASE_ENTITY, false);
    }

    public function getIncludeInProduct() : bool
    {
        return $this->_getField(self::FIELD_INCLUDE_IN_PRODUCT, true);
    }

    public function hasAutoRunFields() : bool
    {
        $enumSendType = $this->getSendType();

        if (is_null($enumSendType)) {
            return false;
        }

        if ($enumSendType->getId() === SendType::TYPE_EMAIL) {
            return !empty($this->getEmail());
        }

        if ($enumSendType->getId() === SendType::TYPE_SMS) {
            return !empty($this->getPhone());
        }

        return false;
    }

    public function isMissingAllAutoRunFields() : bool
    {
        return (
            is_null($this->getSendType()) &&
                is_null($this->getPhone()) &&
                is_null($this->getEmail())
        );
    }

    public function outputEntityData()
    {
        $intSendType = null;
        $strDocType = null;
        if (!is_null($this->getSendType())) {
            $intSendType = $this->getSendType()->getId();
        }
        if (!is_null($this->getDocumentType())) {
            $strDocType = $this->getDocumentType()->getId();
        }

        $arrEntityData = array_filter(
            [
                self::FIELD_PHONE_NUMBER => $this->getPhone(),
                self::FIELD_EMAIL => $this->getEmail(),
                self::FIELD_MERGE_FIELDS => $this->getMergeFields(),
                self::FIELD_INTERVIEW_TEMP_ID =>
                    $this->getInterviewTemplateId(),
                self::FIELD_SEND_TYPE => $intSendType,
                self::FIELD_FILE_PATHS => $this->getFilePaths(),
                self::FIELD_DOC_TYPE => $strDocType,
                self::FIELD_COUNTRY => $this->getCountry(),
                self::FIELD_BANK_DETAILS => $this->getBankDetails(),
            ]
        );

        $arrEntityData[self::FIELD_INCLUDE_IN_PRODUCT] =
            $this->getIncludeInProduct();

        return $arrEntityData;
    }
}