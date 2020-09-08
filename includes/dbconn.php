<?php
require "config.php";
$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    die("Connection failed: " . mysqli_connect_error());
	//exit();
}
if (!mysqli_set_charset($link, "utf8")) {
		//printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($link));
		exit();
} else {
		//printf("Текущий набор символов: %s\n", mysqli_character_set_name($link));
}
?>