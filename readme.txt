»спользование:
1. ѕерейти в админпанель в редактирование товара, на табе "ћодули" выбрать нужные модули и выбрать нужную позицию (моежет выбрать любую позицию их надо будет вставить в шаблон продукта)
2. ѕосле того как ¬ы выбрали модуль и позицию переходим в файл /catalog/view/theme/vmsk/template/product/product.twig и в нужном нам месте, где хотим выводить модуль вставл€м код

```php
{% if vmsk_column_right %}
	{% for module_right in vmsk_column_right %}
		{{ module_right }}
	{% endfor %}
{% endif %}
```

делаем это дл€ всех 3 позиций
vmsk_content_top
vmsk_content_bottom
vmsk_column_right

пожеланию можно расширить количество позиций