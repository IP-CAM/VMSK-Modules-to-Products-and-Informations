�������������:
1. ������� � ����������� � �������������� ������, �� ���� "������" ������� ������ ������ � ������� ������ ������� (������ ������� ����� ������� �� ���� ����� �������� � ������ ��������)
2. ����� ���� ��� �� ������� ������ � ������� ��������� � ���� /catalog/view/theme/vmsk/template/product/product.twig � � ������ ��� �����, ��� ����� �������� ������ �������� ���

```php
{% if vmsk_column_right %}
	{% for module_right in vmsk_column_right %}
		{{ module_right }}
	{% endfor %}
{% endif %}
```

������ ��� ��� ���� 3 �������
vmsk_content_top
vmsk_content_bottom
vmsk_column_right

��������� ����� ��������� ���������� �������