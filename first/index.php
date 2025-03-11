<?php

// Инициализация окружения
declare(strict_types=1);

/**
 * Массив, содержащий все транзакции
 * @var array $transactions
 */
$transactions = [
    [
        "id" => 1,
        "date" => "2019-01-01",
        "amount" => 100.00,
        "description" => "Payment for groceries",
        "merchant" => "SuperMart",
    ],
    [
        "id" => 2,
        "date" => "2020-02-15",
        "amount" => 75.50,
        "description" => "Dinner with friends",
        "merchant" => "Local Restaurant",
    ],
];

/**
 * Подсчитывает итоговую сумму транзакций
 *
 * @param array $transactions Список транзакций в виде ассоциативных массивов
 * @return float Итоговая сумма всех транзакций
 */
function calculateTotalAmount(array $transactions): float
{
    $sum = 0.0;
    foreach ($transactions as $item) {
        $sum += $item['amount'];
    }
    return $sum;
}

/**
 * Выполняет поиск транзакций по части описания
 *
 * @param array $transactions Список транзакций для обработки
 * @param string $descriptionPart Подстрока для поиска в описании
 * @return array Список транзакций, соответствующих критерию
 */
function findTransactionByDescription(array $transactions, string $descriptionPart): array
{
    $matches = [];
    foreach ($transactions as $entry) {
        if ($entry['description'] === $descriptionPart) {
            $matches[] = $entry;
        }
    }
    return $matches;
}

/**
 * Осуществляет поиск транзакции по её идентификатору
 *
 * @param array $transactions Список транзакций для анализа
 * @param int $id Уникальный идентификатор транзакции
 * @return array Найденные транзакции (обычно одна)
 */
function findTransactionById(array $transactions, int $id): array
{
    return array_filter($transactions, function ($record) use ($id) {
        return $record['id'] === $id;
    });
}

/**
 * Определяет количество дней с момента транзакции до текущего дня
 *
 * @param string $date Дата транзакции в формате "ГГГГ-ММ-ДД"
 * @return int Число прошедших дней
 */
function daysSinceTransaction(string $date): int
{
    $transactionDate = new DateTime($date);
    $today = new DateTime();
    $interval = $transactionDate->diff($today);
    return $interval->days;
}

/**
 * Регистрирует новую транзакцию в глобальном списке
 *
 * @param int $id Уникальный код транзакции
 * @param string $date Дата в формате "ГГГГ-ММ-ДД"
 * @param float $amount Величина транзакции
 * @param string $description Подробности операции
 * @param string $merchant Наименование продавца
 * @return void
 */
function addTransaction(int $id, string $date, float $amount, string $description, string $merchant): void
{
    $newEntry = [
        "id" => $id,
        "date" => $date,
        "amount" => $amount,
        "description" => $description,
        "merchant" => $merchant,
    ];

    $GLOBALS['transactions'][] = $newEntry;
}

// Упорядочивание транзакций

/** Сортировка по возрастанию даты */
usort($transactions, function($first, $second) {
    return strcmp($first['date'], $second['date']);
});

/** Сортировка по убыванию суммы */
usort($transactions, function($first, $second) {
    return ($second['amount'] <=> $first['amount']);
});

// // Тестирование функционала
// echo calculateTotalAmount($transactions);
// echo '<br><br><br>';
// print_r(findTransactionByDescription($transactions, "Payment for groceries"));
// echo '<br><br><br>';
// print_r(findTransactionById($transactions, 2));
// echo '<br><br><br>';
// print_r(daysSinceTransaction("2019-01-01"));
// echo '<br><br><br>';
// addTransaction(3, "2014-01-01", 34.23, "sampledesc", "samplemerch");
// echo '<br><br><br>';
// print_r($transactions);
// echo '<br><br><br>';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Overview</title>
    <style>
        table {
            border: 1px solid #333;
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #e6e6e6;
        }
    </style>
</head>
<body>
    <!-- Отображение транзакций -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Merchant</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $entry) { ?>
                <tr>
                    <td><?= $entry['id'] ?></td>
                    <td><?= $entry['date'] ?></td>
                    <td><?= $entry['amount'] ?></td>
                    <td><?= $entry['description'] ?></td>
                    <td><?= $entry['merchant'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
