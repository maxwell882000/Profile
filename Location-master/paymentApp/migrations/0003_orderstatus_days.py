# Generated by Django 3.2.8 on 2022-08-10 02:43

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('paymentApp', '0002_auto_20220810_0152'),
    ]

    operations = [
        migrations.AddField(
            model_name='orderstatus',
            name='days',
            field=models.IntegerField(default=0),
            preserve_default=False,
        ),
    ]
