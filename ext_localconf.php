<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/index_ts.php']['preprocessRequest'][] = 'EXT:jquerymobile/class.tx_jquerymobile_detection.php:&tx_jquerymobile_detection->detectMobile';

?>