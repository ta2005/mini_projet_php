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
      public function getId():?int{
	 return $this->id;
      }
      public function __toString():string{
	 return "$this->id $this->designation $this->description";
      }

      public function toHtml():string{
	 $format = "<tr>
	    <td>%d</td>
	    <td>%s</td>
	    <td>%s</td>
	    <td><form method=\"GET\" action=\"home.php\">
	       <input type=\"hidden\" value=$this->id name=\"id\">
	       <button>go</botton>
	    </form>
	    </td>;
	    </tr>";
	       return sprintf($format,
	       $this->id,
	       htmlspecialchars($this->designation),
	       htmlspecialchars($this->description),
	       $this->id);

	 }

   }
?>
