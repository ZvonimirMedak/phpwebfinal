<?php

class Item
{
    // table name definition and database connection
    public $db_conn;
    public $table_name = "cvarciitems";

    // object properties
    public $id;
    public $name;
    public $amount;
    public $price;
    public $imageURL;


    public function __construct($db)
    {
        $this->db_conn = $db;
    }


    public function create()
    {
        $sql = "INSERT INTO " . $this->table_name . " SET name = ?, amount = ?, price = ?, imageURL = ?";

        $prep_state = $this->db_conn->prepare($sql);

        $prep_state->bindParam(1, $this->name);
        $prep_state->bindParam(2, $this->amount);
        $prep_state->bindParam(3, $this->price);
        $prep_state->bindParam(4, $this->imageURL);
        if ($prep_state->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function countAll()
    {
        $sql = "SELECT id FROM " . $this->table_name . "";

        $prep_state = $this->db_conn->prepare($sql);
        $prep_state->execute();

        $num = $prep_state->rowCount(); //Returns the number of rows affected by the last SQL statement
        return $num;
    }

    public function update()
    {
        $sql = "UPDATE " . $this->table_name . " SET name = :name, amount = :amount, price = :price, imageURL = :imageURL WHERE id = :id";
        // prepare query
        $prep_state = $this->db_conn->prepare($sql);


        $prep_state->bindParam(':name', $this->name);
        $prep_state->bindParam(':amount', $this->amount);
        $prep_state->bindParam(':price', $this->price);
        $prep_state->bindParam(':id', $this->id);
        $prep_state->bindParam(':imageURL', $this->imageURL);

        // execute the query
        if ($prep_state->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table_name . " WHERE id = :id ";

        $prep_state = $this->db_conn->prepare($sql);
        $prep_state->bindParam(':id', $this->id);

        if ($prep_state->execute(array(":id" => $id))) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllItems()
    {
        $sql = "SELECT id, name, amount, price, imageURL FROM " . $this->table_name . " ORDER BY name ASC";


        $prep_state = $this->db_conn->prepare($sql);
        $prep_state->execute();

        return $prep_state;
        $db_conn = NULL;
    }

    function getItem()
    {
        $sql = "SELECT name, amount, price, imageURL FROM " . $this->table_name . " WHERE id = :id";

        $prep_state = $this->db_conn->prepare($sql);
        $prep_state->bindParam(':id', $this->id);
        $prep_state->execute();

        $row = $prep_state->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->amount = $row['amount'];
        $this->price = $row['price'];
        $this->imageURL = $row['imageURL'];
    }
}