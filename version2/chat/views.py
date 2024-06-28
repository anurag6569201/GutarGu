from django.shortcuts import render
from chat.models import Messages
from django.contrib.auth.decorators import login_required

from django.http import HttpResponse
from userauths.models import User

@login_required
def chatpage(request):
    user=request.user
    messages=Messages.get_message(user=user)
    active_direct=None
    directs=None

    if messages:
        message=messages[0]
        active_direct=message['user'].username
        directs=Messages.objects.filter(user=request.user,reciepient=message['user'])
        directs.update(is_read=True)

        for message in messages:
            if message['user'].username==active_direct:
                message['unread']=0

    context={
        'messages':messages,
        'directs':directs,
        'user':user,
        'active_direct':active_direct,
    }
    return render(request,'chat/app/chatpage.html',context)

def directs(request,username):
    user=request.user
    messages=Messages.get_message(user=user)
    active_direct=username
    directs=Messages.objects.filter(user=user,reciepient__username=username)
    directs.update(is_read=True)

    for message in messages:
        if message['user'].username==username:
            message['unread']=0

    context={
        'messages':messages,
        'directs':directs,
        'user':user,
        'active_direct':active_direct,
    }
    return render(request,'chat/app/chatpageuser.html',context)

def sendDirect(request):
    if request.method=="POST":
        from_user=request.user
        to_user_username=request.POST['to_user']
        body=request.POST['body']

        to_user=User.objects.get(username=to_user_username)
        Messages.sender_message(from_user,to_user,body)
        success="Message Sent"
        return HttpResponse(success)