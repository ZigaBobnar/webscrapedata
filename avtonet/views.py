from django.http import HttpResponse, HttpResponseRedirect
from django.shortcuts import get_object_or_404
from django.urls import reverse
from django.views import generic
from django.views.decorators.http import require_POST
import json

from .models import CarAd, EngineType, TransmissionType, AgeType


class IndexView(generic.ListView):
    template_name = 'avtonet/index.html'
    context_object_name = 'latest_ads_list'

    def get_queryset(self):
        return CarAd.objects.order_by('-first_seen_on')[:50]


class DetailsView(generic.DetailView):
    context_object_name = 'carAd'
    model = CarAd
    template_name = 'avtonet/details.html'


def update(request, id):
    carAd = get_object_or_404(CarAd, pk=id)

    carAd.title = request.POST['title']

    carAd.save()

    return HttpResponseRedirect(reverse('avtonet:details', args=(carAd.id,)))


@require_POST
def import_brief(request):
    result = {'error': False, 'updated': [], 'new': [], 'not_updated': []}

    ads = json.loads(request.body.decode('utf-8'))

    for ad_id in ads:
        ad = ads[ad_id]
        carAds = CarAd.objects.filter(avtonet_id=ad['avtonet_id'])
        if carAds:
            updated = False
            carAd = carAds[0]
            if carAd.cover_title != ad['title']:
                carAd.cover_title = ad['title']
                updated = True
            if carAd.title != ad['title']:
                carAd.title = ad['title']
                updated = True
            if 'price' in ad and carAd.price != ad['price']:
                carAd.price = ad['price']
                updated = True
            carAd.cover_photo_name = ad['cover_photo_name']
            if 'first_registration_year' in ad:
                carAd.first_registration_year = ad['first_registration_year']
            if 'age' in ad:
                carAd.age = AgeType.objects.filter(type_name=ad['age'])[0]
            if 'driven_distance' in ad:
                carAd.driven_distance = ad['driven_distance']
            if 'engine_type' in ad:
                carAd.engine_type = EngineType.objects.filter(type_name=ad['engine_type'])[0]
            if 'engine_power_kw' in ad:
                carAd.engine_power_kw = ad['engine_power_kw']
            if 'engine_power_hp' in ad:
                carAd.engine_power_hp = ad['engine_power_hp']
            if 'engine_volume_ccm' in ad:
                carAd.engine_volume_ccm = ad['engine_volume_ccm']
            if 'transmission_type' in ad:
                carAd.transmission_type = TransmissionType.objects.filter(type_name=ad['transmission_type'])[0]
            if 'number_of_gears' in ad:
                carAd.number_of_gears = ad['number_of_gears']
            if updated:
                CarAd.save(carAd)
                result['updated'].append(ad_id)
            else:
                result['not_updated'].append(ad_id)
        else:
            carAd = CarAd(avtonet_id=ad_id)
            carAd.cover_title = ad['title']
            carAd.title = ad['title']
            if 'price' in ad:
                carAd.price = ad['price']
            carAd.cover_photo_name = ad['cover_photo_name']
            if 'first_registration_year' in ad:
                carAd.first_registration_year = ad['first_registration_year']
            if 'age' in ad:
                carAd.age = AgeType.objects.filter(type_name=ad['age'])[0]
            if 'driven_distance' in ad:
                carAd.driven_distance = ad['driven_distance']
            if 'engine_type' in ad:
                carAd.engine_type = EngineType.objects.filter(type_name=ad['engine_type'])[0]
            if 'engine_power_kw' in ad:
                carAd.engine_power_kw = ad['engine_power_kw']
            if 'engine_power_hp' in ad:
                carAd.engine_power_hp = ad['engine_power_hp']
            if 'engine_volume_ccm' in ad:
                carAd.engine_volume_ccm = ad['engine_volume_ccm']
            if 'transmission_type' in ad:
                carAd.transmission_type = TransmissionType.objects.filter(type_name=ad['transmission_type'])[0]
            if 'number_of_gears' in ad:
                carAd.number_of_gears = ad['number_of_gears']
            CarAd.save(carAd)
            result['new'].append(ad_id)
        


    return HttpResponse(json.dumps(result))
