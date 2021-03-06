# Generated by Django 3.0 on 2019-12-17 11:57

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='CarAd',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('avtonetId', models.CharField(max_length=50)),
                ('title', models.CharField(max_length=200)),
                ('price', models.CharField(max_length=20)),
                ('first_seen_on', models.DateTimeField(verbose_name='First seen date')),
            ],
        ),
        migrations.CreateModel(
            name='AdData',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('key', models.CharField(max_length=200)),
                ('value', models.CharField(max_length=200)),
                ('updated_on', models.DateTimeField(verbose_name='Updated on date')),
                ('carAd', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='avtonet.CarAd')),
            ],
        ),
    ]
