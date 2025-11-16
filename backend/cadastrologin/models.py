from django.db import models

class Usuario(models.Model):
    ID_Usuario = models.AutoField(primary_key=True)
    nome = models.CharField(max_length=100)
    email = models.EmailField()
    senha = models.CharField(max_length=128)
    nickname = models.CharField(max_length=50)

    def __str__(self):
        return self.nome