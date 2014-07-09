<?php

/**
 * 系统常量类
 * 
 * @author Administrator
 *
 */
class Bonjour_Core_GlobalConstant {
	
	const BONJOUR_SUCCESS = '0000';
	const BONJOUR_ERROR   = '0001';
	
	/**
	 * 状态字常量
	 */
	const PROJECT_INITIALIZED = 0;
	const PROJECT_STARTED = 1;
	const PROJECT_CLOSED = 2;
	const PROJECT_CANCELED =3;
	
	const REQUIREMENT_INITIALIZED = 0;
	const REQUIREMENT_VERIFY_SUBMITTED = 1;
	const REQUIREMENT_VERYFY_RETURNED = 2;
	const REQUIREMENT_VERIFIED = 3;
	const REQUIREMENT_PROJECT_APPROVED = 4;
	const REQUIREMENT_CHECK_SUBMITTED = 5;
	const REQUIREMENT_CHECK_RETURNED = 6;
	const REQUIREMENT_CHECKED = 7;
	const REQUIREMENT_CLOSED = 8;
}

?>