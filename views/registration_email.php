<?php
// no echo here, just HTML
?>

<table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
  <td style="text-align: center;color: #ffffff;background-color: #1d2d77;width: 60%;font-family: Montserrat;">
    <h1 style="color:#ffff;">VIDYEN 4.0 </h1>
  </td>
  <td style="text-align: center;font-family: Montserrat;border: solid 2px;padding-top: 20px;">
    <h1>CONFERENCE<br> 2026</h1>
  </td>
</tr>
</table>

<table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td style="width: 10%;height: 80px; "></td>
<td style="width: 90%; font-family: Montserrat;font-weight: bold;">
    Dear <?= $user_name ?>,
</td>
</tr>
</table>

<table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td style="width: 10%;"></td>
<td style="width: 90%;">
  <p style="font-family: Montserrat;">
    Greetings from Yenepoya Dental Education Unit, Yenepoya Dental College, Yenepoya(Deemed to be University).
  </p>
</td>
</tr>

<tr>
<td></td>
<td>
  <p style="font-family: Montserrat;">
    The first step of registration is complete. Kindly note the following,
  </p>
</td>
</tr>
</table>

<table width="650" align="center">
<tr>
<td style="width: 10%;"></td>
<td>
  <p style="font-family: Montserrat;">
    1. Your conference registration ID is 
    <b><?= $register_code ?></b>
  </p>
</td>
</tr>
</table>

<table width="650" align="center">
<tr>
<td style="width: 10%;"></td>
<td>
  <p style="font-family: Montserrat;">
    2. Total amount to be paid is 
    <b><?= $Amt1 ?></b>
  </p>
</td>
</tr>
</table>

<table width="650" align="center">
<tr>
<td style="width: 10%;"></td>
<td>

<?php if ($delegate_type == "National"): ?>

<p style="font-family: Montserrat;">
3. Kindly follow the link given for payment
</p>

<p style="font-family: Montserrat;font-weight: bold;">
<a href="<?= $link ?>"><?= $link ?></a>
</p>

<?php else: ?>

<p style="font-family: Montserrat;">
3. Transfer/Wire Transfer the Amount to the following Account details
</p>

<p><b>Account Name:</b> YENEPOYA DEEMED TO BE UNIVERSITY</p>
<p><b>Account Number:</b> 50200090985117</p>
<p style="color:red;"><b>(Type of Account: Current Account – EEFC – USD)</b></p>
<p><b>IFSC Code:</b> HDFC0001269</p>
<p><b>Branch:</b> MG ROAD, MANGALORE</p>
<p><b>BRANCH Code:</b> 001269</p>
<p><b>MICR Code:</b> 575240003</p>
<p><b>SWIFT Code:</b> HDFCINBB</p>

<?php endif; ?>

</td>
</tr>
</table>

<table width="650" align="center">
<tr>
<td style="width: 10%;"></td>
<td>
  <p style="font-family: Montserrat;">
    Your registration process would be completed after the payment.
  </p>
</td>
</tr>
</table>

<table width="650" align="center">
<tr>
<td style="width: 10%;"></td>
<td>
  <p style="font-family: Montserrat;">
    Username: <?= $email ?><br/>
    Password: <?= $mobile ?>
  </p>
</td>
</tr>
</table>

<table width="650" align="center">
<tr>
<td style="width: 10%;"></td>
<td>
  <p style="font-family: Montserrat;">
    Click to login :
    <a href="https://vidyen.yenepoya.in/decyen/login.php">
      https://vidyen.yenepoya.in/decyen/login.php
    </a>
  </p>
</td>
</tr>
</table>

<table width="650" align="center">
<tr>
<td style="width: 10%;"></td>
<td>
  <p style="font-family: Montserrat;font-weight: bold;">
    Registration Committee
  </p>
  <p style="font-family: Montserrat;font-weight: bold;">
    VIDYEN 4.0, 2026
  </p>
</td>
</tr>
</table>

<table width="650" align="center">
<tr>
<td colspan="100" style="text-align: center;background-color: #2e354a;">
  <p style="color: #ffffff;">
    Yenepoya Dental Education Unit, Yenepoya Dental College
  </p>
</td>
</tr>
</table>