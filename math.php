<?php

//calculer d'une factorielle
function fact($n)
{
    if($n<=1)
    {
        return 1;
        //losqu'on arriver a 1 en retourner
    }
    return $n * fact($n-1);
}

