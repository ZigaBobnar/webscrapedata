from django.db import models

class CarAd(models.Model):
    avtonetId = models.CharField(max_length=50)
    title = models.CharField(max_length=200)
    price = models.CharField(max_length=20)
    first_seen_on = models.DateTimeField('First seen date')

class AdData(models.Model):
    carAd = models.ForeignKey(CarAd,
        on_delete=models.CASCADE)
    key = models.CharField(max_length=200)
    value = models.CharField(max_length=200)
    updated_on = models.DateTimeField('Updated on date')
