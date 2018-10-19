<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



/*

| -------------------------------------------------------------------------

| Email

| -------------------------------------------------------------------------

| This file lets you define parameters for sending emails.

| Please see the user guide for info:

|

|	http://codeigniter.com/user_guide/libraries/email.html

|

*/

// $config['protocol'] = 'smtp';

// $config['charset']  = 'UTF-8';

// $config['wordwrap'] = TRUE;

// $config['mailtype'] = 'html'; //Use 'text' if you don't need html tags and images  

// $config['smtp_host'] = 'smtp.mandrillapp.com';

// $config['smtp_user'] = 'JBOSolutions - Diseño Web y Diseño Gráfico - Rosario';

// $config['smtp_pass'] = '4kRjDqDOZLTZ-weXGBxnAw';

// $config['smtp_port'] = '587';

// $config['newline'] = "\r\n";

/////////////////////////////

$config['protocol'] = 'smtp';

$config['charset']  = 'UTF-8';

$config['wordwrap'] = TRUE;

$config['mailtype'] = 'html'; //Use 'text' if you don't need html tags and images  

$config['smtp_host'] = 'smtp-pulse.com';

$config['smtp_user'] = 'sales@jbosolutions.com';

$config['smtp_pass'] = 'Gki3jfqaEPZqr';

$config['smtp_port'] = '587';

$config['newline'] = "\r\n";




/* End of file email.php */

/* Location: ./application/config/email.php */