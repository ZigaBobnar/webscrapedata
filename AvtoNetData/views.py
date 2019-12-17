from django.http import HttpResponse
from django.template import loader
from django.shortcuts import render

from .models import CarAd

def index(request):
    latestAdsList = CarAd.objects.order_by('-first_seen_on')[:5]
    context = {
        'latestAdsList': latestAdsList,
    }

    return render(request, 'AvtoNetData/index.html', context)

def detail(request, id):
    return HttpResponse('Looking at ad %s' % id)
