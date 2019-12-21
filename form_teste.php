<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

        <title>Cadastro Produtos</title>
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" />    
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>
    <body>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                    <h2>Cadastro de Produtos</h2>
                </div>
            </div>
            <div class="row ">               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>   Insira os dados </strong>  
                        </div>
                        <div class="panel-body">
                            <form role="form">
                                <input type="checkbox" class="form-group">	Manter em destaque</input>
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <input type="text" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Preço</label>
                                            <input type="number" class="form-control"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Lista Preço</label>
                                            <input type="number" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Marca</label>
                                    <select class="form-control">
                                        <option>C&A</option>
                                        <option>Puma</option>
                                        <option>Pena</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Categoria</label>
                                            <select class="form-control">
                                                <option>Homens</option>
                                                <option>Mulheres</option>
                                                <option>Crianças</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Sub/Categoria</label>
                                            <select class="form-control">
                                                <option>Roupas</option>
                                                <option>Acessórios</option>
                                                <option>Esporte</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <input type="file" class="form-group"></input>

                                <div class="form-group">
                                    <label>Detalhes</label>
                                    <textarea class="form-control"/></textarea>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="#" class="btn btn-success btn-block btn-danger">Cancela</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="btn btn-success btn-block">Salvar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>                                
            </div>
        </div>

        <script src="assets/plugins/jquery-1.10.2.js"></script>
        <script src="assets/plugins/bootstrap.js"></script>
    </body>
</html>
