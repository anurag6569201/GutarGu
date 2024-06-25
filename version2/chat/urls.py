from chat import views
from django.urls import path

app_name="chat"

urlpatterns=[
    path("",views.chatpage,name="chatpage"),
    path("direct/<username>",views.directs,name="directs"),
]
