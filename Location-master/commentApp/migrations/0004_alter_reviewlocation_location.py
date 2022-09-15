# Generated by Django 3.2.8 on 2021-12-18 09:43

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        ('locationApp', '0005_auto_20211125_2351'),
        ('commentApp', '0003_auto_20211124_2159'),
    ]

    operations = [
        migrations.AlterField(
            model_name='reviewlocation',
            name='location',
            field=models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, related_name='reviews', to='locationApp.location'),
        ),
    ]
