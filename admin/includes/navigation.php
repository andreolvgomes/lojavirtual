<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">        
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php">INÍCIO</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="cadProdutosTable.php">Produtos</a></li>
                        <li><a href="cadMarcas.php">Marcas</a></li>
                        <li><a href="cadUsuariosTable.php">Usuários</a></li>
                        <li><a href="cadCategoriasTable.php">Categorias</a></li>
                    </ul>
                </li>                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Resultados<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="resultado-clientes-mais-compra.php">Clientes que mais compram</a></li>
                        <li><a href="resultado-produtos-mais-vendido.php">Produtos Mais Vendido</a></li>
                        <li><a href="resultado-produtos-menos-vendido.php">Produtos Menos Vendido</a></li>
                        <li><a href="resultado-produtos-em-falta.php">Produto em falta no Estoque</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Vendas<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="resultado-vendas-analise-aprovacao.php">Análise e Aprovação</a></li>
                        <li><a href="cadAntamento-VendaTable.php">Andamento Em Vendas</a></li>
                        <li><a href="resultado-desencalhar-venda.php">Liberar Produtos Venda Encalhada</a></li>                        
                    </ul>
                </li>
                <li class="dropdown">
                    <?php
                    $ola = "Olá";
                    if (login_logado()) {
                        $name = explode(' ', $usuario->getUsu_nomecompleto())[0];
                        $ola .= ", " . $name;
                    }
                    ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $ola; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
                <li><a href="../index.php">Ir Loja</a></li>
            </ul>
        </div>
    </div>
</nav>
