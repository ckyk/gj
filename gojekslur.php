<?php

error_reporting(0);
include ("ck.php");
echo "\e             CK              \n";
echo "\n";
nope:
echo "\e[?] Masukkan Nomor HP Anda : ";
$nope = trim(fgets(STDIN));
$cek = cekno($nope);
if ($cek == false)
    {
    echo "\e[x] Nomor Telah Terdaftar\n";
			goto nope;
    }
  else
    {
echo "\e[!] Siapkan OTPmu\n";
sleep(5);
$register = register($nope);
if ($register == false)
    {
    echo "\e[x] Failed Get OTP!\n";
    }
  else
    {
    otp:
    echo "\e[!] Masukkan Kode Verifikasi (OTP) : ";
    $otp = trim(fgets(STDIN));
    $verif = verif($otp, $register);
    if ($verif == false)
        {
        echo "\e[x] Kode Verifikasi Salah\n";
        goto otp;
        }
      else
        {
		$h=fopen("toket.txt","a");
		fwrite($h,json_encode(array('token' => $verif, 'voc' => 'gofood gak ada'))."\n");
		fclose($h); 
                echo "\e[!] Trying to redeem Voc\n";
                sleep(3);
            $claim = reff($verif);
            if ($claim == false){
            echo "\e[!] Failed to Claim Voucher, Try to Claim Manually\n";
            }else{
                echo "\e[+] ".$claim."\n";
            }
    }
    }
    }


?>