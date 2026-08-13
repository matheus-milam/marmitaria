<?php
include("conexao.php");

$id = $_GET['id'] ?? null;
$busca = trim($_GET['busca'] ?? '');
?>

<section class="py-5">
  <div class="container">

    <div class="text-center mb-5">
      <h2 class="fw-bold">Cardápio</h2>
      <p class="text-muted">Encontre sua marmita favorita</p>
    </div>

    <div class="row g-4 justify-content-center">

      <?php

      if ($id) {
          $sql = "SELECT * FROM marmita WHERE id_marmita = :id";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(['id' => $id]);
          $marmitas = $stmt->fetchAll(PDO::FETCH_ASSOC);

      } elseif ($busca !== '') {
          $sql = "SELECT * FROM marmita WHERE nm_marmita LIKE :busca ORDER BY nm_marmita";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(['busca' => '%' . $busca . '%']);
          $marmitas = $stmt->fetchAll(PDO::FETCH_ASSOC);

      } else {
          $sql = "SELECT * FROM marmita ORDER BY nm_marmita";
          $stmt = $pdo->prepare($sql);
          $stmt->execute();
          $marmitas = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      if (count($marmitas) === 0) {
      ?>
        <div class="alert alert-warning text-center col-12 col-md-8">
          Nenhuma marmita encontrada<?php echo $busca !== '' ? ' para "' . $busca . '"' : ''; ?>.
        </div>
      <?php
      } else {
          foreach ($marmitas as $marmita) {
      ?>

        <div class="col-12 col-md-6 col-lg-4">
          <div class="card h-100 shadow-sm border-2">
            <img src="imgs/<?php echo $marmita['img_marmita']; ?>" class="card-img-top" alt="<?php echo $marmita['nm_marmita']; ?>">

            <div class="card-body text-center">
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

      <?php
          }
      }
      ?>

    </div>
  </div>
</section>