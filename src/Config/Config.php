<?php

namespace srag\Plugins\SrUserEnrolment\Config;

use ilSrUserEnrolmentPlugin;
use srag\ActiveRecordConfig\SrUserEnrolment\ActiveRecordConfig;
use srag\Plugins\SrUserEnrolment\ExcelImport\ExcelImport;
use srag\Plugins\SrUserEnrolment\ExcelImport\ExcelImportFormGUI;
use srag\Plugins\SrUserEnrolment\Utils\SrUserEnrolmentTrait;

/**
 * Class Config
 *
 * @package srag\Plugins\SrUserEnrolment\Config
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class Config extends ActiveRecordConfig
{

    use SrUserEnrolmentTrait;
    const TABLE_NAME = "srusrenr_config";
    const PLUGIN_CLASS_NAME = ilSrUserEnrolmentPlugin::class;
    const KEY_ROLES = "roles";
    const KEY_SHOW_ASSISTANTS = "show_assistants";
    const KEY_SHOW_ENROLMENT_WORKFLOW = "show_enrolment_workflow";
    const KEY_SHOW_EXCEL_IMPORT = "show_excel_import";
    const KEY_SHOW_EXCEL_IMPORT_CONFIG = "show_excel_import_config";
    const KEY_SHOW_RESET_PASSWORD = "show_reset_password";
    const KEY_SHOW_RULES_ENROLL = "show_rules_enroll";
    /**
     * @var array
     */
    protected static $fields
        = [
            self::KEY_ROLES                                               => [self::TYPE_JSON, []],
            self::KEY_SHOW_ASSISTANTS                                     => [self::TYPE_BOOLEAN, false],
            self::KEY_SHOW_ENROLMENT_WORKFLOW                             => [self::TYPE_BOOLEAN, false],
            self::KEY_SHOW_EXCEL_IMPORT                                   => [self::TYPE_BOOLEAN, false],
            self::KEY_SHOW_EXCEL_IMPORT_CONFIG                            => [self::TYPE_BOOLEAN, true],
            self::KEY_SHOW_RESET_PASSWORD                                 => [self::TYPE_BOOLEAN, false],
            self::KEY_SHOW_RULES_ENROLL                                   => [self::TYPE_BOOLEAN, false],
            ExcelImportFormGUI::KEY_COUNT_SKIP_TOP_ROWS                   => [self::TYPE_INTEGER, 0],
            ExcelImportFormGUI::KEY_CREATE_NEW_USERS                      => [self::TYPE_BOOLEAN, false],
            ExcelImportFormGUI::KEY_FIELDS                                => [
                self::TYPE_JSON,
                [
                    [
                        "type"           => ExcelImport::FIELDS_TYPE_ILIAS,
                        "key"            => "login",
                        "column_heading" => ""
                    ],
                    [
                        "type"           => ExcelImport::FIELDS_TYPE_ILIAS,
                        "key"            => "email",
                        "column_heading" => ""
                    ],
                    [
                        "type"           => ExcelImport::FIELDS_TYPE_ILIAS,
                        "key"            => "firstname",
                        "column_heading" => ""
                    ],
                    [
                        "type"           => ExcelImport::FIELDS_TYPE_ILIAS,
                        "key"            => "lastname",
                        "column_heading" => ""
                    ],
                    [
                        "type"           => ExcelImport::FIELDS_TYPE_ILIAS,
                        "key"            => "passwd",
                        "column_heading" => ""
                    ],
                    [
                        "type"           => ExcelImport::FIELDS_TYPE_ILIAS,
                        "key"            => "gender",
                        "column_heading" => ""
                    ],
                    [
                        "type"           => ExcelImport::FIELDS_TYPE_ILIAS,
                        "key"            => "time_limit_owner",
                        "column_heading" => ""
                    ],
                    [
                        "type"           => ExcelImport::FIELDS_TYPE_ILIAS,
                        "key"            => "org_unit",
                        "column_heading" => ""
                    ],
                    [
                        "type"           => ExcelImport::FIELDS_TYPE_ILIAS,
                        "key"            => "org_unit_position",
                        "column_heading" => ""
                    ]
                ],
                true
            ],
            ExcelImportFormGUI::KEY_GENDER_F                              => [self::TYPE_STRING, "f"],
            ExcelImportFormGUI::KEY_GENDER_M                              => [self::TYPE_STRING, "m"],
            ExcelImportFormGUI::KEY_GENDER_N                              => [self::TYPE_STRING, "n"],
            ExcelImportFormGUI::KEY_LOCAL_USER_ADMINISTRATION             => [self::TYPE_BOOLEAN, false],
            ExcelImportFormGUI::KEY_LOCAL_USER_ADMINISTRATION_OBJECT_TYPE => [
                self::TYPE_INTEGER,
                ExcelImport::LOCAL_USER_ADMINISTRATION_OBJECT_TYPE_CATEGORY
            ],
            ExcelImportFormGUI::KEY_LOCAL_USER_ADMINISTRATION_TYPE        => [self::TYPE_INTEGER, ExcelImport::LOCAL_USER_ADMINISTRATION_TYPE_TITLE],
            ExcelImportFormGUI::KEY_MAP_EXISTS_USERS_FIELD                => [self::TYPE_INTEGER, ExcelImport::MAP_EXISTS_USERS_LOGIN],
            ExcelImportFormGUI::KEY_ORG_UNIT_ASSIGN                       => [self::TYPE_BOOLEAN, false],
            ExcelImportFormGUI::KEY_ORG_UNIT_ASSIGN_POSITION              => [self::TYPE_INTEGER, ExcelImport::ORG_UNIT_POSITION_FIELD],
            ExcelImportFormGUI::KEY_ORG_UNIT_ASSIGN_TYPE                  => [self::TYPE_INTEGER, ExcelImport::ORG_UNIT_TYPE_TITLE],
            ExcelImportFormGUI::KEY_SET_PASSWORD                          => [self::TYPE_INTEGER, ExcelImport::SET_PASSWORD_RANDOM],
            ExcelImportFormGUI::KEY_SET_PASSWORD_FORMAT_DATE              => [self::TYPE_BOOLEAN, false]
        ];
}
