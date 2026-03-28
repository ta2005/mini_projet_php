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

      public function toHtml(string $role):string{
	 $format = '<tr>
	    <td>%d</td>
	    <td><img src=\"%s\" width=40 height=40 alt=Profile></td>
	    <td>%s</td>
	    <td>%s</td>
	    <td>%s</td>
	    %s
	    </tr>';

	       $result=($role==='admin')? 
		  "<td>
		  <div>
		     <form action=delete_etud.php method=\"POST\">
			<input type=\"hidden\" name=id value=$this->id>
			<button>Delete</button>
		     </form>
		     <form action=edit_etud.php method=\"POST\">
			<input type=\"hidden\" name=\"id\" value=$this->id>
			<button>edit</button>
		     </form>
		  </div>
		  </td>":"";
	       return sprintf($format,
	       $this->id,
	       htmlspecialchars($this->img),
	       htmlspecialchars($this->name),
	       $this->date_de_naiss->format('Y-m-d'),
	       htmlspecialchars((string) $this->section),
	       $result,
	    );

	 }

      }
      /* $a = new Etudiant("talel",new DateTimeImmutable("2024-12-2"),"tabssi",1,1); */
      /* echo $a->toHtml("admin"); */
   ?>


