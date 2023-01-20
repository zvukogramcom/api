# api
Using the Text-to-Speech API with Zvukogram

Для мгновенной озвучки коротких текстов до 300 символов использовать apiShortText.php

Для более длинных текстов озвучка происходит в 2 этапа:
1 Создание задачи с получением айди задачи apiLongTextCreateTask.php
2 Проверка задачи по айди с получением результата apiLongTextGetResult.php 
