from django.shortcuts import render


def login(request):
    context={

    }
    return render(request,"userauths/app/sign-in.html",context)

def register(request):
    context={

    }
    return render(request,"userauths/app/sign-out.html",context)
