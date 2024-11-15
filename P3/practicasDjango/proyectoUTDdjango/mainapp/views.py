from django.shortcuts import render, redirect

# Create your views here.

def index(request):
    return render(request, 'mainapp/index.html',{
        'title':'Inicio',
        'content':'.:: Bienvenido a mi pagina de inicio'
    })

def about(request):
    return render(request, 'mainapp/about.html',{
        'title':'Acerca De',
        'content':'.:: Somo un equipo de desarrollo de SW Multiplataforma con Django ::.'
    })

def mision(request):
    return render(request, 'mainapp/mision.html',{
        'title':'Mision',
    })

def vision(request):
    return render(request, 'mainapp/vision.html',{
        'title':'Vision',
    })

# Redirige a la URL deseada, por ejemplo, la página de inicio con error 404 1er forma
def redireccion_404(request, exception):
    return redirect('inicio')

# Redirige a la URL deseada, por ejemplo, la página de inicio con error 404 2da forma
def error404_2(request, exception):
    return render(request,'mainapp/404.html')