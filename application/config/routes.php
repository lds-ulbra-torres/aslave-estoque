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
$route['default_controller'] = 'HomeController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
/* RORAS LOGIN */
$route['login'] = 'UserController';
/* ROTAS FINANCEIRO */
$route['financial'] = 'financialController';
$route['classification'] = 'classificationController';
$route['create-classification-form'] = 'classificationController/createForm';
$route['create-classification'] = 'classificationController/create';
$route['delete-classification'] = 'classificationController/delete';
$route['update-classification/(:num)'] = 'classificationController/update/$1';
$route['update-classification-form/(:num)'] = 'classificationController/updateForm/$1';
$route['financial-movimentation'] = 'movimentationController';
$route['create-movimentation-form'] = 'movimentationController/createMovimentationForm';
$route['create-movimentation'] = 'movimentationController/createMovimentation';
$route['delete-movimentation'] = 'movimentationController/deleteMovimentation';
$route['update-movimentation-form/(:num)'] = 'movimentationController/updateMovimentationForm/$1';
$route['update-movimentation/(:num)'] = 'movimentationController/updateMovimentation/$1';
$route['search-movimentation'] = 'movimentationController/searchMovimentation';
$route['search-classification'] = 'classificationController/searchPerType';

/* ROTAS PESSOAS */
$route['people'] = 'peopleController';
$route['people/(:num)'] = 'peopleController/index/$1';
$route['people-create-form'] = 'peopleController/peopleCreateView';
$route['create-people'] = 'peopleController/create';
$route['delete-people/(:num)'] = 'peopleController/delete/$1';
$route['update-people/(:num)'] = 'peopleController/update/$1';

/* ROTAS DO SEARCH */
$route['templateSearch'] = 'searchController';

/* ROTAS DO SOBRE */
$route['sobre'] = 'AboutController';

/* ROTAS CONTROLE DE ESTOQUE */ 
$route['stock'] = 'StockController';
$route['stock/groups'] = 'StockController/groups';
$route['stock/groups/create'] = 'StockController/createGroupView';
$route['stock/groups/update/(:num)'] = 'StockController/updateGroupView/$1';
$route['stock/groups/delete'] = 'StockController/deleteGroupView';
$route['stock/products'] = 'StockController/products';
$route['stock/products/create'] = 'StockController/createProductView';
$route['stock/products/update/(:num)'] = 'StockController/updateProductView/$1';
$route['stock/products/delete'] = 'StockController/deleteProductView';
$route['stock/entries'] = 'StockController/entriesView';
$route['stock/entries/create'] = 'StockController/createEntryView';
$route['stock/entries/(:num)'] = 'StockController/detailedEntryView';
$route['stock/outputs'] = 'StockController/outputsView';
$route['stock/outputs/create'] = 'StockController/createOutputView';
$route['stock/outputs/(:num)'] = 'StockController/detailedOutputView';

/* ROTAS CONTROLE DE USUARIOS */
$route['user/create'] = 'UserController/createUserView';
$route['users'] = 'UserController/usersView';
$route['user/update/(:num)'] = 'UserController/updateUserView/$1';