<?php
/*
 * This file contains the default configuration for email
 */

// Set the default useragent to flyRuby Mail
$config['useragent'] = 'Epic Change mail';

// Use smtp - valid options are mail, sendmail, or smtp
$config['protocol'] = 'smtp';
$config['smtp_timeout']='30';
$config['smtp_host'] = 'ssl://smtp.googlemail.com';
$config['smtp_user'] = 'contact@epicchange.org';
$config['smtp_pass'] = 'epicchange';
$config['smtp_port'] = '465';
$config['newline'] = "\r\n";
$config['wordwrap'] = TRUE;
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";

// Default to HTML
$config['mailtype'] = 'html';

// Enable BCC batch
$config['bcc_batch_mode'] = TRUE;
