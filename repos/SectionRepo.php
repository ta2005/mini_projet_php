<?php
class SectionRepo{

    public function __construct(private $pdo) {}

    public function getSectionDesign() {
        return $this->pdo->query("
            SELECT DISTINCT ON (designation) id, designation
            FROM section
            ORDER BY designation, id ASC
        ")->fetchAll();
    }

    public function getSectionAll() {
        return $this->pdo->query("
            SELECT * FROM section ORDER BY id ASC
        ")->fetchAll();
    }
}
?>
