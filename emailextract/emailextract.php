<?php
set_time_limit(0);
require('../lib/db.php');

 /* connect to gmail with your login account details */
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';

$db = new DBClass();
$sql = "SELECT * from user";
$result = $db->query($sql);
if ($db->numRows($result) > 0) {
    while($row = $db->fetchAssoc($result)) {
        $username = $row['email'];
        $password = $row['email_password'];
    }
} else {
    echo "0 results";
}
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

//$emails = imap_search($inbox,'ALL'); // finds all incoming mail from "person" containing partial text in subject 'something in subject'
$fromDate = "7 Jul 2014";
$endDate = "6 Jul 2014";
$emails = imap_search($inbox, '"'.$fromDate.'" BEFORE "'.$endDate.'"');

if($emails) {

    $count = 1;


    rsort($emails);


    foreach($emails as $email_number)
    {

        $overview = imap_fetch_overview($inbox,$email_number,0);

        $message = imap_fetchbody($inbox,$email_number,2);

        $structure = imap_fetchstructure($inbox, $email_number);

        $attachments = array();

        if(isset($structure->parts) && count($structure->parts))
        {
            for($i = 0; $i < count($structure->parts); $i++)
            {
                $attachments[$i] = array(
                    'is_attachment' => false,
                    'filename' => '',
                    'name' => '',
                    'attachment' => ''
                );

                if($structure->parts[$i]->ifdparameters)
                {
                    foreach($structure->parts[$i]->dparameters as $object)
                    {
                        if(strtolower($object->attribute) == 'filename')
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['filename'] = $object->value;
                        }
                    }
                }

                if($structure->parts[$i]->ifparameters)
                {
                    foreach($structure->parts[$i]->parameters as $object)
                    {
                        if(strtolower($object->attribute) == 'name')
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['name'] = $object->value;
                        }
                    }
                }

                if($attachments[$i]['is_attachment'])
                {
                    $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);

                    if($structure->parts[$i]->encoding == 3)
                    {
                        $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                    }
                    elseif($structure->parts[$i]->encoding == 4)
                    {
                        $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                    }
                }
            }
        }

        foreach($attachments as $attachment)
        {
            if($attachment['is_attachment'] == 1)
            {
                $filename = $attachment['name'];

		        $filepath = '../pdf/'.$attachment['name'];
                if(empty($filepath)) $filepath = '../pdf/'.$attachment['name'];;

                if(empty($filepath)) $filepath = '../pdf/'. time() . ".dat";

                echo($filepath." ");

                if(file_exists('../pdf/' . $filename)) {
                echo(".. file already exists! \n");
                } else {
                echo(".. saving \n");
                $fp = fopen('../pdf/' . $filename, "w+");
                fwrite($fp, $attachment['attachment']);
                fclose($fp);
                }
            }

        }

    }

}

imap_close($inbox);

echo "Done";

?>
