<?php/*************************************************************** *  Copyright notice * *  (c) 2010 Joerg Kummer <typo3 et enobe dot de> *  All rights reserved * *  This script is part of the TYPO3 project. The TYPO3 project is *  free software; you can redistribute it and/or modify *  it under the terms of the GNU General Public License as published by *  the Free Software Foundation; either version 2 of the License, or *  (at your option) any later version. * *  The GNU General Public License can be found at *  http://www.gnu.org/copyleft/gpl.html. * *  This script is distributed in the hope that it will be useful, *  but WITHOUT ANY WARRANTY; without even the implied warranty of *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the *  GNU General Public License for more details. * *  This copyright notice MUST APPEAR in all copies of the script! ***************************************************************//** * Class for detect and redirect mobile devices. * * $Id: class.tx_jquerymobile_detection.php * * @author	Joerg Kummer <typo3 et enobe dot de> * @package TYPO3 * @subpackage jquerymobile *//** * [CLASS/FUNCTION INDEX of SCRIPT] * *   47: class tx_jquerymobile_detection *   56:     function detectMobile() *  111:     function ext_hardRedirect($url) *  111:     function getSelfUrl($prependProtocol=true) * * TOTAL FUNCTIONS: 3 * */ class tx_jquerymobile_detection { 		/**	 * Main methode to detect mobile devices and redirect	 *	 * @return	void	 * @author	Joerg Kummer <typo3 et enobe dot de>	 * @access	public	 */	public function detectMobile() {			// get url        $selfUrl = $this->getSelfUrl();		$url = $selfUrl;			// get GET params		$getType = t3lib_div::_GET('type');		$forceMobile = t3lib_div::_GET('forceMobile');			// defined user agents		#$userAgent = 'iPhone|iPod|iPad|IEMobile|Android|Blackberry|Palm|NetFront|Windows CE|MIDP|UP\.Browser|Symbian';		$userAgent = 'android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino';		$userAgentSubstring = '1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-';			// match user agent		$matchUserAgent = preg_match('/' . $userAgent . '/i', $_SERVER['HTTP_USER_AGENT']);		$matchUserAgentSubstring = preg_match('/' . $userAgentSubstring . '/i',substr($userAgent,0,4));			// get extConf for defaults		$_EXTCONF = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['jquerymobile']);			// push '&type' GET-parameter		$url .= '&type='.$_EXTCONF['page_typeNum'];				if ( ($forceMobile || $matchUserAgent || $matchUserAgentSubstring) && !$getType ) {			$this->ext_hardRedirect($url);		} else {			// do nothing		}	}			/**	 * Send a redirect header	 *	 * @param	string	URL to redirect to	 * @return	void	 * @author	Carsten Windler <info et windler-consulting dot de>	 * @access	public	 */	public function ext_hardRedirect($url)	{			// header("HTTP 302 Redirect");		header('Location: ' . $url);		exit;	}			/**	 * Retrieve the requested URI	 * 	 * @return  string:	$prependProtocol as boolean	 * @author	Carsten Windler <info et windler-consulting dot de>	 * @access	public	 */	private function getSelfUrl($prependProtocol=true) {			// get uri		if(!isset($_SERVER['REQUEST_URI'])) {			$serverrequri = $_SERVER['PHP_SELF']; 		} else { 			$serverrequri = $_SERVER['REQUEST_URI']; 		} 			// HTTPS		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 			// return uri		if($prependProtocol) {			return substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")) . $s . "://" . $_SERVER['SERVER_NAME'] . $serverrequri; 		} else {			return $_SERVER['SERVER_NAME'] . $serverrequri;		}	}}if (defined('TYPO3_MODE') && $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/jquerymobile/class.tx_jquerymobile_detection.php'])  {	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/jquerymobile/class.tx_jquerymobile_detection.php']);}?> 