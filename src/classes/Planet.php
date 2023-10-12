<?php

class Planet
{
    protected $id;
    protected $name;
    protected $rotation;
    protected $orbit;
    protected $diameter;
    protected $gravity;
    protected $water;
    protected $population;
    protected $climateId;
    protected $climate;
    protected $terrainId;
    protected $terrain;
    protected $image;

    /**
     * @param $id
     * @param $name
     * @param $rotation
     * @param $orbit
     * @param $diameter
     * @param $gravity
     * @param $water
     * @param $population
     * @param $gender
     * @param $climateId
     * @param $climate
     * @param $terrainId
     * @param $terrain
     * @param $image
     */
    public function __construct($id, $name, $rotation, $orbit, $diameter, $gravity, $water, $population, $climateId, $climate, $terrainId, $terrain, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->rotation = $rotation;
        $this->orbit = $orbit;
        $this->diameter = $diameter;
        $this->gravity = $gravity;
        $this->water = $water;
        $this->population = $population;
        $this->climateId = $climateId;
        $this->climate = $climate;
        $this->terrainId = $terrainId;
        $this->terrain = $terrain;
        $this->image = $image;
    }

    public static function findById($id) {
        try {
            $open_review_s_db = new PDO("sqlite:" . '../src/resources/star_wars.db');
            $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $planets = $open_review_s_db->query("SELECT * FROM planet WHERE planetID = " . $id);
            $result = $planets->fetch(PDO::FETCH_ASSOC);

            $climate = $open_review_s_db->query("SELECT * FROM climate WHERE planetClimateID IN (SELECT climateID FROM planet_climate WHERE planetID = " . $id . ")");
            $climateResult = $climate->fetch(PDO::FETCH_ASSOC);

            $terrain = $open_review_s_db->query("SELECT * FROM terrain WHERE planetTerrainID IN (SELECT terrainID FROM planet_terrain WHERE planetID = " . $id . ")");
            $terrainResult = $terrain->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null; // No matching record found
            }

            $img = explode('/revision', $result['image_url']);
            return new Planet($result['planetID'], $result['planet_name'], $result['planet_rotation_period'], $result['planet_orbital_period'],
                $result['planet_diameter'], $result['planet_gravity'], $result['planet_surface_water'], $result['planet_population'],
                $climateResult['planetclimateID'], $climateResult['planet_climate'], $terrainResult['planetterrainID'], $terrainResult['planet_terrain'], $img[0]);

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
    public function getRotation()
    {
        return $this->rotation;
    }

    /**
     * @return mixed
     */
    public function getOrbit()
    {
        return $this->orbit;
    }

    /**
     * @return mixed
     */
    public function getDiameter()
    {
        return $this->diameter;
    }

    /**
     * @return mixed
     */
    public function getGravity()
    {
        return $this->gravity;
    }

    /**
     * @return mixed
     */
    public function getWater()
    {
        return $this->water;
    }

    /**
     * @return mixed
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * @return mixed
     */
    public function getClimateId()
    {
        return $this->climateId;
    }

    /**
     * @return mixed
     */
    public function getClimate()
    {
        return $this->climate;
    }

    /**
     * @return mixed
     */
    public function getTerrainId()
    {
        return $this->terrainId;
    }

    /**
     * @return mixed
     */
    public function getTerrain()
    {
        return $this->terrain;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        if ($this->image != NULL){
            return $this->image;
        } else {
            return "img/noimage.png";
        }

    }



}