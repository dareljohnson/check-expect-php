<?php

// CheckExpect

$messages = array();

function consoleLog($msg) {
    global $messages;
    array_push($messages, $msg);
};

function sendToConsole(){
   global $messages;

   echo '<script type="text/javascript">';
   foreach($messages as $msg) { 
       echo 'console.log('; 
       echo json_encode(html_entity_decode($msg, ENT_HTML5),JSON_HEX_TAG);
       echo ');';
   };
   echo '</script>';
};

function sendToSystemConsole(){
    global $messages;
 
    foreach($messages as $msg) { 
        echo $msg ."\n";

    };
 };

$results = array(
	"total" => 0,
	"bad" => 0
	);

function printTestResults(){
    global $results;
    consoleLog('=========================================');
    consoleLog("Of " .  $results["total"]
    . " tests, " .  $results['bad'] . " failed, "
    . ((int)$results["total"] - (int)$results['bad']) . " passed.");
};

function printTestResultsToSystem(){
    global $results;
    echo '=========================================' . PHP_EOL;
    echo "Of " .  $results["total"]
    . " tests, " .  $results['bad'] . " failed, "
    . ((int)$results["total"] - (int)$results['bad']) . " passed." . PHP_EOL;
};

$tests = array();

function checkExpect($f , $mode, $param , $expected , $name = "", $web = false)
{
    $result = NULL;
	global $results;
    global $tests;
	
    if ($mode <= 1)
    {
        $result = call_user_func($f, $param);
    }
    else if ($mode >= 2)
    {
        $result = call_user_func_array($f, $param);
    }
    else if ($mode === 0 || $param === "void")
    {
        $result = call_user_func($f);
    }

    if (isset($name) && $name !="")
    {
        $testname = "For unit test: " . $name;
        consoleLog($testname);
        array_push($tests, $testname);
    }
    else
    {
        $testname = "For unit test: " . "unknown test";
        consoleLog($testname);
        array_push($tests, $testname);
    }

    if ($result !== $expected)
    {
        $testfailed = ($web) ? "+test: " . '<span id="test" style="color:red">failed</span>' : "+test: FAILED!";
		array_push($tests,$testfailed);
        consoleLog($testfailed);
        $testresult = ($web) ? '<span id="test" style="color:red">Expected </span>' . $expected . ", but was " . $result 
                : "++Expected " . $expected . ", but was " . $result;
        consoleLog($testresult);
        $results['bad']++;
		$results['total']++;	
        array_push($tests,$testresult);
        return false;
    }
    else
    {
        $testpassed = ($web) ? "+test: " . '<span id="test" style="color:green">passed</span>' : "+test: PASSED";
        consoleLog($testpassed);
        $results['total']++;
        array_push($tests,$testpassed);
        return true;
    }
};


//-- mode
/*
$void_mode = 0;   
$normal_mode = 1;
$list_mode = 2;
*/
//---Tests 
/*
$param2 = 10;
$listOfNumbers1 = [3, 6];
$param3 = ["Darel", "Johnson"];
$str1 = "Darel";
$str2 = "Johnson";
$Person = new Person();
*/
//checkExpect(square, $normal_mode, $param2, 10 * 10, "squaring to nums");
//checkExpect(add, $list_mode, $listOfNumbers1, 3 + 6 , "adding a list of nums");
//checkExpect(stringTogether, $list_mode, $param3, $str1 . " ". $str2);
//checkExpect(array($Person, "fullName") , $void_mode, "void", "John Doe", "Person object test for fullnames");


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