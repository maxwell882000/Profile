# Generated by Django 3.2.8 on 2022-05-24 11:37

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        ('confidentialApp', '0001_initial'),
    ]

    operations = [
        migrations.CreateModel(
            name='SaleText',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('header', models.CharField(max_length=100, verbose_name='Загаловок')),
                ('body', models.TextField(verbose_name='Описание правил')),
            ],
            options={
                'verbose_name_plural': 'Правила покупки услуг',
            },
        ),
    ]