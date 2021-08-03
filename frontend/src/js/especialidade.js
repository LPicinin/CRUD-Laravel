import api from '../api';


function insert(nome, descricao) {
    api.post("especialidade/", {
            nome,
            descricao,
        })
        .then((response) => {
            if (response.status == 200) {
                return true;
            }
        })
        .catch((err) => {
            console.log("Erro " + err);
        });
    return false;
}

function getEspecialidades() {
    console.log('entrou');
    api
        .get("especialidades")
        .then((response) => {
            console.log(response.data);
            return response.data;
        })
        .catch((err) => {
            console.log("Erro " + err);
        });

    return [];
}

export { insert, getEspecialidades };