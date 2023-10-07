<?php


class Person
{
    protected $id;
    protected $name;
    protected $height;
    protected $mass;
    protected $hairColor;
    protected $skinColor;
    protected $eyeColor;
    protected $birth;
    protected $gender;
    protected $homeWorld;
    protected $species;
    protected $image;

    function __construct($id, $name, $height, $mass, $hairColor, $skinColor, $eyeColor, $birth, $gender, $homeWorld,
                         $species, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->height = $height;
        $this->mass = $mass;
        $this->hairColor = $hairColor;
        $this->skinColor = $skinColor;
        $this->eyeColor = $eyeColor;
        $this->birth = $birth;
        $this->gender = $gender;
        $this->homeWorld = $homeWorld;
        $this->species = $species;
        $this->image = $image;
    }

    public static function findById($id) {
        try {
            $open_review_s_db = new PDO("sqlite:" . '../src/resources/star_wars.db');
            $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $cast = $open_review_s_db->query("SELECT * FROM people WHERE peopleID = " . $id);
            $result = $cast->fetch(PDO::FETCH_ASSOC);

            $species = $open_review_s_db->query("SELECT * FROM species WHERE speciesID = " . $id);
            $speciesResult = $species->fetch(PDO::FETCH_ASSOC);

            $homeworld = $open_review_s_db->query("SELECT * FROM planet WHERE planetID = " . $id);
            $homeworldResult = $homeworld->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null; // No matching record found
            }

            $img = explode('/revision', $result['image_url']);
            return new Person($result['peopleID'], $result['people_name'], $result['people_height'], $result['people_mass'],
                $result['people_hair_color'], $result['people_skin_color'], $result['people_eye_color'], $result['people_birth_year'],
                $result['people_gender'], $homeworldResult['planet_name'], $speciesResult['species_name'], $img[0]);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
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
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return mixed
     */
    public function getMass()
    {
        return $this->mass;
    }

    /**
     * @return mixed
     */
    public function getHairColor()
    {
        return $this->hairColor;
    }

    /**
     * @return mixed
     */
    public function getSkinColor()
    {
        return $this->skinColor;
    }

    /**
     * @return mixed
     */
    public function getEyeColor()
    {
        return $this->eyeColor;
    }

    /**
     * @return mixed
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return mixed
     */
    public function getHomeWorld()
    {
        return $this->homeWorld;
    }

    /**
     * @return mixed
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }







}