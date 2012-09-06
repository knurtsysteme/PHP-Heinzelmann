<?php 

require_once(__DIR__ . '/../modules/simpletest/autorun.php');
require_once(__DIR__ . '/../src/knurt/test/CodeStructure.php');
require_once(__DIR__ . '/../src/knurt/domaincheck/WhoIsDomainCheck.php');

use knurt\domaincheck\WhoIsDomainCheck;
use knurt\test\CodeStructure;

/**
 * checks the test subpackage.
 * 
 * @package PHP Heinzelmann
 * @subpackage unit-tests
 * @author Daniel Oltmanns <danieloltmanns@knurt.de>
 * @copyright Copyright (c) 2012 knurtsysteme.de
 * @license MIT License
 * @since 05/08/2012
 */
class TestTest extends UnitTestCase {
	
	public function testDomainCheckObject() {
		$this->assertTrue(CodeStructure::classImplements('knurt\domaincheck\DomainCheck', new WhoIsDomainCheck("asdf")));
		$this->assertFalse(CodeStructure::classImplements('FooBar', new WhoIsDomainCheck("asdf")));
	}

	public function testNullValues() {
		$this->assertFalse(CodeStructure::classImplements('FooBar', null));
		$this->assertFalse(CodeStructure::classImplements(null, new WhoIsDomainCheck("asdf")));
		$this->assertFalse(CodeStructure::classImplements(null, null));
	}
}
?>