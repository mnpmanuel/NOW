<?php

#
# Exemplo de envio de e-mail SMTP PHPMailer
#
# Inclui os ficheiros class.phpmailer.php localizado na pasta phpmailer
require_once("phpmailer/class.phpmailer.php");
require_once("phpmailer/class.smtp.php");

# Inicia a classe PHPMailer
$mail = new PHPMailer();

# Define os dados do servidor e tipo de conexão
$mail->IsSMTP(); // Define que a mensagem será SMTP
$mail->Host = "localhost"; # Endereço do servidor SMTP, na WebHS basta usar localhost caso a conta de email esteja na mesma máquina de onde esta a correr este código, caso contrário altere para o seu desejado ex: mail.nomedoseudominio.pt
$mail->Port = 587; // Porta TCP para a conexão
$mail->SMTPAutoTLS = false; // Utiliza TLS Automaticamente se disponível
$mail->SMTPAuth = true; # Usar autenticação SMTP - Sim
$mail->Username = 'noreply@no-office-work.com'; # Login de e-mail
$mail->Password = 'Penacova2019'; // # Password do e-mail
# Define o remetente (você)
$mail->From = "noreply@no-office-work.com"; # Seu e-mail
$mail->FromName = "No Office Work"; // Seu nome
# Define os destinatário(s)
$mail->AddAddress('mp@imatch.pt', 'Pessoa Nome 1'); # Os campos podem ser substituidos por variáveis
#$mail->AddAddress('webmaster@nomedoseudominio.pt'); # Caso queira receber uma copia
#$mail->AddCC('pessoa2@dominio.pt', 'Pessoa Nome 2'); # Copia
#$mail->AddBCC('pessoa3@dominio.pt', 'Pessoa Nome 3'); # Cópia Oculta
# Define os dados técnicos da Mensagem
$mail->IsHTML(true); # Define que o e-mail será enviado como HTML
#$mail->CharSet = 'iso-8859-1'; # Charset da mensagem (opcional)

$local = strip_tags(htmlspecialchars($_POST['local']));
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$space = strip_tags(htmlspecialchars($_POST["space"]));
$message = strip_tags(htmlspecialchars($_POST['message']));

# Define a mensagem (Texto e Assunto)
$mail->Subject = "NOW Contact Form:  $name"; # Assunto da mensagem
$mail->Body = "You have received a new message from your website contact form.<br><br>"."Here are the details:<br>Location: $local<br>Name: $name<br>Email: $email_address<br>Phone: $phone<br>Wants: $space<br>Message: $message";
$mail->AltBody = "Este é o corpo da mensagem de teste, somente Texto! \r\n :)";

# Define os anexos (opcional)
#$mail->AddAttachment("c:/temp/documento.pdf", "documento.pdf"); # Insere um anexo
# Envia o e-mail
$enviado = $mail->Send();

# Limpa os destinatários e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();

# Exibe uma mensagem de resultado (opcional)
// if ($enviado) {
// echo "E-mail enviado com sucesso!";
// } else {
// echo "Não foi possível enviar o e-mail.";
// echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
// }
?>
