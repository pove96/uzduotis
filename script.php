<?php

//$dataPath = trim(fgets(STDIN));
$dataPath = trim('input.json');
$json = file_get_contents($dataPath);
$data = json_decode($json, true);

$requiredIncome = $data['required_income'];
$smsList = $data['sms_list'];

//foreach ($smsList as &$record) {
//    $record['valueRatio'] = $record['income'] / $record['price'];
//}

usort($smsList, function ($a, $b) {
    return $b['income'] <=> $a['income'];
});

$result = [];
while ($requiredIncome > 0) {
    foreach ($smsList as $record) {
        if ($requiredIncome - $record['income'] > 0 || end($smsList) === $record) {
            $requiredIncome -= $record['income'];
            $result[] = $record['price'];
            break;
        }
    }
}

print json_encode($result);

?>