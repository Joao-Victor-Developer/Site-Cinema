from django.urls import path
from . import views

app_name = 'chat'

urlpatterns = [
    path('', views.lista_grupos, name='lista_grupos'),
    path('criar/', views.criar_grupo, name='criar_grupo'),
    path('grupo/<int:grupo_id>/', views.detalhes_grupo, name='detalhes_grupo'),
    path('grupo/<int:grupo_id>/entrar/', views.entrar_grupo, name='entrar_grupo'),
    path('grupo/<int:grupo_id>/sair/', views.sair_grupo, name='sair_grupo'),
    path('api/grupo/<int:grupo_id>/mensagens/', views.carregar_mensagens, name='carregar_mensagens'),
    path('grupo/<int:grupo_id>/excluir/', views.excluir_grupo, name='excluir_grupo'),
]
