<?php include("conexao.php"); ?>

<?php
include("conexao.php");

$sql = "SELECT * FROM marmita WHERE nm_marmita = 'Porco no tacho'";
$resultado = mysqli_query($conexao, $sql);
$marmita = mysqli_fetch_assoc($resultado);
?>

<section class="py-5">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm border-2">
          <img src="imgs/<?php echo $marmita['img_marmita']; ?>" class="card-img-top border-1" alt="Foto da Marmita">

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

  
</section>