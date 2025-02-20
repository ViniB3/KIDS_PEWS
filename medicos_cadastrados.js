document.addEventListener("DOMContentLoaded", fetchMedicos);

function fetchMedicos() {
    fetch("medicos_cadastrados.php")
        .then(response => response.json())
        .then(data => {
            console.log("Dados recebidos:", data);
            const medicosDiv = document.getElementById("medico-list");
            medicosDiv.innerHTML = "";

            if (data.length === 0) {
                medicosDiv.innerHTML = "<p>Nenhum médico cadastrado.</p>";
                return;
            }

            data.forEach(medico => {
                const medicoItem = document.createElement("div");
                medicoItem.classList.add("medico-item");

                medicoItem.innerHTML = `
                    <span>CRM: ${medico.crm} | Nome: ${medico.nome} | Especialidade: ${medico.especialidade}</span>
                    <button onclick="editarMedico(${medico.crm})">Editar</button>
                    <button onclick="excluirMedico(${medico.crm})">Excluir</button>
                `;

                medicosDiv.appendChild(medicoItem);
            });
        })
        .catch(error => console.error("Erro ao carregar médicos:", error));
}

function editarMedico(crm) {
    window.location.href = `editar_medico.html?crm=${crm}`;
}

function excluirMedico(crm) {
    if (confirm("Tem certeza que deseja excluir este médico?")) {
        fetch(`excluir_medico.php?crm=${crm}`, { method: "GET" })
            .then(response => response.text())
            .then(data => {
                alert(data);
                fetchMedicos(); // Atualiza a lista após exclusão
            })
            .catch(error => console.error("Erro ao excluir médico:", error));
    }
}
