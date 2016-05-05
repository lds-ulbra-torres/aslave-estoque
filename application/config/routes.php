<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'homeController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

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

/* ROTAS PESSOAS */
$route['people'] = 'peopleController';
$route['people-create-form'] = 'peopleController/peopleCreateView';
$route['create-people'] = 'peopleController/create';
$route['delete-people/(:num)'] = 'peopleController/delete/$1';
$route['update-people/(:num)'] = 'peopleController/update/$1';

/* ROTAS DO SEARCH */
$route['templateSearch'] = 'searchController';
$route['movimentation-search'] = 'movimentationController/searchMovimentation';
