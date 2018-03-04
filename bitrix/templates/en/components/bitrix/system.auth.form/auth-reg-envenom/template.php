<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?	if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']):?>
<div class="error-list">
	<div class="close"><svg version="1.1" id="close" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							width="25px" height="25px" viewBox="0 0 25 25" enable-background="new 0 0 25 25" xml:space="preserve">
<path d="M12.505,0.333c3.361,0,6.404,1.362,8.606,3.565c2.203,2.203,3.565,5.245,3.565,8.606c0,3.361-1.362,6.404-3.565,8.606
	c-2.202,2.203-5.245,3.565-8.606,3.565c-3.361,0-6.404-1.362-8.606-3.565c-2.203-2.202-3.565-5.245-3.565-8.606
	c0-3.361,1.362-6.404,3.565-8.606C6.101,1.696,9.144,0.333,12.505,0.333L12.505,0.333z M19.929,5.08
	c-1.9-1.9-4.525-3.075-7.424-3.075c-2.899,0-5.524,1.175-7.424,3.075c-1.9,1.9-3.075,4.525-3.075,7.424
	c0,2.899,1.175,5.524,3.075,7.424c1.9,1.9,4.525,3.075,7.424,3.075c2.899,0,5.524-1.175,7.424-3.075
	c1.9-1.9,3.075-4.525,3.075-7.424C23.004,9.605,21.828,6.98,19.929,5.08L19.929,5.08z"/>
			<polygon points="18.312,7.879 7.879,18.312 6.697,17.13 17.13,6.697 18.312,7.879 "/>
			<polygon points="17.13,18.312 6.697,7.879 7.879,6.697 18.312,17.13 17.13,18.312 "/>
</svg></div>
	<?=ShowMessage($arResult['ERROR_MESSAGE'])?>
</div>
<?endif;?>

<?if($arResult["FORM_TYPE"] == "login"):?>

<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
<?foreach ($arResult["POST"] as $key => $value):?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />
	<table class="auth-table">
		<tr>
			<td><?if($arResult["AUTH_SERVICES"]):?>
					<p>используя для входа социальные сети</p>
					<?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", ".default",
						array(
							"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
							"CURRENT_SERVICE"=>$arResult["CURRENT_SERVICE"],
							"AUTH_URL"=>$arResult["AUTH_URL"],
							"POST"=>$arResult["POST"],
							"SUFFIX" => "form",
						),
						$component,
						array("HIDE_ICONS"=>"Y")
					);
					?>
				<?endif?></td>
		</tr>
		<tr>
			<td colspan="2">
				<label><?=GetMessage("AUTH_LOGIN")?></label>
				<input type="text" class="insty" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" size="17" />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<label><?=GetMessage("AUTH_PASSWORD")?></label>
			<input type="password" class="insty" name="USER_PASSWORD" maxlength="50" size="17" autocomplete="off" />
				<a class="forgot" href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
				<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure<?=$arResult["RND"]?>" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
				<script type="text/javascript">
				document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
				</script>
				<?endif?>
				<label class="rememberme">
					<input class="checkbox" type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" checked="">
					<span class="checkbox-custom"></span>
					<span class="label">Запомнить меня</span>
				</label>
				<input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON2")?>" />
			</td>
		</tr>
<?if ($arResult["CAPTCHA_CODE"]):?>
		<tr>
			<td colspan="2">
			<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
			<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
			<input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
<?endif?>
		<tr>

		</tr>
	</table>
</form>

<?if($arResult["AUTH_SERVICES"]):?>
<?/*
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"AUTH_URL"=>$arResult["AUTH_URL"],
		"POST"=>$arResult["POST"],
		"POPUP"=>"Y",
		"SUFFIX"=>"form",
	),
	$component,
	array("HIDE_ICONS"=>"Y")
);*/

?>
<?endif?>

<?
elseif($arResult["FORM_TYPE"] == "otp"):
?>

<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="OTP" />
	<table width="95%">
		<tr>
			<td colspan="2">
			<?echo GetMessage("auth_form_comp_otp")?><br />
			<input type="text" name="USER_OTP" maxlength="50" value="" size="17" autocomplete="off" /></td>
		</tr>
<?if ($arResult["CAPTCHA_CODE"]):?>
		<tr>
			<td colspan="2">
			<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
			<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
			<input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
<?endif?>
<?if ($arResult["REMEMBER_OTP"] == "Y"):?>
		<tr>
			<td valign="top"><input type="checkbox" id="OTP_REMEMBER_frm" name="OTP_REMEMBER" value="Y" /></td>
			<td width="100%"><label for="OTP_REMEMBER_frm" title="<?echo GetMessage("auth_form_comp_otp_remember_title")?>"><?echo GetMessage("auth_form_comp_otp_remember")?></label></td>
		</tr>
<?endif?>
		<tr>
			<td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
		</tr>
		<tr>
			<td colspan="2"><noindex><a href="<?=$arResult["AUTH_LOGIN_URL"]?>" rel="nofollow"><?echo GetMessage("auth_form_comp_auth")?></a></noindex><br /></td>
		</tr>
	</table>
</form>

<?
else:
?>

<form action="<?=$arResult["AUTH_URL"]?>">
	<table width="95%">
		<tr>
			<td align="center">
				<?=$arResult["USER_NAME"]?><br />
				<?=$arResult["USER_LOGIN"]?><br />
				<a href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><?=GetMessage("AUTH_PROFILE")?></a><br />
			</td>
		</tr>
		<tr>
			<td align="center">
			<?foreach ($arResult["GET"] as $key => $value):?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endforeach?>
			<input type="hidden" name="logout" value="yes" />
			<input type="submit" name="logout_butt" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" />
			</td>
		</tr>
	</table>
</form>
<?endif?>

