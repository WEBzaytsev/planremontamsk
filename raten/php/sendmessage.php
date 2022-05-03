<?php
if (isset($_SERVER['HTTP_REFERER'])) 
{
	$sendto  = 'advplanremonta@gmail.com';
	$from  = 'advplanremonta@gmail.com';
	$parsed_url = parse_url($_SERVER['HTTP_REFERER']);
	$subject  = 'Заявка ('.$parsed_url['host'].$parsed_url['path'].')';
	$headers  = "From: ".$from."\r\n";
	$headers .= "Reply-To: ".$from."\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html;charset=utf-8 \r\n";
	$msg  = "<html><body style='font-family:Arial,sans-serif;'>";
	$msg .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>".$subject."</h2>\r\n";

	$msg_amo ="";

	$msg_amo .="<p><strong>Форма:</strong> ".$_POST['title']."</p>";

	if (isset($_POST['name']))
	{
		if ($_POST['name']!=='') {
			$msg .= "<p><strong>Имя:</strong> ".$_POST['name']."</p>\r\n";
			$msg_amo .= "<p><strong>Имя:</strong> ".$_POST['name']."</p>\r\n";
		}
	}
	if (isset($_POST['phone']))
	{
		if ($_POST['phone']!=='') {
			$msg .= "<p><strong>Телефон:</strong> ".$_POST['phone']."</p>\r\n";
			$msg_amo .= "<p><strong>Телефон:</strong> ".$_POST['phone']."</p>\r\n";
		}
	}
	if (isset($_POST['what']))
	{
		if ($_POST['what']!=='') {
			$msg .= "<p><strong>Что нужно отремонтировать:</strong> ".$_POST['what']."</p>\r\n";
			$msg_amo .= "<p><strong>Что нужно отремонтировать:</strong> ".$_POST['what']."</p>\r\n";
		}
	}
	if (isset($_POST['type']))
	{
		if ($_POST['type']!=='') {
			$msg .= "<p><strong>Вид ремонта:</strong> ".$_POST['type']."</p>\r\n";
			$msg_amo .= "<p><strong>Вид ремонта:</strong> ".$_POST['type']."</p>\r\n";
		}
	}
	if (isset($_POST['home']))
	{
		if ($_POST['home']!=='') {
			$msg .= "<p><strong>Новостройка:</strong> ".$_POST['home']."</p>\r\n";
			$msg_amo .= "<p><strong>Новостройка:</strong> ".$_POST['home']."</p>\r\n";
		}
	}
	if (isset($_POST['area_range']))
	{
		if ($_POST['area_range']!=='') {
			$msg .= "<p><strong>Площадь помещения:</strong> ".$_POST['area_range']."</p>\r\n";
			$msg_amo .= "<p><strong>Площадь помещения:</strong> ".$_POST['area_range']."</p>\r\n";
		}
	}
	if (isset($_POST['room']))
	{
		if ($_POST['room']!=='') {
			$msg .= "<p><strong>Количество комнат:</strong> ".$_POST['room']."</p>\r\n";
			$msg_amo .= "<p><strong>Количество комнат:</strong> ".$_POST['room']."</p>\r\n";
		}
	}
	if (isset($_POST['title']))
	{
		if ($_POST['title']!=='') {
			$msg .= "<p><strong>Форма:</strong> ".$_POST['title']."</p>\r\n";
		}
	}
	if (isset($_POST['utm_source']))
	{
		if ($_POST['utm_source']!=='') {
			$msg .= "<p><strong>utm_source:</strong> ".$_POST['utm_source']."</p>\r\n";
		}
	}
	if (isset($_POST['utm_medium']))
	{
		if ($_POST['utm_medium']!=='') {
			$msg .= "<p><strong>utm_medium:</strong> ".$_POST['utm_medium']."</p>\r\n";
		}
	}
	if (isset($_POST['utm_campaign']))
	{
		if ($_POST['utm_campaign']!=='') {
			$msg .= "<p><strong>utm_campaign:</strong> ".$_POST['utm_campaign']."</p>\r\n";
		}
	}
	if (isset($_POST['utm_content']))
	{
		if ($_POST['utm_content']!=='') {
			$msg .= "<p><strong>utm_content:</strong> ".$_POST['utm_content']."</p>\r\n";
		}
	}
	if (isset($_POST['utm_term']))
	{
		if ($_POST['utm_term']!=='') {
			$msg .= "<p><strong>utm_term:</strong> ".$_POST['utm_term']."</p>\r\n";
		}
	}
	$msg .= "</body></html>";
	if (@mail($sendto, $subject, $msg, $headers))   {
		echo "true";
	} else {
		echo "false";
	}


	// определяем URL 
	$Url = 'https://pro100banda.ru/rest/1/ap94tbf8vlswges0/crm.lead.add.json';
	// описываем параметры  лида 
	$ParamLid = http_build_query(array(
	  'fields' => array(
	    'TITLE' => str_replace(" ","",$_SERVER["HTTP_REFERER"]), // НАЗВАНИЕ
	    'NAME' => $_POST["name"], // ИМЯ
	    'PHONE' => Array(
           "n0" => Array(
               "VALUE" => str_replace(" ","",$_POST["phone"]),
               "VALUE_TYPE" => "WORK",
           )), // РАБОЧИЙ ТЕЛЕФОН в массиве
	'OPENED' => 'Y', // Доступно для всех
	'SOURCE_ID' => "9623669930", //Источник 
	'UTM_CAMPAIGN'=> $_POST["utm_campaign"],
	'UTM_CONTENT' => $_POST["utm_content"],
	'UTM_TERM' => $_POST["utm_term"],
	'UTM_MEDIUM' => $_POST["utm_medium"],
	'UTM_SOURCE' => $_POST["utm_source"],
	'COMMENTS' => $msg_amo,
	'UF_CRM_1599650391' => "SALE", //По какой компании сделка = План Ремонта
	'UF_CRM_1598020616' => "9623669930", //Источник лида или сделки = План Ремонта РК от Темури
	),
	  'params' => array("REGISTER_SONET_EVENT" => "Y")
	));
	// обращаемся к сформированному URL при помощи функции curl_exec для создания лида
	$ch = curl_init();
	curl_setopt_array($ch, array(
	  CURLOPT_SSL_VERIFYPEER => 0,
	  CURLOPT_POST => 1,
	  CURLOPT_HEADER => 0,
	  CURLOPT_RETURNTRANSFER => 1,
	  CURLOPT_URL => $Url,
	  CURLOPT_POSTFIELDS => $ParamLid,
	));
	$result = curl_exec($ch);
	print_r($result);
	curl_close($ch);
	$result = json_decode($result, 1);
	if (array_key_exists('error', $result)) echo "Ошибка при сохранении лида: ".$result['error_description']."<br/>";
}
?>
