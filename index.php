<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>Modelo - Login Persona</title>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://login.persona.org/include.js"></script>
<script>
$(document).ready(function(e) {
	// Clique no botão login
	$("#login-btn").click(function(e) {
		e.preventDefault();
		navigator.id.request();
	});
	
	// Clique no botão logoff
    $("#logout-btn").click(function(e) {
        e.preventDefault();
        navigator.id.logout();
    });	
});	

	// Verifica os dados de login
    function verifyAssertion(assertion) {
        $.post("login.php", { "assertion": assertion }, function onSuccess(resp) {	
             window.location = "index.php";
        });
    };
	
	// Aguarda o evento de login/logout ocorrer para iniciar a ação
    navigator.id.watch({
        onlogin: function(assertion) {
             verifyAssertion(assertion);
        },
        onlogout: function() {
       		//window.location = "logout.php";	
        },
        loggedInUser: undefined
    });	
</script>
</head>

<body>
<?php 
	// Verifica se a sessão está vazia para exibir o botão login, caso não esteja exibe os dados
	if($_SESSION["email"] == ""){ 
?>
<img id="login-btn" src="img/persona-only-signin-link.png" width="323" height="132" style="cursor:pointer;"  alt="SignIn"/>
<?php } else { ?>
<br><br>
<strong>Usuário está logado!</strong><br>
Dados de usuário:<br>
E-mail: <?php echo $_SESSION["email"]; ?>
<br>
<!-- Botão para Logout -->
<a id="logout-btn" href="#">Sair</a>
<?php } ?>
</body>
</html>