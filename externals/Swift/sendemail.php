<?php
include("Swift/lib/swift_required.php");

//Create the Transport
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
    ->setUsername('dpal@veristrat.com')
    ->setPassword('veristrat13');

//Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

//Create a message

$msg = '<form  action="http://www.shaadiekhas.com/thankspage" name="shaadi" method="POST">
			<table>
				<tr>
					<td> Name:</td><td> <input type="text" value="" name="txt_name" id="txt_name"/></td>
				</tr>
				<tr>
					<td> Email:</td><td> <input type="text" value="" name="txt_email" id="txt_email"/></td>
				</tr>
				<tr>
					<td> Phone:</td><td> <input type="text" value="" name="txt_phone" id="txt_phone"/><br>
					<input type="submit">
					</td>
				</tr>
				<tr>
				<td>
				This is a normal text<br>
				<p style="text-decoration:blink; color:#414141;"><strong>this is a sample of style text</strong></p> <br>
					<img alt="" src="?ui=2&amp;ik=a86d36d2d6&amp;view=att&amp;th=131d7e8ba52c0cb0&amp;attid=0.1&amp;disp=emb&amp;realattid=498f0132f9da5d18_0.1&amp;zw">
<br>
				
				</td>
				</tr>
			</table>
</form>';

$message = Swift_Message::newInstance('Wonderful Subject')
    ->setFrom(array('dpal@veristrat.com' => 'Devender'))
    ->setBody($msg, 'text/html');

//Send the message
$failedRecipients = array('dpal@veristrat.com' => 'Devender Pal');
$numSent = 0;
$to = array('devender_158top@rediffmail.com' => 'saurabh sinha', 'saurabh@veristrat.com' => 'kumar saurabh');

foreach ($to as $address => $name) {

    $message->setTo(array($address => $name));
    $numSent += $mailer->send($message, $failedRecipients);
}

printf("Sent %d messages\n", $numSent);


?>
