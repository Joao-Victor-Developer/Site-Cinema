from django.urls import path, include
from rest_framework import routers
from .views import UsuarioViewSet, login

router = routers.DefaultRouter()
router.register(r'usuarios', UsuarioViewSet)

urlpatterns = [
    path('', include(router.urls)),
    path('login/', login),  # 👈 ADD ISSO
]