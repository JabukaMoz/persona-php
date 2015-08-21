#persona-php
Exemplo de integração do Mozilla Persona em PHP/HTML/JS

- No Index estão as chamadas para o Login e Logout
- No login.php está a validação do usuário e criação da sessão
- No logout.php a sessão é removida

Antes de utilizar é necessário ajustar as configurações no login.php referente ao domínio do site.

Por exemplo:
```
  Login.php
  
  <?php
  session_start();
  // Link para verificar o login
  $url = 'https://verifier.login.persona.org/verify';
  // Link do site onde o login está sendo realizado
  $audience = 'http(s)://seusite.com.br'; <- Aqui você coloca seu site.
  
  /** Resto do código **/
```

Mais informações
[Mozilla Persona]  <-Link em Inglês

[Mozilla Persona]:https://developer.mozilla.org/en-US/Persona/
