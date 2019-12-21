<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';

include_once BASEURL . 'persistence/daoUsuarios.class.php';
require_once BASEURL . 'persistence/connection.class.php';
require_once BASEURL . 'model/usuarios.class.php';

class DaoUsuarios {

    function insert(Usuarios $usuario) {
        $sql = "insert into usuarios(Usu_email,Usu_nomecompleto,Usu_observarcao,"
                . "Usu_senha,Usu_tipo,Usu_permicao,Usu_rua,Usu_numero,Usu_bairro,Usu_cep,Cid_sequencial,Est_sequencial"
                . ",Usu_celular,Usu_telefone) "
                . "values (:Usu_email,:Usu_nomecompleto,:Usu_observarcao,:Usu_senha,:Usu_tipo,:Usu_permicao"
                . ",:Usu_rua,:Usu_numero,:Usu_bairro,:Usu_cep,:Cid_sequencial,:Est_sequencial,:Usu_celular,:Usu_telefone)";

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Usu_email", $usuario->getUsu_email(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_nomecompleto", $usuario->getUsu_nomecompleto(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_observarcao", $usuario->getUsu_observarcao(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_senha", $usuario->getUsu_senha(), PDO::PARAM_INT);
        $stmt->bindValue(":Usu_tipo", $usuario->getUsu_tipo(), PDO::PARAM_INT);
        $stmt->bindValue(":Usu_permicao", $usuario->getUsu_permicao(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_rua", $usuario->getUsu_rua(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_numero", $usuario->getUsu_numero(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_bairro", $usuario->getUsu_bairro(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_cep", $usuario->getUsu_cep(), PDO::PARAM_STR);
        $stmt->bindValue(":Cid_sequencial", $usuario->getCid_sequencial(), PDO::PARAM_INT);
        $stmt->bindValue(":Est_sequencial", $usuario->getEst_sequencial(), PDO::PARAM_INT);
        $stmt->bindValue(":Usu_celular", $usuario->getUsu_celular(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_telefone", $usuario->getUsu_telefone(), PDO::PARAM_STR);

        $stmt->execute();
        $id = Connection::connect()->lastInsertId();
        $usuario->setUsu_codigo($id);
        return $usuario;
    }

    function update(Usuarios $usuarios) {
        $sql = "update usuarios set Usu_email = :Usu_email, Usu_nomecompleto = :Usu_nomecompleto "
                . ",Usu_observarcao = :Usu_observarcao ,Usu_senha = :Usu_senha ,Usu_tipo = :Usu_tipo,"
                . "Usu_permicao = :Usu_permicao,Usu_rua = :Usu_rua, Usu_numero = :Usu_numero,Usu_bairro = :Usu_bairro,"
                . "Usu_cep = :Usu_cep,Cid_sequencial = :Cid_sequencial,Est_sequencial = :Est_sequencial,"
                . "Usu_celular = :Usu_celular,Usu_telefone = :Usu_telefone where Usu_codigo = :Usu_codigo";

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Usu_email", $usuarios->getUsu_email(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_nomecompleto", $usuarios->getUsu_nomecompleto(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_observarcao", $usuarios->getUsu_observarcao(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_senha", $usuarios->getUsu_senha(), PDO::PARAM_INT);
        $stmt->bindValue(":Usu_codigo", $usuarios->getUsu_codigo(), PDO::PARAM_INT);
        $stmt->bindValue(":Usu_tipo", $usuarios->getUsu_tipo(), PDO::PARAM_INT);
        $stmt->bindValue(":Usu_permicao", $usuarios->getUsu_permicao(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_rua", $usuarios->getUsu_rua(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_numero", $usuarios->getUsu_numero(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_bairro", $usuarios->getUsu_bairro(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_cep", $usuarios->getUsu_cep(), PDO::PARAM_STR);
        $stmt->bindValue(":Cid_sequencial", $usuarios->getCid_sequencial(), PDO::PARAM_INT);
        $stmt->bindValue(":Est_sequencial", $usuarios->getEst_sequencial(), PDO::PARAM_INT);
        $stmt->bindValue(":Usu_celular", $usuarios->getUsu_celular(), PDO::PARAM_STR);
        $stmt->bindValue(":Usu_telefone", $usuarios->getUsu_telefone(), PDO::PARAM_STR);

        return $stmt->execute();
    }

    function delete($usu_codigo) {
        $sql = "delete from usuarios where Usu_codigo = :Usu_codigo";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Usu_codigo", $usu_codigo, PDO::PARAM_INT);

        return $stmt->execute();
    }

    function select($usu_codigo = "") {
        $sql = "select * from usuarios";
        if ($usu_codigo > 0) {
            $sql = "select * from usuarios where usu_codigo = '$usu_codigo' ";
        }
        $list_usuarios = [];
        foreach (Connection::connect()->query($sql) as $record) {
            $usuarios = new Usuarios();
            $usuarios->setUsu_codigo($record['Usu_codigo']);
            $usuarios->setUsu_nomecompleto($record['Usu_nomecompleto']);
            $usuarios->setUsu_email($record['Usu_email']);
            $usuarios->setUsu_senha($record['Usu_senha']);
            $usuarios->setUsu_observarcao($record['Usu_observarcao']);
            $usuarios->setUsu_tipo($record['Usu_tipo']);
            $usuarios->setUsu_permicao($record['Usu_permicao']);
            $usuarios->setUsu_rua($record['Usu_rua']);
            $usuarios->setUsu_numero($record['Usu_numero']);
            $usuarios->setUsu_bairro($record['Usu_bairro']);
            $usuarios->setUsu_cep($record['Usu_cep']);
            $usuarios->setCid_sequencial($record['Cid_sequencial']);
            $usuarios->setEst_sequencial($record['Est_sequencial']);
            $usuarios->setUsu_telefone($record['Usu_telefone']);
            $usuarios->setUsu_celular($record['Usu_celular']);

            $list_usuarios[] = $usuarios;
        }
        return $list_usuarios;
    }

    function buscaUser($usu_email, $usu_senha) {
        $sql = "select * from usuarios where Usu_email = '$usu_email' and Usu_senha = '$usu_senha'";

        foreach (Connection::connect()->query($sql) as $record) {
            $usuarios = new Usuarios();
            $usuarios->setUsu_codigo($record['Usu_codigo']);
            $usuarios->setUsu_nomecompleto($record['Usu_nomecompleto']);
            $usuarios->setUsu_email($record['Usu_email']);
            $usuarios->setUsu_senha($record['Usu_senha']);
            $usuarios->setUsu_observarcao($record['Usu_observarcao']);
            $usuarios->setUsu_tipo($record['Usu_tipo']);
            $usuarios->setUsu_permicao($record['Usu_permicao']);
            $usuarios->setUsu_rua($record['Usu_rua']);
            $usuarios->setUsu_numero($record['Usu_numero']);
            $usuarios->setUsu_bairro($record['Usu_bairro']);
            $usuarios->setUsu_cep($record['Usu_cep']);
            $usuarios->setCid_sequencial($record['Cid_sequencial']);
            $usuarios->setEst_sequencial($record['Est_sequencial']);
            $usuarios->setUsu_telefone($record['Usu_telefone']);
            $usuarios->setUsu_celular($record['Usu_celular']);

            return $usuarios;
        }
        return new Usuarios();
    }

    function getCount() {
        $sql = "select count(Usu_codigo) from usuarios";
        $stmt = Connection::connect()->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
        return 0;
    }

    function existsUsu_email(Usuarios $usuario) {
        $sql = "select count(Usu_codigo) from usuarios where Usu_email = :usu_email";
        if ($usuario->getUsu_codigo() > 0) {
            $sql .= " and Usu_codigo != :usu_codigo";
        }

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":usu_email", $usuario->getUsu_email(), PDO::PARAM_STR);
        if ($usuario->getUsu_codigo() > 0) {
            $stmt->bindValue(":usu_codigo", $usuario->getUsu_codigo(), PDO::PARAM_INT);
        }
        if ($stmt->execute()) {
            return $stmt->fetchColumn() > 0;
        }
        return false;
    }

    function usuario_sendo_utilizado($usu_codigo){
        return Connection::exists("select count(Usu_codigo) from usuarios where Usu_codigo = '$usu_codigo'");
    }
}
