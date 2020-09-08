<?php 

	$phoneAlreadyExists = false;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //write into db
	
	require "includes/dbconn.php";
	require "includes/lib.php";
	$PromoType = $_POST["promotype"]?$_POST["promotype"]:false;
	$phoneAlreadyExists = isPhoneAlreadyUsed($_POST['friend_phone']);
	if(!$phoneAlreadyExists){
		putClientInfoIntoDB($_POST['friend_name'], $_POST['friend_phone'], $PromoType);
		header("Location: success.php?dp=$PromoType");
		exit();
	}
	
	
}


$promocodes = array(
"asia" => array(10103,10112,10119,10131,10138,10157,10163,10167,10173,10177,10180,10184,10188,10191,10197),
"russia" => array(10201,10210,10217,10221,10230,10247,10253,10257,10271,10276,10282,10286,10289,10293,10299),
"america" => array(10300,10314,10319,10321,10334,10352,10363,10367,10370,10373,10382,10386,10389,10391,10395),
"penka" => array(10403,10407,10417,10420,10435,10446,10452,10456,10466,10471,10481,10483,10485,10491,10498),
"dutyfree" => array(10507,10511,10516,10521,10528,10537,10541,10553,10564,10569,10583,10589,10590,10592,10597),
);

$curPromocodes = $promocodes[$_GET["dp"]];
if(!$promocodes[$_GET["dp"]]){
	$curPromocodes = $promocodes['asia'];
}
?>

				
				

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/reset.css" media="all">
    <link type="text/css" rel="stylesheet" href="css/styles.css" media="all">
    <title>Терминал Е</title>
</head>
<body>
<div class="wrapper">
    <header class="header">
        <a href="index.php"><img class='logo' src="images/white_logo%201.svg" alt="logo"></a>
        <div class="socials">
            <a class="socials__item" target="blank" href="https://www.instagram.com/terminal_e_foodhall/"><img src="images/instagram.svg" alt="inst"></a>
            <a class="socials__item" href="#"><img src="images/youtube.svg" alt="youtube"></a>
            <img class="socials__item" src="images/RU.svg" alt="lang">
        </div>
    </header>
    <main>
        <div class="background-text">
            <h1>БЛАГОДАРИМ</h1>
            <h2>Регистрация на рейс прошла успешно</h2>
            <p>ВАШ ПРОМОКОД: <span class="promocode">
			<?php 
				if($curPromocodes){
					echo $curPromocodes[array_rand($curPromocodes, 1)];
				}else{
					echo "000000";
				}?>
			</span></p>
            <p>На забыл подарить промокод другу?</p>
        </div>
        <div class="yellow-container">
            <div class="yellow-container__header">
                <div class="container-name">Подарить перелет другу</div>
                <img src="images/logo_for_yellow%201.svg" alt="" class="container-logo">
            </div>
            <div class="yellow-container__content">
                <form id="form" action="" method="post">
                    <div class="options-row">
                        <div class="input">
                            <label for="friendName" class="input__label">Имя друга</label>
                            <input name="friend_name" id="friendName" class="input__input" type="text" value="<?=$phoneAlreadyExists?$_POST['friend_name']:""?>">
                            <img class="input__arrow-brand" src="images/arrow_brand.svg" alt="arrow">
                        </div>
                        <div class="input">
                            <label for="phone_2" class="input__label">Номер друга</label>
                            <input id="phone_2" name="friend_phone" placeholder="+7 (___) ___ - ____" class="input__input" type="text" value="">
							<div class="error-msg" style="display:<?=$phoneAlreadyExists?"block":"none"?>">На этот номер уже регистрировались</div>
							<select style="display:none;" name="promotype" form="form" id="arrival" class="input__select input__input">
								<option value="<?=$_GET['dp']?>">Вок и ток</option>
							</select>
                        </div>
                        <button class="button" type="submit">ПРОМОКОД ДРУГУ</button>
                    </div>
                    <div class="agreement">
                        <div class="checkbox-wrapper">
                            <input name="agreement" id="agreement__checkbox" type="checkbox">
                        </div>
                        <label for="agreement__checkbox" class="yellow-container__text">Согласие на обработку персональных данных</label>
                    </div>
                </form>
				<div class="parent_popup">
						<div class="popup yellow-container">
							<div class="agreement__content">
								<p class="yellow-container__text">Пользователь, оставляя заявку на интернет-сайте Общества с ограниченной ответственностью «Восход» (ООО «Восход») http(s)://welcome.terminaleda.ru, даёт настоящее согласие на обработку персональных данных (далее – Согласие).
								Действуя свободно, по своей волей и в своем интересе, а также подтверждая свою дееспособность, даю свое согласие ООО «Восход» (ИНН 2543133007), которое расположено по адресу: 690002, г. Владивосток,  ул. Некрасовская, 57 кв. 13, на обработку своих персональных данных со следующими условиями:
								</p>
								<ol  class="yellow-container__text agreement__list">
									<li>Согласие дается на обработку персональных данных с использованием средств автоматизации.</li>
									<li>Согласие дается на обработку следующих моих персональных данных:
										персональные данные, не являющиеся специальными или биометрическими: фамилия, имя, отчество; номера контактных телефонов.</li>
									<li>Персональные данные не являются общедоступными.</li>
									<li>Цели обработки персональных данных:
										<ul>
											<li>формирование списка гостей </li>
											<li>уведомление о предстоящих акциях/анонсах/новинках </li>
											<li>отправка информационных писем</li>
										</ul>
									</li>
									<li>Основанием для обработки персональных данных является: ст. 24 Конституции Российской Федерации; Федеральный закон №152-ФЗ «О персональных данных»; Закон Российской Федерации от 19 апреля 1991 № 1032-1 «О занятости населения в Российской Федерации»; устав ООО «Восход»; настоящее согласие на обработку персональных данных.</li>
									<li>В ходе обработки с персональными данными будут совершены следующие действия: сбор; запись; систематизация; накопление; хранение; уточнение (обновление, изменение); извлечение; использование; обезличивание; блокирование; удаление; уничтожение.</li>
									<li>Обработка персональных данных может быть прекращена по запросу субъекта персональных данных. Хранение персональных данных, зафиксированных на бумажных носителях осуществляется согласно Федеральному закону №125-ФЗ «Об архивном деле в Российской Федерации» и иными нормативно-правовыми актами в области архивного дела и архивного хранения.</li>
									<li>Согласие может быть отозвано субъектом персональных данных или его представителем путем направления письменного заявления в ООО «Восход» или его представителю по адресу, указанному в Согласии.</li>
									<li>В случае отзыва субъектом персональных данных или его представителем согласия на обработку персональных данных, ООО «Восход» вправе продолжить обработку персональных данных без согласия субъекта персональных данных при наличии оснований, указанных в пунктах 2 – 11 части 1 статьи 6, части 2 статьи 10 и части 2 статьи 11 Федерального закона №152-ФЗ «О персональных данных» от 27.07.2006 г.</li>
									<li>Настоящее согласие действует все время до момента прекращения обработки персональных данных, указанного в п.7 и п.8 данного Согласия.</li>
								</ol>
						</div>


					<div class="popup__control-buttons">
						<button class="button" id="agreement_cancel" type="button">Отмена</button>
						<button class="button" id="agreement_ok" type="button">Согласен</button>
					</div>
				</div>
			</div>
            </div>
        </div>
    </main>
</div>
    <footer class="footer">
        <div class="footer__content wrapper">
			<a href="index.php" class="plain-logo"><img src="images/plane.svg" alt="plane_logo" class="plain-logo"></a>
            <a href="index.php" class="logo"><img src="images/logo_for_yellow%201.svg"  alt="logo"></a>
            <div class="socials">
                <a class="socials__item" target="blank" href="https://www.instagram.com/terminal_e_foodhall/"><img src="images/instagram_gray.svg" alt="inst"></a>
                <a class="socials__item" href="#"><img src="images/youtube_gray.svg" alt="youtube"></a>
                <img class="socials__item" src="images/RU_gray.svg" alt="lang">
            </div>

            <table class="contacts">
                <tr>
                    <td class="contacts__dt">Адрес:</td>
                    <td class="contacts__dd">Владивосток, Батарейная 3А</td>
                </tr>
                <tr>
                    <td class="contacts__dt">Email:</td>
                    <td class="contacts__dd"><a href="mailto:info@terminaleda.ru">info@terminaleda.ru</a></td>
                </tr>
                <tr>
                    <td class="contacts__dt">Телефон:</td>
                    <td class="contacts__dd"><a href="tel:+78005558078">+7-800-555-80-78</a></td>
                </tr>
            </table>
        </div>
    </footer>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/jquery.maskedinput.min.js"></script>
<script src="js/success_script.js"></script>
</body>
</html>