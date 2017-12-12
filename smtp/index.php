<?php
echo "<pre>";
  require_once 'swiftmailer/lib/swift_required.php';
    echo 'Sending mail <br />';

    $host = 'smtp.office365.com';
    $port = 587;
    $email = 'contact@hlalighting.com';
    $pass = 'Factory.1';
    $enc = 'tls';

    $transport = Swift_SmtpTransport::newInstance($host, $port,$enc)
      ->setUsername($email)
      ->setPassword($pass)->setAuthMode('LOGIN');

    echo 'line 40 <br />';
    $mailer = Swift_Mailer::newInstance($transport);
    $message = Swift_Message::newInstance('Wonderful Subject from WFLI')
      ->setFrom(array($email => 'Test'))
      ->setTo(array('developer@consciouswebdesign.com'=> 'A name'))
      ->setBody('Test Message Body')
    ;
    echo 'line 52 <br />';

    $result = $mailer->send($message);
    echo $result;
    echo 'line 58 <br />';
?>
