document.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    const crm = params.get("crm");  // Obtém o CRM da URL

    // Carregar dados do médico para edição
    if (crm) {
        fetch(`buscar_medico.php?crm=${crm}`)
            .then(response => response.json())
            .then(data => {
                // Preencher os campos com os dados do médico
                document.getElementById("crm").value = data.crm;
                document.getElementById("nome").value = data.nome;
                document.getElementById("especialidade").value = data.especialidade;
            })
            .catch(error => console.error("Erro ao carregar médico:", error));
    } else {
        alert("CRM não encontrado na URL!");
    }

    // Enviar dados ao servidor para atualização
    document.getElementById("edit-form").addEventListener("submit", (e) => {
        e.preventDefault(); // Previne o envio padrão do formulário

        const formData = new FormData(e.target);

        // Depuração: Verificar os dados que estão sendo enviados
        formData.forEach((value, key) => {
            console.log(key + ": " + value); // Mostrar cada campo enviado
        });

        fetch("atualizar_medico.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log("Resposta do servidor: ", data); // Verificar o que é retornado
            if (data.includes("Médico atualizado com sucesso!")) {
                alert("Médico atualizado com sucesso!");
                window.location.href = "medicos_cadastrados.html"; // Redireciona após atualização
            } else {
                alert("Erro ao atualizar médico: " + data);
            }
        })
        .catch(error => console.error("Erro ao atualizar médico:", error));
    });
});
