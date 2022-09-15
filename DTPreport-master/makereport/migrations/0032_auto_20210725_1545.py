# Generated by Django 3.1.5 on 2021-07-25 10:45

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('makereport', '0031_auto_20210725_1507'),
    ]

    operations = [
        migrations.AlterField(
            model_name='closing',
            name='customer_address_desc',
            field=models.CharField(blank=True, default='Адрес Заказчика', max_length=100, null=True),
        ),
        migrations.AlterField(
            model_name='closing',
            name='customer_desc',
            field=models.CharField(blank=True, default='Заказчик', max_length=100, null=True),
        ),
        migrations.AlterField(
            model_name='closing',
            name='customer_props_desc',
            field=models.CharField(blank=True, default='Реквизиты заказчика', max_length=100, null=True),
        ),
        migrations.AlterField(
            model_name='closing',
            name='damage_auto_desc',
            field=models.CharField(blank=True, default='Ущерб автотранспортного средства по состоянию ', max_length=100, null=True),
        ),
        migrations.AlterField(
            model_name='closing',
            name='movable_property_desc',
            field=models.CharField(blank=True, default='Движимое имущество', max_length=100, null=True),
        ),
        migrations.AlterField(
            model_name='closing',
            name='owner_desc',
            field=models.CharField(blank=True, default='Владелец', max_length=100, null=True),
        ),
        migrations.AlterField(
            model_name='closing',
            name='place_registration_desc',
            field=models.CharField(blank=True, default='Место регистрации объекта оценки', max_length=100, null=True),
        ),
    ]