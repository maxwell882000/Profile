# Generated by Django 3.1.5 on 2021-05-12 12:11

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('makereport', '0016_auto_20210512_1238'),
    ]

    operations = [
        migrations.AlterField(
            model_name='car',
            name='car_number',
            field=models.CharField(max_length=20),
        ),
        migrations.AlterField(
            model_name='car',
            name='mileage',
            field=models.CharField(max_length=20),
        ),
        migrations.AlterField(
            model_name='consumable',
            name='unit',
            field=models.CharField(max_length=20, verbose_name='Ед.измер.'),
        ),
        migrations.AlterField(
            model_name='contract',
            name='contract_date',
            field=models.CharField(blank=True, max_length=20, null=True),
        ),
        migrations.AlterField(
            model_name='contract',
            name='contract_number',
            field=models.CharField(blank=True, max_length=20, null=True),
        ),
        migrations.AlterField(
            model_name='customer',
            name='passport_number',
            field=models.CharField(max_length=20, verbose_name='Паспорт'),
        ),
        migrations.AlterField(
            model_name='product',
            name='unit',
            field=models.CharField(max_length=20, verbose_name='Ед.измер.'),
        ),
        migrations.AlterField(
            model_name='report',
            name='report_date',
            field=models.CharField(max_length=20),
        ),
        migrations.AlterField(
            model_name='report',
            name='report_number',
            field=models.CharField(max_length=20),
        ),
        migrations.AlterField(
            model_name='report',
            name='total_report_cost',
            field=models.CharField(max_length=20),
        ),
    ]
