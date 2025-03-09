# Отчет по лабораторной работе №3: Массивы и Функции

## Инструкции по запуску проекта

1. Установите PHP (если не установлен).
2. Скачайте файлы.
3. Откройте нужный файл в `Visual Studio Code`.
4. Откройте терминал, зайдите в директорию `first` или `second` и запустите локальный сервер с помощью команды:
   ```sh
   php -S localhost:8000
   ```
5. Откройте браузер и перейдите по адресу `http://localhost:8000`.

## Описание лабораторной работы

Цель работы – освоить использование условных конструкций и циклов в PHP. В рамках работы реализуется расписание работы сотрудников на основе текущего дня недели и несколько вариантов циклов. В первой части (`first`) реализована система управления транзакциями с использованием массивов и функций. Во второй части (`second`) создана коллекция изображений с динамическим выводом файлов из директории.

## Краткая документация к проекту

1. Файл `index.php` в директории `first` – реализация системы учета транзакций с функциями обработки данных и выводом таблицы.
2. Файл `index.php` в директории `second` – отображение коллекции изображений из заданной папки с применением стилей.

## Фрагменты кода, описание выполнения заданий

### first `index.php`:

Файл содержит систему управления транзакциями. Основные элементы:

- **Массив `$transactions`:** Хранит данные о транзакциях (ID, дата, сумма, описание, продавец).
- **Функции:**
  - `calculateTotalAmount()` – подсчитывает общую сумму транзакций с использованием цикла `foreach`.
  - `findTransactionByDescription()` – ищет транзакции по части описания с помощью `strpos()`.
  - `findTransactionById()` – возвращает транзакцию по её ID с использованием `array_filter()`.
  - `daysSinceTransaction()` – вычисляет количество дней с даты транзакции до текущего дня с использованием объектов `DateTime`.
  - `addTransaction()` – добавляет новую транзакцию в глобальный массив `$GLOBALS['transactions']`.
- **Сортировка:** Реализована сортировка транзакций по дате и сумме с использованием `usort()`.
- **Вывод:** Таблица с транзакциями генерируется с помощью цикла `foreach` в HTML.

Пример кода функции `calculateTotalAmount`:
```php
function calculateTotalAmount(array $transactions): float
{
    $sum = 0.0;
    foreach ($transactions as $item) {
        $sum += $item['amount'];
    }
    return $sum;
}
```

### second `index.php`:

Файл реализует вывод коллекции изображений из директории `image/`. Основные элементы:

- **Логика PHP:**
  - Используется функция `scandir()` для чтения содержимого директории.
  - Массив `$valid_types` определяет допустимые расширения файлов (например, `jpg`, `jpeg`).
  - Цикл `foreach` с фильтрацией через `array_filter()` и `in_array()` отбирает только изображения для вывода.
- **HTML/CSS:** Стилизованная страница с заголовком, навигацией, футером и адаптивным отображением изображений в виде коллекции.

Пример кода вывода изображений:
```php
$items = scandir($folder);
$valid_types = ['jpg', 'jpeg'];
foreach ($items as $file) {
    $fileExt = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (in_array($fileExt, $valid_types)) {
        $imagePath = $folder . $file;
        echo "<img src=\"{$imagePath}\" alt=\"Изображение\">";
    }
}
```

## Ответы на контрольные вопросы

- **Что такое массивы в PHP?**  
  Массивы в PHP – это структуры данных, которые позволяют хранить множество значений под одним именем. Они могут быть индексированными (с числовыми ключами), ассоциативными (с именованными ключами) или многомерными.

- **Каким образом можно создать массив в PHP?**  
  Массив можно создать несколькими способами:
  1. Используя квадратные скобки: `$array = [1, 2, 3];`
  2. Используя функцию `array()`: `$array = array("key" => "value");`
  3. Динамически добавляя элементы: `$array[] = "new element";`

- **Для чего используется цикл `foreach`?**  
  Цикл `foreach` используется для перебора элементов массива или объекта. Он упрощает доступ к значениям (и ключам, если нужно) без необходимости управлять индексами вручную. Пример: `foreach ($array as $key => $value) { ... }`.

## Список использованных источников

1. Официальная документация PHP: [https://www.php.net/manual/ru/](https://www.php.net/manual/ru/)
2. Руководство по лабораторной работе (предоставлено преподавателем).
3. Примеры кода из лекций.

## Дополнительные важные аспекты

- Нет