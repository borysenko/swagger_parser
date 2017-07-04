<h1>Swagger Parser Расширение для Yii 2</h1>

<h2>Установка</h2>

<pre>
<code>
composer require  borysenko/swagger_parser "master"
</code>
</pre>


<h2>Настройка</h2>
в config\main.php добавляем
<pre>
<code>
    'controllerMap' => [
        'swagger' => [
            'class' => 'borysenko\swagger_parser\SwaggerController',
            ]
     ],
</code>
