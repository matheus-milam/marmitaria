

<section class="hero">
        
        <div class="container">
                <div class="row align-items-center">
                        <div class="col-md-6 mt-n5 text-shadow">
                                
                                <h1 class="display-3 fw-bold" style="color: orange;">
                                        Sabor do Céu
                                </h1>   
                                
                                <h2 class="display fw-bold">
                                        Sabor que Alimenta
                                        e Encanta
                                </h2>
                                <p class="lead">
                                        Almoço saboroso, fresquinho e preparado especialmente para você.
                                </p>
                                  <a href="index.php?pagina=semana" class="btn btn-success btn-lg">     
                                         Ver Marmitas
                                </a>
                        </div>
                </div>
        </div>
</section>

<section class="py-5 bg-light">
        <div class="container-home">

        <div class="mb-5 text-center">
                <h2 class="fw-bold">Por que escolher Sabor do Céu?</h2>
                        <p class="text-muted">Qualidade, sabor e praticidade para seu dia a dia</p>
        </div>

        <div class="row g-4">

                <div class="col-12 col-md-6 col-lg-3">
                        <div class="card border-1 shadow-sm h-100 text-center p-4">
                                <div class="icon mb-3">🍛</div>
                                <h3>Comida Caseira</h3>
                                <p class="text-muted">
                                        Refeições preparadas com carinho e sabor de comida feita em casa.
                                </p>
                        </div>
                </div>
        

                        
        
        <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-1 shadow-sm h-100 text-center p-4">
                    <div class="icon mb-3">🥬</div>
                    <h5>Ingredientes Frescos</h5>
                    <p class="text-muted">
                        Produtos selecionados diariamente para garantir qualidade.
                    </p>
                </div>
         </div>

          <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-1 shadow-sm h-100 text-center p-4">
                    <div class="icon mb-3">🚚</div>
                    <h5>Entrega Rápida</h5>
                    <p class="text-muted">
                        Receba sua marmita quentinha onde estiver.
                    </p>
                </div>
         </div>

         <div class="col-12 col-md-6 col-lg-3">
                <div class="card border-1                shadow-sm h-100 text-center p-4">
                    <div class="icon mb-3">💚</div>
                    <h5>Preço Justo</h5>
                    <p class="text-muted">
                        Alimentação de qualidade sem pesar no bolso.
                    </p>
                </div>
            </div>

        </div>

</div>

</section>

<section id="cardapio" class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Marmita do Dia</h2>
      <p class="text-muted">Aqui está nossa opção do dia:</p>
    </div>

    <div class="row g-4">
 <?php
include("conexao.php");

$dias = [
    'Monday'    => 'Segunda',
    'Tuesday'   => 'Terça',
    'Wednesday' => 'Quarta',
    'Thursday'  => 'Quinta',
    'Friday'    => 'Sexta',
    'Saturday'  => 'Sábado',
    'Sunday'    => 'Domingo'
];

$hoje = $dias[date('l')];

$sql = "SELECT *
        FROM dia_marmita dm
        INNER JOIN diasemana d ON d.id_dia = dm.id_dia
        INNER JOIN marmita m ON m.id_marmita = dm.id_marmita
        WHERE d.nm_dia = '$hoje'";

$resultado = mysqli_query($conexao, $sql);

$marmita = mysqli_fetch_assoc($resultado);
?>
<div class="container-card">
 <div class="col-12 col-md-6 col-lg-4" style="align-items: center; display: flex;">
        <div class="card h-100 shadow-sm border-2">
          <img src="imgs/<?php echo $marmita['img_marmita']; ?>" class="card-img-top" style="display: flex; justify-content: center;" alt="Foto da Marmita">



            <h5 class="card-title">
              <?php echo $marmita['nm_marmita']; ?>
            </h5>

            <p class="card-text text-muted">
              <?php echo $marmita['ds_marmita']; ?>
            </p>

            <p class="fw-bold text-success">
              R$ <?php echo number_format($marmita['nr_preco'], 2, ',', '.'); ?>
            </p>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</section>
