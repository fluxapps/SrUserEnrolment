<?php

namespace srag\DIC\SrUserEnrolment\DIC;

use srag\DIC\SrUserEnrolment\Database\DatabaseDetector;
use srag\DIC\SrUserEnrolment\Database\DatabaseInterface;

/**
 * Class AbstractDIC
 *
 * @package srag\DIC\SrUserEnrolment\DIC
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
abstract class AbstractDIC implements DICInterface {

	/**
	 * AbstractDIC constructor
	 */
	protected function __construct() {

	}


	/**
	 * @inheritdoc
	 */
	public function database(): DatabaseInterface {
		return DatabaseDetector::getInstance($this->databaseCore());
	}
}