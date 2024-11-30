from django.shortcuts import render, redirect

#Create your views here.
def index(request):
    return render(request,'mainapp/index.html',{
        'tittle':'Inicion | Pagina principal',
        'content':'..::¡Bienvenido a mBienvenido a mi pagina priincipali pagina priincipal!::..'
    })

def about(request):
    return render(request,'mainapp/about.html',{
        'tittle':'Acerca de',
        'content':'..::Somos un equipo de Desarrollo de SW con DJango::..'
    })

def mision(request):
    return render(request,'mainapp/mision.html',{
        'tittle':'Mision de la UTD',
    })


def vision(request):
    return render(request,'mainapp/vision.html',{
        'tittle':'Vision de la UTD',
    })


def registro_user(request):
    return render(request,'users/registro.html',{
        'tittle':'Formulario de Registro',
        'content':'..::Registrate::..'
    })


def iniciosesion_user(request):
    return render(request,'users/iniciosesion.html',{
        'tittle':'Formulario de Inicio de Sesion',
        'content':'..::Inicia Sesion::..'
    })

def error404(request, exception):
    return redirect('inicio')