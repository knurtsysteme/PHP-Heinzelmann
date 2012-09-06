<?php

require_once(__DIR__ . '/modules/simpletest/autorun.php');

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

	private function getAllTestFiles() {
		$result = array();
		$candidates = scandir(__DIR__);
		foreach($candidates as $candidate) {
			if(preg_match('/^Test.+\.php$/', $candidate) && __DIR__ . DIRECTORY_SEPARATOR . $candidate  != __FILE__) {
				$result[] = __DIR__ . DIRECTORY_SEPARATOR . $candidate;
			}
		}
		return $result;
	}

	/**
	 * add all files into the testsuite that:
	 * - are in this directry
	 * - begin with "Test"
	 * - end with "php"
	 * - is not this file
	 */
	public function AllTests() {
		$this->TestSuite('All tests for PHP Heinzelmann ');
		$testFiles = $this->getAllTestFiles();
		foreach($testFiles as $testFile) {
			$this->addFile($testFile);
		}
	}

}

?>
