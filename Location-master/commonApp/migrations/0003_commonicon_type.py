# Generated by Django 3.2.8 on 2021-12-19 10:18

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('commonApp', '0002_auto_20211218_1538'),
    ]

    operations = [
        migrations.AddField(
            model_name='commonicon',
            name='type',
            field=models.IntegerField(choices=[(0, 'Меню'), (1, 'Виды деятельности'), (2, 'Специалисты'), (3, 'Личный кабинет пользователя')], default=0, unique=True),
        ),
    ]