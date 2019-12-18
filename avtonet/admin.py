from django.contrib import admin

from .models import CarAd, AdData

class CarAdAdmin(admin.ModelAdmin):
    fields = ['title']

admin.site.register(CarAd, CarAdAdmin)
