from django.urls import path

from . import views

app_name = 'avtonet'
urlpatterns = [
    path('', views.index, name='index'),
    path('<int:id>/', views.detail, name='detail'),
    path('<int:id>/update', views.update, name='update')
]
