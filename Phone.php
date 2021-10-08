<?php

Class Phone {
    public int $serialNumber;
    public string $model;
    public string $color;
    public float $screenSize;

    public function __construct(int $serialNumber, string $model, string $color, float $screenSize) {
        $this->serialNumber = $serialNumber;
        $this->model = $model;
        $this->color = $color;
        $this->screenSize = $screenSize;
    }
}

Class Mapper
{
    private PDO $conn;

    public function __construct() { $this->conn = new PDO('mysql:host=localhost;dbname=sitedb', 'newuser', 'password'); }

    public function save(Phone $phone) {
        $newPhone = "Insert Into phones(serialNumber, model, color, screenSize) Values(?, ?, ?, ?)";
        $addPhone = $this->conn->prepare($newPhone);
        $addPhone->execute(array($phone->serialNumber, $phone->model, $phone->color, $phone->screenSize));
    }

    public function remove(Phone $phone) {
        $deletePhone = "Delete from phones where serialNumber = ?";
        $delPhone = $this->conn->prepare($deletePhone);
        $delPhone->execute(array($phone->serialNumber));
    }

    public function getById($serialNumber) {
        $getPlayer = $this->conn->prepare("Select * from phones where serialNumber = ?");
        $getPlayer->execute(array($serialNumber));
        $row = $getPlayer->fetch();

        return $row;
    }

    public function all() {
        $getAllPlayers = $this->conn->prepare("SELECT * FROM phones");
        $getAllPlayers->execute();
        $row = $getAllPlayers->fetchAll();

        return $row;
    }

    public function getByFieldColor($fieldValue): array
    {
        $getPlayerByField = $this->conn->prepare("Select * from phones where color = ?");
        $getPlayerByField->execute(array($fieldValue));

        $row = $getPlayerByField->fetch();
        return $row;
    }
}


$phone = new Phone(5, "ssas", "ssas", 11);
$mapper = new Mapper();
//$mapper->save($phone);
//$mapper->remove($phone);
$sa = $mapper->all();

var_dump($sa);
echo "<p>-------<p>";
$sa = $mapper->getByID(1);

var_dump($sa);
echo "<p>-------<p>";
$sa = $mapper->getByFieldColor("ssas");

var_dump($sa);

