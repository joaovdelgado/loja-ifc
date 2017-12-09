<?php


// O Controlador é a peça de código que sabe qual classe chamar, para onde redirecionar e etc.
// Use o método $_GET para obter informações vindas de outras páginas.

require_once "../models/Produto.php";
require_once "../models/CrudProdutos.php";

//quando um valor da URL for igual a cadastrar faça isso
if ( $_GET['acao'] == 'cadastrar') {
    $produto = new Produto($_POST['nome'], $_POST['preco'], $_POST['categoria'], $_POST['quantidade']);
    $crud = new CrudProdutos();
   $crud->salvar($produto);
   header( 'location: ../views/admin/produtos.php');
}

//quando um valor da URL for igual a editar faça isso
if ( $_GET['acao'] == 'editar'){

    $crud = new CrudProdutos();
    $produto = new Produto($_POST['nome'], $_POST['preco'], $_POST['categoria'], $_POST['estoque'], $_POST['id']);

    $crud->editar($produto);

    header( 'location: ../views/admin/produtos.php?msg=atualizado com sucesso ');

}

//quando um valor da URL for igual a excluir faça isso
if ( $_GET['acao'] == 'excluir'){
    $crud = new CrudProdutos();
    $crud->excluir($_GET['id']);

    header('location: ../views/admin/produtos.php');
}

if($_GET['acao'] == 'comprar') {

    $crud = new CrudProdutos();

    $msg = $crud->comprar($_POST['id'], $_POST['quantidadeEstoque']);

    header("location: ../views/produto.php?id=$_POST[id]&msg=$msg");
}