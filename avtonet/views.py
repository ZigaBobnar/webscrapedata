from django.http import HttpResponse, HttpResponseRedirect, Http404
from django.shortcuts import render, get_object_or_404
from django.urls import reverse

from .models import CarAd

def index(request):
    latestAdsList = CarAd.objects.order_by('-first_seen_on')[:5]
    context = {
        'latestAdsList': latestAdsList,
    }

    return render(request, 'avtonet/index.html', context)

def detail(request, id):
    carAd = get_object_or_404(CarAd, pk=id)

    return render(request, 'avtonet/detail.html', {
        'carAd': carAd
    })


def update(request, id):
    carAd = get_object_or_404(CarAd, pk=id)
    
    carAd.title = request.POST['title']

    carAd.save()

    return HttpResponseRedirect(reverse('avtonet:detail', args=(carAd.id,)))
