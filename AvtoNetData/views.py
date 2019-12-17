from django.http import HttpResponse, Http404
from django.shortcuts import render

from .models import CarAd

def index(request):
    latestAdsList = CarAd.objects.order_by('-first_seen_on')[:5]
    context = {
        'latestAdsList': latestAdsList,
    }

    return render(request, 'AvtoNetData/index.html', context)

def detail(request, id):
    try:
        carAd = CarAd.objects.get(pk=id)
    except CarAd.DoesNotExist:
        raise Http404('The requested ad does not exist')

    return render(request, 'AvtoNetData/detail.html', {
        'carAd': carAd
    })
