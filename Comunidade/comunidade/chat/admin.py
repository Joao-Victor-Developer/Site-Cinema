from django.contrib import admin

# Register your models here.
from django.contrib import admin
from .models import Grupo, Mensagem

@admin.register(Grupo)
class GrupoAdmin(admin.ModelAdmin):
    list_display = ['nome', 'criador', 'data_criacao']
    search_fields = ['nome']

@admin.register(Mensagem)
class MensagemAdmin(admin.ModelAdmin):
    list_display = ['autor', 'grupo', 'data_envio']
    list_filter = ['grupo', 'data_envio']