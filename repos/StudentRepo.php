<?php

class StudentRepo {

    public function __construct(private $pdo) {}

    public function getAllStudentsAndSections() {
        return $this->pdo->query("
            SELECT e.id, e.name, e.date_de_naissance, e.img_url, s.designation as section_dsg
            FROM etudiant e
            LEFT JOIN section s ON e.section_id = s.id
            ORDER BY e.id ASC
        ")->fetchAll();
    }

    public function getStudentById($id) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM etudiant WHERE id = ?
        ");
        $stmt->execute([$id]);

        $etudiant = $stmt->fetch();
        return $etudiant;
    }

    public function getStudentDetailsAndSection($id) {
        $stmt = $this->pdo->prepare("
            SELECT e.*, s.designation, s.description
            FROM etudiant e
            LEFT JOIN section s ON e.section_id = s.id
            WHERE e.id = ?
        ");
        $stmt->execute([$id]);

        $etudiant = $stmt->fetch();
        return $etudiant;
    }

    public function createStudent($name, $ddn, $img_url, $section_id) {
        $stmt = $this->pdo->prepare("
            INSERT INTO etudiant (name, date_de_naissance, img_url, section_id)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$name, $ddn, $img_url, $section_id]);
    }

    public function updateStudent($id, $name, $ddn, $img_url, $section_id) {
        $stmt = $this->pdo->prepare("
            UPDATE etudiant
            SET name = ?, date_de_naissance = ?, img_url = ?, section_id = ?
            WHERE id = ?
        ");
        return $stmt->execute([$name, $ddn, $img_url, $section_id, $id]);
    }

    public function deleteStudent($id) {
        $stmt = $this->pdo->prepare("DELETE FROM etudiant WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

?>
