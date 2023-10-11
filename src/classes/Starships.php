<?php

class Starships
{
    protected $id;
    protected $name;
    protected $model;
    protected $cost;
    protected $length;
    protected $maxSpeed;
    protected $crew;
    protected $passengers;
    protected $cargoCapacity;
    protected $consumes;
    protected $hyperdriveRating;
    protected $MGLT;
    protected $classID;
    protected $image;
    protected $manufacturerID;
    protected $starship_class;

    /**
     * @param $id
     * @param $name
     * @param $model
     * @param $cost
     * @param $length
     * @param $maxSpeed
     * @param $crew
     * @param $passengers
     * @param $cargoCapacity
     * @param $consumes
     * @param $hyperdriveRating
     * @param $MGLTSpeed
     * @param $classID
     * @param $image
     */
    public function __construct($id, $name, $model, $cost, $length, $maxSpeed, $crew, $passengers, $cargoCapacity,
                                $consumes, $hyperdriveRating, $MGLT, $classID, $image, $manufacturerID, $starship_class)
    {
        $this->id = $id;
        $this->name = $name;
        $this->model = $model;
        $this->cost = $cost;
        $this->length = $length;
        $this->maxSpeed = $maxSpeed;
        $this->crew = $crew;
        $this->passengers = $passengers;
        $this->cargoCapacity = $cargoCapacity;
        $this->consumes = $consumes;
        $this->hyperdriveRating = $hyperdriveRating;
        $this->MGLT = $MGLT;
        $this->classID = $classID;
        $this->image = $image;
        $this->manufacturerID = $manufacturerID;
        $this->starship_class = $starship_class;
    }


    public static function findById($id) {
        try {
            $open_review_s_db = new PDO("sqlite:" . '../src/resources/star_wars.db');
            $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $starship = $open_review_s_db->query("SELECT * FROM starship WHERE starshipID = " . $id);
            $result = $starship->fetch(PDO::FETCH_ASSOC);

            $manufacturer = $open_review_s_db->query("SELECT * FROM starship_manufacturer WHERE starshipID = " . $id);
            $resultManufacturer = $manufacturer->fetch(PDO::FETCH_ASSOC);

            $starshipClass = $open_review_s_db->query("SELECT * FROM starshipclass WHERE starshipclassID = " . $result['starshipclassID']);
            $resultStarshipClass = $starshipClass->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null; // No matching record found
            }
            $img = explode('/revision', $result['image_url']);

            if ($resultManufacturer){
                return new Starships($result['starshipID'], $result['starship_name'], $result['starship_model'], $result['starship_cost_in_credits'],
                    $result['starship_length'], $result['starship_max_atmosphering_speed'], $result['starship_crew'], $result['starship_passengers'],
                    $result['starship_cargo_capacity'], $result['starship_consumables'], $result['starship_hyperdrive_rating'],
                    $result['starship_MGLT'], $result['starshipclassID'], $img[0], $resultManufacturer['manufacturerID'], $resultStarshipClass['starship_class']);
            } else {
                return new Starships($result['starshipID'], $result['starship_name'], $result['starship_model'], $result['starship_cost_in_credits'],
                    $result['starship_length'], $result['starship_max_atmosphering_speed'], $result['starship_crew'], $result['starship_passengers'],
                    $result['starship_cargo_capacity'], $result['starship_consumables'], $result['starship_hyperdrive_rating'],
                    $result['starship_MGLT'], $result['starshipclassID'], $img[0], 10, $resultStarshipClass['starship_class']);
            }



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
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return mixed
     */
    public function getMaxSpeed()
    {
        return $this->maxSpeed;
    }

    /**
     * @return mixed
     */
    public function getCrew()
    {
        return $this->crew;
    }

    /**
     * @return mixed
     */
    public function getPassengers()
    {
        return $this->passengers;
    }

    /**
     * @return mixed
     */
    public function getCargoCapacity()
    {
        return $this->cargoCapacity;
    }

    /**
     * @return mixed
     */
    public function getConsumes()
    {
        return $this->consumes;
    }

    /**
     * @return mixed
     */
    public function getHyperdriveRating()
    {
        return $this->hyperdriveRating;
    }

    /**
     * @return mixed
     */
    public function getMGLT()
    {
        return $this->MGLT;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getClassID()
    {
        return $this->classID;
    }

    /**
     * @return mixed
     */
    public function getManufacturerID()
    {
        return $this->manufacturerID;
    }

    /**
     * @return mixed
     */
    public function getStarshipClass()
    {
        return $this->starship_class;
    }






}

