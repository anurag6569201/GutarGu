from core import views
from django.urls import path

app_name="userauths"

urlpatterns=[
    path("",views.welcome,name="welcome"),
]
