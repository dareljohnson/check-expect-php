<?php
// Turn off all error reporting
error_reporting(0);

require '../vendor/autoload.php';

require '../src/check-expect.php';

// HtDD and HtDF examples

function square($a)
{
    return (int)($a) * (int)($a);
};

function multiply($a, $b)
{
    return (int)($a) * (int)($b);
};

function add()
{
	$arguments = func_get_args();
    $total = 0;
    $num = 0;
    $numArgs = func_num_args();

    for ($i = 0;$i < $numArgs; $i++)
    {
        $num = $arguments[$i];
        $total +=  (int)$num;
    }
    return $total;
};

function stringTogether()
{
    $arguments = func_get_args();
    $newStr = "";
    $str = "";
    $numArgs = func_num_args();
    
    for ($i = 0;$i < $numArgs;$i++)
    {
        $str = $arguments[$i];
        $newStr .= (string)$str ." ";
    }
    return trim($newStr);
};

class Person{
	protected $firstName = "John";
	protected $lastName = "Doe";
	
	public function fullName(){
		return $this->firstName ." ". $this->lastName;
	}
}

//-- mode
$void_mode = 0;   
$normal_mode = 1;
$list_mode = 2;

//---Tests 
$param2 = 10;
$listOfNumbers1 = [3, 6];
$param3 = ["Darel", "Johnson"];
$str1 = "Darel";
$str2 = "Johnson";
$Person = new Person();

checkExpect(square, $normal_mode, $param2, 10 * 10, "squaring to nums");
checkExpect(add, $list_mode, $listOfNumbers1, 3 + 6 , "adding a list of nums");
checkExpect(stringTogether, $list_mode, $param3, $str1 . " ". $str2);
checkExpect(array($Person, "fullName") , $void_mode, "void", "John Doe", "Person object test for fullnames");

sendToSystemConsole();

printTestResultsToSystem();

//call_user_func("printTestResults");

//foreach($tests as $test) { echo $test ."<br/><br/>"; };

//sendToConsole();
?>
<?php
/*
<div><p><?= $test?></p><br/></div>
<div>
<p><?="Of " .  $results["total"]
    . " tests, " .  $results['bad'] . " failed, "
    . ((int)$results["total"] - (int)$results['bad']) . " passed." ?></p>
</div>
*/
?>