<?php

class Manufacturer
{
    protected $id;
    protected $name;
    protected $img;

    /**
     * @param $id
     * @param $name
     * @param $img
     */
    public function __construct($id, $name, $img)
    {
        $this->id = $id;
        $this->name = $name;
        $this->img = $img;
    }

    public static function findById($id) {
        try {
            $open_review_s_db = new PDO("sqlite:" . '../src/resources/star_wars.db');
            $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $manufacturer = $open_review_s_db->query("SELECT * FROM manufacturer WHERE manufacturerID = " . $id);
            $result = $manufacturer->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null; // No matching record found
            }

            $img = explode('/revision', $result['image_url']);
            return new Manufacturer($result['manufacturerID'], $result['vehicle_manufacturer'], $img[0]);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        if ($this->img){
            return $this->img;
        } else {
            return "img/noimage.png";
        }
    }



}