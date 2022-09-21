<?php

//Kullan�c� ad�n� tan�ml�yoruz
define('USERNAME', 'admin');

//�ifreyi tan�ml�yoruz
define('PASSWORD', 'demo');

// Taray�c�y� belirliyoruz.
define('USER_AGENT', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.2309.372 Safari/537.36');

//Giri� i�in gerekli cookie bilgilerini tutuyoruz.
define('COOKIE_FILE', 'cookie.txt');

//Giri� yap�lacak sayfa
define('LOGIN_FORM_URL', 'https://www.test.com/admin');

//Giri� i�lemlerinin post edilece�i sayfa
define('LOGIN_ACTION_URL', 'https://www.test.com/admin/giris');


//Giri� yap�lan sayfadaki form bilgilerini tan�ml�yoruz
$postValues = array(
    'kullanici' => USERNAME,
    'sifre' => PASSWORD
);

// cURL
$curl = curl_init();

//Giri� sayfas�na post ediyoruz.
curl_setopt($curl, CURLOPT_URL, LOGIN_ACTION_URL);

//POST Methodunu belirledik.
curl_setopt($curl, CURLOPT_POST, true);

//Giri� bilgilerini post k�sm�na �ekiyoruz.
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postValues));

// SSL ayarlar�n� yap�yoruz.
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//Giri� id bilgilerini cookie dosyas�na �ekiyoruz.
curl_setopt($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);

//Bot olmad���m�z� belirtiyoruz.
curl_setopt($curl, CURLOPT_USERAGENT, USER_AGENT);

//Veriyi transfer ediyoruz.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//Giri� yap�lacak sayfay� belirliyoruz.
curl_setopt($curl, CURLOPT_REFERER, LOGIN_FORM_URL);

//Y�nlendirme yapmayaca��m�z� belirtiyoruz.
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);

//Sorguyu �al��t�r�yoruz.
curl_exec($curl);

//Hata varm� diye kontrol ediyoruz.
if(curl_errno($curl)){
    throw new Exception(curl_error($curl));
}

//Giri� yap�ld�ktan sonraki sayfay� belirliyoruz.
curl_setopt($curl, CURLOPT_URL, 'https://www.test.com/admin/anasayfa');

//Cookie sayfas�n� kullan�yoruz.
curl_setopt($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);

//Bot olmad���m�z� belirtiyoruz.
curl_setopt($curl, CURLOPT_USERAGENT, USER_AGENT);

// SSL ayarlar�n� yap�yoruz.
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// Sonucu yazd�r�yoruz.
echo curl_exec($curl);

?>