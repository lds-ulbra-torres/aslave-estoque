<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** $ACTIVE_GROUP -> Não esquecer de alterar para 'dev' ou 'test'
 * JAMAIS realize testes em 'prod', e não bagunce o 'test'.
 * Em memória a Feldens, Peixeira Dropadora de DBs
 *
 * Host+Pass do 'prod' tá no trello
 */
$active_group = 'test';
$query_builder = TRUE;

$db['test'] = array(
	'dsn'	=> '',
	'hostname' => 'slavedb_teste.mysql.dbaas.com.br',
	'username' => 'slavedb_teste',
	'password' => 'Peixeira',
	'database' => 'slavedb_teste',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['dev'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'slavedb',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['prod'] = array(
	'dsn'	=> '',
	'hostname' => '',
	'username' => 'slavedb',
	'password' => '',
	'database' => 'slavedb',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
