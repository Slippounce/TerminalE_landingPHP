<?php
$phoneAlreadyExists = false;
$friendPhoneAlreadyExists = false;
$didPut = false;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //write into db
	require "includes/dbconn.php";
	require "includes/lib.php";
	$PromoType = $_POST["promotype"]?$_POST["promotype"]:false;
	if($_POST['friend_name']){
		$friendPhoneAlreadyExists = isPhoneAlreadyUsed($_POST['friend_phone']);
		if(!$friendPhoneAlreadyExists){
			if(putClientInfoIntoDB($_POST['friend_name'], $_POST['friend_phone'], $PromoType)){
					$didPut = true;
			}
		}	
	}
	if($_POST['name']){
		$phoneAlreadyExists = isPhoneAlreadyUsed($_POST['phone']);
		if(!$phoneAlreadyExists){
			if(putClientInfoIntoDB($_POST['name'], $_POST['phone'], $PromoType)){
					$didPut = true;
			}
		}
	}
	
	if($didPut){
		header("Location: success.php?dp=$PromoType");
		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="css/datepicker.min.css" rel="stylesheet" type="text/css">
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
        <a class="socials__item" target="blank" href="https://www.youtube.com/channel/UCJmUh8RtFXQYMYH8ewsyKnw"><img src="images/youtube.svg" alt="youtube"></a>
        <img class="socials__item" src="images/RU.svg" alt="lang">
    </div>
</header>
<main>
    <div class="background-text">
        <h1>СКОРО</h1>
        <h2>ПЕРВОЕ ГАСТРОНОМИЧЕСКОЕ ПУТЕШЕСТВИЕ</h2>
        <p>Фуд-молл Терминал Е-это ваше первое гастрономическое путешествие.
            <br>В воздухе висит предвкушение полета, положительных эмоций и увлекательных приключений. Вокруг звуки взлетающих боингов и ваши воспоминания от последнего полета </p>
    </div>
    <div class="yellow-container">
        <div class="yellow-container__header">
            <div class="container-name">Регистрация на рейс</div>
            <img src="images/logo_for_yellow%201.svg" alt="" class="container-logo">
        </div>
        <div class="yellow-container__content">
            <div class="options-row">
                <div class="input">
                    <label for="departure" class="input__label">Отправление</label>
                    <input id="departure" class="input__input input--disabled" type="text" value="Терминал Е" readonly>
                </div>
                <div class="input">
                    <label for="arrival" class="input__label">Прибытие</label>
                    <select name="promotype" form="form" id="arrival" class="input__select input__input">
                        <option value="asia" <?php if(($phoneAlreadyExists || $friendPhoneAlreadyExists) && $_POST['promotype'] === 'asia') echo selected?>>Вок и ток (Азия)</option>
                        <option value="russia" <?php if(($phoneAlreadyExists || $friendPhoneAlreadyExists) && $_POST['promotype'] === 'russia') echo selected?>>Компот (Россия)</option>
                        <option value="america" <?php if(($phoneAlreadyExists || $friendPhoneAlreadyExists) && $_POST['promotype'] === 'america') echo selected?>>Дуглас (Америка)</option>
                        <option value="penka" <?php if(($phoneAlreadyExists || $friendPhoneAlreadyExists) && $_POST['promotype'] === 'penka') echo selected?>>Penka (Парк развлечений)</option>
                        <option value="dutyfree" <?php if(($phoneAlreadyExists || $friendPhoneAlreadyExists) && $_POST['promotype'] === 'dutyfree') echo selected?>>Duty free</option>
                    </select>
                </div>
                <div class="input">
                    <label for="class" class="input__label">Класс</label>
                    <select id="class" class="input__select input__input">
                        <option value="econom" >Эконом</option>
                        <option value="business">Бизнес</option>
						<option value="business">Первый</option>
                    </select>
                </div>
            </div>
            <div class="frame frame--squeezed">
                <div class="frame__item">
                    <input class="frame__radio-input" type="radio" id="flightType1"
                           name="flightType" value="roundTrip" checked>
                    <label class="frame__radio-label" for="flightType1">Туда и обратно</label>
                </div>
                <div class="frame__item">
                    <input class="frame__radio-input" type="radio" id="flightType2"
                           name="flightType" value="onlyThere">
                    <label class="frame__radio-label" for="flightType2">В одну сторону</label>
                </div>
                <div class="frame__item">
                    <input class="frame__radio-input" type="radio" id="flightType3"
                           name="flightType" value="difRoad">
                    <label class="frame__radio-label" for="flightType3">Сложный маршрут</label>
                </div>

            </div>

            <div class="options-row">
                <div class="input">
                    <label for="departureDate" class="input__label">Туда</label>
                    <label class="input__date-label input--disabled">
                        <input id="departureDate" class="input--middle input__input input--disabled" type="text" value="01.10.2020" readonly>
                    </label>
                </div>
                <div class="input">
                    <label for="arrivalDate" class="input__label">Обратно</label>
                    <label class="input__date-label input--disabled">
						<input id="arrivalDate" class="input--middle input__input input--disabled" type="text" value="Открытая дата" readonly>
                    </label>
                </div>
                <div class="options-row__frame frame frame--squeezed">
                    <div class="frame__item">
                        <input class="frame__radio-input" type="radio" id="dateType1"
                               name="dateType" value="roundTrip" checked >
                        <label class="frame__radio-label" for="dateType1">Точные даты</label>
                    </div>
                    <div class="frame__item">
                        <input class="frame__radio-input" type="radio" id="dateType2"
                               name="dateType" value="onlyThere">
                        <label class="frame__radio-label" for="dateType2">± 3дня</label>
                    </div>
                </div>
            </div>
            <div class="options-row options-row--flex-start">

                <div class="input input-mini">
                    <label for="matures" class="input__label">Взрослые:</label>
                    <select id="matures" class="input__select input__input">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <div class="input input-mini">
                    <label for="children" class="input__label">Дети (2-12):</label>
                    <select id="children" class="input__select input__input">
                        <option value="1">0</option>
						<option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <div class="input input-mini">
                    <label for="babies" class="input__label">Младенцы:</label>
                    <select id="babies" class="input__select input__input">
						<option value="1">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

            </div>
            <h1 class="yellow-container_header2">Зарегистрируйся на рейс и получи промокод на <span id="offer">азиатское бенто</span></h1>
            <form id="form" action="" method="post">
                <div class="options-row">
                    <div class="input">
                        <label for="name" class="input__label">Ваше имя</label>
                        <input id="name" name="name" class="input__input" type="text" form="form" value="<?=$phoneAlreadyExists?$_POST['name']:""?>">
                        <img class="input__arrow-brand" src="images/arrow_brand.svg" alt="arrow">
                    </div>
                    <div class="input">
                        <label for="phone_1" class="input__label">Ваш номер</label>
                        <input id="phone_1" name="phone" placeholder="+7 (___) ___ - ____" form="form" class="input__input" type="tel" value="">
						<div class="error-msg" style="display:<?=$phoneAlreadyExists?"block":"none"?>">На этот номер уже регистрировались</div>
                    </div>
                    <button id="me" class="button" type="submit">ПОЛУЧИТЬ ПРОМОКОД</button>
                </div>
                <div class="options-row">
                    <div class="input">
                        <label for="friendName" class="input__label">Имя друга</label>
                        <input name="friend_name" id="friendName" class="input__input" type="text" value="<?=$friendPhoneAlreadyExists?$_POST['friend_name']:""?>">
                        <img class="input__arrow-brand" src="images/arrow_brand.svg" alt="arrow">
                    </div>
                    <div class="input">
                        <label for="phone_2" class="input__label">Номер друга</label>
                        <input id="phone_2" name="friend_phone" placeholder="+7 (___) ___ - ____" class="input__input" type="text" value="">
						<div class="error-msg" style="display:<?=$friendPhoneAlreadyExists?"block":"none"?>">На этот номер уже регистрировались</div>
                    </div>
                    <button id="for_friend" class="button" type="submit">ПРОМОКОД ДРУГУ</button>
                </div>
            </form>
            <div class="agreement">
                <div class="checkbox-wrapper">
                    <input name="agreement" id="agreement__checkbox" type="checkbox">
                </div>
                <label for="agreement__checkbox" class="yellow-container__text">Согласие на обработку персональных данных</label>
            </div>
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
		<a href="index.php" class="plain-logo"><img src="images/plane.svg" alt="plane_logo"></a>
        <a href="index.php" class="logo"><img src="images/logo_for_yellow%201.svg"  alt="logo"></a>
        <div class="socials">
            <a class="socials__item" target="blank" href="https://www.instagram.com/terminal_e_foodhall/"><img src="images/instagram_gray.svg" alt="inst"></a>
            <a class="socials__item" target="blank" href="https://www.youtube.com/channel/UCJmUh8RtFXQYMYH8ewsyKnw"><img src="images/youtube_gray.svg" alt="youtube"></a>
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
</body>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/jquery.maskedinput.min.js"></script>
<script src="js/datepicker.min.js"></script>
<script src="js/index_script.js"></script>
</html>