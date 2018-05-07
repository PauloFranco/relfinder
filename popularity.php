<?php
function popularity($quantidades, $tamanho_relacao){
    return ((1/$tamanho_relacao) * ($quantidades[0]/$quantidades[1]));
}
?>