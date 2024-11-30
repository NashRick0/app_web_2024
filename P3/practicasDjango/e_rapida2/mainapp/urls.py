from django.contrib import admin
from django.urls import path
from mainapp import views
from django.conf.urls import handler400

urlpatterns = [
    path('inicio/', views.index, name='inicio'),
    path('', views.index, name='inicio'),
    path('acercade/', views.about, name='acercade'),
    path('mision/', views.mision, name='mision'),
    path('vision/', views.vision, name='vision'),
]

#handler404 = views.redireccion_404
handler404 = views.error404