<?php

//Variable
/*

auto déclarante
auto typée avec un typage dynamique
5 : int, float, string, bool, null
Nommage : camelCase
Anglais
 */

$myVar = "Yves";
$myVar = 2;
$myVar2 = &$myVar;
$myVar2 = "Toto";

echo $myVar;

//Incrémenation et la décrémentation

$myVar = 0;
echo $myVar; //0
$myVar += 1;
echo $myVar; //1
$myVar + 1;
echo $myVar; // 1
echo $myVar++; //1
echo ++$myVar; // 3
echo $myVar = $myVar + 1; //4
echo ++$myVar; //5
echo $myVar; //5

//Conditions
$myVar = "18";
if($myVar < 18)
    echo "Mineur";
else if($myVar == 18)
    echo "tout juste majeur";
else
    echo "Majeur";


//Condition ternaire
// instruction (condition)?vrai:faux;
$myVar = "18";
if($myVar < 18)
    echo "Mineur";
else
    echo "Majeur";

echo ($myVar < 18)?"Mineur":"Majeur";

//Le null coalescent

$name = null;
if( $name == null) {
    echo "Joe";
}else{
    echo $name;
}

echo $name??"Joe";


//Le switch

$scope = "admin";

switch ($scope){
    case "admin":
        echo "Peut tout faire";
        break;
    case "author":
        echo "Peut modifier le contenu";
    default:
        echo "Peut afficher le contenu";
        break;
}

//FOR
for($cpt=0;$cpt<10;++$cpt){
    echo $cpt;
}

//WHILE
$number = rand(1,6);
$cpt = 1;
while ($number != 6){
    $number = rand(1,6);
    $cpt++;
}
echo "Il m'a fallut ".$cpt."Itérations";


$cpt = 0;
do{
    $number = rand(1,600);
    $cpt++;
}while ($number != 6);
echo "Il m'a fallut ".$cpt."Itérations";


//ARRAY
$array = [];
//$array = array();
/*
$class = [0=>"Pierre", "test"=>"Paul", 0=>"Jeanne"];
echo $class[2];


$class[] = "Toto";

echo "<pre>";
print_r($class);
var_dump($class);
echo "</pre>";
*/

$student = ["firstname"=>"Andrieu", "lastname"=>"QUENTIN", "average"=>10];
//Afficher Prénom Nom a une moyenne de note/20
echo $student["firstname"]." ".$student["lastname"].
    " a une moyenne de ".$student["average"]."/20";


$array = [
            0=>[
                0=>[],
                1=>[
                    0=>[],
                    1=>[
                        0=>[
                            0=>[]
                        ]
                    ]
                ],
                2=>[],
                3=>[]
            ]
        ];//

//echo $array[0][1][][];

$class = [
    10=>["Pierre", 12],
    1=>["Paul", 14],
    2=>["Jeanne", 16],
];


foreach ($class as $key=>$student){
    echo "<li>".$student[0].":".$student[1]."</li>";
}


//Fonctions

hello();
function hello()
{
    echo "Bonjour";
}

$firstname = "Yves";
function helloYou($firstname= "")
{
    //global $firstname;
    echo "Bonjour ".$firstname;
}
helloYou();






$firstname = "   jean YvEs     ";
function cleanAndCheckFirstname(&$firstname)
{
    $firstname = ucwords(strtolower(trim($firstname)));
    return strlen($firstname)>=2;
}
if(cleanAndCheckFirstname($firstname)){
    echo "Welcome ".$firstname;
}else{
    echo "NOK";
}




