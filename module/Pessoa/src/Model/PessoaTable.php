<?php

	//Classe qu ira manipular o nosso modelo de dados e interagir com o nosso banco de dados atraves do TableGateway, que é uma classe pronta do Zend Framework
	namespace Pessoa\Model;
	use Zend\Db\TableGateway\TableGatewayInterface;
	use RuntimeException;

	class PessoaTable{
		private $tableGateway;

		public function __construct(TableGatewayInterface $tableGateway){
			$this->tableGateway = $tableGateway;
		}

		public function getAll(){
			return $this->tableGateway->select();
		}

		public function getPessoa($id){
			$id= (int) $id;//Só para verificar se o id passado é um inteiro
			$rowset = $this->tableGateway->select(['id' => $id]);
			$row= $rowset->current();
			if(!$row){
				throw new RuntimeException(sprintf("Não foi encontrado o id %d",$id));		
			}
			return $row;
		}

		public function salvarPessoa(Pessoa $pessoa){
			$dados = [
				'nome' => $pessoa->getNome(),
				'sobrenome' => $pessoa->getSobrenome(),
				'email' => $pessoa->getEmail(),
				'situacao' => $pessoa->getSituacao(),
			];

			$id= (int) $pessoa -> getId();
			if($id === 0){
				$this->tableGateway->insert($dados);
				return;
			}
			$this->tableGateway->update($dados,['id'=>$id]);//A condição fica entre os parenteses;
		}

		public function deletarPessoa($id){
			$this->tableGateway->delete(['id'=>(int) $id]);
		}

	}

?>