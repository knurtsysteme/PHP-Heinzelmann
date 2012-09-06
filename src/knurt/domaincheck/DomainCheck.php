<?php

namespace knurt\domaincheck;

/**
 * check if a domain is valid or exists
 *
 * @package PHP Heinzelmann
 * @subpackage domaincheck
 * @author Daniel Oltmanns <danieloltmanns@knurt.de>
 * @copyright Copyright (c) 2012 knurtsysteme.de
 * @license MIT License
 * @since 05/08/2012
 */
interface DomainCheck {
	
	/**
	 * return true if the domain is checkable and valid.
	 * return null, if the domain is not checkable.
	 * return false on invalid domains.
	 * invalid domains are subdomains (requesting "sub.domain.com") or
	 * domains with characters not allowed.
	 */
	public function isValid();
	
	/**
	 * return true if the domain exists.
	 * if the domain is invalid, 
	 * return false (because it does not exist)
	 */
	public function exists();
		
	/**
	 * return true if the domain can be checked
	 */
	public function isCheckable();
}
?>
