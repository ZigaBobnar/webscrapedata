from django.contrib import admin

from .models import CarAd, AdData

class CarAdAdmin(admin.ModelAdmin):
    fields = ['title', 'price', 'first_seen_on']
    
    list_filter = ['first_seen_on']

admin.site.register(CarAd, CarAdAdmin)
