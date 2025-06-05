<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require __DIR__ . '/lib/vendor/autoload.php';
require  __DIR__ .'/conexao/conexao.php';

$pdo = Conexao::getInstance();

date_default_timezone_set('America/Sao_Paulo');//Pegando o fuso

// Pegando a data de amanhã
$amanha = date('Y-m-d', strtotime('+1 day'));
$sql = "
    SELECT 
    p.nomepac AS nome, 
    p.email, 
    a.start,
    m.nome AS nome_medico
FROM agendamento a
JOIN cadastro_paciente p ON a.ficha = p.ficha
JOIN medicos m ON a.id_medico = m.id_medico
WHERE DATE(a.start) = :amanha

";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':amanha', $amanha);
$stmt->execute();

$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Agendamentos encontrados: " . count($agendamentos) . "<br>";
echo "Data de amanhã: $amanha";


    foreach ($agendamentos as $index => $ag) {
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0; // ou SMTP::DEBUG_SERVER para modo desenvolvimento
    $mail->isSMTP(); 
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'cirurgiacampo@gmail.com';
    $mail->Password   = 'ctcp exym akhi bzbx';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    //Recipients
     //Remetente e destinatário
        $mail->setFrom('cirurgiacampo@gmail.com', 'Campo cirurgia');
        $mail->addAddress($ag['email'], $ag['nome']);

 // Conteúdo do e-mail
        $mail->isHTML(true);
        $dataFormatada = date('d/m/Y \à\s H:i', strtotime($ag['start']));
        $mail->Subject = 'Lembrete: Cirurgia agendada';
        $mail->Body    = " 
            Olá <strong>{$ag['nome']}</strong>,<br><br>
            Estamos entrando em contato para lembrar que você tem uma cirurgia agendada para 
            <strong>{$dataFormatada}</strong>.<br><br>
            O procedimento será realizado pelo(a) <strong>{$ag['nome_medico']}</strong>.<br><br>
            Pedimos que chegue com antecedência de pelo menos <strong>30 minutos</strong> e traga 
            todos os seus documentos e exames necessários.<br><br>
            Caso tenha qualquer dúvida, entre em contato conosco pelo e-mail 
            <a href='mailto:cirurgiacampo@gmail.com'>cirurgiacampo@gmail.com</a>.<br><br>
            Agradecemos pela confiança.<br><br>
            Atenciosamente,<br>
            <strong>Equipe Grupo União.</strong>";
        
    $mail->send();
    echo "E-mail enviado com sucesso para {$ag['email']}<br>";

} catch (Exception $e) {
    echo "Erro ao enviar para {$ag['email']}: {$mail->ErrorInfo}<br>";

}
}