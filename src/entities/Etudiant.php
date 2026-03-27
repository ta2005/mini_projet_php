<?php
   class Etudiant{
      //this mean that this value can be null

      public function __construct(
				    private string $name,
				    private DateTimeImmutable $date_de_naiss,
				    private string $img,
				    private int $section,
				    private ?int $id=null
			){}

      /*    public function __construct(private string $designation, */
      /*    private string $description, */
      /*    private ?int $id */
      /* ) {} */
      public function setId($id){
	 $this->id=$id;
      }
      public function getId():?int{
	 return $this->id;
      }
      public function __toString():string{
	 return "$this->id $this->name".$this->date_de_naiss->format('Y-M-D').$this->img;
      }


   }
?>


