from django.shortcuts import render

# Create your views here.
def chatpage(request):
    context={

    }
    return render(request,'chat/app/chatpage.html',context)