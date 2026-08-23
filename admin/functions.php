<?php

function redimensionarImagem($origem, $larguraMax, $alturaMax, $qualidade = 100) {

    $destino = $origem;

    if (!file_exists($origem)) {
        return false;
    }

    list($larguraOriginal, $alturaOriginal, $tipo) = getimagesize($origem);

    $proporcao = $larguraOriginal / $alturaOriginal;

    if ($larguraMax / $alturaMax > $proporcao) {
        $novaLargura = $alturaMax * $proporcao;
        $novaAltura = $alturaMax;
    } else {
        $novaLargura = $larguraMax;
        $novaAltura = $larguraMax / $proporcao;
    }

    $novaImagem = imagecreatetruecolor($novaLargura, $novaAltura);

    switch ($tipo) {
        case IMAGETYPE_JPEG:
            $imagem = imagecreatefromjpeg($origem);
            break;
        case IMAGETYPE_PNG:
            $imagem = imagecreatefrompng($origem);
            imagealphablending($novaImagem, false);
            imagesavealpha($novaImagem, true);
            break;
        default:
            return false;
    }

    imagecopyresampled(
        $novaImagem,
        $imagem,
        0, 0, 0, 0,
        $novaLargura, $novaAltura,
        $larguraOriginal, $alturaOriginal
    );

    switch ($tipo) {
        case IMAGETYPE_JPEG:
            imagejpeg($novaImagem, $destino, $qualidade);
            break;
        case IMAGETYPE_PNG:
            imagepng($novaImagem, $destino);
            break;
    }

    imagedestroy($imagem);
    imagedestroy($novaImagem);

    return true;
}