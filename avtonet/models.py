from django.db import models


class EngineType(models.Model):
    type_name = models.CharField(max_length=20)

    def __str__(self):
        return self.type_name


class TransmissionType(models.Model):
    type_name = models.CharField(max_length=20)

    def __str__(self):
        return self.type_name


class ChassisType(models.Model):
    type_name = models.CharField(max_length=20)

    def __str__(self):
        return self.type_name


class CarAd(models.Model):
    avtonet_id = models.CharField(max_length=20, null=True, blank=True)
    title = models.CharField(max_length=120, blank=True)
    price = models.DecimalField(max_digits=12, decimal_places=2, null=True, blank=True)
    cover_photo_name = models.CharField(max_length=60, null=True, blank=True)
    first_registration_year = models.IntegerField(null=True, blank=True)
    safety_inspection_until = models.IntegerField(null=True, blank=True)
    driven_distance = models.IntegerField(null=True, blank=True)
    engine_type = models.ForeignKey(EngineType, on_delete=models.DO_NOTHING, null=True, blank=True)
    engine_power_kw = models.IntegerField(null=True, blank=True)
    engine_power_hp = models.IntegerField(null=True, blank=True)
    engine_volume_ccm = models.IntegerField(null=True, blank=True)
    transmission_type = models.ForeignKey(TransmissionType, on_delete=models.DO_NOTHING, null=True, blank=True)
    number_of_gears = models.IntegerField(null=True, blank=True)
    location = models.CharField(max_length=120, null=True, blank=True)
    features = models.CharField(max_length=1000, null=True, blank=True)
    notes = models.CharField(max_length=1000, null=True, blank=True)
    phone_number = models.CharField(max_length=40, null=True, blank=True)
    first_seen_on = models.DateTimeField(auto_now_add=True, blank=True)
    ad_published_on = models.DateTimeField(null=True, blank=True)
    last_fully_crawled_on = models.DateTimeField(null=True, blank=True)
    today_views = models.IntegerField(null=True, blank=True)

    def __str__(self):
        return self.title + ', ' + str(self.price)
