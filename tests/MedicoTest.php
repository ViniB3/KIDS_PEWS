<?php
use PHPUnit\Framework\TestCase;

class MedicoTest extends TestCase {
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
        
        // Incluir o arquivo onde a função inserirMedico() está definida
        include_once __DIR__ . '/../cadastra_medico.php';
    }

    protected function tearDown(): void {
        // Limpa os dados da tabela
        $this->conn->query("TRUNCATE TABLE medico");

        // Fecha a conexão
        $this->conn->close();
    }

    public function testInserirMedico() {
        // Chamar a função de inserção
        $resultado = inserirMedico($this->conn, "SP", 123456, "Dr. João", "Cardiologia", "senha123");

        // Verificar se a inserção foi bem-sucedida
        $this->assertTrue($resultado);

        // Verificar se o médico foi inserido
        $query = $this->conn->query("SELECT * FROM medico WHERE crm = 123456");
        $this->assertEquals(1, $query->num_rows);
    }
}
?>
