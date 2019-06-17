<?php
	namespace Pessoa\Model;

	class Pessoa{

		private $id;
		private $nome;
		private $sobrenome;
		private $email;
		private $situacao;

		function setId($id){
			$this->id=$id;
		}

		function setNome($nome){
			$this->nome=$nome;
		}

		function setSobrenome($sobrenome){
			$this->sobrenome=$sobrenome;
		}

		function setEmail($email){
			$this->email=$email;
		}

		function setSituacao($situacao){
			$this->situacao=$situacao;
		}

		function getNome(){
			return $this->nome;
		}

		function getEmail(){
			return $this->email;
		}

		function getSobrenome(){
			return $this->Sobrenome;
		}

		function getSituacao(){
			return $this->Situacao;
		}

		function getId(){
			return $this->id;
		}

		public function exchangeArray(array $data){
			$this->id = !empty($data['id']) ? $data['id'] : null;
			$this->nome = !empty($data['nome']) ? $data['nome'] : null;
			$this->sobrenome = !empty($data['sobrenome']) ? $data['sobrenome'] : null;
			$this->email = !empty($data['email']) ? $data['email'] : null;
			$this->situacao = !empty($data['situacao']) ? $data['situacao'] : null;			
		}


	}
?>