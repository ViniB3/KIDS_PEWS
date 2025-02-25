<?php
use PHPUnit\Framework\TestCase;

class CalcularPontuacaoTest extends TestCase {

    // Testa se a função calcula corretamente a pontuação
    public function testCalcularPontuacaoPews() {
        // Dados de exemplo para a função
        $dados = [
            "aval_neurologica" => 1,
            "aval_cardiovascular" => 2,
            "aval_respiratoria" => 3,
            "pos_op" => 1,
            "nebulizacao_resgate" => 2,
            "emese" => 0
        ];

        // Incluir o arquivo que contém a função calcularPontuacaoPews
        include_once __DIR__ . '/../conta_pews.php';

        // Chama a função de cálculo da pontuação
        $pontuacao = calcularPontuacaoPews($dados);

        // Assertiva: A pontuação total deve ser a soma dos valores
        $this->assertEquals(9, $pontuacao);
    }

    // Testa caso onde nenhum valor é selecionado
    public function testCalcularPontuacaoSemValores() {
        // Dados vazios
        $dados = [
            "aval_neurologica" => 0,
            "aval_cardiovascular" => 0,
            "aval_respiratoria" => 0,
            "pos_op" => 0,
            "nebulizacao_resgate" => 0,
            "emese" => 0
        ];

        // Incluir o arquivo que contém a função calcularPontuacaoPews
        include_once __DIR__ . '/../conta_pews.php';

        // Chama a função de cálculo da pontuação
        $pontuacao = calcularPontuacaoPews($dados);

        // Assertiva: A pontuação total deve ser 0
        $this->assertEquals(0, $pontuacao);
    }

    // Testa caso onde os valores são dados diretamente
    public function testCalcularPontuacaoComValoresAltos() {
        // Dados com valores altos
        $dados = [
            "aval_neurologica" => 3,
            "aval_cardiovascular" => 3,
            "aval_respiratoria" => 3,
            "pos_op" => 3,
            "nebulizacao_resgate" => 3,
            "emese" => 3
        ];

        // Incluir o arquivo que contém a função calcularPontuacaoPews
        include_once __DIR__ . '/../conta_pews.php';

        // Chama a função de cálculo da pontuação
        $pontuacao = calcularPontuacaoPews($dados);

        // Assertiva: A pontuação total deve ser 18 (soma de todos os valores)
        $this->assertEquals(18, $pontuacao);
    }
}
?>
