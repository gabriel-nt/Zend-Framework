<?php
	
	namespace Pessoa\Controller;
	use Zend\Mvc\Controller\AbstractActionController;
	use Zend\View\Model\ViewModel;

	class PessoaController extends AbstractActionController{
		//O Action no final do metodo, deve sempre ter para o Zend saber que é uma ação

		private $table;

	    public function __construct($table) {
	        $this->table = $table;
	    }

		public function indexAction(){
			//Todos os metodos do controller eles devem retornar uma view
			return new ViewModel(['pessoas' => $this->table->getAll()]);//O Zend ira renderizar todas as colunas da tabelea do banco de dados
		}

		public function adicionarAction(){
			return new ViewModel();
		}

		public function salvarAction(){
			return new ViewModel();
		}

		public function editarAction(){
			return new ViewModel();
		}

		public function deletarAction(){
			return new ViewModel();
		}

		public function confirmacaoAction(){
			return new ViewModel();
		}
	}
?>