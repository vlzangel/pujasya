<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'search/grid';

$route['404_override'] = 'Custom_404';
$route['translate_uri_dashes'] = FALSE;

//Routes paginas de la empresa
$route['terminos_y_condiciones'] = 'index/terminos_y_condiciones';
$route['preguntas_frecuentes'] = 'index/preguntas_frecuentes';
$route['contacta'] = 'index/contacta';
$route['comprarfichas'] = 'cuenta/comprarfichas';
$route['comprarfichas/(:any)/(:any)'] = 'cuenta/comprarfichas/$1/$2';
$route['comprarproducto/(:any)'] = 'cuenta/comprarproducto/$1';

//Route para perfil empresa

$route['anuncios/empresa/(:any)'] = 'anuncios/empresa/$1';
$route['anuncios/empresa/(:any)/(:num)'] = 'anuncios/empresa/$1/$2';

//Routes para listado de anuncios
$route['anuncios/(:any)'] = 'anuncios/index/$1';
$route['anuncios/(:any)/(:any)'] = 'anuncios/index/$1/$2';
$route['anuncios/(:any)/(:any)/(:num)'] = 'anuncios/index/$1/$2/$3';

//Route para detalle de anuncio

$route['anuncio/(:any)'] = 'anuncios/anuncio/$1';

//Routes para busquedas
$route['busqueda/(:any)/(:any)'] = 'anuncios/busqueda/$1/$2';
$route['busqueda/(:any)/(:any)/(:num)'] = 'anuncios/busqueda/$1/$2/$3';

//Route para registro

$route['registro'] = 'ingresar/registro';

/* Administrador */

	$route['admin'] = 'Login_admin/login';
	$route['admin/logear'] = 'Login_admin/logear';
	$route['administrador'] = 'Administrador/home';




