from django.shortcuts import render

# Create your views here.

def index(request):
    return render(request, 'mainapp/index.html', {
        'title': 'Inicio | Pagina Princiapl',
        'content': '.:: Bienvenido a mi pagina principal ::.'
    })

def about(request):
    return render(request, 'mainapp/about.html', {
        'title': 'Acerca de',
        'content': '.:: Somos un equipo de Desarrollo de SW con Django ::.'
    })

def vision(request):
    return render(request, 'mainapp/vision.html', {
        'title': 'Vision',
        'content': '.:: Vision de la Universidad Tecnologica de Durango ::.'
    })

def mision(request):
    return render(request, 'mainapp/mision.html', {
        'title': 'Mision',
        'content': '.:: Mision de la Universidad Tecnologica de Durango ::.'
    })
