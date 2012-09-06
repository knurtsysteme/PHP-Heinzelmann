<?php

require_once(__DIR__ . '/../modules/simpletest/autorun.php');

/**
 * run all tests.
 * 
 * @package PHP Heinzelmann
 * @subpackage unit-tests
 * @author Daniel Oltmanns <danieloltmanns@knurt.de>
 * @copyright Copyright (c) 2012 knurtsysteme.de
 * @license MIT License
 * @since 05/08/2012
 */
class AllTests extends TestSuite {
	
	public function AllTests() {
		$this->TestSuite('All tests for PHP Heinzelmann ');
		$this->addFile(dirname(__FILE__) . '/TestDomainCheck.php');
		$this->addFile(dirname(__FILE__) . '/TestTest.php');
	}

}

?>
