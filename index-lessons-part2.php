<?php

$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', 'root');


//1. Выборка без защиты от SQL инъекции

$username = 'Joker';
$password = 'joker';

$sql = "SELECT * FROM users WHERE name ='{$username}' AND password = '{$password}' LIMIT 1";

$result = $db->query($sql);

echo "<h2>Выборка без защиты от SQL инъекции:</h2>";
// print_r($result->fetch(PDO::FETCH_ASSOC));

if ($result->rowCount() == 1) {
	$user = $result->fetch(PDO::FETCH_ASSOC);
	echo "Имя пользователя: {$user['name']} <br>";
	echo "Пароль пользователя: {$user['password']} <br>";
}

//2. Выборка с защитой от SQL инъекции - в РУЧНОМ режиме

$username = 'Joker';
$password = 'joker';
// ДЛЯ ОБЕСПЕЧЕНИЯ БЕЗОПАСНОСТИ !!!
$username = htmlentities($username);
$password = htmlentities($password);
//пересмотреть мастер-класс и исправить то, что надо
// $username = $db->quote ($username);
$username = strtr($username, array('_' => '\_', '%' => '\%'));

// $password = $db->quote ($password);
$password = strtr($password, array('_' => '\_', '%' => '\%'));


$sql = "SELECT * FROM users WHERE name ='{$username}' AND password = '{$password}' LIMIT 1";
$result = $db->query($sql);

echo "<h2>Выборка с защитой от SQL инъекции - в РУЧНОМ режиме:</h2>";

if ($result->rowCount() == 1) {
	$user = $result->fetch(PDO::FETCH_ASSOC);
	echo "Имя пользователя: {$user['name']} <br>";
	echo "Пароль пользователя: {$user['password']} <br>";
}

//3. Выборка с защитой от SQL инъекции - в АВТОМАТИЧЕСКОМ режиме

$sql = "SELECT * FROM users WHERE name = :username AND password = :password LIMIT 1";

$stmt = $db->prepare($sql);

$username = 'Joker';
$password = 'joker';

// ДЛЯ ОБЕСПЕЧЕНИЯ БЕЗОПАСНОСТИ !!!
$username = htmlentities($username);
$password = htmlentities($password);

$stmt->bindValue(':username', $username);
$stmt->bindValue(':password', $password);


$stmt->execute();
// $stmt->execute(':username' => $username, ':password' => $password);

$stmt->bindColumn('name', $name);
$stmt->bindColumn('password', $password);


echo "<h2>Выборка с защитой от SQL инъекции - в АВТОМАТИЧЕСКОМ режиме:</h2>";

$stmt->fetch();
echo "Имя пользователя: {$name} <br>";
echo "Пароль пользователя: {$password} <br>";


//4. Выборка с защитой от SQL инъекции - в АВТОМАТИЧЕСКОМ режиме - запрос в другом формате

$sql = "SELECT * FROM users WHERE name = ? AND password = ? LIMIT 1";

$stmt = $db->prepare($sql);

$username = 'Joker';
$password = 'joker';

// ДЛЯ ОБЕСПЕЧЕНИЯ БЕЗОПАСНОСТИ !!!
$username = htmlentities($username);
$password = htmlentities($password);

// $stmt->bindValue(1, $username);
// $stmt->bindValue(2, $password);
// $stmt->execute();

$stmt->execute(array($username, $password));

$stmt->bindColumn('name', $name);
$stmt->bindColumn('password', $password);

echo "<h2>Выборка с защитой от SQL инъекции - в АВТОМАТИЧЕСКОМ режиме - запрос в другом формате:</h2>";

$stmt->fetch();
echo "Имя пользователя: {$name} <br>";
echo "Пароль пользователя: {$password} <br>";

// // Вставка данных в БД

$sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
$stmt = $db->prepare($sql);

$username = "Flash";
$email = "777";
$password = "flash@hotmail.com";

$stmt->bindValue(':name', $username);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':password', $password);
$stmt->execute();


echo "<h2>Вставка данных в БД:</h2>";

echo "<p>Было затронуто строк: " . $stmt->rowCount() . "</p>";
echo "<p>ID вставленной записи: ". $db->lastinsertId() ."</p>";

// Обновление данных

$sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";

$stmt = $db->prepare($sql);

$username = "New Flash";
$email = "newwwflash@hotmail.com";
$id = '13';

$stmt->bindValue(':name', $username);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':id', $id);
$stmt->execute();


echo "<h2>Вставка данных в БД:</h2>";

echo "<p>Было затронуто строк: " . $stmt->rowCount() . "</p>";

// Удаление данных

$sql = "DELETE FROM users WHERE name = :name";

$stmt = $db->prepare($sql);

$username = "New Flash";
$stmt->bindValue(':name', $username);

//выполнение запроса
$stmt->execute();
echo "<p>Было затронуто строк: " . $stmt->rowCount() . "</p>";

?>
