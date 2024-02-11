<?php
    namespace core\classes;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class EnviarEmail{
        public function enviar_email_confirmacao_novoCliente($email_cliente, $purl){
            // Enviar email de confirmacao do novo cliente

            // Constroi o purl (link de confirmacao)
            $link = BASE_URL . '?a=confirmar_email&purl=' . $purl;

            
            $mail = new PHPMailer(true);

            try {
                //Server settings
                //Configuracoes do servidor
                $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = EMAIL_HOST;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = EMAIL_FROM;                   //SMTP username
                $mail->Password   = EMAIL_PASS;                  //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = EMAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                $mail->CharSet    = 'UTF-8';

                //Recipients
                $mail->setFrom(EMAIL_FROM, APP_NAME);
                $mail->addAddress($email_cliente);     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                //Emissor e receptor
                $mail->isHTML(true);                                  //Set email format to HTML

                //Assunto
                $mail->Subject = APP_NAME . ' - Confirmação de email';

                //Prepara a corpo da mensagem em HTML a ser enviada ao cliente
                $html = '<p>Seja bem vindo à nossa loja ' . APP_NAME . '.</p>';
                $html .= '<p>Para poder entrar na sua conta, precisa confirmar o email</p>';
                $html .= '<p>Para confirmar o email, clique no link abaixo </p>';
                $html .= '<p><a href="'.$link.'">Confirmar email</p>';
                $html .= '<p><i><small>'. APP_NAME .'</small></i></p>';

                $mail->Body = $html;
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                //echo 'Message has been sent';
                return true;
            } catch (Exception $e) {
                //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                return false; 
            }
        }
        
    }
?>