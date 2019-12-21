<?php
include 'includes/head.php';
include 'includes/navigation.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1>Cliente</h1>
            </legend>
        </div>
    </div>
    <form>
        <div class="row">
            <div class="form-group col-md-4">
                <label>Nome</label>
                <input type="text" class="form-control" name="txtMar_descricao"/>
            </div>
            <div class="form-group col-md-4">
                <label>CPF</label>
                <input type="text" class="form-control" name="txtMar_descricao"/>
            </div>
            <div class="form-group col-md-4">
                <label>Telefone</label>
                <input type="text" class="form-control" name="txtMar_descricao"/>
            </div>
            <div class="form-group col-md-4">
                <label>Endereço</label>
                <input type="text" class="form-control" name="txtMar_descricao"/>
            </div>
            <div class="form-group col-md-4">
                <label>Numero</label>
                <input type="text" class="form-control" name="txtMar_descricao"/>
            </div>
            <div class="form-group col-md-4">
                <label>Cidade</label>
                <input type="text" class="form-control" name="txtMar_descricao"/>
            </div>
            <div class="form-group col-md-4">
                <label>Bairo</label>
                <input type="text" class="form-control" name="txtMar_descricao"/>
            </div>
            <div class="form-group col-md-4">
                <label>CEP</label>
                <input type="text" class="form-control" name="txtMar_descricao"/>
            </div>
               <div class="form-group col-md-4">
                <label>Estado</label>
                <input type="text" class="form-control" name="txtMar_descricao"/>
            </div>
            
            <div class="col-md-4">
                <br><br>
                <br>
                <input type="submit" class="btn btn-success btn-block" value="Cadastrar">
                <input type="submit" class="btn btn-danger btn-block" value="Cancelar">
            </div>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>