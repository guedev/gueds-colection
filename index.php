<?php

include_once 'dados.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Gued's Collection</title>



    <style>

        .card-img-top {
            height: 200px; /* Defina a altura fixa desejada */
            object-fit: cover; /* Para garantir que a imagem preencha o espaço mantendo a proporção */
        }

        .desc-jogo {
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Limita o número de linhas a 3 */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis; /* Exibe "..." quando o texto é cortado */
        }

       
    </style>


</head>
<body>
   
<div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4 g-4">
            <?php foreach ($arrayJogos as $jogo) { ?>
                <div class="col <?php if ($index % 4 === 0) echo 'offset-lg-0'; ?> <?php if ($index !== 0) echo 'offset-md-0'; ?>" >
                    <div class="card" style="width: 18rem; margin: 1rem auto;">
                        <img src="<?= $jogo["urlImage"] ?>" class="card-img-top" alt="...">
                        <div class="card-header">
                            <h6 class="card-title"><?= $jogo["nome"]; ?> </h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Ano de Lançamento: <?= $jogo["lancamento"]; ?> </p>
                            <p class="card-text">Editora: <?= $jogo["editora"]; ?> </p>
                            <p class="card-text">Nº de Jogadores: <?= $jogo["numJogadores"]; ?> </p>
                            <p class="card-text desc-jogo"><?= $jogo["descricao"]; ?>t.</p>
                            
                        </div>
                        <div class="card-footer text-muted">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetalhes" data-idjogo="<?= $jogo["id_jogo"]; ?>">
                            Detalhes
                        </button>
                        </div>
                    </div>
                </div>
            <?php } ?>  
        </div>  



 <!-- modal -->
 <div class="modal fade" id="modalDetalhes" tabindex="-1" aria-labelledby="modalDetalhesLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetalhesLabel">Detalhes do Jogo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 id="modalNome"></h6>
                    <p class="rounded" id="modalnumJoga" style="background-color: #b3cde0; padding: 0 8px; width: fit-content"></p>
                    <p id="modalEditora"></p>
                    <p id="modalDescricao"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var modalDetalhes = document.getElementById('modalDetalhes');
    modalDetalhes.addEventListener('show.bs.modal', function (event) {
        // Botão que acionou o modal
        var button = event.relatedTarget;
        // Extrair o id_jogo do botão de detalhes
        var idJogo = button.getAttribute('data-idjogo');
  
        var modalBody = modalDetalhes.querySelector('.modal-body');
        // Encontrar o jogo correspondente ao id
        var jogo = <?php echo json_encode($arrayJogos); ?>.find(function(jogo) {
            return jogo.id_jogo == idJogo;
        });

        // Atualizar o conteúdo do modal com os detalhes do jogo
        document.getElementById('modalNome').textContent = jogo.nome;
        document.getElementById('modalEditora').textContent = "Editora: " + jogo.editora;
        document.getElementById('modalnumJoga').textContent = jogo.numJogadores + " Jogadores";
        document.getElementById('modalDescricao').textContent = jogo.descricao;

    });
</script>          

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>