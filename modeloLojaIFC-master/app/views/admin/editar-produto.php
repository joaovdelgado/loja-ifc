<!-- ## !!ADICIONE O CABECALHO E O RODAPE PARA A PAGINA -->
<?php
require_once "cabecalho.php";
require_once "../../models/CrudProdutos.php";

$crud = new CrudProdutos();

$produto = $crud->getProduto($_GET['id']);



?>

<h2>Editar Produtos</h2>
<form action="../../controllers/controladorProduto.php?acao=editar" method="post">
    <div class="form-group">
        <label for="produto">Produto:</label>
        <input value="<?=$produto->nome ?>" name="nome" type="text" class="form-control" id="produto" aria-describedby="nome produto" placeholder="">
    </div>

    <div class="form-group">
        <label for="preco">Preco</label>
        <input value="<?=$produto->preco ?>" name="preco" type="number" step="0.01" class="form-control" id="preco" placeholder="">
    </div>

    <div class="form-group">
        <label for="quantidade">Quantidade</label>
        <input value="<?=$produto->quantidadeEstoque ?>" name="estoque" type="number" class="form-control" id="quantidade" placeholder="">
    </div>

    <div class="form-group">
        <label for="Categoria">Categoria</label>
        <select value="<?=$produto->categoria ?>" name="categoria" class="form-control" id="Categoria">
            <option>Fruta</option>
            <option>Legume</option>
            <option>Hortaliça</option>
        </select>
    </div>

    <input type="hidden" name="id" value="<?=$produto->id ?>">

    <button type="submit" class="btn btn-primary">Editar produto</button>

</form>

<?php require_once "rodape.php"; ?>