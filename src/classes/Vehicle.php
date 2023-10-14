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


    public static function searchVehicle($query)
    {
        try {
            $open_review_s_db = new PDO("sqlite:" . '../src/resources/star_wars.db');
            $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Search for vehicles:
            $queryParam = $query . '%'; // Add a '%' to match names starting with the query
            $vehicles = $open_review_s_db->prepare("SELECT * FROM vehicle WHERE vehicle_name LIKE :query");
            $vehicles->bindParam(':query', $queryParam, PDO::PARAM_STR);
            $vehicles->execute();
            //all results list
            $results = [];

            while ($row = $vehicles->fetch(PDO::FETCH_ASSOC)) {
                // Create Vehicle objects and populate them with data
                $img = explode('/revision', $row['image_url']);
                $vehicle = new Vehicle($row['vehicleID'], $row['vehicle_name'], $row['vehicle_model'], $row['vehicle_cost_in_credits'],
                    $row['vehicle_length'], $row['vehicle_max_atmosphering_speed'], $row['vehicle_crew'], $row['vehicle_passengers'],
                    $row['vehicle_cargo_capacity'], $row['vehicle_consumables'], $row['vehicleclassID'],
                    $img[0], null, null);
                $results[] = $vehicle;
            }

            $open_review_s_db = null;
            return $results;

        } catch (PDOException $e) {
            die($e->getMessage());
        }
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
            $open_review_s_db = null;
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