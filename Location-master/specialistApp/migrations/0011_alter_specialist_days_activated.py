# Generated by Django 3.2.8 on 2022-08-10 03:05

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('specialistApp', '0010_auto_20220810_0243'),
    ]

    operations = [
        migrations.AlterField(
            model_name='specialist',
            name='days_activated',
            field=models.IntegerField(default=0, verbose_name='Количество дней про аккаунта'),
        ),
    ]
