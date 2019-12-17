from django.http import HttpResponse, Http404
from django.shortcuts import render, get_object_or_404

from .models import CarAd

def index(request):
    latestAdsList = CarAd.objects.order_by('-first_seen_on')[:5]
    context = {
        'latestAdsList': latestAdsList,
    }

    return render(request, 'AvtoNetData/index.html', context)

def detail(request, id):
    carAd = get_object_or_404(CarAd, pk=id)
    
    return render(request, 'AvtoNetData/detail.html', {
        'carAd': carAd
    })
