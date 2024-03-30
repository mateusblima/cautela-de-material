<?php

use Dompdf\Dompdf;

require 'vendor/autoload.php';

$dompdf = new Dompdf();

$pg = strtoupper($_POST['pg']);
$guerra = strtoupper($_POST['guerra']);
$setor = strtoupper($_POST['setor']);
$ramal = $_POST['ramal'];
$name = strtoupper($_POST['name']);
$materialSelecionado = $_POST['material'];



function addSelectedMaterials($materialSelecionado)
{
    $items = '';
    foreach ($materialSelecionado as $material) {
        $items .= "<li>$material</li>";
    }
    return $items;
}


$html = ("
<div style='position: relative; text-align:center;'>
    <img src='images/brasao.png' style='position:relative;top:0.5in;line-height:0.21in;'>
</div>
<div style='position:relative;top:1.05in;text-align:center; '><span style='font-style:normal;font-weight:bold;font-size:12pt;font-family:Times New Roman;color:#000000 '>CAUTELA
        DE MATERIAL</span><br /></div>


<div style='position:relative; line-height:0.24in; text-align: center; top:1.2in; '><span style='font-style:normal; font-weight:bold; font-size:12pt; font-family:Times New Roman; color:#000000 '>
        TERMO DE COMPROMISSO
    </span>
    <br />
</div>


<div style='position:relative;top:0.5in;left:0.34in;line-height:0.24in;text-align: justify;width: 660px; '><br>
    <br /><br /><span style='color:#000 '>Eu " . $pg . " " . $guerra . ", do setor " . $setor . ", ramal:
        "
    . $ramal . "
        comprometo-me a zelar pelo material abaixo discriminado emprestado pela seção da Tecnologia da Informação e
        devolver nas mesmas condições no
        prazo de 3 dias úteis.</span></span><br />
</div>

<div style='position:relative;top:0.1in;left:0.34in;line-height:0.24in;text-align: justify;width: 660px; '><br>
    <br /><br /><span style='color:#000 '>Obs: 'O usúario é responsavel pela movimentação do equipamento de sua Seção à
        Seção de Tecnologia da Informação e Comunicação da BAFZ e vice-versa; '
        NPA TIECOM 11-05/2018</span></span><br />
</div>

<div style='position:relative;top:-0.3in;left:0.34in;line-height:0.24in;text-align: justify;width: 660px; '>
    <br><br><br><span style='color:#000 '><b>Descrição completa do material emprestado:</b></span>
</div>

<div style='position:relative;top:0.3in;left:0.34in;'><br>
    <ul> " . addSelectedMaterials($materialSelecionado) . "<ul>
</div>

<div style='position:absolute; right: 50px; bottom:0.6in;text-align: center '>
    <div style ='text-align:center;'>
        <p>________________________________</p>
    </div>
    <div style ='text-align:center;'>
        <p>" . $pg . " " . $name . "</p>
    </div>
<span style='font-style:normal;font-weight:normal;font-size:12pt;font-family:Times New Roman;color:#000000 '>
        Fortaleza-CE, " . date('d ') . " / " . date('m ') . " / " . date('Y ') . ".</span>
        <br />
</div>

");

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Cautela " . date('d') . "-" . date('m') . ".pdf", array("Attachment" => false));
