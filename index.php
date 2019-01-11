<!-- index.php -->
<?php 

$person1_name = 'Peter';
$person1_speciality = 'Programmer';
$person1_age = 25;


function person1_hello($name, $speciality, $age) {
	echo "Hello! My name is $name. I am a $speciality and $age years old.";

}

person1_hello($person1_name, $person1_speciality, $person1_age);

echo "<br><br>";

$person2_name = 'Jane';
$person2_speciality = 'Designer';
$person2_age = 23;


function person2_hello($name, $speciality, $age) {
	echo "Hello! My name is $name. I am a $speciality and $age years old.";

}

person1_hello($person2_name, $person2_speciality, $person2_age);

echo "<br><br>";

class Person {
	
	// public $name = "John Doe";
	// public $speciality = "some spec";
	// public $age = "30";

	public $name;
	public $speciality;
	public $age;

	// public function __construct() {
	// 	echo "Hi object!";

	public function __construct($name, $speciality, $age) {
		$this->name = $name;
		$this->$speciality = $speciality;
		$this->age = $age;
	}

	public function greeting() {
		echo "Hello! My name is ". $this->name .". I am a ". $this->speciality ." and ". $this->age ." years old.";
		// echo $this->name; 
	}
}

$person1 = new Person('Peter', 'Programmer', 25);

// $person1->name = 'Peter';
// $person1->speciality = 'Programmer';
// $person1->age = 25;

$person1->greeting();

echo "<br><br>";

$person2 = new Person('Jane', 'Designer', 20);
$person2->greeting();

// $person1->greeting($person1->name, $person1->speciality, $person1->age);

// echo $person1->name;
// echo $person1->speciality;
// echo $person1->age;

?>