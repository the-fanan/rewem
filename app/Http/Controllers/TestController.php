<?php

namespace rewem\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function mailer(Request $request)
    {
   //  phpinfo();
        $mbox = imap_open("{imap.gmail.com:993/imap/ssl}INBOX", "fanan.dala@stu.cu.edu.ng", "CLASSICAL1");

        // get information about the current mailbox (INBOX in this case)
        $mboxCheck = imap_check($mbox);

        // get the total amount of messages
        $totalMessages = $mboxCheck->Nmsgs;

        // select how many messages you want to see
        $showMessages = 5;

        // get those messages    
        $result = array_reverse(imap_fetch_overview($mbox,($totalMessages-$showMessages+1).":".$totalMessages));

        // iterate trough those messages
        foreach ($result as $mail) {

            echo $mail->from;
            echo "</br>";
           // print_r($mail); 

           /* // if you want the mail body as well, do it like that. Note: the '1.1' is the section, if a email is a multi-part message in MIME format, you'll get plain text with 1.1
            $mailBody = imap_fetchbody($mbox, $mail->msgno, '1.1');

            // but if the email is not a multi-part message, you get the plain text in '1'
            if(trim($mailBody)=="") {
                $mailBody = imap_fetchbody($mbox, $mail->msgno, '1');
            }

            // just an example output to view it - this fit for me very nice
            echo nl2br(htmlentities(quoted_printable_decode($mailBody)));*/
        }

        imap_close($mbox);
    }
}
