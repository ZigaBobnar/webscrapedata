from django.urls import path
from django.views.decorators.csrf import csrf_exempt

from . import views

app_name = 'avtonet'
urlpatterns = [
    path('', views.IndexView.as_view(), name='index'),
    path('<int:pk>/', views.DetailsView.as_view(), name='details'),
    path('<int:id>/update', views.update, name='update'),
    path('import_brief', csrf_exempt(views.import_brief), name='importBrief'),
]
