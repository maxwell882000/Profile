# Generated by Django 3.2.8 on 2022-08-10 02:43

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('specialistApp', '0009_specialist_plan'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='specialist',
            name='is_deactivated',
        ),
        migrations.AddField(
            model_name='specialist',
            name='days_activated',
            field=models.BooleanField(default=0, verbose_name='Количество дней про аккаунта'),
        ),
    ]
