from django.http import HttpResponse, HttpResponseRedirect
from django.shortcuts import get_object_or_404
from django.urls import reverse
from django.views import generic
from django.views.decorators.http import require_POST
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


@require_POST
def import_brief(request):
    result = {'error': False}

    data = json.loads(request.body.decode('utf-8'))
    ads = data['ads']

    for ad in ads:
        pass

    return HttpResponse(json.dumps(result))
