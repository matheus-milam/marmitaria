

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
    <div class="row g-4">
 <section id="cardapio" class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Marmita do Dia</h2>
      <p class="text-muted">Aqui está nossa opção do dia:</p>
    </div>

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

    $hoje =  $dias[date('l')];

    $sql = "SELECT *
            FROM dia_marmita dm
            INNER JOIN diasemana d ON d.id_dia = dm.id_dia
            INNER JOIN marmita m ON m.id_marmita = dm.id_marmita
            WHERE d.nm_dia = '$hoje'";

    $resultado = mysqli_query($conexao, $sql);
    $marmita = mysqli_fetch_assoc($resultado);
    ?>

    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-4">

        <?php if($marmita) { ?>
          <div class="card h-100 shadow-sm border-2">
            <img src="imgs/<?php echo $marmita['img_marmita']; ?>" class="card-img-top" alt="Foto da Marmita">

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
        <?php } else { ?>
          <div class="alert alert-warning text-center">
            Não temos marmita cadastrada para hoje.
          </div>
        <?php } ?>

      </div>
    </div>
  </div>
</section>

<?php

$bairros = [
    "Centro" => 2,
    "Paraná D'Oeste" => 10,
    "Vila Gianello" => 8,
    "Vila Belém" => 8
];

function consultarFrete($bairros, $bairro){

    if (isset($bairros[$bairro])) {
        return $bairros[$bairro];
    } else {
        return 0;
    }
}

$bairroSelecionado = $_GET['bairro'] ?? "";
$frete = consultarFrete($bairros, $bairroSelecionado);

$total = 0;

$total = $marmita['nr_preco'] + $frete;

?>

<form method="GET" class="mt-3">

    <input type="hidden" name="pagina" value="home">

    <label class="form-label">
        Escolha seu bairro:
    </label>

    <select name="bairro" class="form-select mb-3">

        <option value="">
            Selecione um bairro
        </option>

        <?php foreach($bairros as $bairro => $valorFrete) { ?>

            <option
                value="<?php echo $bairro; ?>"
                <?php echo ($bairroSelecionado == $bairro) ? 'selected' : ''; ?>
            >
                <?php echo $bairro; ?>
                - R$ <?php echo number_format($valorFrete, 2, ',', '.'); ?>
            </option>

        <?php } ?>

    </select>

    <button class="btn btn-success" type="submit">
        Calcular Total
    </button>

</form>

<?php if($marmita && $bairroSelecionado) { ?>

    <div class="alert alert-success mt-3">

        <strong>Bairro:</strong>
        <?php echo $bairroSelecionado; ?>

        <br>

        <strong>Frete:</strong>
        R$ <?php echo number_format($frete, 2, ',', '.'); ?>

        <br>

        <strong>Total:</strong>
        R$ <?php echo number_format($total, 2, ',', '.'); ?>

    </div>

<?php } ?>
