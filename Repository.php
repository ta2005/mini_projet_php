<?php

class Repository
{
    protected $bd;
    protected $tableName;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->bd = ConnexionBD::getInstance();
    }

    
    public function findAll()
    {
        $query = "SELECT * FROM " . $this->tableName;
        $stmt = $this->bd->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ligne par id

    public function findEtudiantById($id)
    {
        $query = "SELECT e.id, e.name, e.date_de_naiss, e.img, e.section_id, s.des AS section_nom
              FROM etudiant e
              LEFT JOIN section s ON e.section_id = s.id
              WHERE e.id = :id";
        $stmt = $this->bd->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
}

    // ligne par username
    public function findByUserName($username)
    {
        $query = "SELECT * FROM " . $this->tableName . " WHERE name = :username";
        $stmt = $this->bd->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
//  etudiants avec leur section
public function findEtudiantsAndSection()
{
    $query = "SELECT e.id, e.name, e.date_de_naiss, e.img, s.des AS section_nom
              FROM etudiant e
              LEFT JOIN section s ON e.section_id = s.id";
    $stmt = $this->bd->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//add eleve
public function insert($name, $date_de_naiss, $img, $section)
{
    $query = "INSERT INTO etudiant (name, date_de_naiss, img, section_id) 
              VALUES (:name, :date_de_naiss, :img, :section)";
    $stmt = $this->bd->prepare($query);
    $stmt->bindParam(':name',         $name);
    $stmt->bindParam(':date_de_naiss',$date_de_naiss);
    $stmt->bindParam(':img',          $img);
    $stmt->bindParam(':section',      $section);
    $stmt->execute();
}

// modifier 
public function update($id, $name, $date_de_naiss, $img, $section)
{
    $query = "UPDATE etudiant 
              SET name = :name, 
                  date_de_naiss = :date, 
                  img = :img, 
                  section_id = :section
              WHERE id = :id";
    $stmt = $this->bd->prepare($query);
    $stmt->bindParam(':id',      $id);
    $stmt->bindParam(':name',    $name);
    $stmt->bindParam(':date',    $date_de_naiss);
    $stmt->bindParam(':img',     $img);
    $stmt->bindParam(':section', $section);
    $stmt->execute();
}

public function delete($id)
{
    $query = "DELETE FROM " . $this->tableName . " WHERE id = :id";
    $stmt = $this->bd->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}
public function findEtudiantsAndSectionPagine($limite, $offset)
{
    $query = "SELECT e.id, e.name, e.date_de_naiss, e.img, s.des AS section_nom
              FROM etudiant e
              LEFT JOIN section s ON e.section_id = s.id
              LIMIT :limite OFFSET :offset";
    $stmt = $this->bd->prepare($query);
    $stmt->bindParam(':limite',  $limite,  PDO::PARAM_INT);
    $stmt->bindParam(':offset',  $offset,  PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function countEtudiants()
{
    $query = "SELECT COUNT(*) FROM etudiant";
    $stmt  = $this->bd->prepare($query);
    $stmt->execute();
    return (int) $stmt->fetchColumn();
}
}