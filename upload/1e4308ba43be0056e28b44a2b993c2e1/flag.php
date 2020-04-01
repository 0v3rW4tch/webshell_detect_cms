<?
class Student
{
    public $score = 0;

}
$e = new Student();
$e->score = 10000; 
echo serialize($e);

?>