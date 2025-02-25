<?php
// Função para cálculo da pontuação
function calcularPontuacaoPews($dados) {
    $campos = [
        "aval_neurologica",
        "aval_cardiovascular",
        "aval_respiratoria",
        "pos_op",
        "nebulizacao_resgate",
        "emese"
    ];

    $total = 0;

    // Somar os valores dos campos selecionados
    foreach ($campos as $campo) {
        if (isset($dados[$campo])) {
            $total += intval($dados[$campo]);
        }
    }

    return $total;
}
?>
