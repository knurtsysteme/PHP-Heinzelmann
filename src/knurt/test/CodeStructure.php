<?php

namespace knurt\test;

/**
 * test the structure of code.
 *
 * @package PHP Heinzelmann
 * @subpackage test
 * @author Daniel Oltmanns <danieloltmanns@knurt.de>
 * @copyright Copyright (c) 2012 knurtsysteme.de
 * @license MIT License
 * @since 05/08/2012
 */
class CodeStructure {

	/**
	 * return true, if the class of the given object implements the given interface
	 * 
	 * @param mixed $interface
	 * @param mixed $obj
	 * @return boolean true if given object implements the given interface
	 */
	public static function classImplements($interface, $obj) {
		$result = false;
		foreach(class_implements(get_class($obj)) as $i) {
			if($i == $interface) {
				$result = true;
			}
		}
		return $result;
	}
}
?>