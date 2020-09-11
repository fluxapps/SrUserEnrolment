<?php

namespace srag\RequiredData\SrUserEnrolment\Field\Field\Group;

use srag\RequiredData\SrUserEnrolment\Field\AbstractField;
use srag\RequiredData\SrUserEnrolment\Field\FieldCtrl;
use srag\RequiredData\SrUserEnrolment\Field\FieldsCtrl;

/**
 * Class GroupField
 *
 * @package srag\RequiredData\SrUserEnrolment\Field\Field\Group
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class GroupField extends AbstractField
{

    const TABLE_NAME_SUFFIX = "group";
    const PARENT_CONTEXT_FIELD_GROUP = 1000;


    /**
     * @inheritDoc
     */
    public function getFieldDescription() : string
    {
        $descriptions = array_map(function (AbstractField $field) : string {
            return $field->getFieldTitle();
        }, self::requiredData()->fields()->getFields(self::PARENT_CONTEXT_FIELD_GROUP, $this->field_id));

        return nl2br(implode("\n", array_map(function (string $description) : string {
            return htmlspecialchars($description);
        }, $descriptions)), false);
    }


    /**
     * @inheritDoc
     */
    public function getActions() : array
    {
        return array_merge(parent::getActions(), [
            self::dic()->ui()->factory()->link()->standard(self::requiredData()->getPlugin()->translate("ungroup", FieldsCtrl::LANG_MODULE),
                self::dic()->ctrl()->getLinkTargetByClass($this->getFieldCtrlClass(), FieldCtrl::CMD_UNGROUP)),
        ]);
    }
}