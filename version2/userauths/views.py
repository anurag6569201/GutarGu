from django.shortcuts import render

def welcome(request):
    context={

    }
    return render(request,"userauths/app/welcome.html",context)
