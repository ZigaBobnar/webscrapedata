from django.contrib import admin

from .models import CarAd, ChassisType, EngineType, TransmissionType

class CarAdAdmin(admin.ModelAdmin):
    #fields = ['title', 'price', 'first_seen_on']
    
    #list_filter = ['first_seen_on']
    pass

admin.site.register(CarAd, CarAdAdmin)
admin.site.register(ChassisType)
admin.site.register(EngineType)
admin.site.register(TransmissionType)
