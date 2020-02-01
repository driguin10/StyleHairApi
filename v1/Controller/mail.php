<?php

class Email
{

    public function sendMail($emaildestinatario, $assunto, $mensagem)
    {
        $emailsender = 'stylehairapp@gmail.com';
        $quebra_linha = "\n";
        $emailremetente = $emailsender;
        $comcopia = "";
        $comcopiaoculta = "";
        $nomeremetente = "styleHair Company";
        $headers = "MIME-Version: 1.1" . $quebra_linha;
        $headers .= "Content-type: text/html; charset=iso-8859-1" . $quebra_linha;
        $headers .= "From: " . $emailsender . $quebra_linha;
        $headers .= "Return-Path: " . $emailsender . $quebra_linha;
        if (strlen($comcopia) > 0) {
            $headers .= "Cc: " . $comcopia . $quebra_linha;
        }

        if (strlen($comcopiaoculta) > 0) {
            $headers .= "Bcc: " . $comcopiaoculta . $quebra_linha;
        }

        $headers .= "Reply-To: " . $emailremetente . $quebra_linha;
        if (mail($emaildestinatario, $assunto, $mensagem, $headers, "-r" . $emailsender)) {
            return true;
        }

    }
}
