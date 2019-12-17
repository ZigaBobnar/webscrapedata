from django.http import HttpResponse
from django.template import loader

from .models import CarAd

def index(request):
    latestAdsList = CarAd.objects.order_by('-first_seen_on')[:5]
    template = loader.get_template('AvtoNetData/index.html')
    context = {
        'latestAdsList': latestAdsList,
    }

    return HttpResponse(template.render(context, request))

def detail(request, id):
    return HttpResponse('Looking at ad %s' % id)
