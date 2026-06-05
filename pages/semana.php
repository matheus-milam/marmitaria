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