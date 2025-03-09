<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Коллекция изображений</title>
    <style>
        body {
            font-family: 'Verdana', sans-serif;
            margin: 0;
            padding: 0;
            background-color:rgb(255, 158, 250);
        }

        header {
            background-color:rgb(211, 16, 152);
            color: #fff;
            text-align: center;
            padding: 25px;
        }

        nav {
            background-color: rgb(63, 0, 44);
            padding: 12px;
        }   

        nav a {
            color: rgb(255, 0, 195);
            text-decoration: none;
            margin: 0 20px;
        }

        nav a:hover {
            text-decoration: overline;
        }

        .image-collection {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 25px;
        }

        .image-collection img {
            max-width: 220px;
            height: auto;
            margin: 12px;
            border: 3px solid #ccc;
            border-radius: 8px;
        }

        footer {
            background-color:rgb(131, 0, 124);
            color: #fff;
            text-align: center;
            padding: 12px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <h1>Коллекция изображений</h1>
    </header>

    <nav>
        <a>Домой</a>
        <a>Коллекция</a>
    </nav>

    <div class="image-collection">
        <?php
        /**
         * Выводит коллекцию изображений из заданной папки
         * Считывает содержимое директории image/ и отображает изображения с подходящими расширениями
         */

        // Указываем путь к директории с изображениями
        $folder = 'image/';
        
        /**
         * @var array $items Список элементов в директории
         */
        $items = scandir($folder);
        if ($items === false) {
            echo "<p>Не удалось открыть директорию</p>";
        } else {
            $items = array_filter($items, fn($item) => !in_array($item, ['.', '..']));

            /**
             * @var array $valid_types Список разрешённых типов файлов
             */
            $valid_types = ['jpg', 'jpeg'];

            foreach ($items as $file) {
                $fileExt = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($fileExt, $valid_types)) {
                    $imagePath = $folder . $file;
                    echo "<img src=\"{$imagePath}\" alt=\"Изображение\">";
                }
            }
        }
        ?>
    </div>

    <footer>
        <p>Footer</p>
    </footer>
</body>

</html>