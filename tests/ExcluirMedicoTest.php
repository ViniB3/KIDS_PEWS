<?php
use PHPUnit\Framework\TestCase;

class ExcluirMedicoTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        // Conectar ao banco de dados diretamente no teste
        $host = "localhost";
        $user = "root";  // Substitua pelo seu usuário do MySQL
        $pass = "root";    // Substitua pela sua senha do MySQL
        $dbname = "test_db";  // Substitua pelo nome do banco de dados

        $this->conn = new mysqli($host, $user, $pass, $dbname);

        if ($this->conn->connect_error) {
            die("Erro de conexão: " . $this->conn->connect_error);
        }

        // Criar tabela temporária para testes (se necessário)
        $this->conn->query("CREATE TABLE IF NOT EXISTS medico (
            id INT AUTO_INCREMENT PRIMARY KEY,
            estado VARCHAR(2),
            crm INT,
            nome VARCHAR(255),
            especialidade VARCHAR(255),
            senha VARCHAR(255)
        )");

        // Inserir um médico para testar a exclusão
        $this->conn->query("INSERT INTO medico (estado, crm, nome, especialidade, senha) 
                            VALUES ('SP', 123456, 'Dr. João', 'Cardiologia', 'senha123')");
    }

    protected function tearDown(): void {
        // Limpa os dados da tabela
        $this->conn->query("TRUNCATE TABLE medico");

        // Fecha a conexão
        $this->conn->close();
    }

    public function testExcluirMedico() {
        // O CRM do médico que foi inserido
        $crm = 123456;

        // Executar a exclusão do médico
        $sql = "DELETE FROM medico WHERE crm=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $crm);

        // Realiza a execução
        $resultado = $stmt->execute();

        // Verificar se a execução foi bem-sucedida
        $this->assertTrue($resultado);

        // Verificar se o médico foi realmente excluído
        $query = $this->conn->query("SELECT * FROM medico WHERE crm = $crm");
        $this->assertEquals(0, $query->num_rows);

        $stmt->close();
    }
}
?>
