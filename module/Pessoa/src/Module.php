<?php
	/*Arquivo que é chamado quando o modulo é carregado pelo Zend...Ele é preciso
	para o Zend saber que este diretorio é um modulo*/

	namespace Pessoa;
	use Zend\ModuleManager\Feature\ConfigProviderInterface;
	use Zend\Db\Adapter\AdapterInterface;
	use Zend\Db\ResultSet\ResultSet;
	use Zend\Db\TableGateway\TableGateway;
	use Pessoa\Controller\PessoaController;

	class Module implements ConfigProviderInterface{

		public function getConfig(){
			return include __DIR__ .'/../config/module.config.php';
		}
		/*Configuração do tableGateway para ele ser da classe pessoa e reconhecer a mesma
		Iremos utilizar uma configuração de serviço e fornecer uma factorie que vai nos fornecer uma PessoaTable com uma tableGateway já configurado dentro.
		Para retonar as configurações de serviço quando o modulo for criado
		*/

		public function getServiceConfig(){
			return [
				'factories' => [
					/*Especie de construtor esta função
					O container é uma classe do Zend que utiliza para passar injeção de dependecias para varias classes quando o ServiceManager( que é o gerenciador de dependecias do Zend) quando ele for atuar. Quando ele for criar uma classe PessoaTable, o ServiceManager vai acionar este metodo passando o container como injeção de dependencia*/
					Model\PessoaTable::class => function($container){
						$tableGateway = $container->get(Model\PessoaTableGateway::class);
						return new Model\PessoaTable($tableGateway);
					},
					Model\PessoaTableGateway::class=> function($container){
						$dbAdapter = $container->get(AdapterInterface::class);
                    	$resultSetPrototype = new ResultSet();
                    	$resultSetPrototype->setArrayObjectPrototype(new Model\Pessoa());
                    	return new TableGateway('pessoa', $dbAdapter, null, $resultSetPrototype);
					},

				]
			];
		}
		//Metodo para realizar o construtor do classe PessoaTable
		public function getControllerConfig() {
        return [
            'factories' => [
                PessoaController::class => function($container) {
                    $tableGateway = $container->get(Model\PessoaTable::class);
                    return new PessoaController($tableGateway);
                	},
            	],
        	];
    	}
	}