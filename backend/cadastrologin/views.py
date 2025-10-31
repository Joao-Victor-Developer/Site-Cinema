from rest_framework import viewsets
from rest_framework.response import Response
from rest_framework.decorators import api_view
from .models import Usuario
from .serializers import UsuarioSerializer
from django.contrib.auth.hashers import make_password, check_password

class UsuarioViewSet(viewsets.ModelViewSet):
    queryset = Usuario.objects.all()
    serializer_class = UsuarioSerializer

@api_view(['POST'])
def login(request):
    email = request.data.get('email')
    senha = request.data.get('senha')

    if email is None or senha is None:
        return Response({"erro": "Email e senha são obrigatórios"}, status=400)

    senha = str(senha).strip()  # remove espaços

    try:
        usuario = Usuario.objects.get(email=email)
    except Usuario.DoesNotExist:
        return Response({"erro": "Usuário não encontrado"}, status=404)

    if check_password(senha, usuario.senha):
        return Response({"mensagem": "Login efetuado!", "usuario": usuario.nickname})
    else:
        return Response({"erro": "Senha incorreta"}, status=401)