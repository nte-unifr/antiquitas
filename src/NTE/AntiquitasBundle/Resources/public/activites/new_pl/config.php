<?php

$config = array();

$config['debug'] = false;

$config['dbhost'] = 'localhost';
$config['dbname'] = 'elrng_antiquitas';
$config['dbuser'] = 'elrng_antiquitas';
$config['dbpass'] = 'fbg69s';
$config['dbprefix'] = 'ant2_';

$config['admin_logins'] = array('admin'=>'lucrece');

$config['deflang'] = 'fr';	// either 'fr' or 'de'

$config['rootpath'] = dirname(__FILE__);

$config['freepass'] = true;

$config['wysiwyg'] = true;	// whether or not to use wysiwyg in the admin

$config['overwrite_qstats'] = true;	// set to true to keep only the students final answer in the statistics. False will keep all answers.

$config['user_session_var'] = 'antiquitas_userid';
$config['essais_session_var'] = 'antiquitas_essais';

$config['theme_stylesheet'] = 'old.css';
