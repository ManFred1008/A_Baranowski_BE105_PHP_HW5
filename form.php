<?php

// print_r($_GET);

$name = $_GET['name'];
$phone = $_GET['phone'];
$email = $_GET['email'];
$message = $_GET['message'];

function check_phone_num($phone) {

   $phone = str_replace([' ', '-', '_'], '', $phone);
   $oper = substr($phone, 4, 2);
   // var_dump($oper == 29);
   // echo $phone . "<br/>";
   if ($phone[0] != '+') return false;
   else $phone = ltrim($phone, '\+');

   if (strlen($phone) == 12) {
   } else return false;

   if (!is_numeric($phone)) {
      return false;  
   }

   if (strpos($phone, '375') != 0   ) return (false . "Нет кода страны"); 

   if($oper == 29 || $oper == 25 || $oper == 33 || $oper == 44 || $oper == 17) return true;   
   else return false;   
}

function check_email($email) {

   if (str_replace(' ', '', $email) !== $email) {
      echo "Ошибка: адрес не должен содержать пробелы";
      return false;
   }

   $alfa_ru = ['А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е', 'Ё', 'ё', 'Ж', 'ж', 'З', 'з', 'И', 'и', 'Й', 'й', 'К', 'к', 'Л', 'л', 'М', 'м', 'Н', 'н', 'О', 'о', 'П', 'п', 'Р', 'р', 'С', 'с', 'Т', 'т', 'У', 'у', 'Ф', 'ф', 'Х', 'х', 'Ц', 'ц', 'Ч', 'ч', 'Ш', 'ш', 'Щ', 'щ', 'Ъ', 'ъ', 'Ы', 'ы', 'Ь', 'ь', 'Э', 'э', 'Ю', 'ю', 'Я', 'я'];
   if (str_replace($alfa_ru, '', $email) !== $email) {
      echo "Ошибка: адрес не должен содержать русские буквы";
      return false;
   }

   $inhibit_sym = ['!', '#', '$', '%', '^', '&', '\'', '"', '*', '(', ')', '+', '=', '[', ']', '{', '}', '\\', '|', ':', ';', '<', ',', '>', '?', '/', '`', '~'];
   if (str_replace($inhibit_sym, '', $email) !== $email) {
      echo "Ошибка: адрес не должен содержать спецсимволы";
      return false;
   }

   if (strpos($email, '@') != strrpos($email, '@')) {
      echo "Ошибка: адрес может содержать только один знак '@'";
      return false;
   }

   $allow_sym = ['@', '-', '_', '.'];

   if (trim($email, implode('', $allow_sym)) !== $email) {
      echo "Ошибка: знаки '@', '-', '_', '.' не могут быть первыми и последними в адресе";
      return false;
   }

   $inhibit_comb = [];
   foreach($allow_sym as $v1) {
      foreach(array_reverse($allow_sym) as $v2) {
         array_push($inhibit_comb, $v1 . $v2); 
      }
   }

   if (str_replace($inhibit_comb, '', $email) !== $email) {
      echo "Ошибка: знаки '@', '-', '_', '.' не могут идти подряд";
      return false;
   }

   if (strpos($email, '@') <= 2) {
      echo "Ошибка: имя эл. почты до знака '@' должно быть длиной более 2 символов";
      return false;
   }

   $email_name = substr($email, 0, strpos($email, '@'));
   $arr_num = range(0, 9);

   if (ltrim($email_name, implode('', $arr_num)) !== $email_name) {
      echo "Ошибка: цифры не могут быть первыми в имени эл. почты до знака '@'";
      return false;
   }

   if (strpos($email, '@') > strrpos($email, '.')) {
      echo "Ошибка: укажите домен верхнего уровня";
      return false;
   }

   $domain = substr($email, strrpos($email, '.') + 1);

   if ((strlen($domain) < 2)) {
      echo "Ошибка: домен верхнего уровня не может быть длиной менее 2 символов";
      return false;
   }

   if ((strlen($domain) > 11)) {
      echo "Ошибка: домен верхнего уровня не может быть длиной более 11 символов";
      return false;
   }
   return true;
}

echo "Привет ${name}";

echo '<hr/>';

echo (check_phone_num($phone)) ? "Номер телефона ${phone} подходит" : "Номер телефона ${phone} не подходит";

echo '<hr/>';

echo (check_email($email)) ? "Электронная почта ${email} подходит" : '';
echo '<hr/>';

if (strlen($message) >= 5 && strlen($message) <= 250) {
   echo $message . '- отличное сообщение';
} else if (strlen($message) < 5) echo 'Ошибка: сообщение слишком короткое'; 
      else echo 'Ошибка: сообщение слишком длинное';