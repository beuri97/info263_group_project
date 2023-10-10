<?php

class Vehicle
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
    protected $classID;
    protected $image;
    protected $manufacturerID;
    protected $vehicle_class;

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
     * @param $classID
     * @param $image
     * @param $manufacturerID
     * @param $vehicle_class
     */
    public function __construct($id, $name, $model, $cost, $length, $maxSpeed, $crew, $passengers, $cargoCapacity, $consumes, $classID, $image, $manufacturerID, $vehicle_class)
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
        $this->classID = $classID;
        $this->image = $image;
        $this->manufacturerID = $manufacturerID;
        $this->vehicle_class = $vehicle_class;
    }


    public static function findById($id) {
        try {
            $open_review_s_db = new PDO("sqlite:" . '../src/resources/star_wars.db');
            $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $vehicle = $open_review_s_db->query("SELECT * FROM vehicle WHERE vehicleID = " . $id);
            $result = $vehicle->fetch(PDO::FETCH_ASSOC);

            $manufacturer = $open_review_s_db->query("SELECT * FROM vehicle_manufacturer WHERE vehicleID = " . $id);
            $resultManufacturer = $manufacturer->fetch(PDO::FETCH_ASSOC);

            $vehicleClass = $open_review_s_db->query("SELECT * FROM vehicleclass WHERE vehicleclassID = " . $result['vehicleclassID']);
            $resultVehicleClass = $vehicleClass->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null; // No matching record found
            }

            $img = explode('/revision', $result['image_url']);
            return new Vehicle($result['vehicleID'], $result['vehicle_name'], $result['vehicle_model'], $result['vehicle_cost_in_credits'],
                $result['vehicle_length'], $result['vehicle_max_atmosphering_speed'], $result['vehicle_crew'], $result['vehicle_passengers'],
                $result['vehicle_cargo_capacity'], $result['vehicle_consumables'], $result['vehicleclassID'],
                $img[0], $resultManufacturer['manufacturerID'], $resultVehicleClass['vehicle_class']);

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
    public function getClassID()
    {
        return $this->classID;
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
    public function getManufacturerID()
    {
        return $this->manufacturerID;
    }

    /**
     * @return mixed
     */
    public function getVehicleClass()
    {
        return $this->vehicle_class;
    }


}