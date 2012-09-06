<?php 

require_once(__DIR__ . '/modules/simpletest/autorun.php');
require_once(__DIR__ . '/../src/knurt/domaincheck/WhoIsDomainCheck.php');

use knurt\domaincheck\WhoIsDomainCheck;

/**
 * checks the domainchecker subpackage.
 * 
 * needs internet access to pass.
 * 
 * @package PHP Heinzelmann
 * @subpackage unit-tests
 * @author Daniel Oltmanns <danieloltmanns@knurt.de>
 * @copyright Copyright (c) 2012 knurtsysteme.de
 * @license MIT License
 * @since 05/08/2012
 */
class TestDomainCheck extends UnitTestCase {

	private static function domainCheck($domain) {
		return new WhoIsDomainCheck($domain);
	}

	public function testDomainCheckerInvalid() {
		$domains = array('sub.domain.com', 'a+b.de', 'cd ef.de');
		foreach($domains as $domain) {
			$this->assertFalse(self::domainCheck($domain)->isValid(), $domain);
			$this->assertFalse(self::domainCheck($domain)->exists(), $domain);
		}
	}
	
	public function testIsCheckable() {
		$this->assertFalse(self::domainCheck('knurtsysteme.asdf')->isCheckable());
		$this->assertTrue(self::domainCheck('knurtsysteme.de')->isCheckable());
		$this->assertNull(self::domainCheck('knurtsysteme.yxcv')->isValid());
		$this->assertNull(self::domainCheck('knurtsysteme.lkmt')->exists());
	}

	public function testDomainCheckerNotExistingValid() {
		$domain = 'totally-idiot-domain-0560465046540654604.de';
		$this->assertFalse(self::domainCheck($domain)->exists());
		$this->assertTrue(self::domainCheck($domain)->isValid());
	}

	public function testIgnoreWww() {
		$domain = 'www.knurtsysteme.de';
		$this->assertTrue(self::domainCheck($domain)->exists());
		$this->assertTrue(self::domainCheck($domain)->isValid());
	}

	public function testDomainCheckerExistingValid() {
		$domain = 'knurtsysteme.de';
		$this->assertTrue(self::domainCheck($domain)->exists());
		$this->assertTrue(self::domainCheck($domain)->isValid());
	}
}
?>