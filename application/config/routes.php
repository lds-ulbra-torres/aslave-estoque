<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
$route['people'] = 'PeopleController/people';
$route['people/(:num)'] = 'PeopleController/people/$1';
$route['detailed-person/(:num)'] = 'PeopleController/detailedPerson/$1';
$route['create-person'] = 'PeopleController/create';
$route['delete-person/(:num)'] = 'PeopleController/delete/$1';
$route['update-person/(:num)'] = 'PeopleController/update/$1';

/* ROTAS DO SEARCH */
$route['templateSearch'] = 'searchController';

/* ROTAS DO SOBRE */
$route['sobre'] = 'AboutController';

/* ROTAS CONTROLE DE ESTOQUE */
$route['stock'] = 'StockController';
$route['stock/groups'] = 'StockController/groups';
$route['stock/groups/(:num)'] = 'StockController/groups/$1';
$route['stock/groups/create'] = 'StockController/createGroupView';
$route['stock/groups/update/(:num)'] = 'StockController/updateGroupView/$1';
$route['stock/products'] = 'StockController/products';
$route['stock/products/(:num)'] = 'StockController/products/$1';
$route['stock/products/create'] = 'StockController/createProductView';
$route['stock/products/update/(:num)'] = 'StockController/updateProductView/$1';
$route['stock/entries'] = 'StockController/entriesView';
$route['stock/entries/(:num)'] = 'StockController/detailedEntryView';
$route['stock/entries/create'] = 'StockController/createEntryView';
$route['stock/entries/update/(:num)'] = 'StockController/updateEntryView/$1';
$route['stock/outputs'] = 'StockController/outputsView';
$route['stock/outputs/(:num)'] = 'StockController/detailedOutputView';
$route['stock/outputs/create'] = 'StockController/createOutputView';
$route['stock/outputs/update/(:num)'] = 'StockController/updateOutputView/$1';

/* ROTAS CONTROLE DE USUARIOS */
$route['user/create'] = 'UserController/createUserView';
$route['users'] = 'UserController/usersView';
$route['user/update/(:num)'] = 'UserController/updateUserView/$1';

/* ROTAS CONTROLE DE INTERNOS */
$route['internal'] = 'InternalController';
$route['internal/create'] = 'InternalController/internalCreateView';
