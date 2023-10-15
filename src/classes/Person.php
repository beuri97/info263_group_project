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
    protected $homeWorldId;
    protected $homeWorld;
    protected $species;
    protected $image;

    function __construct($id, $name, $height, $mass, $hairColor, $skinColor, $eyeColor, $birth, $gender, $homeWorldId, $homeWorld,
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
        $this->homeWorldId = $homeWorldId;
        $this->homeWorld = $homeWorld;
        $this->species = $species;
        $this->image = $image;
    }


    public static function peopleCount()
    {
        try {
            $open_review_s_db = new PDO("sqlite:" . '../src/resources/star_wars.db');
            $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //get count of people:
            $cast = $open_review_s_db->query("SELECT count(*) as num FROM people");
            $result = $cast->fetch(PDO::FETCH_ASSOC);
            $open_review_s_db = null;
            return $result['num'];

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    public static function searchPeople($query)
    {
        try {
            $open_review_s_db = new PDO("sqlite:" . '../src/resources/star_wars.db');
            $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Search for people:
            $queryParam = $query . '%'; // Add a '%' to match names starting with the query
            $cast = $open_review_s_db->prepare("SELECT * FROM people WHERE people_name LIKE :query");
            $cast->bindParam(':query', $queryParam, PDO::PARAM_STR);
            $cast->execute();
            //all results list
            $results = [];

            while ($row = $cast->fetch(PDO::FETCH_ASSOC)) {
                // Create Person objects and populate them with data
                $img = explode('/revision', $row['image_url']);
                $person = new Person($row['peopleID'], $row['people_name'], $row['people_height'], $row['people_mass'],
                    $row['people_hair_color'], $row['people_skin_color'], $row['people_eye_color'], $row['people_birth_year'],
                    $row['people_gender'], $row['people_homeworld_id'], null, null, $img[0]);
                $results[] = $person;
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

            $cast = $open_review_s_db->query("SELECT * FROM people WHERE peopleID = " . $id);
            $result = $cast->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null; // No matching record found
            }

            $species = $open_review_s_db->query("SELECT * FROM species WHERE speciesID = " . $result['people_species_id']);
            $speciesResult = $species->fetch(PDO::FETCH_ASSOC);

            $homeworld = $open_review_s_db->query("SELECT * FROM planet WHERE planetID = " . $result['people_homeworld_id']);
            $homeworldResult = $homeworld->fetch(PDO::FETCH_ASSOC);

            $open_review_s_db = null;

            if (!$speciesResult) {
                $img = explode('/revision', $result['image_url']);
                return new Person($result['peopleID'], $result['people_name'], $result['people_height'], $result['people_mass'],
                    $result['people_hair_color'], $result['people_skin_color'], $result['people_eye_color'], $result['people_birth_year'],
                    $result['people_gender'], $result['people_homeworld_id'], $homeworldResult['planet_name'], null, $img[0]);
            }

            if (!$homeworldResult) {
                $img = explode('/revision', $result['image_url']);
                return new Person($result['peopleID'], $result['people_name'], $result['people_height'], $result['people_mass'],
                    $result['people_hair_color'], $result['people_skin_color'], $result['people_eye_color'], $result['people_birth_year'],
                    $result['people_gender'], $result['people_homeworld_id'], null, $speciesResult['species_name'], $img[0]);
            }


            $img = explode('/revision', $result['image_url']);
            return new Person($result['peopleID'], $result['people_name'], $result['people_height'], $result['people_mass'],
                $result['people_hair_color'], $result['people_skin_color'], $result['people_eye_color'], $result['people_birth_year'],
                $result['people_gender'], $result['people_homeworld_id'], $homeworldResult['planet_name'], $speciesResult['species_name'], $img[0]);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    public function getPlanetImage($planetId)
    {
        try {
            $open_review_s_db = new PDO("sqlite:" . '../src/resources/star_wars.db');
            $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $homeworld = $open_review_s_db->query("SELECT * FROM planet WHERE planetID = " . $planetId);
            $homeworldResult = $homeworld->fetch(PDO::FETCH_ASSOC);
            $img = explode('/revision', $homeworldResult['image_url']);
            if ($img[0] != NULL){
                return $img[0];
            } else {
                return "img/noimage.png";
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
    public function getHomeWorldId()
    {
        return $this->homeWorldId;
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