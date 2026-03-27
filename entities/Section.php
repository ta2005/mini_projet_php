<?php
   class Section{
      //this mean that this value can be null
      private string $designation;
      private string $description;
      private ?int $id;
      /*    public function __construct(private string $designation, */
      /*    private string $description, */
      /*    private ?int $id */
      /* ) {} */
      public function setId($id){
	 $this->id=$id;
      }
      public function __toString():string{
	 return "$this->id $this->designation $this->description";
      }


   }
?>
