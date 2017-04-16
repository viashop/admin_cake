Fábrica de Envio de Emails

**Exemplo de Envio**

    $sendMail = new EmailEsqueceuSenha();
    
    if ($sendMail instanceof EmailEsqueceuSenha) {
    
        $sendOk = $sendMail->setNome($this->dados_cliente['Cliente']['nome'])
                ->setEmail($this->email)
                ->setHash($this->hash)
                ->setFromName('ViaLoja Shopping')
                ->setAddress($this->email)
                ->setSubject('Redefinição de senha')
                ->setMessage($sendMail->draw()) //Envia o conteúdo no modo de interface
                ->sendMail();
    
        if (!v::type('bool')->validate($sendOk)) {
            throw new \RuntimeException("Não foi possivel efetuar a operação tente novamente.", E_USER_WARNING);
        }
    }

Obs.: Várias classes são utilizadas

**Fluente Interface via DI**

    $sendMail->setMessage($sendMail->draw())