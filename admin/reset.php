Form Lupa Password
<p></p>
</pre>
<form action="" method="post">
<table>
<tbody>
<tr>
<td >Email Anda : <input  type="text" name="email" />
<input type="submit" class="btn btn-primary" name="submit" value="submit"  /></td>
</tr>
</tbody>
</table>
</form>
<pre>
<?php 
error_reporting(0);
if (isset($_POST['submit'])){
include("../mh/koneksi.php");
include "sendEmail-v156.php";
$sql = "SELECT password FROM users WHERE email='$_POST[email]'";
$hasil = mysql_query($sql);
$jumlah = mysql_num_rows($hasil);
 
if ($jumlah==1){
$data=mysql_fetch_array($hasil);
$decode = base64_decode($data[password]);
$to = "$_POST[email]"; //alamat email user
$subject = "Password Anda";
$sender   = 'oong12370@gmail.com';
$passmail = 'OONG2016804234';
$message .= "Password Anda : <strong>$decode</strong>";
 
email_localhost($to, $subject, $message, $sender, $passmail);
echo "Password telah terkirim ke email Anda";
}
else{
echo "Password tidak bisa dikirimkan ke email Anda";
}
}
?>