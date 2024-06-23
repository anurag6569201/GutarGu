from userauths import views
from django.urls import path

app_name="userauths"

urlpatterns=[
    path("user/login",views.login,name="sign-in"),
    path("user/register",views.login,name="sign-up"),
]
