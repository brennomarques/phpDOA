<?php

    require_once("config.php");
/*********************BUSCAS****************/
    //Busca Por ID usuario
    // $root = new Usuario();
    // $root->loadById(1);
    // echo $root;

    //Busca todos Usuarios
    // $lista = Usuario::eListAll();
    // echo json_encode($lista);

    //Busca determinado usuario
    // $search = Usuario::eSearch("root");
    // echo json_encode($search)

    //Carregar um usuario usando login e a senha
    // $usuario = new Usuario();
    // $usuario->login("root", "1235");
    // echo $usuario;
/*********************INSERT****************/
    // $aluno = new Usuario();
    // $aluno->setDeslogin("joão");
    // $aluno->setDessenha("@joaor");
    // $aluno->eInsert();
    // echo $aluno;

/*********************UPDATE****************/
// $usuario = new Usuario();
// $usuario->loadById(11);
// $usuario->eUpdate("vini", "1250");
// echo $usuario;

/*********************DELETE****************/
    $usuario = new Usuario();
    $usuario->loadById(8);
    $usuario->eDelete();
    echo $usuario;

?>