<?php

namespace srag\Plugins\SrUserEnrolment\EnrolmentWorkflow\RequiredData\Field\UserSelect;

use ilSrUserEnrolmentPlugin;
use srag\Plugins\SrUserEnrolment\EnrolmentWorkflow\RequiredData\FieldCtrl;
use srag\Plugins\SrUserEnrolment\Utils\SrUserEnrolmentTrait;
use srag\RequiredData\SrUserEnrolment\Field\StaticMultiSearchSelect\StaticMultiSearchSelectFieldFormGUI;

/**
 * Class UserSelectFieldFormGUI
 *
 * @package srag\Plugins\SrUserEnrolment\EnrolmentWorkflow\RequiredData\Field\UserSelect
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class UserSelectFieldFormGUI extends StaticMultiSearchSelectFieldFormGUI
{

    use SrUserEnrolmentTrait;
    const PLUGIN_CLASS_NAME = ilSrUserEnrolmentPlugin::class;
    /**
     * @var UserSelectField
     */
    protected $object;


    /**
     * @inheritDoc
     */
    public function __construct(FieldCtrl $parent, UserSelectField $object)
    {
        parent::__construct($parent, $object);
    }


    /**
     * @inheritDoc
     */
    public function deliverPossibleOptions(/*?*/ string $search = null) : array
    {
        return self::srUserEnrolment()->ruleEnrolment()->searchUsers($search);
    }
}