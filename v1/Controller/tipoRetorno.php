
<?php

function tipoSaida($cod)
{
    if ($cod == "0") {
        header('HTTP/1.1 200 00'); // ok
    } else
    if ($cod == "00") {
        header('HTTP/1.1 204 01'); // ok retorna alguma coisa
    } else
    if ($cod == "1") {
        header('HTTP/1.1 400 01'); // não encontrado
    } else
    if ($cod == "2") {
        header('HTTP/1.1 400 02'); // parametros incorretos
    } else
    if ($cod == "3") {
        header('HTTP/1.1 400 03'); // erro ao salvar
    } else
    if ($cod == "4") {
        header('HTTP/1.1 400 04'); // erro ao editar
    } else
    if ($cod == "5") {
        header('HTTP/1.1 400 05'); // erro ao excluir
    } else
    if ($cod == "6") {
        header('HTTP/1.1 400 06'); // email não encontrado
    } else
    if ($cod == "7") {
        header('HTTP/1.1 400 07'); // codigo de redefinição incorreto
    } else
    if ($cod == "8") {
        header('HTTP/1.1 400 08'); // parametros incorretos
    } else
    if ($cod == "9") {
        header('HTTP/1.1 400 09'); // parametros incorretos
    }

    exit(0);
}

?>