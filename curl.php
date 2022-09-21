<?php

//Kullanýcý adýný tanýmlýyoruz
define('USERNAME', 'admin');

//Þifreyi tanýmlýyoruz
define('PASSWORD', 'demo');

// Tarayýcýyý belirliyoruz.
define('USER_AGENT', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.2309.372 Safari/537.36');

//Giriþ için gerekli cookie bilgilerini tutuyoruz.
define('COOKIE_FILE', 'cookie.txt');

//Giriþ yapýlacak sayfa
define('LOGIN_FORM_URL', 'https://www.test.com/admin');

//Giriþ iþlemlerinin post edileceði sayfa
define('LOGIN_ACTION_URL', 'https://www.test.com/admin/giris');


//Giriþ yapýlan sayfadaki form bilgilerini tanýmlýyoruz
$postValues = array(
    'kullanici' => USERNAME,
    'sifre' => PASSWORD
);

// cURL
$curl = curl_init();

//Giriþ sayfasýna post ediyoruz.
curl_setopt($curl, CURLOPT_URL, LOGIN_ACTION_URL);

//POST Methodunu belirledik.
curl_setopt($curl, CURLOPT_POST, true);

//Giriþ bilgilerini post kýsmýna çekiyoruz.
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postValues));

// SSL ayarlarýný yapýyoruz.
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//Giriþ id bilgilerini cookie dosyasýna çekiyoruz.
curl_setopt($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);

//Bot olmadýðýmýzý belirtiyoruz.
curl_setopt($curl, CURLOPT_USERAGENT, USER_AGENT);

//Veriyi transfer ediyoruz.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//Giriþ yapýlacak sayfayý belirliyoruz.
curl_setopt($curl, CURLOPT_REFERER, LOGIN_FORM_URL);

//Yönlendirme yapmayacaðýmýzý belirtiyoruz.
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);

//Sorguyu çalýþtýrýyoruz.
curl_exec($curl);

//Hata varmý diye kontrol ediyoruz.
if(curl_errno($curl)){
    throw new Exception(curl_error($curl));
}

//Giriþ yapýldýktan sonraki sayfayý belirliyoruz.
curl_setopt($curl, CURLOPT_URL, 'https://www.test.com/admin/anasayfa');

//Cookie sayfasýný kullanýyoruz.
curl_setopt($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);

//Bot olmadýðýmýzý belirtiyoruz.
curl_setopt($curl, CURLOPT_USERAGENT, USER_AGENT);

// SSL ayarlarýný yapýyoruz.
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// Sonucu yazdýrýyoruz.
echo curl_exec($curl);

?>