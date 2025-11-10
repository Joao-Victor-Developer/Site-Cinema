from django.db import models

# Create your models here.
from django.db import models
from django.contrib.auth.models import User
from django.utils import timezone

class Grupo(models.Model):
    nome = models.CharField(max_length=100)
    descricao = models.TextField(blank=True)
    criador = models.ForeignKey(User, on_delete=models.CASCADE)
    data_criacao = models.DateTimeField(auto_now_add=True)
    membros = models.ManyToManyField(User, related_name='grupos', blank=True)
    
    def __str__(self):
        return self.nome
    
    def pode_excluir(self, usuario):
        """Verifica se o usuário tem permissão para excluir o grupo"""
        return usuario == self.criador or usuario.is_superuser
    
    class Meta:
        ordering = ['-data_criacao']

class Mensagem(models.Model):
    grupo = models.ForeignKey(Grupo, on_delete=models.CASCADE, related_name='mensagens')
    autor = models.ForeignKey(User, on_delete=models.CASCADE)
    conteudo = models.TextField()
    data_envio = models.DateTimeField(auto_now_add=True)
    
    def __str__(self):
        return f"{self.autor.username} - {self.grupo.nome}"
    
    class Meta:
        ordering = ['data_envio']