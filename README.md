#Simple Callback Module#
Простой модуль обратного звонка или для обратной связи. Совместим с Joomla 3.0 и выше.

![mod_simplecallback screenshot](http://joomla.startler.ru/images/screenshots/mod_simplecallback-1.png)
![mod_simplecallback screenshot](http://joomla.startler.ru/images/screenshots/mod_simplecallback-2.png)
![mod_simplecallback screenshot](http://joomla.startler.ru/images/screenshots/mod_simplecallback-3.png)

Демо: [joomla.startler.ru](http://joomla.startler.ru/)
Скачать: [v1.0.0-beta](https://github.com/birdkiwi/mod_simplecallback/releases/download/v1.0.0-beta/mod_simplecallback.tar.gz)

**Основные преимущества:**

 1. Бесплатный
 2. Безопасный: поддержка токенов ([CSRF](https://docs.joomla.org/How_to_add_CSRF_anti-spoofing_to_forms))  и капчи
 3. Без перезагрузки страницы (ajax).
 4. Возможность вставки нескольких модулей на одну страницу
 5. Содержит все необходимые настройки

Модуль поддерживает несколько видов отображения на странице:

 - *Как обычный модуль* —  форма вставляется в указанную позицию
 - *Как оверлей* — код формы вставлен в позицию, но сама форма скрыта. Вызвать
   форму можно с любой кнопки на странице с аттрибутом
   **data-simplecallback-open**, например:

```html
<a href="#" data-simplecallback-open>
    Обратная связь
</a>
```

В коде сверху вызовется самый первый модуль с оверлеем. Если на странице размещается сразу несколько модулей, то вызвать нужный можно указав ID модуля в аттрибуте **data-simplecallback-open**, например:

```html
<a href="#" data-simplecallback-open="93">
    Обратный звонок
</a>
```

Закрыть оверлей можно любой кнопкой/ссылкой с атрибутом **data-simplecallback-close**, пример:

```html
<a href="#" data-simplecallback-close>
    Закрыть [x]
</a>
```

Еще вызвать модуль можно через JS:

```javascript
/* показать оверлей с модулем по id */
    simplecallback.show(id); 
/* скрыть оверлей с модулем */
    simplecallback.hide(); 
```

Модуль создан без особого прицела на визуальный дизайн, т.к. дизайн каждого сайта индивидуален, поэтому вам предоставляется полная свобода для оформления и верстки. Тем не менее, чуть позже будут добавлены несколько тем, например bootstrap-совместимая.

**Рекомендации по настройке:**

Настоятельно рекомендуется настроить в общих настройках Joomla отправку писем не через PHP Mail, а через SMTP-сервер. Это уменьшит шанс того, что ваше письмо попадет в спам или вовсе будет удалено на вашем почтовом ящике фильтрами.
  
Система — Общие настройки — Сервер — Способ отправки: SMTP

Для SMTP рекомендуется завести отдельный ящик, в целях безопасности, т.к. SMTP пароли в Joomla хранятся в открытом виде. В случае компрометации Joomla ваш основной ящик не пострадает!


**Что будет дальше:**

 - Поддержка SMS шлюзов, например sms.ru для уведомления администратора
   сайта
 - Компонент com_simplecontact в котором будут сохраняться все
   отправленные данные
