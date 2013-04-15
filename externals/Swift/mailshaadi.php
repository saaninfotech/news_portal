<?php
include("Swift/lib/swift_required.php");

//Create the Transport
$transport = Swift_SmtpTransport::newInstance('server.veristrat.com', 465, 'ssl')
    ->setUsername('prerna@shaadiekhas.com')
    ->setPassword('veristrat182');

//Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);
$link = mysql_connect("localhost", "root", "d@t@b@s3");
mysql_select_db("db_mailer", $link);
//get the email address from database
$sql = "select * from smailer_details where is_send='0'";
$exec = mysql_query($sql);
$numSent = 0;
while ($emailArray = mysql_fetch_array($exec)) {
    $ori_email = $emailArray['email'];
    $ori_name = $emailArray['name'];
    $nameArray = explode(" ", $ori_name);
//Create a message
    $msg = '
<div style="width: 656px; margin: 0pt auto; background-color: #ffffff; border: 1px solid #c2c2c2; font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: #333333; line-height: 20px;">
<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
	
		<tr>
			<td style="padding-left:20px;" height="85"><a title="Wedding Management Softwate" href="http://www.shaadiekhas.com/"  target="_blank"><img src="http://www.shaadiekhas.com/campaigns/emailerimages/emailer-logo.gif" border="0" alt="Shaaadiekhas | Wedding Management Softwate" /></a></td>
			<td style="padding-right:20px; vertical-align:middle; line-height:20px" align="right">Email: <a href="mailto:prerna@shaadiekhas.com">prerna@shaadiekhas.com</a><br /> Contact: +91.11.4940.4918</td>
		</tr>
		<tr>
			<td style="height: 67px;" colspan="2" height="67" align="left" valign="middle" bgcolor="#5a8d16">
			<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
				
					<tr>
						<td style="padding-left:20px; color:#fff; font-size:36px; letter-spacing:0px; font-weight:bold;" width="72%" align="center" colspan="2">Latest News!!!<!--<a title="Sign up for 30 Days free trail" href="http://www.shaadiekhas.com/registration/" target="_blank"><img src="http://www.shaadiekhas.com/campaigns/emailerimages/emailer-30dayrialbtn.png" alt="Sign up for 30 Days free trail" border="0"/></a>--></td>
					</tr>
				
			</table>
			</td>
		</tr>
		<tr>
			<td colspan="2"><p style="padding:5px 0 0 19px;">Hi ' . ucwords($nameArray[0]) . ',</p><p style="padding:0 0 10px 19px;">I am glad to share with you the latest press coverage of Shaadi-e-Khas in \'The Sunday Guardian\'. This is just one of the coverages our product has recently received.  For more media updates, visit our <a href="http://www.shaadiekhas.com/press" target="_blank">Press Page.</a> <br>Thank you for your patronage and we will keep you posted of any future developments.<br><br>Cheers!</p></td>
		</tr>
		<tr>
			<td style="padding-left:20px; font-size:18px; font-weight:bold; letter-spacing:-1px; color:#2e2e2e;padding-bottom:5px;" colspan="2">Media Coverage</td>
		</tr>
		<tr>
			<td style="padding-left:20px; font-size:16px; font-weight:normal;" colspan="2">Wedding planning gets digital dose.</td>
		</tr>
		<tr>
			<td style="padding-left:20px; font-size:11px; color:#888; line-height:30px; font-weight:normal;" colspan="2">Aug 14, 2011 | Media: The Sunday Guardian</td>
		</tr>
		<tr>
			<td style="padding-left:20px; font-size:11px; color:#888; font-weight:normal;" colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="padding-left:20px;" colspan="2" align="left" valign="top">
				<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
					
						<tr>
							<td width="23%" align="left" valign="top"><img src="http://www.shaadiekhas.com/campaigns/emailerimages/sunday.jpg" alt="Jetwings" /></td>
							<td style="color:#626161;" width="77%">The big fat Indian wedding can be a logistical nightmare even for the most seasoned event organisers. Little wonder then, that the crazy world of weddings has spawned a sub-industry of wedding planners and organisers who take over the process, allowing you to sit back and enjoy the experience. Now Veristrat has gone a step further and developed an online tool that gives people the option to manage the entire show — complete with band, baaja and baarat — with the mere click of a button. Shaadi-e-Khas, an online event and wedding management software, aims to simplify the tedious task of planning a wedding.</td>
						</tr>
						<tr>
							<td colspan="2" height="10" align="left" valign="top">&nbsp;</td>
						</tr>
						<tr>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top">
								<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
									
										<tr>
											<td width="77%" align="left"><a href="http://www.shaadiekhas.com/press" target="_blank">Read More</a></td>
											<td width="23%">&nbsp;</td>
										</tr>
									
								</table>
							</td>
						</tr>
					
				</table>
			</td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid #c2c2c2;" colspan="2"></td>
		</tr>
		<tr>
			<td colspan="2" height="12">&nbsp;</td>
		</tr>
		<tr>
			<td style="padding-left:20px; font-size:18px; font-weight:bold; letter-spacing:-1px; color:#2e2e2e;padding-bottom:5px;" colspan="2">Our Packages</td>
		</tr>
		<tr>
			<td style="padding-left:20px; padding-top:10px; padding-right:20px;" colspan="2" align="left" valign="top">
				<table style="width: 100%; border: 1px solid #c2c2c2;" border="0" cellspacing="0" cellpadding="0">
					
						<tr>
							<td style="padding-left:20px; border-bottom:1px solid #c2c2c2; font-size:14px; font-weight:bold; border-right:1px solid #c2c2c2;" height="36">Validity Period</td>
							<td style="border-bottom:1px solid #c2c2c2; border-right:1px solid #c2c2c2; font-weight:normal; color:#222;" align="center">30 Days</td>
							<td style="border-bottom:1px solid #c2c2c2; border-right:1px solid #c2c2c2;font-weight:normal; color:#222;" align="center">1 year</td>
							<td style="border-bottom:1px solid #c2c2c2; border-right:none;font-weight:normal; color:#222;" align="center">2 years</td>
						</tr>
						<tr>
							<td style="padding-left:20px;  border-bottom:1px solid #c2c2c2; font-size:14px; font-weight:bold; border-right:1px solid #c2c2c2;" height="36">No. of events</td>
							<td style="border-bottom:1px solid #c2c2c2; border-right:1px solid #c2c2c2; font-weight:normal; color:#222;" align="center">1 Event</td>
							<td style="border-bottom:1px solid #c2c2c2; border-right:1px solid #c2c2c2; font-weight:normal; color:#222;" align="center">4 Events</td>
							<td style="border-bottom:1px solid #c2c2c2; border-right:none;font-weight:normal; color:#222;" align="center">10 Events</td>
						</tr>
						<tr>
							<td style="padding-left:20px;  border-bottom:1px solid #c2c2c2; font-size:14px; font-weight:bold; border-right:1px solid #c2c2c2;" height="36">Price</td>
							<td style="border-bottom:1px solid #c2c2c2; font-weight:normal; color:#222; border-right:1px solid #c2c2c2; " align="center">INR 5000</td>
							<td style="border-bottom:1px solid #c2c2c2; font-weight:normal; color:#222; border-right:1px solid #c2c2c2;" align="center">INR 15000</td>
							<td style="border-bottom:1px solid #c2c2c2; font-weight:normal; color:#222; border-right:none" align="center">INR 30000</td>
						</tr>
						<tr>
							<td style="padding-left:20px; border-right:1px solid #c2c2c2;" height="42" colspan="4" align="center">
							<a title="enquire" href="http://www.shaadiekhas.com/weddingplanners" target="_blank"><img src="http://www.shaadiekhas.com/campaigns/emailerimages/contact-now.jpg" border="0" alt="contact now" width="143" height="32" /></a></td>
							<!--<td style=" border-right:1px solid #c2c2c2;" align="center"><a title="enquire" href="http://www.shaadiekhas.com/weddingplanners" target="_blank"><img src="http://www.shaadiekhas.com/campaigns/emailerimages/enquire.jpg" border="0" alt="enquire" width="71" height="24" /></a></td>
							<td style="border-right:1px solid #c2c2c2;" align="center"><a title="enquire" href="http://www.shaadiekhas.com/weddingplanners" target="_blank"><img src="http://www.shaadiekhas.com/campaigns/emailerimages/enquire.jpg" border="0" alt="enquire" width="71" height="24" /></a></td>
							<td style="border-right:none" align="center"><a title="enquire" href="http://www.shaadiekhas.com/weddingplanners" target="_blank"><img src="http://www.shaadiekhas.com/campaigns/emailerimages/enquire.jpg" border="0" alt="enquire" width="71" height="24" /></a></td>-->
						</tr>
					
				</table>
			</td>
		</tr>
		<tr>
			<td style="border-bottom:1px solid #c2c2c2;" colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="padding-left:20px; font-size:18px; font-weight:bold; letter-spacing:-1px; color:#2e2e2e;padding-bottom:5px; padding-top:8px;" colspan="2">Enquiry section for wedding and event planners</td>
		</tr>
</table>
		<form action="http://www.shaadiekhas.com/thankspage" method="post" name="site" id="site">
			<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td style="padding-left:15px;"><input type="hidden" name="ori_email" id="ori_email" value="' . $ori_email . '"></td>
			<td style="padding-left:15px;">&nbsp;</td>
			</tr>
			<tr>
			<td style="padding-left:15px;" width="50%">Name:</td>
			<td style="padding-left:15px;" width="50%">Phone No:</td>
			</tr>
			<tr>
			<td style="padding-left:15px;"><input id="name" style="width: 262px; padding: 2px 8px;border: 1px solid #d1d1d1;" name="name" type="text" /></td>
			<td style="padding-left:15px;"><input id="phone" style="width: 232px; padding: 2px 8px; border: 1px solid #d1d1d1;" name="phone" type="text" /></td>
			</tr>
			<tr>
			<td style="padding-left:15px;">Email ID:</td>
			<td style="padding-left:15px;">Company Name:</td>
			</tr>
			<tr>
			<td style="padding-left:15px;"><input id="email" style="width: 262px; padding: 2px 8px; border: 1px solid #d1d1d1;" name="email" type="text" /></td>
			<td style="padding-left:15px;"><input id="company" style="width: 232px; padding: 2px 8px; border: 1px solid #d1d1d1;" name="company" type="text" /></td>
			</tr>
			<tr>
			<td style="padding-left:15px;">How many weddings/events do you do in a year?</td>
			<td style="padding-left:15px;">Are you using any kind of software already?</td>
			</tr>
			<tr>
			<td style="padding-left:15px;"><input id="noofevents" style="width: 262px; padding: 2px 8px; border: 1px solid #d1d1d1;" name="noofevents" type="text" /></td>
			<td style="padding-left:15px;"><input id="software" style="width: 232px; padding: 2px 8px; border: 1px solid #d1d1d1;" name="software" type="text" /></td>
			</tr>

			<tr>
			<td style="padding-left: 15px; height: 10px;" colspan="2">&nbsp;</td>
			</tr>
			<tr>
			<td style="padding-left:15px;" colspan="2" align="center">
			<input type="image" src="http://www.shaadiekhas.com/campaigns/emailerimages/emailer-submit.png" height="32" width="143" border="0" alt="Submit Form">
			</td>

			</tr>
			<tr>
			<td style="padding-left:15px;">&nbsp;</td>
			<td style="padding-left:15px;">&nbsp;</td>
			</tr>
			
		</table>
		</form>
		<p style="padding-left:15px;font-size:18px; font-weight:bold;"><strong>Testimonials</strong></p>           
		<table style="width: 100%; border: 1px solid #eedfaf;" border="0" cellspacing="0" cellpadding="0" bgcolor="#fbf8e7">
		
		<tr>
		<td style="padding:15px 15px 0px 15px;">I took this application for my sister&rsquo;s wedding and it made things so easy for me. I saved my time and sent personal invites which were an instant hit with all! It was very convenient for me to keep a track of all my arrangements and vendors and my website was also appreciated by everyone. I used the mobile version and to my surprise, it did not turn me down even once! Thank you Shaadi-e-Khas for making my sister&rsquo;s wedding a perfect one!!!</td>
		</tr>
		<tr>
		<td style="padding-right:15px;" align="right"><strong>- Tanu weds Manoj</strong></td>
		</tr>
		<tr>
		<td style="padding:15px 15px 0px 15px;">Using Shaadi-e-Khas took out stress out of all my wedding events and made me manage things in a much organized and better way. My decision to use the application was very correct and I benefitted a lot. Thank you Shaadi-e-Khas&hellip;</td>
		</tr>
		<tr>
		<td style="padding-right:15px;" align="right"><strong>- Swati weds Rajesh</strong></td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		</tr>
		</table>
&nbsp;   Shaadi-e-Khas<br />&nbsp;&nbsp;Veristrat Inc.<br /> &nbsp;&nbsp;DLF Tower A, Suite 518, Jasola, New Delhi-110044<br /> &nbsp;&nbsp;Email: <a href="mailto:prerna@shaadiekhas.com">prerna@shaadiekhas.com</a><br /> &nbsp;&nbsp;Phone No.: +91.11.4940.4918<br /> &nbsp;&nbsp;Follow us on&nbsp;<span><a href="http://www.facebook.com/shaadiekhas" target="_blank"><img src="http://www.shaadiekhas.com/campaigns/emailerimages/emailer-fbicon.png" alt="facebook" border="0"/></a></span> <span><a href="https://twitter.com/#!/ShaadieKhas" target="_blank"><img src="http://www.shaadiekhas.com/campaigns/emailerimages/emaier-twittericon.png" border="0" alt="twitter" /></a></span></div>';

//the message ends here

    $message = Swift_Message::newInstance('Wedding Planning goes Digital!')
        ->setFrom(array('prerna@shaadiekhas.com' => 'Prerna Bajpai'))
        ->setBody($msg, 'text/html');

//Send the message
    $failedRecipients = array();

    $to = array($ori_email => $ori_name);

    foreach ($to as $address => $name) {

        $message->setTo(array($address => $name));
        $numSent += $mailer->send($message, $failedRecipients);
        echo "email send to $ori_email";
    }
//echo $msg;
    $updateSql = "update smailer_details set is_send='1' where email='$ori_email' and name='$ori_name'";
    mysql_query($updateSql);

}

printf("Sent %d messages\n", $numSent);
echo "<br>";
printf($failedRecipients);
?>
