<?php
	/*Arquivo de configuração do Zend...Assim como existe um arquivo de configuração global,
	nosso módulo tmb pode ter uma configuração...O Zend quanto executa a aplicação, ele procura todos os
	modulo de config e junta todos os arq de configuração e faz uma mesclagem...Ele retorna um array é que é mesclado na configuração global

	As configurações no Zend são, nada menos, do que array*/

	namespace Pessoa;
	use Zend\Router\Http\Segment;
	use Zend\ServiceManager\Factory\InvokableFactory;

	return [
		'router' => [
			'routes' => [
				'pessoa' => [
					//A rota do tipo Segment, nos permite criar rotas com o tipo de segmento abaixo 
					'type' => Segment::class,
					'options' => [
						//O route contem uma expressão regular para verificar a rota
						'route' => '/pessoa[/:action[/:id]]',
						//Constraints são restrições aplicadas as nossas rotas
						'constraints' => [
                        	'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        	'id'     => '[0-9]+',
                    	],
                    	'defaults' => [
                        	'controller' => Controller\PessoaController::class,
                        	'action'     => 'index',
                   		],
					],
				],
			],
		],
		//O zend sempre que carrega uma página, ele vai tentar criar um construtor de uma determinada classe passada na rota
		'controllers' => [
			//Determinada as factories para os meus controllers, assim com a classe invokable ele cria um construtor generico
			'factories' => [
				//Controller\PessoaController::class => InvokableFactory::class,
			],
		],
		//Informa para o Zend, aonde encontra as view deste módulo Pessoa
		'view_manager' => [
			'template_path_stack' => [
				'pessoa' => __DIR__ .'/../view',
			],
		],
		'db' => [
    	'driver' => 'Pdo_Mysql',
    	'database' => 'teste',
    	'username' => 'root',
    	'password' => '',
    	'hostname' => 'localhost'
    	],

	];

?>