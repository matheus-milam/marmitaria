

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
                                  <a href="index.php?pagina=cardapio" class="btn btn-success btn-lg">     
                                         Ver Cardápio
                                </a>
                        </div>
                </div>
        </div>
</section>

<section class="py-5 bg-light">
        <div class="container">

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

<?php include("conexao.php"); ?>


<section id="cardapio" class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Marmitas da Semana</h2>
      <p class="text-muted">Aqui estão nossas opções da semana</p>
    </div>

    <div class="row g-4">
      <?php
      $sql = "SELECT d.nm_dia, m.nm_marmita, m.ds_marmita, m.nr_preco, m.img_marmita
              FROM dia_marmita dm
              INNER JOIN diasemana d ON d.id_dia = dm.id_dia
              INNER JOIN marmita m ON m.id_marmita = dm.id_marmita
              ORDER BY d.id_dia";

      $resultado = mysqli_query($conexao, $sql);

      while($marmita = mysqli_fetch_assoc($resultado)) {
      ?>

      <div class="col-12 col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm border-0">
          <img src="imgs/<?php echo $marmita['img_marmita']; ?>" class="card-img-top" alt="Foto da Marmita">

          <div class="card-body">
            <span class="badge bg-success mb-2">
              <?php echo $marmita['nm_dia']; ?>
            </span>

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

      <?php } ?>
    </div>
  </div>
</section>
