<?php
require_once '../database/Database.php';
class Pays
{
    private $id_pays;
    private $nom;
    private $population;
    private $langues_officielles;
    private $p_description;
    private $continent;
    private $img_pays;
    private $id_continent_fk;


    public function __construct($id_pays, $nom, $population, $langues_officielles, $p_description, $continent, $img_pays, $id_continent_fk)
    {
        $this->id_pays = $id_pays;
        $this->nom = $nom;
        $this->population = $population;
        $this->langues_officielles = $langues_officielles;
        $this->p_description = $p_description;
        $this->continent = $continent;
        $this->img_pays = $img_pays;
        $this->id_continent_fk = $id_continent_fk;
    }

    public function getdata()
    {
        $db = new Database();
        $sql = "SELECT * from pays";
        $stmt = $this->$db->prepare($sql);
        return $stmt->execute();
    }

}
;


$tes1 = new Pays(1,"charaf",20555,"arb","arb","arb","arb","arb");
$data=$tes1->getdata();
echo "Pays :";
echo "<br>";
var_dump($data);



