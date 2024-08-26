<?php

function soh_digito($str)
{
   for ($i = 0; $i < strlen($str); $i++) {
      if (($str[$i] < "0") or ($str[$i] > "9")) {
         return false;
      }
   }
   return true;
}

function real($str)
{
   $parte_inteira = true;

   for ($i = 0; $i < strlen($str); $i++) {
      if (($str[$i] < "0") or ($str[$i] > "9")) {
         if (($str[$i] == ".") and $parte_inteira) {
            $parte_inteira = false;
         }
      }
   }
   return $parte_inteira;
}

function zfill($str = null, $nz = null)
{
   while (strlen($str) < $nz) {
      $str = "0" . $str;
   }
   return $str;
}

function zclean($valor)
{
   $out = "";

   for ($i = 0; $i < strlen($valor); $i++) {
      if ($valor[$i] > "0" && $valor[$i] != ".") {
         $out .= $valor[$i];
      }
   }

   if (strlen($out) == 0) {
      $out = "0";
   }
   return $out;
}

function retira_zeros($in)
{
   $out = "";
   for ($i = 0; $i < strlen($in); $i++) {
      if ($in[$i] > "0") {
         $out .= $in[$i];
         $prox = $i;
         $prox++;
         if (@$in[$prox] == "0") {
            for ($j = $prox; $j < strlen($in); $j++) {
               $out .= $in[$j];
            }
         }
      }
   }
   return $out;
}

function maior_valor_array($array)
{
   foreach ($array as $arr) {
      if (!isset($max) or max($arr) > $max) {
         $max = max($arr);
      }
   }
   return $max;
}

function filtra_digitos($in)
{
   $out = "";
   $arr = str_split($in);

   foreach ($arr as $a) {
      if (is_numeric($a)) {
         $out .= $a;
      }
   }
   return $out;
}

function ljust($str, $n)
{
   while (strlen($str) < $n) {
      $str .= " ";
   }
   return $str;
}

function rjust($str, $n)
{
   while (strlen($str) < $n) {
      $str = " " . $str;
   }
   return $str;
}

function capitaliza_nome($nome)
{
   $nome = ucwords(mb_strtolower($nome));
   $nome = str_replace(" Da ", " da ", $nome);
   $nome = str_replace(" De ", " de ", $nome);
   $nome = str_replace(" Do ", " do ", $nome);
   $nome = str_replace(" E ", " e ", $nome);
   return str_ireplace('tecbiz', 'TecBiz', $nome);
}

function enquadra_string($valor, $largura)
{
   return substr(ljust($valor, $largura), 0, $largura);
}

function enquadra_numero($valor, $largura)
{
   return substr(zfill(filtra_digitos($valor), $largura), 0, $largura);
}

function enquadra_valor($valor, $largura)
{
   return substr(zfill(number_format($valor, 2, "", ""), $largura), 0, $largura);
}

function formata_cnpj($cnpj)
{
   $cnpj = filtra_digitos($cnpj);
   $out = null;
   $cnpj = zfill($cnpj, 14);
   if ($cnpj) {
      $a = str_split($cnpj);
      $out = $a[0] . $a[1] . "." . $a[2] . $a[3] . $a[4] . "." . $a[5] . $a[6] . $a[7] . "/" . $a[8] . $a[9] . $a[10] . $a[11] . "-" . $a[12] . $a[13];
   }
   return $out;
}

function formata_cpf($cpf)
{
   $cpf = zfill(filtra_digitos($cpf), 11);

   if (($cpf * 1) == 0) {
      return null;
   }
   return  substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "-" . substr($cpf, 9, 2);
}

function desformatacnpj($cnpj)
{
   $saida = str_replace(".", "", $cnpj);
   $saida = str_replace("/", "", $saida);
   $saida = str_replace("-", "", $saida);
   return $saida;
}

function desformatacpf($cpf)
{
   $saida = str_replace(".", "", $cpf);
   $saida = str_replace("/", "", $saida);
   $saida = str_replace("-", "", $saida);
   return filtra_digitos($saida);
}

function dma2amd($data)
{
   if ($data) {
      $data = explode("/", $data);

      if (count($data) === 3) {
         if ($data[2] < 80) {
            $data[2] = 2000 + $data[2];
         } elseif ($data[2] < 100) {
            $data[2] = 1900 + $data[2];
         }
         return $data[2] . "-" . zfill($data[1], 2) . "-" . zfill($data[0], 2);
      }
      return '';
   } else {
      return "";
   }
}

function dma2amdch($data)
{
   if ($data) {
      $hora = substr($data, 11, 8);
      $data = substr($data, 0, 10);
      $data  = explode("/", $data);
      if ($data[2] < 80) {
         $data[2] = 2000 + $data[2];
      } elseif ($data[2] < 100) {
         $data[2] = 1900 + $data[2];
      }
      return $data[2] . "-" . zfill($data[1], 2) . "-" . zfill($data[0], 2) . " " . $hora;
   } else {
      return "";
   }
}

function amd2dmach($data)
{
   if ($data) {
      $hora = substr($data, 11, 8);
      $data = substr($data, 0, 10);
      $data = explode("-", $data);
      return $data[2] . "/" . $data[1] . "/" . $data[0] . " " . $hora;
   } else {
      return "";
   }
}

function amd2dma($data)
{
   if ($data) {
      $hora = substr($data, 11, 8);
      $data = substr($data, 0, 10);
      $data = explode("-", $data);
      return str_replace("//", '', $data[2] . "/" . $data[1] . "/" . $data[0]);
   } else {
      return "";
   }
}

function marca_dc($valor)
{
   if ($valor > 0) {
      return "<FONT COLOR=\"#0000F0\"><B>C</B></FONT>";
   } elseif ($valor < 0) {
      return "<FONT COLOR=\"#F000000\"><B>D</B></FONT>";
   } else {
      return "<FONT COLOR=\"#00C000\"><B>Z</B></FONT>";
   }
}

function scapador($string)
{
   $tamanho = strlen($string);

   for ($i = 0; $i <= $tamanho; $i++) {

      if ($string[$i] == "'" || $string[$i] == "\\" || $string[$i] == "\"") {
         $saida .= "'" . $string[$i];
      } else {
         $saida .= $string[$i];
      }
   }
   return $saida;
}

function scapador2($string)
{
   return str_replace("'", "´", $string);
}

function retira_acentuados($var)
{
   $saida = null;
   $tamanho = strlen($var);
   $negados = array("Â", "Á", "À", "Ã", "Ä", "É", "Ê", "È", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ô", "Õ", "Ò", "Ö", "Ú", "Ù", "Û", "Ü", "Ç", "Ñ", "â", "á", "à", "ã", "ä", "é", "ê", "è", "ë", "í", "ì", "î", "ï", "ó", "ô", "õ", "ò", "ö", "ú", "ù", "û", "ü", "ç", "ñ");
   $alterar = array("A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C", "N", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C", "N");

   for ($i = 0; $i < $tamanho; $i++) {

      for ($x = 0; $x < count($negados); $x++) {

         if ($var[$i] == $negados[$x]) {
            $var[$i] = $alterar[$x];
         }
      }
      $saida .= $var[$i];
   }
   return $saida;
}

function formata_valor($valor)
{
   return str_replace(',', '.', $valor);
}

function formata_valor_tela($valor)
{
   return str_replace(".", ",", $valor);
}

function formata_valor_tela_html($valor)
{
   return "<div align=\"right\">$valor</div>";
}

function normaliza_valor($valor)
{

   substr($valor, 0, 1) == "-" ? $neg = true : $neg = false;

   if ($valor) {
      $valor = str_split($valor);
      $out = '';
      foreach ($valor as $n) {
         is_numeric($n) ? $out .= $n : $out .= '';
      }

      if ($out) {
         $out *=  0.01;
      } else {
         $out = 0.00;
      }

      $saida = number_format($out, 2, ".", "");

      if ($neg) {
         $saida *= (-1);
      }
      return $saida;
   }
}

function normaliza_valor2($valor)
{
   normaliza_valor($valor);
}

function arrayDiff($arrOri, $arrAlt)
{
   $result = null;

   foreach ($arrOri as $ch => $value) {
      if ($value != $arrAlt[$ch]) {
         $result[$ch] = $arrAlt[$ch];
      }
   }
   return $result;
}

function calculaMeses($dataInicial, $dataFinal)
{
   $data1 = $dataInicial;
   $arr = explode('/', $data1);
   $data2 = $dataFinal;
   $arr2 = explode('/', $data2);
   $dia1 = $arr[0];
   $mes1 = $arr[1];
   $ano1 = $arr[2];
   $dia2 = $arr2[0];
   $mes2 = $arr2[1];
   $ano2 = $arr2[2];
   $a1 = ($ano2 - $ano1) * 12;
   $m1 = ($mes2 - $mes1);
   $result = ($m1 + $a1);
   return $result;
}

function desformata_cartao($numero)
{
   $numero = str_replace("-", " ", $numero);
   return str_replace(" ", "", $numero);
}

function formata_cartao_tela($numero)
{

   if ($numero) {
      $numero = desformata_cartao($numero);

      if (substr($numero, 0, 6) == '629869') {
         $part = str_split($numero);
         $numero = $part[0] . $part[1] . $part[2] . $part[3] . " " . $part[4] . $part[5] . $part[6] . $part[7] . " " . $part[8] . $part[9] . $part[10] . $part[11] . " " . $part[12] . $part[13] . $part[14] . $part[15];
      } else {
         $n = str_split(filtra_digitos($numero));
         $numero = $n[0] . $n[1] . $n[2] . $n[3] . "-" . $n[4] . $n[5] . "-" . $n[6] . $n[7] . "-" . $n[8] . $n[9] . $n[10] . $n[11] . $n[12] . "-" . $n[13];
      }
   }
   return $numero;
}

function formata_cartao_banco($numero)
{
   if ($numero) {
      $numero = desformata_cartao($numero);

      if (substr($numero, 0, 6) == '629869') {
         $part = str_split($numero);
         $numero = trim($part[0] . $part[1] . $part[2] . $part[3] . $part[4] . $part[5] . $part[6] . $part[7] . $part[8] . $part[9] . $part[10] . $part[11] . $part[12] . $part[13] . $part[14] . $part[15]);
      } else {
         $n = str_split(filtra_digitos($numero));
         $numero = trim($n[0] . $n[1] . $n[2] . $n[3] . "-" . $n[4] . $n[5] . "-" . $n[6] . $n[7] . "-" . $n[8] . $n[9] . $n[10] . $n[11] . $n[12] . "-" . $n[13]);
      }
   }
   return $numero;
}

function mod11($nro)
{
   $tm = strlen($nro);
   $base = 9;
   $arrNro = str_split($nro);

   for ($c = 1; $c <= $tm; $c++) {
      $base < 2 ? $base = 9 : null;
      $arrBase[$c] = $base;
      $base--;
   }
   $tot = 0;
   foreach (array_reverse($arrBase) as $key => $value) {
      $tot += ($value * $arrNro[$key]);
   }

   $dv = ($tot % 11);
   $dv == 10 ? $dv = 0 : null;
   return $dv;
}

function redir($destino, $pagina = null)
{
   !$pagina ? $pagina = 1 : null;
   $arr = array(1 => "_parent", "_self", "_top", "_bottom");
   print "<script>window.open('" . $destino . "', '" . $arr[$pagina] . "')</script>";
}

function soh_numeros($str)
{
   $str = str_split($str);
   $out = null;
   foreach ($str as $c) {
      if (is_numeric($c)) {
         $out .= $c;
      }
   }
   return $out;
}

function tira_acentos($entrada, $retornoMaisuculo = true)
{
   $s = array("Ã", "Õ", "Á", "É", "Í", "Ó", "Ú", "À", "È", "Ì", "Ò", "Ù", "Â", "Ê", "Î", "Ô", "Û", "Ä", "Ë", "Ï", "Ö", "Ü", "ã", "õ", "á", "é", "í", "ó", "ú", "à", "è", "ì", "ò", "ù", "â", "ê", "î", "ô", "û", "ä", "ë", "ï", "ö", "ü");
   $r = array("A", "O", "A", "E", "I", "O", "U", "A", "E", "I", "O", "U", "A", "E", "I", "O", "U", "A", "E", "I", "O", "U", "a", "o", "a", "e", "i", "o", "u", "a", "e", "i", "o", "u", "a", "e", "i", "o", "u", "a", "e", "i", "o", "u");
   $saida = str_replace($s, $r, $entrada);

   if ($retornoMaisuculo) {
      $saida = strtoupper($saida);
   }
   return $saida;
}

function retorna_maiusculas($entrada)
{
   $s = array("ã", "õ", "á", "é", "í", "ó", "ú", "à", "è", "ì", "ò", "ù", "â", "ê", "î", "ô", "û", "ä", "ë", "ï", "ö", "ü");
   $r = array("Ã", "Õ", "Á", "É", "Í", "Ó", "Ú", "À", "È", "Ì", "Ò", "Ù", "Â", "Ê", "Î", "Ô", "Û", "Ä", "Ë", "Ï", "Ö", "Ü");
   $saida = str_replace($s, $r, $entrada);
   return $saida;
}

function valida_mat($matricula)
{
   $str = str_split($matricula);

   foreach ($str as $c) {

      if (!is_numeric($c)) {
         return false;
      }
   }
   return true;
}

function valida_matricula_numercia($matricula)
{
   $str = str_split($matricula);
   if (substr($matricula, 0, 1) == "0") {
      return false;
   }

   foreach ($str as $c) {

      if (!is_numeric($c)) {
         return false;
      }
   }
   return true;
}

function zero_esquerda($num)
{
   $str = str_split($num);
   $i = '0';

   foreach ($str as $c) {
      if ($c == '0' and $i == '0') {
         $out .= '';
      }

      if ($c == '0' and $i == '1') {
         $out .= $c;
      }

      if ($c != '0' and $i == '1') {
         $out .= $c;
      }

      if ($c != '0' and $i == '0') {
         $out .= $c;
         $i = '1';
      }
   }
   return $out;
}

function arr_meses($mes)
{
   $meses = array('01' => 'JANEIRO', '02' => 'FEVEREIRO', '03' => 'MARÇO', '04' => 'ABRIL', '05' => 'MAIO', '06' => 'JUNHO', '07' => 'JULHO', '08' => 'AGOSTO', '09' => 'SETEMBRO', '10' => 'OUTUBRO', '11' => 'NOVEMBRO', '12' => 'DEZEMBRO');
   return $meses[$mes];
}

function arr_meses2($mes)
{
   $meses = array('JANEIRO' => '01', 'FEVEREIRO' => '02', 'MARÇO' => '03', 'ABRIL' => '04', 'MAIO' => '05', 'JUNHO' => '06', 'JULHO' => '07', 'AGOSTO' => '08', 'SETEMBRO' => '09', 'OUTUBRO' => '10', 'NOVEMBRO' => '11', 'DEZEMBRO' => '12');
   return $meses[$mes];
}

function last_day_month($mes, $ano)
{
   $array_day = ';31;28;31;30;31;30;31;31;30;31;30;31';
   $array_day = explode(";", $array_day);
   $resto = $ano % $mes;

   if ($resto == 0) {
      $array_day[2] = 29;
   }
   return $array_day[+$mes];
}

function ultimo_dia_mes($mes, $ano)
{
   $data = date('t/' . $mes . "/" . $ano);
   $data = explode('/', $data);
   return $data[0];
}

function normalizaFloat2Decimais($valor, $casas)
{
   !$casas ? $casas = 1 : null;
   $casasBase = 1000;
   $x = 1;

   while ($casas > $x) {
      $casasBase *= 10;
      $x++;
   }
   $arr = str_split($valor);
   $out = null;
   foreach ($arr as $n) {

      if (is_numeric($n)) {
         $out .= $n;
      }
   }

   if (($out * 1) == 0) {
      return number_format($out, $casas, ".", "");
   }
   return $out * 100 / $casasBase;
}

function formata_cep($cep)
{
   $cep = soh_numeros($cep);
   $cep = str_pad($cep, 8, " ", STR_PAD_LEFT);
   return substr($cep, 0, 5) . "-" . substr($cep, 5, 3);
}

function validaCPF($cpf)
{   // Verifiva se o número digitado contém todos os digitos
   $cpf = str_pad(preg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
   // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
   if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
      return false;
   } else {   // Calcula os números para verificar se o CPF é verdadeiro
      for ($t = 9; $t < 11; $t++) {
         for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf{
               $c} * (($t + 1) - $c);
         }
         $d = ((10 * $d) % 11) % 10;
         if ($cpf{
            $c} != $d) {
            return false;
         }
      }
      return true;
   }
}

function real2decimal($valor)
{
   $val1 = str_replace('.', '', $valor);
   $val2 = str_replace(',', '.', $val1);
   return $val2;
}

function array_sort_by_column(&$arr, $col, $dir = null)
{
   if (!$dir) {
      $dir = 'SORT_ASC';
   }

   $sort_col = array();
   foreach ($arr as $key => $row) {
      $sort_col[$key] = $row[$col];
   }
   array_multisort($sort_col, $dir, $arr);
}

function multiSort($array, $opcoes)
{
   $coluna = isset($opcoes[0]) ? $opcoes[0] : 0;
   //$coluna = $coluna; //array_key_exists($coluna, $array) ? $coluna : 0;
   $tipo   = isset($opcoes[1]) ? $opcoes[1] : 'string';
   $ordem   = isset($opcoes[2]) ? $opcoes[2] : 'asc';
   $b = array();

   foreach ($array as $k => $v) {
      if ($tipo == 'decimal') {
         $b[] = normaliza_valor((strip_tags($v[$coluna])));
      } elseif ($tipo == 'numeric') {
         $b[] = soh_numeros(strip_tags($v[$coluna]));
      } else if ($tipo == 'date') {
         $b[] = soh_numeros(dma2amd(strip_tags($v[$coluna])));
      } else {
         $b[] = trim(preg_replace('/ \ xc2 \ xa0 /', '', strip_tags($v[$coluna])));
      }
   }
   $ordem == 'desc' ? arsort($b, SORT_REGULAR) : asort($b, SORT_REGULAR);
   $c = array();

   foreach ($b as $k => $v) {
      $c[] = $array[$k];
   }
   return $c;
}

function cmp($a, $b)
{
   $c = explode("|", $a);
   $d = explode("|", $b);
   return $c[2] < $d[2];
}

function array_orderby()
{
   $args = func_get_args();
   $data = array_shift($args);
   foreach ($args as $n => $field) {
      if (is_string($field)) {
         $tmp = array();
         foreach ($data as $key => $row)
            $tmp[$key] = $row[$field];
         $args[$n] = $tmp;
      }
   }
   $args[] = &$data;
   call_user_func_array('array_multisort', $args);
   return array_pop($args);
}

function msort()
{
   $params = func_get_args();
   $array = array_pop($params);

   if (!is_array($array))
      return false;

   $multisort_params = array();
   foreach ($params as $i => $param) {
      if (is_string($param)) {
         ${"param_$i"} = array();
         foreach ($array as $index => $row) {
            ${"param_$i"}[$index] = $row[$param];
         }
      } else
         ${"param_$i"} = $params[$i];
      $multisort_params[] = &${"param_$i"};
   }
   $multisort_params[] = &$array;
   call_user_func_array("array_multisort", $multisort_params);
   return $array;
}

function validaEmail($email)
{
   return (bool)(filter_var($email, FILTER_VALIDATE_EMAIL));
}

function mascaraCartao($numcar)
{
   $parte = substr($numcar, 6, 6);
   $subs = str_pad("", strlen($parte), "*", STR_PAD_RIGHT);
   $numcar = str_replace($parte, $subs, $numcar);
   return formata_cartao_tela($numcar);
}

//===============================================================

function tiraAcentos($string, $slug = FALSE)
{
   $ascii['a'] = array_merge(range(224, 229), array(230));
   $ascii['e'] = range(232, 235);
   $ascii['i'] = range(236, 239);
   $ascii['o'] = array_merge(range(242, 246), array(240, 248));
   $ascii['u'] = range(249, 252);
   // Código ASCII dos outros caracteres
   $ascii['b'] = array(223);
   $ascii['c'] = array(231);
   $ascii['d'] = array(208);
   $ascii['n'] = array(241);
   $ascii['y'] = array(253, 255);

   $ascii['A'] = range(192, 197);
   $ascii['E'] = range(200, 203);
   $ascii['O'] = range(210, 214);
   $ascii['U'] = range(217, 220);
   $ascii['I'] = range(204, 207);
   $ascii['C'] = array(199);

   foreach ($ascii as $key => $item) {
      $acentos = '';
      foreach ($item as $codigo) $acentos .= chr($codigo);
      $troca[$key] = '/[' . $acentos . ']/i';
   }

   $string = preg_replace(array_values($troca), array_keys($troca), $string);

   if ($slug) {
      // Troca tudo que não for letra ou número por um caractere ($slug)
      $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
      // Tira os caracteres ($slug) repetidos
      $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);

      $string = trim($string, $slug);
   }
   return strtoupper($string);
}

function printr($var, $die = null)
{
   echo '<pre>' . print_r($var, true) . '</pre>';
   if ($die) die();
}

function debitoCredito($valor, $inverter = false, $estorno = null)
{
   /*
	$array
	$valor 		= valor
	$inverter 	= inverter letra
	$etorno      = situação (difertente de nulo estornado
	*/
   $arrayFormatado[0]   = $valor;
   $arrayFormatado[1]   = null;

   if ($estorno <> null) {
      $arrayFormatado[0] = number_format(($valor * -1), 2, ',', '.') . '<B><font  size = 1 color = RED> E</font></B>';
   } else {
      if ($valor <> 0) {
         if ($valor < 0) {
            $arrayFormatado[0] = number_format(($valor * -1), 2, ',', '.') . '<B><font  size = 1 color = BLUE> C</font></B>';
            if ($inverter == true) {
               $arrayFormatado[0] = number_format($valor, 2, ',', '.') . '<B><font  size = 1 color = RED> D</font></B>';
            }
         } else {

            $arrayFormatado[0] = number_format($valor, 2, ',', '.') . '<B><font  size = 1 color = RED> D</font></B>';
            if ($inverter == true) {
               $arrayFormatado[0] = number_format(($valor * -1), 2, ',', '.') . '<B><font  size = 1 color = BLUE> C</font></B>';
            }
         }
      } else {
         $arrayFormatado[0] = number_format($valor, 2, ',', '.') . '&nbsp;&nbsp;';
         //$arrayFormatado[0] = number_format($valor,2, ',', '.').'<B><font  size = 1 color = GREEN> Z </font></B>';
      }
   }
   return $arrayFormatado;
}


function debitoCreditoxxxxxx($valor, $inverter = false, $estorno = null)
{
   /*
	$array
	$valor 		= valor
	$inverter 	= inverter letra
	$etorno      = situação (difertente de nulo estornado
	*/
   $arrayFormatado[0]   = $valor;
   $arrayFormatado[1]   = null;

   if ($estorno <> null) {
      $arrayFormatado[0] = number_format(($valor * -1), 2, ',', '.') . '<B><font  size = 1 color = RED>E</font></B>';
   } else {
      if ($valor <> 0) {
         if ($valor < 0) {
            $arrayFormatado[0] = '<B><font  size = 1 color = BLUE>+</font></B>' . number_format(($valor * -1), 2, ',', '.');
            if ($inverter == true) {
               $arrayFormatado[0] = '<B><font  size = 1 color = RED>-</font></B>' . number_format($valor, 2, ',', '.');
            }
         } else {

            $arrayFormatado[0] = '<B><font  size = 1 color = RED>-</font></B>' . number_format($valor, 2, ',', '.');
            if ($inverter == true) {
               $arrayFormatado[0] = '<B><font  size = 1 color = BLUE>+</font></B>' . number_format(($valor * -1), 2, ',', '.');
            }
         }
      } else {
         $arrayFormatado[0]    = number_format($valor, 2, ',', '.');
      }
   }
   return $arrayFormatado;
}

function conta_dias($data1, $data2)
{
   $data1 = preg_match('/[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9][0-9][0-9]/', $data1) === 1 ? dma2amd($data1) : $data1;
   $data2 = preg_match('/[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9][0-9][0-9]/', $data2) === 1 ? dma2amd($data2) : $data2;
   $dias = 0;
   $data1 = new DateTime($data1);
   $data2 = new DateTime($data2);
   $dias = ($data1 > $data2) ? $data1->diff($data2) : $data2->diff($data1);
   return $dias->days;
}

function mascaraEmail($email, $mascararCom = '_')
{
   $mascara = explode("@", $email);
   $part1Email = $mascara[0];
   $part2Email = $mascara[1];
   $quantidadeCarac = strlen($part1Email);
   $inicio = $quantidadeCarac / 4;
   $inicio = $inicio > 1 ? $inicio : 1;
   $inicioString = substr($part1Email, 0, $inicio);
   $restanteString = str_replace($inicioString, "", $part1Email);
   $restanteString = preg_replace("/[^0-9_-]/", $mascararCom, $restanteString);
   $quantidadeCarac2 = strlen($part2Email);
   $tamanhoEmailParte2 = strpos($part2Email, '.') > 1 ? strpos($part2Email, '.') : 1;
   $finalParte2 = substr($part2Email, ($tamanhoEmailParte2 / 2), $quantidadeCarac2);
   $inicioParte2 = str_replace($finalParte2, "", $part2Email);
   $inicioParte2 = preg_replace("/[^0-9_-]/", $mascararCom, $inicioParte2);
   $mascaraNova = $inicioString . $restanteString . "@" . $inicioParte2 . $finalParte2;
   return $mascaraNova;
}

function marcaLinhaEstornada($dado = null)
{
   return "<span style=\"text-decoration:line-through ;\">$dado</span>";
}

function mesesAnosEntreDatas($d1, $d2)
{
   $array = array();
   $dif    = strtotime($d1) - strtotime($d2);
   if ($dif < 0) {
      $dif = 0;
   }
   $meses          = floor($dif / (60 * 60 * 24 * 30));
   $Year         = $meses / 12;
   $array['anos']    = round((float)$Year, 2);
   $array['meses'] = $meses;
   return $array;
}

function comparaDoisArraysDeMesmaChave($arr1, $arr2, $debug = false)
{
   $result = '';

   foreach ($arr1 as $key => $value) {
      if (trim($value) != trim($arr2[$key])) {
         $result[] = "$key de $value para $arr2[$key]";
      }
   }

   if ($debug) {
      var_dump($arr1);
      echo '<br><br>';
      var_dump($arr2);
      echo '<br><br>';
      var_dump($result);
      die();
   }

   $out = is_array($result) ? join(', ', $result) : null;
   return $out;
}

rename("index.html", "read.me");
function utf8_array_converter($array)
{
   array_walk_recursive($array, function (&$item, $key) {
      if (!mb_detect_encoding($item, 'utf-8', true)) {
         $item = utf8_encode($item);
      }
   });
   return $array;
}

function tt($str, $matar = false, $logTexto = false)
{
   if ($logTexto) {
      $fp = fopen('/var/log/tecbiz/log_manual.txt', 'a+');
      fwrite($fp, 'Data: ' . date('d/m/Y H:i:s'));
      fwrite($fp, PHP_EOL);
      fwrite($fp, $str);
      fwrite($fp, PHP_EOL . PHP_EOL);
      fclose($fp);
   } else {
      echo '<pre>';
      var_dump($str);
      //var_export($str);
      echo ('</pre>');
   }
   $matar ? die() : null;
}

function getTagNegrito($var)
{
   return "<b>$var</b>";
}

function getTagCenter($var)
{
   return "<center>$var</center>";
}

function getTagRight($var)
{
   return "<div align=\"right\">$var</div>";
}

function centralizar($total, $string, $completar)
{
   return str_pad($string, $total, $completar, STR_PAD_BOTH);
}

function normalizaFrase($frase, $colunas, $quebra = '@')
{
   return wordwrap($frase, $colunas, $quebra);
}

function justificaTexto($dado1, $dado2, $colunas)
{
   $dif = $colunas - (strlen($dado1) + strlen($dado2));
   return $dado1 . str_pad("", $dif, " ", STR_PAD_RIGHT) . $dado2;
}

function array_map_recursive($array, $callback)
{
   $func = function ($item) use (&$func, &$callback) {
      return is_array($item) ? array_map($func, $item) : call_user_func($callback, $item);
   };
   return array_map($func, $array);
}

function dataEstaEntreDuasDatas($dataInicio, $dataFim, $data)
{
   return ($data >= $dataInicio && $data <= $dataFim);
}

function getDescricaoAutorizadores($meio = null)
{
   $array['TEF'] = 'Autorizador pelo leitor de tarja magnética como demais cartões de crédito/débito';
   $array['WEB'] = 'Autorizador via site da TecBiz';
   $array['POS'] = 'Semelhante as maquininhas de cartão.';
   $array['APP'] = 'Com smartphone android ou IOS através dos aplicativos.';
   $array['URA'] = 'Atendimento telefônico automático com dados digitados.';

   if (!$meio)
      return $array;

   return  $array[$meio];
}

function implodeWithKeys($glue, $array)
{
   $result = [];
   foreach ($array as $key => $value) {
      $result[] = "$key - $value";
   }
   return implode($glue, $result);
}
