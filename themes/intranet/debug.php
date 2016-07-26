<?php

$data = '25/07/2016';
echo Check::Data($data);
echo "<br>";
echo date('Y-m-d H:i:s');
echo "<br>";
echo date('Y-m-d', strtotime(Check::Data($data)));
//date('Y-m-d', strtotime(Check::Data($request->reg_date_correcao)));