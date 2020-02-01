<?php

/*
verifica autenticação da chave
 */

class autenticacao
{
    public $chave = "R20p1g8S7m85ar92t";

    public function autentic($request)
    {
        $headerValueArray = $request->getHeader('HTTP_apiKey');
        if ($headerValueArray[0] == $this->chave) {
            return true;
        } else {
            return false;
        }
    }
}
