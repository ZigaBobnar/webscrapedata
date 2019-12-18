from django.http import HttpResponse, HttpResponseRedirect, Http404
from django.shortcuts import render, get_object_or_404
from django.urls import reverse
from django.views import generic
import json

from .models import CarAd

class IndexView(generic.ListView):
    template_name = 'avtonet/index.html'
    context_object_name = 'latest_ads_list'

    def get_queryset(self):
        return CarAd.objects.order_by('-first_seen_on')[:5]

class DetailsView(generic.DetailView):
    context_object_name = 'carAd'
    model = CarAd
    template_name = 'avtonet/details.html'

def update(request, id):
    carAd = get_object_or_404(CarAd, pk=id)
    
    carAd.title = request.POST['title']

    carAd.save()

    return HttpResponseRedirect(reverse('avtonet:details', args=(carAd.id,)))

def importBrief(request):
    data = json.loads(request.body.decode('utf-8'))
    

    return HttpResponse(json.dumps(data, indent=2))
