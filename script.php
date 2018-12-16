<?php

$dataPath = trim('input.json');
$json = file_get_contents($dataPath);
$data = json_decode($json, true);
$result = [];

$requiredIncome = $data['required_income'];
$smsList = $data['sms_list'];
// Usort sorts smsList array and returns incomes from the highest to the smallest
usort($smsList, function ($a, $b) {
    return $b['income'] <=> $a['income'];
});

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