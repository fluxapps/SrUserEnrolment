<?php

namespace srag\Plugins\SrUserEnrolment\EnrolmentWorkflow\Rule;

use ActiveRecord;
use arConnector;
use ilSrUserEnrolmentPlugin;
use LogicException;
use srag\DIC\SrUserEnrolment\DICTrait;
use srag\Plugins\SrUserEnrolment\Utils\SrUserEnrolmentTrait;

/**
 * Class AbstractRule
 *
 * @package srag\Plugins\SrUserEnrolment\EnrolmentWorkflow\Rule
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
abstract class AbstractRule extends ActiveRecord
{

    use DICTrait;
    use SrUserEnrolmentTrait;
    /**
     * @var string
     *
     * @abstract
     */
    const TABLE_NAME_SUFFIX = "";
    const PLUGIN_CLASS_NAME = ilSrUserEnrolmentPlugin::class;
    const PARENT_CONTEXT_COURSE = 1;
    const PARENT_CONTEXT_STEP = 2;
    const PARENT_CONTEXT_ACTION = 3;
    const PARENT_CONTEXT_RULE_GROUP = 4;
    const TYPE_COURSE_RULE = 1;
    const TYPE_STEP_ACTION = 2;
    const TYPE_STEP_CHECK_ACTION = 3;
    const TYPE_ACTION_IF = 4;
    const TYPE_RULE_GROUP = 5;
    const TYPES
        = [
            self::PARENT_CONTEXT_STEP       => [
                self::TYPE_STEP_ACTION       => "action",
                self::TYPE_STEP_CHECK_ACTION => "check_action"
            ],
            self::PARENT_CONTEXT_ACTION     => [
                self::TYPE_ACTION_IF => "if"
            ],
            self::PARENT_CONTEXT_COURSE     => [
                self::TYPE_COURSE_RULE => "course_rule"
            ],
            self::PARENT_CONTEXT_RULE_GROUP => [
                self::TYPE_RULE_GROUP => "group"
            ]
        ];


    /**
     * @inheritDoc
     */
    public static function getTableName() : string
    {
        if (empty(static::TABLE_NAME_SUFFIX)) {
            throw new LogicException("table name suffix is empty!");
        }

        return ilSrUserEnrolmentPlugin::PLUGIN_ID . "_rul_" . static::TABLE_NAME_SUFFIX;
    }


    /**
     * @return string
     */
    public function getConnectorContainerName()
    {
        return static::getTableName();
    }


    /**
     * @return string
     *
     * @deprecated
     */
    public static function returnDbTableName()
    {
        return static::getTableName();
    }


    /**
     * @return string
     */
    public static function getRuleType() : string
    {
        return strtolower(end(explode("\\", static::class)));
    }


    /**
     * @param int|null $parent_context
     *
     * @return bool
     */
    public static function supportsParentContext(/*?*/ int $parent_context = null) : bool
    {
        switch ($parent_context) {
            default:
                return true;
        }
    }


    /**
     * @var int
     *
     * @con_has_field    true
     * @con_fieldtype    integer
     * @con_length       8
     * @con_is_notnull   true
     * @con_is_primary   true
     * @con_sequence     true
     */
    protected $rule_id;
    /**
     * @var bool
     *
     * @con_has_field    true
     * @con_fieldtype    integer
     * @con_length       1
     * @con_is_notnull   true
     */
    protected $enabled = true;
    /**
     * @var int
     *
     * @con_has_field    true
     * @con_fieldtype    integer
     * @con_length       8
     * @con_is_notnull   true
     */
    protected $parent_context;
    /**
     * @var string
     *
     * @con_has_field    true
     * @con_fieldtype    text
     * @con_is_notnull   true
     */
    protected $parent_id;
    /**
     * @var int
     *
     * @con_has_field    true
     * @con_fieldtype    integer
     * @con_length       8
     * @con_is_notnull   true
     */
    protected $type;


    /**
     * AbstractRule constructor
     *
     * @param int              $primary_key_value
     * @param arConnector|null $connector
     */
    public function __construct(/*int*/ $primary_key_value = 0, arConnector $connector = null)
    {
        parent::__construct($primary_key_value, $connector);
    }


    /**
     * @return string
     */
    public function getRuleTypeTitle() : string
    {
        return self::plugin()->translate("rule_type_" . static::getRuleType(), RulesGUI::LANG_MODULE);
    }


    /**
     * @return string
     */
    public function getRuleTitle() : string
    {
        return $this->getRuleTypeTitle();
    }


    /**
     * @return string
     */
    public abstract function getRuleDescription() : string;


    /**
     * @return string
     */
    public function getId() : string
    {
        return self::getRuleType() . "_" . $this->rule_id;
    }


    /**
     * @param string $field_name
     *
     * @return mixed|null
     */
    public function sleep(/*string*/ $field_name)
    {
        $field_value = $this->{$field_name};

        switch ($field_name) {
            case "enabled":
                return ($field_value ? 1 : 0);

            default:
                return null;
        }
    }


    /**
     * @param string $field_name
     * @param mixed  $field_value
     *
     * @return mixed|null
     */
    public function wakeUp(/*string*/ $field_name, $field_value)
    {
        switch ($field_name) {
            case "enabled":
                return boolval($field_value);

            default:
                return null;
        }
    }


    /**
     * @return int
     */
    public function getRuleId() : int
    {
        return $this->rule_id;
    }


    /**
     * @param int $rule_id
     */
    public function setRuleId(int $rule_id)/*: void*/
    {
        $this->rule_id = $rule_id;
    }


    /**
     * @return bool
     */
    public function isEnabled() : bool
    {
        return $this->enabled;
    }


    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled)/*: void*/
    {
        $this->enabled = $enabled;
    }


    /**
     * @return int
     */
    public function getParentContext() : int
    {
        return $this->parent_context;
    }


    /**
     * @param int $parent_context
     */
    public function setParentContext(int $parent_context)/* : void*/
    {
        $this->parent_context = $parent_context;
    }


    /**
     * @return string
     */
    public function getParentId() : string
    {
        return $this->parent_id;
    }


    /**
     * @param string $parent_id
     */
    public function setParentId(string $parent_id)/* : void*/
    {
        $this->parent_id = $parent_id;
    }


    /**
     * @return int
     */
    public function getType() : int
    {
        return $this->type;
    }


    /**
     * @param int $type
     */
    public function setType(int $type) /*: void*/
    {
        $this->type = $type;
    }
}