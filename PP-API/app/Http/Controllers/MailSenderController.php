<?php

namespace App\Http\Controllers;

class MailSenderController extends Controller
{
    public $from = 'stevetenadjang@gmail.com';
    public $fromName = 'Steve Tenadjang';
    public $subject = 'STEVE TENADJANG CV';

    public function SendMailPDF($email): bool
    {
        $to = $email;
        $file = 'storage/files/SteveTenadjangCV-pdf.pdf';

        $htmlContent = '
        <h3>Hope to here from you soon👍.</h3>
        <p>A copy STEVE TENADJANG CV</p>
        ';
        $headers = "From: $this->fromName" . " <" . $this->from . ">";
        // Boundary
        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

        // Headers for attachment
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

        // Multipart boundary
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";

        // Preparing attachment
        if (((!empty($file)) > 0) && is_file($file)) {
            $message .= "--{$mime_boundary}\n";
            $fp = @fopen($file, "rb");
            $data = @fread($fp, filesize($file));

            @fclose($fp);
            $data = chunk_split(base64_encode($data));
            $message .= "Content-Type: application/octet-stream; name=\"" . basename($file) . "\"\n" .
                "Content-Description: " . basename($file) . "\n" .
                "Content-Disposition: attachment;\n" . " filename=\"" . basename($file) . "\"; size=" . filesize($file) . ";\n" .
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
        }
        $message .= "--{$mime_boundary}--";
        $returnPath = "-f" . $this->from;

        // Send email
        if (!mail($to, $this->subject, $message, $headers, $returnPath)) {
            return false;
        }
        return true;
        // Email sending status
        //    echo $mail?"<h1>Email Sent Successfully!</h1>":"<h1>Email sending failed.</h1>";
    }

    public function SendMailIMG($email): bool
    {
        $to = $email;
        $file = 'storage/files/SteveTenadjangCV-img.jpeg';


        $htmlContent = '
        <h3>Hope to here from you soon👍.</h3>
        <p>A copy STEVE TENADJANG CV</p>
        ';
        $headers = "From: $this->fromName" . " <" . $this->from . ">";
        // Boundary
        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

        // Headers for attachment
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

        // Multipart boundary
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";

        // Preparing attachment
        if (((!empty($file)) > 0) && is_file($file)) {
            $message .= "--{$mime_boundary}\n";
            $fp = @fopen($file, "rb");
            $data = @fread($fp, filesize($file));

            @fclose($fp);
            $data = chunk_split(base64_encode($data));
            $message .= "Content-Type: application/octet-stream; name=\"" . basename($file) . "\"\n" .
                "Content-Description: " . basename($file) . "\n" .
                "Content-Disposition: attachment;\n" . " filename=\"" . basename($file) . "\"; size=" . filesize($file) . ";\n" .
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
        }
        $message .= "--{$mime_boundary}--";
        $returnPath = "-f" . $this->from;

        // Send email
        if (!mail($to, $this->subject, $message, $headers, $returnPath)) {
            return false;
        }
        return true;
        // Email sending status
        //    echo $mail?"<h1>Email Sent Successfully!</h1>":"<h1>Email sending failed.</h1>";
    }
}
