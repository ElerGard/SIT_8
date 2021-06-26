<?php

Class Phone {
    public int $serialNumber;
    public string $model;
    public string $color;
    public float $screenSize;

    public function setId(int $id) {
        $this->id = $id;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function __construct(int $serialNumber, string $model, string $color, float $screenSize) {
        $this->serialNumber = $serialNumber;
        $this->model = $model;
        $this->color = $color;
        $this->screenSize = $screenSize;
    }
}

Class Mapper{
    private PDO $conn;

    public function __construct() { $conn = new PDO("mysql:host=localhost;dbname=Phone", 'elergard', '13254'); }

    public function save(Phone $phone) {
        $newPhone = "Insert Into phones(serialNumber, model, color, screenSize) Values(?, ?, ?, ?)";
        $addPhone = $this->conn->prepare($newPhone);
        $addPhone->execute(array($this->serialNumber, $this->model, $this->color, $this->screenSize));
    }

    public function remove(Phone $phone) {
        $deletePhone = "Delete from phones where serialNumber = ?";
        $delPhone = $this->conn->prepare($deletePhone);
        $delPhone->execute(array($this->serialNumber));
    }

    public function getById($id) {
        $getPlayer = $this->conn->prepare("Select * from phones where serialNumber = ? ");
        $getPlayer->execute();
        $row = $getPlayer->fetchAll();

        return new Phone($row['serialNumber'],$row['model'],$row['color'],$row['screenSize']);
    }

    public function all() {
        $getAllPlayers = $this->conn->prepare("SELECT * FROM phones");
        $getAllPlayers->execute();
        $row = $getAllPlayers->fetchAll();

        return $row;
    }

    public function getByField($field, $fieldValue): array
    {

        $getPlayerByField = $this->conn->prepare("Select ? from players where ? = ? ");
        $getPlayerByField->execute(array($field, $field, $fieldValue));
        $row = $getPlayerByField->fetchAll();
        return $row;
    }
}