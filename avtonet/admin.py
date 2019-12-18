from django.contrib import admin

from .models import CarAd, AdData

class CarAdAdmin(admin.ModelAdmin):
    fields = ['title', 'first_seen_on']

admin.site.register(CarAd, CarAdAdmin)
