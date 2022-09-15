# Generated by Django 3.1.5 on 2021-07-25 10:07

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        ('makereport', '0030_auto_20210722_1542'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='closing',
            name='address_customer',
        ),
        migrations.RemoveField(
            model_name='closing',
            name='customer',
        ),
        migrations.RemoveField(
            model_name='closing',
            name='data_creation_mark',
        ),
        migrations.RemoveField(
            model_name='closing',
            name='data_mark',
        ),
        migrations.RemoveField(
            model_name='closing',
            name='main_mark',
        ),
        migrations.RemoveField(
            model_name='closing',
            name='owner',
        ),
        migrations.RemoveField(
            model_name='closing',
            name='passport_data',
        ),
        migrations.RemoveField(
            model_name='closing',
            name='pdf_closing_base64',
        ),
        migrations.RemoveField(
            model_name='closing',
            name='place_registration',
        ),
        migrations.RemoveField(
            model_name='closing',
            name='report_date',
        ),
        migrations.RemoveField(
            model_name='closing',
            name='report_number',
        ),
        migrations.RemoveField(
            model_name='closing',
            name='sign',
        ),
        migrations.AddField(
            model_name='closing',
            name='customer_address_desc',
            field=models.CharField(blank=True, max_length=40, null=True),
        ),
        migrations.AddField(
            model_name='closing',
            name='customer_desc',
            field=models.CharField(blank=True, max_length=40, null=True),
        ),
        migrations.AddField(
            model_name='closing',
            name='customer_props_desc',
            field=models.CharField(blank=True, max_length=40, null=True),
        ),
        migrations.AddField(
            model_name='closing',
            name='damage_auto_desc',
            field=models.CharField(blank=True, max_length=40, null=True),
        ),
        migrations.AddField(
            model_name='closing',
            name='movable_property_desc',
            field=models.CharField(blank=True, max_length=40, null=True),
        ),
        migrations.AddField(
            model_name='closing',
            name='owner_desc',
            field=models.CharField(blank=True, max_length=40, null=True),
        ),
        migrations.AddField(
            model_name='closing',
            name='place_registration_desc',
            field=models.CharField(blank=True, max_length=40, null=True),
        ),
        migrations.AddField(
            model_name='closing',
            name='report',
            field=models.ForeignKey(blank=True, null=True, on_delete=django.db.models.deletion.CASCADE, to='makereport.report'),
        ),
    ]