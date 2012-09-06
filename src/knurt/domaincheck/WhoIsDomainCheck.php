<?php

namespace knurt\domaincheck;

require_once(__DIR__ . '/DomainCheck.php');

/**
 * check if a domain is valid or exists based on who is queries
 *
 * @package PHP Heinzelmann
 * @subpackage domaincheck
 * @author Daniel Oltmanns <danieloltmanns@knurt.de>
 * @copyright Copyright (c) 2012 knurtsysteme.de
 * @license MIT License
 * @since 05/08/2012
 */
class WhoIsDomainCheck implements DomainCheck {

	private $domain = null;

	private $whois = array();

	/**
	 * construct a domain checker based on a who is query.
	 * @param @domain to check
	 */
	public function __construct($domain) {
		$this->domain = get_magic_quotes_gpc() ? str_replace('www.', '', $domain) : addslashes(str_replace('www.', '', $domain));
		$this->whois['de']['server'] = 'whois.denic.de';
		$this->whois['de']['answer'] = 'Status: free';
		$this->whois['com']['server'] = 'whois.crsnic.net';
		$this->whois['com']['answer'] = 'No match for';
		$this->whois['net']['server'] = 'whois.crsnic.net';
		$this->whois['net']['answer'] = 'No match for';
		$this->whois['org']['server'] = 'whois.publicinterestregistry.net';
		$this->whois['org']['answer'] = 'NOT FOUND';
		$this->whois['info']['server'] = 'whois.afildomaincheck.net';
		$this->whois['info']['answer'] = 'NOT FOUND';
		$this->whois['biz']['server'] = 'whois.nic.biz';
		$this->whois['biz']['answer'] = 'Not found';
		$this->whois['ag']['server'] = 'whois.nic.ag';
		$this->whois['ag']['answer'] = 'NOT FOUND';
		$this->whois['am']['server'] = 'whois.nic.am';
		$this->whois['am']['answer'] = 'No match';
		$this->whois['as']['server'] = 'whois.nic.as';
		$this->whois['as']['answer'] = 'Domain Not Found';
		$this->whois['at']['server'] = 'whois.nic.at';
		$this->whois['at']['answer'] = 'nothing found';
		$this->whois['be']['server'] = 'whois.dns.be';
		$this->whois['be']['answer'] = 'Status: FREE';
		$this->whois['cd']['server'] = 'whois.cd';
		$this->whois['cd']['answer'] = 'No match';
		$this->whois['ch']['server'] = 'whois.nic.ch';
		$this->whois['ch']['answer'] = 'not have an entry';
		$this->whois['cx']['server'] = 'whois.nic.cx';
		$this->whois['cx']['answer'] = 'Status: Not Registered';
		$this->whois['dk']['server'] = 'whois.dk-hostmaster.dk';
		$this->whois['dk']['answer'] = 'No entries found';
		$this->whois['it']['server'] = 'whois.nic.it';
		$this->whois['it']['answer'] = 'Status: AVAILABLE';
		$this->whois['li']['server'] = 'whois.nic.li';
		$this->whois['li']['answer'] = 'do not have an entry';
		$this->whois['lu']['server'] = 'whois.dns.lu';
		$this->whois['lu']['answer'] = 'No such domain';
		$this->whois['nu']['server'] = 'whois.nic.nu';
		$this->whois['nu']['answer'] = 'NO MATCH for';
		$this->whois['ru']['server'] = 'whois.ripn.net';
		$this->whois['ru']['answer'] = 'No entries found';
		$this->whois['ws']['server'] = 'whois.nic.ws';
		$this->whois['ws']['answer'] = 'No match for';
	}

	/**
	 * (non-PHPdoc)
	 * @see knurt\domaincheck.DomainCheck::isValid()
	 */
	public function isValid() {
		if($this->isCheckable() == false) {
			return null;
		} else {
			return $this->domain != null && preg_match('/^([a-zA-Z0-9]+(-[a-zA-Z0-9]+)*)+\.([a-zA-Z]{2,3})$/', $this->domain);
		}
	}

	private function getTld() {
		return preg_replace('/.+\./', '', $this->domain);
	}

	private function getDomainWithoutTld() {
		return preg_replace('/\..+/', '', $this->domain);
	}

	/**
	 * (non-PHPdoc)
	 * @see knurt\domaincheck.DomainCheck::isCheckable()
	 */
	public function isCheckable() {
		return isset($this->whois[$this->getTld()]);
	}

	/**
	 * (non-PHPdoc)
	 * @see knurt\domaincheck.DomainCheck::exists()
	 */
	public function exists() {
		$result = false;
		if($this->isCheckable() == false) {
			$result = null;
		}
		else if($this->isValid() == false) {
			// an invalid url cannot exist!
			$result = false;
		}
		else if($this->domain != null) {
			$answer = '';
			$check = fsockopen($this->whois[$this->getTld()]['server'], 43);
			fputs($check, $this->domain . "\r\n");
			while(feof($check) == false) {
				$answer .= fgets($check, 128);
			}
			fclose($check);
			$result = preg_match('/' . $this->whois[$this->getTld()]['answer'] . '/', $answer) == false;
		}
		return $result;
	}

}
?>
