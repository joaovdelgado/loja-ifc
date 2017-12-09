<?php
/**
 * Created by PhpStorm.
 * User: JEFFERSON
 * Date: 16/11/2017
 * Time: 10:56
 */

require_once "Conexao.php";
require_once "Produto.php";

class CrudProdutos {

    private $conexao;
    private $produto;

    public function __construct() {
        $this->conexao = Conexao::getConexao();
    }

    public function salvar(Produto $produto){

        $this->conexao->exec("INSERT INTO tb_produtos (nome, preco, categoria, quantidadeEstoque) VALUES ('$produto->nome', $produto->preco, '$produto->categoria', $produto->quantidadeEstoque)");


    }

    public function getProduto(int $codigo){
        $consulta = $this->conexao->query("SELECT * FROM tb_produtos WHERE id = $codigo");

        $produto = $consulta->fetch(PDO::FETCH_ASSOC); //SEMELHANTES JSON ENCODE E DECODE

        return  new Produto($produto['nome'], $produto['preco'], $produto['categoria'], $produto['quantidadeEstoque'], $produto['id']);

    }

    public function getProdutos(){
        $consulta = $this->conexao->query("SELECT * FROM tb_produtos");
        $arrayProdutos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        //Fabrica de Produtos
        $listaProdutos = [];
        foreach ($arrayProdutos as $produto){
            $listaProdutos[] = new Produto($produto['nome'], $produto['preco'], $produto['categoria'], $produto['quantidadeEstoque'], $produto['id']);
        }

        return $listaProdutos;

    }

    public function editar(Produto $produto){
        $this->conexao->exec("UPDATE tb_produtos SET nome='$produto->nome', preco=$produto->preco, categoria='$produto->categoria', quantidadeEstoque=$produto->quantidadeEstoque  WHERE id = $produto->id");
    }

    public function excluir (int $id) {

        $this->conexao->exec("DELETE FROM tb_produtos WHERE id=$id");
    }

    public function comprar (int $id, int $qtdDesejada) {

        $p = $this->conexao->query("SELECT quantidadeEstoque FROM tb_produtos WHERE id=$id")->fetch(PDO::FETCH_ASSOC);

        if($qtdDesejada>$p['quantidadeEstoque']) {
            return "comprar sucess";
        }

        $novaQuantidade = $p['quantidadeEstoque'] - $qtdDesejada;

        $this->conexao->exec("UPDATE tb_produtos SET quantidadeEstoque = $novaQuantidade WHERE id = $id");
        return "";
    }
}
