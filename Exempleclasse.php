<?php


//convertir une base de donner en une liste on HTLM
//.= concatener parce que c est un ensmble de caracteres le web
$out =  "<ol>";
foreach($member_a as $col => $value)
{
    $out .= <<< HTML
          <li>$col : $value</li>
HTML;

}
$out .= "</ol>";
echo  $out;



for($i=0; $i<5; $i++ )
{
    echo '<p>$i</p>';
}

$x=0;
$y="0";

$z1 = $x == $y;
echo $z1 ? "V1" : "F1";

$z2 = $x === $y;
echo $z2 ? "V2" : "F2";



$out = <<< HTML
 
   <p>c'était mon premier script</p>

HTML;

echo $out;


//echo fact(7);
///$n=6;
for($n=2; $n<=10; $n++)
{
    $fact = fact($n);
    /*
$fact = 1;
for ($i = 1; $i <= $n; $i++) {
    $fact *= $i;
}
            */
    echo <<< HTML
   <p>$n ! = $fact</p>
HTML;
}


?>


</body>
</html>