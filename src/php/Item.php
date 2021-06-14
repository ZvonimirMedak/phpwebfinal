<?php

class Item
{
    // table name definition and database connection
    public $db_conn;
    public $table_name = "items";

    // object properties
    public $id;
    public $name;
    public $amount;
    public $price;


    public function __construct($db)
    {
        $this->db_conn = $db;
    }


    function create()
    {
        //write query
        $sql = "INSERT INTO " . $this->table_name . " SET name = ?, amount = ?, price = ?";

        $prep_state = $this->db_conn->prepare($sql);

        $prep_state->bindParam(1, $this->name);
        $prep_state->bindParam(2, $this->amount);
        $prep_state->bindParam(3, $this->price);

        if ($prep_state->execute()) {
            return true;
        } else {
            return false;
        }

    }

    // for pagination
    public function countAll()
    {
        $sql = "SELECT id FROM " . $this->table_name . "";

        $prep_state = $this->db_conn->prepare($sql);
        $prep_state->execute();

        $num = $prep_state->rowCount(); //Returns the number of rows affected by the last SQL statement
        return $num;
    }


    function update()
    {
        $sql = "UPDATE " . $this->table_name . " SET name = :name, amount = :amount, price = :price WHERE id = :id";
        // prepare query
        $prep_state = $this->db_conn->prepare($sql);


        $prep_state->bindParam(':name', $this->name);
        $prep_state->bindParam(':amount', $this->amount);
        $prep_state->bindParam(':price', $this->price);
        $prep_state->bindParam(':id', $this->id);

        // execute the query
        if ($prep_state->execute()) {
            return true;
        } else {
            return false;
        }
    }


    function delete($id)
    {
        $sql = "DELETE FROM " . $this->table_name . " WHERE id = :id ";

        $prep_state = $this->db_conn->prepare($sql);
        $prep_state->bindParam(':id', $this->id);

        if ($prep_state->execute(array(":id" => $_GET['id']))) {
            return true;
        } else {
            return false;
        }
    }


    function getAllItems()
    {
        $sql = "SELECT id, name, amount, price FROM " . $this->table_name . " ORDER BY name ASC LIMIT ?, ?";


        $prep_state = $this->db_conn->prepare($sql);


       // $prep_state->bindParam(1, $from_record_num, PDO::PARAM_INT); //Represents the SQL INTEGER data type.
        //$prep_state->bindParam(2, $records_per_page, PDO::PARAM_INT);


        $prep_state->execute();

        return $prep_state;
        $db_conn = NULL;
    }

    // for edit user form when filling up
    function getItem()
    {
        $sql = "SELECT name, amount, price FROM " . $this->table_name . " WHERE id = :id";

        $prep_state = $this->db_conn->prepare($sql);
        $prep_state->bindParam(':id', $this->id);
        $prep_state->execute();

        $row = $prep_state->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->amount = $row['amount'];
        $this->price = $row['price'];
    }


}